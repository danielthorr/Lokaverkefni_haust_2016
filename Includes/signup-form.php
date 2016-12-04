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