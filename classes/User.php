<?php

require_once 'Image.php';

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
     * @function name: getUserInfo
     *
     *    This function gets information about a user.
     *
     * @usage example: $db_object->getUserInfo('503');
     *
     * @param int $user_id
     * @return array()
     */
    public function getUserInfo($user_id)
    {
        $stmt = $this->connection-prepare('call GetUserInfo(?)');
        $stmt->bindParam(1,$user_id);

        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            echo $e->getMessage();
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
	public function newUser($username, $password,$email,$country)
	{
		$stmt = $this->connection->prepare('call NewUser(?,?,?,?)');
		$stmt->bindParam(1,$username);
		$stmt->bindParam(2,$password);
        $stmt->bindParam(3,$email);
        $stmt->bindParam(4,$country);

		try {
			$stmt->execute();
			return true;

		} catch (PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}

    public function updateUser($uid,$username,$password,$email,$title,$description,$country)
    {
        $stmt = $this->connection->prepare('call UpdateUserInfo(?,?,?,?,?,?,?)');
        $stmt->bindParam(1,$uid);
        $stmt->bindParam(2,$username);
        $stmt->bindParam(3,$password);
        $stmt->bindParam(4,$email);
        $stmt->bindParam(5,$title);
        $stmt->bindParam(6,$description);
        $stmt->bindParam(7,$country);

        try {
            $stmt->execute();
            header("Location: $_SERVER[HTTP_REFERERER]");

        } catch (PDOException $e) {
            echo $e->getMessage();
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