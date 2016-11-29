<?php

class Question
{
	private $connection;

	public function __construct($connection)
	{
		if (!empty($connection)) {
            $this->connection = $connection;
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
	public function newQuestion($title,$text,$tags)
	{
        // Set spurninguna í gagnagrunninn
		$stmt = $this->connection->prepare('call NewQuestion(?,?,?)');
		$stmt->bindParam(1,$title);
		$stmt->bindParam(2,$text);
		$stmt->bindParam(3,$_SESSION['uid']);

		try {
			// Býr til spurninguna
			$stmt->execute();

			$stmt = $this->connection->prepare('call GetLatestQuestionByUserID(?)');
			$stmt->bindParam(1,$_SESSION['uid']);

			try {
				// Sækir ID-ið á nýju spurningunni
				$stmt->execute();
				$question_id = $stmt->fetch(PDO::FETCH_ASSOC)['id'];

                // Set tögin (tags) í gagnagrunninn
                $tags = explode(',', str_replace(' ', '', $tags)); // Breyti breytunni í fylki

                foreach ($tags as $tag) {
                    // Næ í ID-ið á taginu
                    $stmt = $this->connection->prepare('call GetIDByTagName(?)');
                    $stmt->bindParam(1,$tag);

                    try {
                        $stmt->execute();
                        $tagID = $stmt->fetch(PDO::FETCH_ASSOC)['id'];
                    } catch (PDOException $e) {
                        echo $e->getMessage();
                    }

                    // Set tagið í gagnagrunninn
                    $stmt = $this->connection->prepare('call NewTag(?,?,?)');
                    $stmt->bindParam(1, $question_id);
                    $stmt->bindParam(2, $tagID);
                    $stmt->bindParam(3, $_SESSION['uid']);

                    // Redirect-ar notandann á nýju spurninguna
                    header("Location: showquestion.php?qid=" . $question_id);
                    try {
                        $stmt->execute();
                    } catch(PDOException $e) {
                        echo $e->getMessage();
                    }
                }

			} catch (PDOException $e) {
				echo $e->getMessage();
			}

		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

    public function newQuestionVote($question_id,$vote)
    {
        $stmt = $this->connection->prepare('call NewQuestionVote(?,?,?)');
        $stmt->bindParam(1,$question_id);
        $stmt->bindParam(2,$vote);
        $stmt->bindParam(3,$_SESSION['uid']);

        try {
            $stmt->execute();
            header("Location: $_SERVER[HTTP_REFERERER]");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
	}

    public function getQuestionScore($question_id)
    {
        $stmt = $this->connection->prepare('call GetQuestionScore(?)');
        $stmt->bindParam(1,$question_id);

        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC)['score'];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
	}

    public function getQuestionViews($question_id)
    {
        $stmt = $this->connection->prepare('call GetQuestionViews(?)');
        $stmt->bindParam(1,$question_id);

        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC)['views'];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
	}

    public function getLatestComment($question_id)
    {
        $stmt = $this->connection->prepare('call GetLatestComment(?)');
        $stmt->bindParam(1,$question_id);

        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
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

    public function getAllQuestions($sort)
    {
        $stmt = $this->connection->prepare('call GetAllQuestions(?)');
        $stmt->bindParam(1,$sort);

        try {
            $stmt->execute();
            return $stmt->fetchAll();

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
	}

    public function getQuestionsByTag($tag)
    {
        $stmt = $this->connection->prepare('call GetQuestionByTagID(?)');
        $stmt->bindParam(1,$tag);

        try {
            $stmt->execute();
            return $stmt->fetchAll();

        } catch (PDOException $e) {
            echo $e->getMessage();
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
		$stmt = $this->connection->prepare('call GetQuestionTag(?)');
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