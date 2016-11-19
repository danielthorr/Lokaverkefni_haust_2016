<?php

require_once 'Classes/Image.php';
session_start();

class User
{
    // Connection to the database
	private $connection;

	public function __construct($connection_name)
	{
		if(!empty($connection_name)) {
			$this->connection = $connection_name;
		} else {
			throw new Exception("Could not connect to database");
		}
	}

    /**
     * @function name: newUser
     *
     *    This function creates a new user and inserts them into the database
     *
     * @usage example: $db_object->newUser('example_username', 'example_password');
     *
     * @param varchar $username
     * @param varchar $password
     * @return bool
     */
	public function newUser($username, $password)
	{
		$stmt = $this->connection->prepare('call NewUser(?,?)');
		$stmt->bindParam(1,$username);
		$stmt->bindParam(2,$password);

		try {
			$stmt->execute();
			return true;

		} catch (PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}

    /**
     * @function name: loginValidation
     *
     *    This function check whether a user with a given username and password exists in the database, and if so, returns information about him.
     *
     * @usage example: $db_object->loginValidation('example_username', 'example_password');
     *
     * @param varchar $username
     * @param varchar $password
     * @return array
     */
	public function loginValidation($username, $password)
	{
		$stmt = $this->connection->prepare('call LoginValidation(?,?)');
		$stmt->bindParam(1,$username);
		$stmt->bindParam(2,$password);

		try {
			$stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC);

		} catch (PDOException $e) {
			echo $e->getMessage();
			return array();
		}
	}

	public function updateProfilePicture($destination) {
        $image = new Image($destination,$this->connection);

        try {
            $image->upload();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}