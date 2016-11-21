<?php

class Tag
{
    private $connection;

    public function __construct($connection)
    {
        if (!empty($connection)) {
            $this->connection = $connection;
        } else {
            throw new Exception("Cannot connect to the database.");
        }
    }

    public function getQuestions($tag)
    {
        $tag = explode(',', str_replace(', ', ',', $tag)); // Breyti $tags úr string yfir í array().

        $stmt = $this->connection-prepare('call GetQuestionIDByTag(?)');
        $stmt->bindParam(1,$tag);

        try {
            // Sæki öll ID á spurningum sem eru með ID í $tag og set þau í array().
            $stmt->execute();
            $question_id = implode(',', $stmt->fetchAll());

            $stmt = $this->connection->prepare('call GetQuestionByID(?)');
            $stmt->bindParam(1,$question_id);

            try {
                // Sæki upplýsingar um allar spurningar sem eru með ID í $tag
                $stmt->execute();
                return $stmt->fetchAll();

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}