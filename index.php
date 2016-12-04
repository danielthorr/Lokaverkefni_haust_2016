<?php

session_start();

require_once 'Includes/connection.php';
require_once 'classes/Question.php';
require_once 'classes/Tag.php';

$question = new Question($connection);
$tag = new Tag($connection);

if (isset($_GET['tag'])) {
    $questions = $question->getQuestionsByTag($_GET['tag']);
} else {
    $questions = $question->getAllQuestions('newest');
}

?>

<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Lokaverkefni haust 2016</title>
	<link rel="stylesheet" href="Resources/CSS/mainpage.css">

</head>
<body>
	<header>
		<!-- Create a menu system inside these header tags -->
		<ul class="menubar">
			<div class="first">
				<li><a href="index.php">Home</a></li>
				<li><a href="#">Categories</a></li>
			</div>
			<div class="last">
                <?php if (!isset($_SESSION['uid'])): ?>
				    <li id="login"><a href="#">Log in</a></li>
                    <li><a id="signup" href="#">Sign up</a></li>
                <?php else: ?>
                    <li><a href="process.php?action=logout">Log out</a></li>
                <?php endif; ?>
			</div>
		</ul>
	</header>
	
	<!-- Hidden login and sign up which will only be revealed if the user clicks on the login or sign up buttons -->
	<section class="logIn" style="top: -217px;">
		<form action="process.php?action=login" method="post">
			<!-- image for the close button in the top right corner -->
			<img style="position:absolute; top:8px; right:10px; cursor:pointer;" src="Resources/icons/close.png" height="14px" width="14px" />
			
			<label for="username">Username:</label>
			<input name="username" type="text" />
			
			<label for="password">Password:</label>
			<input name="password" type="password" />
			
			<input name="submit" type="submit" value="Log in" />
		</form>
	</section>
	
	<section class="signUp" style="position:absolute;">
		<form action="process.php?action=signup" method="post">
			<!-- image for the close button in the top right corner -->
			<img style="position:absolute; top:8px; right:10px; cursor:pointer;" src="Resources/icons/close.png" height="14px" width="14px" />
			
			<label for="username">Username:</label>
			<input name="username" type="text" />
			
			<label for="email">Email:</label>
			<input name="email" type="email" />
			
			<label for="password">Password:</label>
			<input name="password" type="password" />
			
			<label for="password2">Re-type password:</label>
			<input name="password2" type="password" />
			
			<input name="submit" type="submit" value="Log in" />
		</form>
	</section>
	
	
	
	<!-- Possible add a banner type message at the top before we show the main content -->
	<div class="banner"><p>Some banner message or image</p></div>

	<!-- Almost everything on the page should go into the mainContainer, except pop-ups, menus, footers, etc. This tag should contain the main content on the page 	-->
	<main class="mainContainer">
		<section class="mainSection">
			<!-- The mainSection tag contains everything on the main area of the webpage, things that we want to the user to focus on. Other things, such as links and navigation, additional and/or useful information should go into the sidebar tags -->
			
			<div class="orderTabs">
				<ul>
					<li class="active">Newest</li>
					<li>Top: 24hrs</li>
					<li>Top: Week</li>
					<li>Top: Month</li>
					<li>Top: 6 Months</li>
					<li>Top: All time</li>
				</ul>
			</div>
			
			<div class="sectionArea">
			
				<?php if (isset($_SESSION['uid'])): ?>
                    <div class="askQuestionBtn">
                        <a href="askQuestion.html">Ask a question</a>
                    </div>
                <?php endif; ?>

                <?php if (count($questions) != 0): ?>
                    <?php foreach ($questions as $q): ?>
                        <?php
                        $latestAnswer = $question->getLatestComment($q['id']);
                        $upvotes = $question->getQuestionScore($q['id']);
                        $answers = count($question->getComments($q['id']));
                        $tags = $question->getQuestionTags($q['id']);
                        $views = $question->getQuestionViews($q['id']);
                        ?>

                        <article class="qOverview">

                            <div class="qOverviewInfo">
                                <div class="qOverviewInfoDates">
                                    <p>Date posted: <?= $q['post_date']; ?></p>
                                    <?php if ($latestAnswer != array()): ?>
                                        <p>Last Answer: <?= $latestAnswer['post_date'] . " by <a href=profile.php?uid=$latestAnswer[uid]>" . $latestAnswer['username'] . "</a>"; ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="qOverviewInfoBoxes">
                                    <div>
                                        <p><?= $upvotes; ?></p>
                                        <p>Upvotes</p>
                                    </div>
                                    <div>
                                        <p><?= $answers; ?></p>
                                        <p>Answers</p>
                                    </div>
                                    <div>
                                        <p><?= $views; ?></p>
                                        <p>Views</p>
                                    </div>
                                </div>
                            </div>

                            <div class="qOverviewSection">
                                <p class="qOverviewSectionName"><a href="question.php?qid=<?= $q['id']; ?>"><?= $q['title']; ?></a></p>
                                <div class="qOverviewTags">
                                    <?php foreach ($tags as $t): ?>
                                        <p><a href="index-test.php?tag=<?= $t['id']; ?>"><?= $t['name']; ?></a></p>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="qOverviewProfile">
                                <?php if ($q['profile_picture'] != ''): ?>
                                    <p><img width="32" height="32" src="Images/Profile_pictures/<?= $q['profile_picture']; ?>"/></p>
                                <?php endif; ?>
                                <p><a href="profile.php?uid=<?=$q['uid']; ?>"><?= $q['username']; ?></a></p>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php endif; ?>
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