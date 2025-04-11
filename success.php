<?php
require_once "etc/config.php";
require_once "etc/global.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (array_key_exists("last-page", $_SESSION)) {
    $str = $_SESSION['last-page'];
    header("refresh:1;url=$str");
} else {
    $str = "index.php";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/success.css">

    <title>Success page</title>
</head>

<body>
    <div class="container">
        <img src="images/check.png">
        <h1>Success</h1>
        <p>Your request has been successfully processed by the database.</p>
        <a href=<?= $str ?>>Click here if you are not redirected after <div id="countdown"></div> seconds....</a>
    </div>

    <!-- js countdown from stackoverflow-->
    <script>
        var timeleft = 2;
        var downloadTimer = setInterval(function () {
            if (timeleft <= 0) {
                clearInterval(downloadTimer);
                document.getElementById("countdown").innerHTML = "0";
            } else {
                document.getElementById("countdown").innerHTML = timeleft;
            }
            timeleft -= 1;
        }, 1000);
    </script>
</body>

</html>

<?php
if (array_key_exists("last-page", $_SESSION)) {
    unset($_SESSION["last-page"]);
}
?>