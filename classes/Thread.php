<?php

class Thread
{
	private $connection;

	public function __construct($connection_name)
	{
		if (!empty($connection_name)) {
			$connection = $connection_name;
		} else {
			throw new Exception("Can't connect to database");
		}
	}

	/**
	*	@function name: getComments
	*
	*	This function gets all comments in a specific question
	*
	* @usage example: $db_object->getComments('503');
	*
	* @param questionID int
	*
	* @returns array()
	*/
	public function getComments($questionID)
	{
		$stmt = $this->connection->prepare('call GetQuestionComments(?)');
		$stmt->bindParam(1,$questionID);

		try {
			$stmt->execute();
			return $stmt->fetchAll();
			
		} catch (PDOException $e) {
			echo $e->getMessage();
			return array();
		}
	}

	/**
	*	@function name: getQuestionTags
	*
	*	This function gets all tags on a specific question
	*
	* @usage example: $db_object->getQuestionTags('253');
	*
	* @param questionID int
	*
	* @returns array()
	*/
	public function getQuestionTags($questionID)
	{
		$stmt = $this->connection->prepare('call GetQuestionTags(?)');
		$stmt->bindParam(1,$questionID);

		try {
			$stmt->execute();
			return $stmt->fetchAll();

		} catch (PDOException $e) {
			echo e->getMessage();
			return array();
		}
	}
}