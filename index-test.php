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
	<title>
        <?php
            if (isset($_SESSION['uid'])) {
                echo $_SESSION['username'];
            } else {
				echo "Not logged in";
			}
        ?>
    </title>
	<link rel="stylesheet" href="Resources/CSS/mainpage.css">

</head>
<body>
	<header>
		<!-- Create a menu system inside these header tags -->
		<ul class="menubar">
			<div class="first">
				<li><a href="index.html">Home</a></li>
				<li><a href="#">Categories</a></li>
			</div>
			<div class="last">
                <?php if (!isset($_SESSION['uid'])): ?>
                    <li><a href="login.php">Log in</a></li>
                    <li><a href="#">Sign up</a></li>
                <?php else: ?>
                    <li id="logout"><a href="process.php?action=logout" id="logout">Log out</a></li>
                <?php endif; ?>
			</div>
		</ul>
	</header>
	
	<!-- Possible add a banner type message at the top before we show the main content -->
	<div class="banner"><p>Some banner message or image</p></div>

	<!-- Almost everything on the page should go into the mainContainer, except pop-ups, menus, footers, etc. This tag should contain the main content on the page 	-->
	<main class="mainContainer">
		<section class="mainSection">
			<!-- The mainSection tag contains everything on the main area of the webpage, things that we want to the user to focus on. Other things, such as links and navigation, additional and/or useful information should go into the sidebar tags -->
			
			<div class="sectionTabs">
				<ul>
                    <li><a href="Index-test.php">Newest</a></li>
					<li>Top: 24hrs</li>
					<li>Top: Week</li>
					<li>Top: Month</li>
					<li>Top: 6 Months</li>
					<li>Top: All time</li>
				</ul>
			</div>
			<div class="sectionArea">
                <?php if (count($questions) != 0): ?>
                    <!-- List all questions -->
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
                                <p class="qOverviewSectionName"><a href="showquestion.php?qid=<?= $q['id']; ?>"><?= $q['title']; ?></a></p>
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
<script type="text/javascript" src="jQuery/jquery-2.2.0.js"></script>
<script type="text/javascript" src="jQuery/testScript.js"></script>
</body>
</html>