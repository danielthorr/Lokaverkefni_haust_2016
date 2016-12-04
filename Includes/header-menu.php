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