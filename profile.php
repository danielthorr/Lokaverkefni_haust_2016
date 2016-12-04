<?php

session_start();

require_once 'Includes/connection.php';
require_once 'classes/User.php';

$user = new User($connection);

$u = $user->getUserInfo($_GET['uid']);

?>

<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title><?= $u['username']; ?>'s profile</title>
	<link rel="stylesheet" href="Resources/CSS/mainpage.css">

</head>
<body>
    <header>
        <!-- Create a menu system inside these header tags -->
        <?php include 'Includes/header-menu.php'; ?>
    </header>

    <!-- Hidden login and sign up which will only be revealed if the user clicks on the login or sign up buttons -->
    <?php if (!isset($_SESSION['uid'])) {
        include 'Includes/login-form.php';
        include 'Includes/signup-form.php';
    }?>
	
	<!-- Possible add a banner type message at the top before we show the main content -->
	<?php include 'Includes/top-banner.php'; ?>

	<!-- Almost everything on the page should go into the mainContainer, except pop-ups, menus, footers, etc. This tag should contain the main content on the page 	-->
	<main class="mainContainer">
		<section class="mainSection" style="width:100%;">
			<!-- The mainSection tag contains everything on the main area of the webpage, things that we want to the user to focus on. Other things, such as links and navigation, additional and/or useful information should go into the sidebar tags -->
			<section class="profileArea">
			
	        <?php if (isset($_GET['settings']) && $_GET['settings'] == true && isset($_SESSION['uid']) && $_GET['uid'] == $_SESSION['uid']): ?>
				<aside class="profileInfo">
					<!-- needs to fix image tag to center the image -->
					<div class="imageContainer">
						<img src="https://placeholdit.imgix.net/~text?txtsize=33&txt=350%C3%97150&w=350&h=150"/>
					</div>
					<div class="uploadImg">
						<label for="profileImage">Change profile picture:</label>
						<input type="file" name="profileImage" form="accountSettings" accept="image/*" />
					</div>
                    <p class="infoText">Username: <?= $u['username']; ?></p>
                    <p class="infoText">Email: <?= $u['email']; ?></p>
                    <p class="infoText">Member since: <?= explode(' ', $u['join_date'])[0]; ?></p>
				</aside>
				
				<hr class="seperate">
				
				<section class="profileMain">
                    <form name="accountSettings" action="process.php?action=editUserInfo" method="post">
						<p class="profileTextLabel">Name</p>
						<input class="profileText edit" type="text" name="realName" value="<?= $u['realName']; ?>"/>
						<hr>
						<p class="profileTextLabel">Email</p>
						<input class="profileText edit" type="email" name="email" value="<?= $u['email']; ?>"/>
						<hr>
						<p class="profileTextLabel">Title</p>
						<input class="profileText edit" type="text" name="title" value="<?= $u['title']; ?>"/>
						<hr>
						<p class="profileTextLabel">Country</p>
						<input class="profileText edit" type="text" name="country" value="<?= $u['country']; ?>"/>
						<hr>
						<p class="profileTextLabel">Description</p>
						<textarea class="profileText edit" name="description"><?= $u['description']; ?></textarea>
						<input type="submit" name="submit" value="Save changes" />
					</form>
				</section>

            <?php else: ?>
				<aside class="profileInfo">
					<!-- needs to fix image tag to center the image -->
					<div class="imageContainer">
						<img src="https://placeholdit.imgix.net/~text?txtsize=33&txt=350%C3%97150&w=350&h=150"/>
					</div>
					<p class="infoText">Username: <?= $u['username']; ?></p>
					<p class="infoText">Email: <?= $u['email']; ?></p>
					<p class="infoText">Member since: <?= explode(' ', $u['join_date'])[0]; ?></p>
				</aside>
				
				<hr class="seperate">
				
				<section class="profileMain">
                    <?php if (isset($_SESSION['uid']) && $_SESSION['uid'] == $_GET['uid']): ?>
					    <a href="profile.php?uid=<?= $_GET['uid']; ?>&settings=true">Edit settings</a><!-- We only want to show the 'Edit settings' option if the user that is logged in is the owner of this profile-->
                    <?php endif; ?>
					<p class="profileTextLabel">Name</p>
					<p class="profileText"><?= $u['realName']; ?></p>
					<hr>
					<p class="profileTextLabel">Title</p>
					<p class="profileText"><?= $u['title']; ?></p>
					<hr>
					<p class="profileTextLabel">Country</p>
					<p class="profileText"><?= $u['country']; ?></p>
					<hr>
					<p class="profileTextLabel">Description</p>
					<p class="profileText"><?= $u['description']; ?></p>
				</section>
            <?php endif; ?>
	
			</section>
		</section>		
	</main>

	<footer>
		<!-- Footer contains some useful information. It can contain links and navigation such as emails, opening times (for a company), date of creation or last edit on the website and other resources that we don't need the attention other elements on the site recieve. -->
		<p>
			What a footer, you blow my mind!
		</p>
	</footer>

<!-- Below this mark should be nothing but extra resources for website functionality. The user will never get to see anything displayed beneath this comment. -->
<script type="text/javascript" src="Resources/javascript/jquery-2.2.0.js"></script>
<script type="text/javascript" src="Resources/javascript/testScript.js"></script>
</body>
</html>