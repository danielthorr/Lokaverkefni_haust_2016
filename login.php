<?php
    session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<div class="loginform-in">
    <h1>User Login</h1>
    <div class="err" id="login-error"></div>
    <fieldset>
        <form action="process.php?action=login" id="loginform-in" method="post">
            <h1><?php if (isset($_SESSION['uid'])) { echo $_SESSION['username']; } ?></h1>
            <ul>
                <li> <label for="name">Username </label>
                    <input type="text" size="30"  name="username" id="username"  /></li>
                <li> <label for="name">Password</label>
                    <input type="password" size="30"  name="password" id="password"  /></li>
                <li> <label></label>
                    <input type="submit" id="login" name="login" value="Login" class="loginbutton" ></li>
            </ul>
        </form>
    </fieldset>
</div>

<script type="text/javascript" src="jQuery/jquery-2.2.0.js"></script>
</body>
</html>