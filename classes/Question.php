<?php

session_start();

class Question
{
	private $connection;

	public function __construct($connection_name)
	{
		if (!empty($connection_name)) {
            $this->connection = $connection_name;
		} else {
			throw new Exception("Can't connect to database");
		}
	}

    /**
     * @function name: newQuestion
     *
     *    This function creates a new question, gets the ID of the new question and redirects the user to showquestion.php
     *
     * @usage example: $db_object->newQuestion('Need help with jQuery', 'How do i get the value of an html input textbox by ID?', '13054');
     *
     * @param varchar $title
     * @param varchar $text
     * @param int $author_id
     * @return none
     */
	public function newQuestion($title,$text,$author_id)
	{
		$stmt = $this->connection->prepare('call NewQuestion(?,?,?)');
		$stmt->bindParam(1,$title);
		$stmt->bindParam(2,$text);
		$stmt->bindParam(3,$author_id);

		try {
			// Býr til spurninguna
			$stmt->execute();

			$stmt = $this->connection->prepare('call GetLatestThreadByUserID(?)');
			$stmt->bindParam(1,$_SESSION['uid']);

			try {
				// Sækir ID-ið á nýju spurningunni
				$stmt->execute();

				$question_id = $stmt->fetch(PDO::FETCH_ASSOC);
				
				// Redirect-ar notandann á nýju spurninguna
				header("Location: showquestion.php?qid=" . $question_id);

			} catch (PDOException $e) {
				echo $e->getMessage();
			}

		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

    /**
     * @function name: getComments
     *
     *    This function gets all comments in a specific question
     *
     * @usage example: $db_object->getComments('503');
     *
     * @param int $question_id
     * @return array
     */
	public function getComments($question_id)
	{
		$stmt = $this->connection->prepare('call GetQuestionComments(?)');
		$stmt->bindParam(1,$question_id);

		try {
			$stmt->execute();
			return $stmt->fetchAll();
			
		} catch (PDOException $e) {
			echo $e->getMessage();
			return array();
		}
	}

    /**
     * @function name: getQuestionTags
     *
     *    This function gets all tags on a specific question
     *
     * @usage example: $db_object->getQuestionTags('253');
     *
     * @param int $question_id
     * @return array
     */
	public function getQuestionTags($question_id)
	{
		$stmt = $this->connection->prepare('call GetQuestionTags(?)');
		$stmt->bindParam(1,$question_id);

		try {
			$stmt->execute();
			return $stmt->fetchAll();

		} catch (PDOException $e) {
			echo $e->getMessage();
			return array();
		}
	}
}