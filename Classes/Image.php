<?php

class Image
{
    private $connection;        // Connection to the database
    protected $destination;     // Path to the image folder on the server
    protected $maxSize = 51200; // Max file size
    protected $messages = [];   // Messages to output after executing a function
    protected $permittedFileTypes = ['image/gif', 'image/jpeg', 'image/pjpeg', 'image/png']; // Allowed file types

    public function __construct($path,$connection)
    {
        if (!empty($connection)) {
            $this->connection = $connection;
        }
        if (!is_dir($path) || !is_writable($path)) {
            throw new Exception("$path must be a valid/writable directory.");
        }
        $this->destination = $path;
    }

    protected function checkSize($file) {
        // error 1 and 2 indicate that the file is bigger than the maximum allowed file size.
        if ($file['error'] == 1 || $file['error'] == 2) {
            return false;
        } else if ($file['size'] == 0) {
            $this->messages[] = $file['name'] . ' is an empty file.';
            return false;
        } else if ($file['size'] > $this->maxSize) {
            $this->messages[] = $file['name'] . ' exceeds the maximum size for a file ($this->getMaxSize()).';
            return false;
        }
        
        return true;
    }

    protected function checkFileType($file) {
        if (in_array($file['type'], $this->permittedFileTypes)) {
            return true;
        } else {
            $this->messages[] = $file['name'] . ' is not a permitted type of file.';
            return false;
        }
    }

    protected function checkFile($file) {
        if ($file['error'] != 0) {
            $this->getErrorMessage($file);
            if ($file['error'] == 4) {
                return false;
            }
        }
        if (!$this->checkSize($file) || !$this->checkFileType($file)) {
            return false;
        }
        return true;
    }

    protected function checkFileExists($file) {
        return file_exists('img/' . $file);
    }

    protected function moveFile($file,$path) {
        $name = str_replace(' ', '_', $path);
        $success = move_uploaded_file($file['tmp_name'], $this->destination . $path);

        if ($success) {
            $this->messages[] = $file['name'] . ' was uploaded successfully';
        } else {
            $this->messages[] = 'Could not upload ' . $file['name'];
        }
    }

    public function getMessages() {
        return $this->messages;
    }

    public function getMaxSize() {
        return number_format($this->maxSize/1024, 1) . ' KB';
    }

    protected function insertIntoDatabase($path,$size,$type) {
        $path = str_replace(' ', '_', $path);
        $stmt = $this->connection->prepare('call UpdateProfilePicture(?,?,?,?)');
        $stmt->bindParam(1,$path);
        $stmt->bindParam(2,$size);
        $stmt->bindParam(3,$type);
        $stmt->bindParam(4,$_SESSION['uid']);

        try {
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function upload() {
        $uploaded = current($_FILES);
        $path = $uploaded['name'];
        $path = str_replace(' ', '_', $path);
        $type = explode('/', $uploaded['type'])[1];
        $size = $uploaded['size'];

        if ($this->checkFileExists($path)) {
            $path = sha1(time().$path) . '.' . $type;
        }

        if (!$this->checkFile($uploaded)) {
            $this->messages[] = "An unknown error occurred";
        } else {
            $this->moveFile($uploaded,$path);
            $this->insertIntoDatabase($path,$size,$uploaded['type']);
        }
    }
}