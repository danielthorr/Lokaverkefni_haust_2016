<?php

session_start();

?>

<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" href="Resources/CSS/mainpage.css">

	<script type="text/javascript" src="Resources/javascript/TinyMCE/tinymce.min.js"></script>
	<script type="text/javascript">
		
		var viewWidth = Math.max(document.documentElement.clientWidth, window.innerWidth);
		var viewHeight = Math.max(document.documentElement.clientHeight, window.innerHeight);
		
		var tinymceHeight = 240;
		
		if (viewHeight < 900){
			tinymceHeight = viewHeight * 0.66;
		}
		else{
			tinymceHeight = 440;
		}
		
		var containerWidth = viewWidth * 0.75;
		var previewWidth = containerWidth - 100; //Might have to change the last value to something else according to how the questions will appear 
		var previewHeight = viewHeight - 88 - 200; //we subtract 88 because of the way tinymce calculates the space and we subtract an additional 200 so we don't completely fill up the screen
	
		var tinymceWidth = containerWidth * 0.95;
	
		tinymce.init({
			selector: '#textAreaQuestion',
			body_class: 'elm1=my_class',
			height : tinymceHeight,
			width : tinymceWidth,
			plugins: ["advlist lists autolink autosave charmap codesample hr image imagetools preview link searchreplace wordcount"],
			advlist_number_styles: "lower-alpha,upper-alpha,lower-roman,upper-roman",
			//toolbar: "charmap codesample",
			//menubar: "charmap",
			toolbar: "undo redo | styleselect | bold, italic | alignleft, aligncenter, alignright, alignjustify | bullist, numlist | outdent, indent",
			menu: {
				view: {title: "Edit", items: "undo, redo | searchreplace"},
				view: {title: "Insert", items: "link, image | hr, charmap | codesample"}
			},
			image_advtab: true, //See this page for more image tools options with php and javascript https://www.tinymce.com/docs/plugins/imagetools/
			plugin_preview_height: previewWidth,
			plugin_preview_width: previewHeight,
			link_context_toolbar: true,
			link_assume_external_targets: true,
			link_title: false
		});
		
	</script>
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
		<section class="mainSection" style="width:100%">
			<!-- The mainSection tag contains everything on the main area of the webpage, things that we want to the user to focus on. Other things, such as links and navigation, additional and/or useful information should go into the sidebar tags -->
			<div class="sectionArea">
				<form id="askQuestionForm" name="askQuestionForm" action="process.php?action=newQuestion" method="post">
				
					<div id="formTop">
						<label for="title">Title:</label>
						<input name="title" type="text" />
					</div>
				
					<textarea form="askQuestionForm" name="text" id="textAreaQuestion"></textarea>
					
					<div id="formBottom">
						<label for="tags">Tags: </label>
						<input name="tags" type="text" />

						<input type="submit" name="submitbtn" value="submit" />
					</div>
				</form>
				
			</div>
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