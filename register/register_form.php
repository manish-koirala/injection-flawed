<main>
    <form action="../register/register.php" method="POST">
        <p id='error-msg' style="text-align: center; color: red;"><?php if (isset($error_msg)) echo $error_msg ?></p>
        <label for="fname">First Name:</label>
        <input type="text" name="fname" id="fname">
        <label for="lname">Last Name:</label>
        <input type="text" name="lname" id="lname">
        <label for="username">Choose a username:</label>
        <input type="text" name="username" id="username">
        <label for="email">Email:</label>
        <input type="text" name="email" id="email">
        <label for="password">Password:</label>
        <input type="text" name="password" id="password">
        <label for="phone_number">Phone Number:</label>
        <input type="text" name="phone" id="phone">
        <label for="creditcard">Credit Card Number:</label>
        <input type="text" name="creditcard" id="creditcard">
        <input type="submit" name="submit" value="Register a new account">
    </form>
</main>