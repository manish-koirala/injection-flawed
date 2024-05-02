<!-- The header of the website. -->
<header>
    <div id='heading-text'>
        <h1>TradeBee</h1>
    </div>
    <nav>
        <?php if (session_status() == PHP_SESSION_NONE) session_start() ?>
        <?php if(isset($_SESSION['uid'])): ?>
            <div id='user-box' style='text-align: center;'>
                Logged In As: <br> <b><?php echo $_SESSION["username"] ?></b>
            </div>
            <a href="../home/index.php">Home</a>
            <a href="../login/logout.php">Logout</a>
        <?php else: ?>
            <a href="../home/index.php">Home</a>
            <a href="../login/login.php">Login</a>
            <a href="../register/register.php">Register</a>
        <?php endif ?>
    </nav>
</header>