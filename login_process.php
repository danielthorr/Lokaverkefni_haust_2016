<?php
session_start();

require_once 'Includes/connection.php';
require_once 'Classes/User.php';

$user = new User($connection);

$userInfo = $user->validateUser($_POST['username'], $_POST['password']); // Athuga hvort notandi sé til, ef svo þá næ ég í upplýsingar um hann.
$userExists = count($userInfo) != 0; // Ef stærðin á $userInfo array-inu er '0' þá er notandinn ekki til eða notandinn sló inn vitlaust username/password.
if ($userExists) {
    echo 'true';
    $_SESSION['uid'] = $userInfo['id']; // User ID
    $_SESSION['username'] = $userInfo['username'];
    //header("Location: profile.php");
} else {
    echo 'false';
}