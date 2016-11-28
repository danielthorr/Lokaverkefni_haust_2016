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
	$questions = $question->getAllQuestions();
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
					<li>Newest</li>
					<li>Top: 24hrs</li>
					<li>Top: Week</li>
					<li>Top: Month</li>
					<li>Top: 6 Months</li>
					<li>Top: All time</li>
				</ul>
			</div>
            <!--<div class="loginform-in">
                <h1>User Login</h1>
                <div class="err" id="login-error"></div>
                <fieldset>
                    <form action="login_process.php" id="loginform-in" method="post">
                        <h1 class="test"></h1>
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
            </div>-->
            <!--<div class="signupform-in">
                <h1>User Signup</h1>
                <div class="err" id="signup-error"></div>
                <fieldset>
                    <form action="process.php?action=signup" id="signupform-in" method="post">
                        <h1 class="test"></h1>
                        <ul>
                            <li> <label for="username">Username </label>
                                <input type="text" size="30"  name="username" id="username"  /></li>
                            <li> <label for="password">Password</label>
                                <input type="password" size="30"  name="password" id="password"  /></li>
                            <li> <label for="retype-password">Retype password</label>
                                <input type="password" size="30"  name="retype-password" id="retype-password"  /></li>
                            <li> <label for="email">Email</label>
                                <input type="email" size="30"  name="email" id="email"  /></li>
                            <li> <label></label>
                                <input type="submit" id="signup" name="signup" value="Signup" class="signupbutton" ></li>
                        </ul>
                    </form>
                </fieldset>
            </div>-->
            <div class="newquestion">
                <h1>Create a new question</h1>
                <form action="process.php?action=newQuestion" method="post">
                    <ul>
                        <li>
                            <label for="title">title </label>
                            <input type="text" size="30"  name="title" id="title"/>
                        </li>
                        <li>
                            <label for="text">Text </label>
                            <textarea name="text" id="text" rows="10" cols="100"></textarea>
                        </li>
                        <li>
                            <label for="tags">Tags </label>
                            <input type="text" size="30" name="tags" id="tags"/>
                        </li>
                        <li>
                            <input type="submit" id="submit" name="submit" value="Submit" class="submitNewThreadButton">
                        </li>
                    </ul>
                </form>
            </div>
			<div class="sectionArea">
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
                                <p>Last Answer: <?= $latestAnswer['post_date'] . " by <a href=profile.php?uid=$latestAnswer[uid]>" . $latestAnswer['username'] . "</a>"; ?></p>
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
                                    <p><a href="index.php?tag=<?= $t['name']; ?>"><?= $t['name']; ?></a></p>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="qOverviewProfile">
                            <p><img width="32" height="32" src="Images/Profile_pictures/<?= $q['profile_picture']; ?>"/></p>
                            <p><a href="profile.php?uid=<?=$q['uid']; ?>"><?= $q['username']; ?></a></p>
                        </div>
                    </article>
                <?php endforeach; ?>
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