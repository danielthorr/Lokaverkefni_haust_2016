<?php

session_start();

require_once 'Includes/connection.php';
require_once 'classes/Question.php';
require_once 'classes/Comment.php';
require_once 'classes/User.php';

$question = new Question($connection);
$comment = new Comment($connection);
$user = new User($connection);

// Næ í upplýsingar um spurninguna
$q = $question->getOriginalPostInfo($_GET['qid']);
$score = $question->getQuestionScore($_GET['qid']);
$postCount = $user->getUserPostCount($q['uid']);
$tags = $question->getQuestionTags($_GET['qid']);

// Næ í öll commentin í spurningunni
$comments = $question->getComments($_GET['qid']);
?>

<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title><?= $q['title']; ?></title>
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
							<p><?= $score; ?></p>
							<img src="Resources/icons/downvote.png" width="40px" height="auto" />
						</div>
                        <!-- User rank -->
                        <p><?= $q['rank']; ?></p>

                        <!-- Post count -->
                        <p><?= $postCount; ?> posts</p>

                        <!-- Post date -->
						<p><?= $q['post_date']; ?></p>

                        <!-- Edited date -->
						<?php if ($q['edited_date'] != null): ?>
                            <p><?= $q['edited_date']; ?></p>
                        <?php endif; ?>

						<p><a href="profile.php?uid=<?= $q['uid']; ?>"><?= $q['username']; ?></a></p>
					</section>
					<section class="QAMain">
						<p class="QTitle"><?= $q['title']; ?></p>
						<p class="QAText"><?= $q['text']; ?></p>
						<div class="QTags">
                            <?php foreach($tags as $t): ?>
                                <a href="index.php?tag=<?=$t['id']; ?>"><?= $t['name']; ?></a>
                            <?php endforeach; ?>
						</div>
					</section>
				</section>

                <?php foreach($comments as $c): ?>
                    <?php
                        $score = $comment->getCommentScore($c['id']);
                        $postCount = $user->getUserPostCount($c['uid']);
                    ?>
                    <section class="QACard">
                        <section class="QAInfo">
                            <div class="votes">
                                <img src="Resources/icons/upvote.png" width="40px" height="auto" />
                                <p><?= $score; ?></p>
                                <img src="Resources/icons/downvote.png" width="40px" height="auto" />
                            </div>
                            <!-- User rank -->
                            <p><?= $c['rank']; ?></p>

                            <!-- Post count -->
                            <p><?= $postCount; ?> posts</p>

                            <!-- Post date-->
                            <p><?= $c['post_date']; ?></p>

                            <!-- Edited date -->
                            <?php if ($c['edited_date'] != null): ?>
                                <p>dateModified</p>
                            <?php endif; ?>

                            <!-- Username -->
                            <p><a href="profile.php?uid=<?=$c['uid']; ?>"><?= $c['username']; ?></a></p>
                        </section>
                        <section class="QAMain">
                            <!-- Comment -->
                            <p class="QAText"><?= $c['text']; ?></p>
                        </section>
                    </section>
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
<script type="text/javascript" src="Resources/javascript/jquery-2.2.0.js"></script>
<script type="text/javascript" src="Resources/javascript/testScript.js"></script>
</body>
</html>