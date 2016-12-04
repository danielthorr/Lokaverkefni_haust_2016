<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
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
			
	<!-- <php if ($_GET[settings] == true && $_GET[$page_user] == $_SESSION[user]) { -->
			
			<!-- If $_GET is used we need to make sure that the user who is logged in is the same as the owner of the profile --
			
				<aside class="profileInfo">
					<!-- needs to fix image tag to center the image --
					<div class="imageContainer">
						<img src="https://placeholdit.imgix.net/~text?txtsize=33&txt=350%C3%97150&w=350&h=150"/>
					</div>
					<div class="uploadImg">
						<label for="profileImage">Change profile picture:</label>
						<input type="file" name="profileImage" form="accountSettings" accept="image/*" />
					</div>
					<p class="infoText">username</p>
					<p class="infoText">accountCreated?</p>
					<p class="infoText">lastActive?</p>
					<p class="infoText">moreInfo?</p>
				</aside>
				
				<hr class="seperate">
				
				<section class="profileMain">
					<form name="accountSettings" action="profile.php?userID=$uid">
						<p class="profileTextLabel">Name</p>
						<input class="profileText edit" type="text" name="fullName" value="$fullName"/>
						<hr>
						<p class="profileTextLabel">Email</p>
						<input class="profileText edit" type="email" name="email" value="$email"/>
						<hr>
						<p class="profileTextLabel">Title</p>
						<input class="profileText edit" type="text" name="title" value="$title"/>
						<hr>
						<p class="profileTextLabel">Country</p>
						<input class="profileText edit" type="text" name="country" value="$country"/>
						<hr>
						<p class="profileTextLabel">Description</p>
						<textarea class="profileText edit" name="description" form="accountSettings">$description
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed molestie eros sed leo bibendum laoreet. Ut vel diam id est aliquam euismod. Duis auctor massa sit amet eros lobortis, quis mattis quam rhoncus. Praesent rutrum ante neque, id rhoncus elit mollis eget. Phasellus at tincidunt lectus. Donec feugiat tincidunt ex ut placerat. In et velit nec libero facilisis lobortis</textarea>
						<input type="submit" name="submit" value="Save changes" />
					</form>
				</section> -->
				
				
	<!-- } else  { 
				
				-->
				<aside class="profileInfo">
					<!-- needs to fix image tag to center the image -->
					<div class="imageContainer">
						<img src="https://placeholdit.imgix.net/~text?txtsize=33&txt=350%C3%97150&w=350&h=150"/>
					</div>
					<p class="infoText">username</p>
					<p class="infoText">email</p>
					<p class="infoText">accountCreated?</p>
					<p class="infoText">lastActive?</p>
					<p class="infoText">moreInfo?</p>
				</aside>
				
				<hr class="seperate">
				
				<section class="profileMain">
					<!-- <php if (isset(user) && userid == $_GET[userid]) { -->
					<a href="profile.php?userid=$uid&settings=true">Edit settings</a><!-- We only want to show the 'Edit settings' option if the user that is logged in is the owner of this profile-->
					<!-- } -->
					<p class="profileTextLabel">Name</p>
					<p class="profileText">Daníel Þór Þórisson</p>
					<hr>
					<p class="profileTextLabel">Title</p>
					<p class="profileText">Nemandi í Tækniskólanum</p>
					<hr>
					<p class="profileTextLabel">Country</p>
					<p class="profileText">Ísland</p>
					<hr>
					<p class="profileTextLabel">Description</p>
					<p class="profileText">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed molestie eros sed leo bibendum laoreet. Ut vel diam id est aliquam euismod. Duis auctor massa sit amet eros lobortis, quis mattis quam rhoncus. Praesent rutrum ante neque, id rhoncus elit mollis eget. Phasellus at tincidunt lectus. Donec feugiat tincidunt ex ut placerat. In et velit nec libero facilisis lobortis</p>
				</section>
	<!-- } end -->
	
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