<?php include('server.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>R-land Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="inner">
        <div ><h1 class="appname">Welcome to the virtual R-land</h1></div>
        <form class="login" action="login.php" method="post">
            <?php include('errors.php') ?>
    
            <label for="email"><b>Email</b></label><br>
            <input type="email" name="email" id="email" required="true" placeholder="eg_m@iitr.ac.in" onfocus="this.placeholder=''" onblur="this.placeholder='eg_m@iitr.ac.in'">
            <br><br>
            <label for="password"><b>Password</b></label><br>
            <input type="password" name="password" id="password" required="true" placeholder="Enter password" onfocus="this.placeholder=''" onblur="this.placeholder='Enter password'">
            <br><br>
            <input type="submit" class="submit-btn" value="Login" name="login_user">
            <p>Not yet Joined? <a href="register.php">Sign in</a></p>
        </form><br><br><br><br><br><br><br><br>
        <div class="footer">- MK Production -</div>
    </div>
</body>
</html>