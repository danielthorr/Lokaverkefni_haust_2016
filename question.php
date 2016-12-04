<?php

session_start();

?>

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
		<section class="mainSection">
			<!-- The mainSection tag contains everything on the main area of the webpage, things that we want to the user to focus on. Other things, such as links and navigation, additional and/or useful information should go into the sidebar tags -->
			<div class="sectionArea">
				
				<!-- use php to load this dynamically  -->
				<!-- QACard: Question/Answer card -->
				<section class="QACard">
					<section class="QAInfo">
						<div class="votes">
							<img src="Resources/icons/upvote.png" width="40px" height="auto" />
							<p>numberOfUpvotes</p>
							<img src="Resources/icons/downvote.png" width="40px" height="auto" />
						</div>
                        <p>user rank</p>
                        <p>post count</p>
						<p>dateAdded</p>
						<p>dateModified</p>
						<p>username</p>
						<p>join date</p>
					</section>
					<section class="QAMain">
						<p class="QTitle">This is the title</p>
						<p class="QAText">This is the main text area. </p>
						<div class="QTags">
							<a href="#">Tag1</a>
							<a href="#">Tag2</a>
							<a href="#">Tag3</a>
						</div>
					</section>
				</section>

                <section class="QACard">
                    <section class="QAInfo">
						<div class="votes">
							<img src="Resources/icons/upvote.png" width="40px" height="auto" />
							<p>numberOfUpvotes</p>
							<img src="Resources/icons/downvote.png" width="40px" height="auto" />
						</div>
                        <p>user rank</p>
                        <p>post count</p>
                        <p>dateAdded</p>
                        <p>dateModified</p>
                        <p>username</p>
                        <p>join date</p>
                    </section>
                    <section class="QAMain">
                        <p class="QAText">Dæmi um comment</p>
                    </section>
                </section>
				
			</div>
		</section>
		
		<aside class="sidebar">
			<!-- The sidebar sits next to the mainSection and can provide lots of useful features for the user.	Everything from navigation and links, additional information or other things the user might be looking for while browsing. -->
			<p>
				Sidebar section
			</p>
		</aside>
		
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