<?php

// Includes
require_once 'Includes/connection.php';
require_once 'Classes/Image.php';
require_once 'classes/User.php';
require_once 'Classes/Question.php';
require_once 'Classes/Tag.php';
require_once 'Classes/Comment.php';

session_start();

$action=$_GET['action'];
$max = 51200;
$destination = $_SERVER['DOCUMENT_ROOT'] . "/2t/3010982789/lokaverkefni_haust_2016/Images/";

// Class objects
$image = new Image($destination, $connection);
$user = new User($connection); // Bý til nýtt object af User klasanum
$question = new Question($connection);
$comment = new Comment($connection);

switch($action) {

    case 'newQuestion':
        $title = $_POST['title'];
        $text = $_POST['text'];
        $tags = $_POST['tags'];

        $question->newQuestion($title,$text,$tags);
        break;

    case 'newQuestionVote':
        $question_id = $_POST['question_id'];
        $vote = $_POST['vote'];

        $question->newQuestionVote($question_id,$vote);
        break;

    case 'newComment':
        $text = $_POST['text'];
        $question_id = $_POST['question_id'];

        $comment->newComment($text, $question_id);
        break;

    case 'newCommentVote':
        $comment_id = $_POST['question_id'];
        $vote = $_POST['vote'];

        $comment->newCommentVote($comment_id,$vote);
        break;

    case 'newSubComment':
        $text = $_POST['text'];
        $comment_id = $_POST['comment_id'];

        $comment->newSubComment($text,$comment_id);
        break;

    case 'newSubCommentVote':
        $comment_id = $_POST['comment_id'];
        $vote = $_POST['vote'];

        $comment->newSubCommentVote($comment_id,$vote);
        break;

    // Þegar notandi leitar eftir ákveðnum tögum.
    case 'searchTag':
        $tag = str_replace(', ', ',', $_POST['tag']);
        header("Location: index.php?tag=$tag");

        break;

    case 'signup':
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        // Athuga hvort emailið sé gilt.
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: Index.php?error=invalid_email");
        }

        // Bý til nýjan notanda og set hann í gagnagrunninn
        if ($user->newUser($username, $password, $email)) {
            header("Location: Index.php");
        }

        break;

    case 'login':
        $userInfo = $user->validateUser($_POST['username'], $_POST['password']); // Athuga hvort notandi sé til, ef svo þá næ ég í upplýsingar um hann.
        $userExists = count($userInfo) != 0; // Ef stærðin á $userInfo array-inu er '1' þá er notandinn ekki til eða notandinn sló inn vitlaust username/password.
        if ($userExists) {
            $_SESSION['uid'] = $userInfo['id']; // User ID
            $_SESSION['username'] = $_POST['username'];
            if (isset($_SERVER['HTTP_REFERERER'])) {
                header("Location: " . $_SERVER['HTTP_REFERERER']);
            } else {
                header("Location: index.php");
            }
        }
        break;

    case 'logout':
        $_SESSION = []; // Eyði öllu úr $_SESSION arrayinu
        if (isset($_SERVER['HTTP_REFERERER'])) {
            header("Location: " . $_SERVER['HTTP_REFERERER']);
        } else {
            header("Location: index.php");
        }
        break;

    case 'updateProfilePicture':
        if (isset($_POST['upload'])) {

            try {
                $user->updateProfilePicture($destination);
                header("Location: $_SERVER[HTTP_REFERERER]");
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        break;

    case 'editUserInfo':
        $user->updateUser($_SESSION['uid'], $_POST['realName'], $_POST['email'], $_POST['title'], $_POST['description'], $_POST['country']);
        break;
}