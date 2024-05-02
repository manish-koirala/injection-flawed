<main>
    <form action="../login/login.php" method="POST">
        <label for="username">Username: </label>
        <input type="text" name="username" id="username">
        <label for="password">Password: </label>
        <input type="text" name="password" id="password">
        <input type="submit" name="submit" value="Login">
        <p id='error-msg' style="text-align: center; color: red;"><?php if (isset($error_msg)) echo $error_msg ?></p>
    </form>
</main>