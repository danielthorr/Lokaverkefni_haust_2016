<?php

require_once '/Includes/connection.php';
require_once '/Classes/Image.php';
require_once '/Classes/Users.php';
session_start();
$action=$_GET['action'];
$max = 51200;
$destination = $_SERVER['DOCUMENT_ROOT'] . "/2t/3010982789/lokaverkefni_haust_2016/Images/";
$image = new Image($destination, $connection);
$user = new User($connection); // Bý til nýtt object af User klasanum

switch($action) {

    case 'signup':
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Athuga hvort emailið sé gilt.
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: Index.php?error=invalid_email");
        }

        // Bý til nýjan notanda og set hann í gagnagrunninn
        if ($user->newUser("Example", "User", $email, $username, $password, '1')) {
            header("Location: Index.php");
        }

        break;

    case 'login':
        $userInfo = $user->loginValidation($_POST['username'], $_POST['password']); // Athuga hvort notandi sé til, ef svo þá næ ég í upplýsingar um hann.
        $userExists = count($userInfo) != 1; // Ef stærðin á $userInfo array-inu er '1' þá er notandinn ekki til eða notandinn sló inn vitlaust username/password.

        if ($userExists) {
            $_SESSION['uid'] = $userInfo[0]; // User ID
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['start'] = time(); // Skeiðklukka sem byrjar þegar notandinn skráir sig inn til að vita hve lengi notandinn er búinn að vera skráður inn.
            header("Location: profile.php");
        } else {
            header("Location: Index.php?error=wrong_login_credentials");
        }
        break;

    case 'logout':
        $_SESSION = []; // Eyði öllu úr $_SESSION arrayinu
        header("Location: Index.php");
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
        $user->updateUser($_SESSION['uid'], $_POST['email'], $_POST['username'], $_POST['description']);
        break;
}