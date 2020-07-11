<?php include('server.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>R-land Register</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="inner">
        <form action="register.php" method="post">

            <div class="sign-up-heading"><h1>Sign Up</h1></div>

            <?php include('errors.php') ?>
            <div class="input-container">
            <label for="username"><b>Username</b></label><br>
            <input type="text" name="username" id="username" required="true" placeholder="Enter username" onfocus="this.placeholder=''" onblur="this.placeholder='Enter username'" value="<?php echo $username; ?>">
            </div>
            <br>
            <div class="input-container">
            <label for="email"><b>Email</b></label><br>
            <input type="email" name="email" id="email" required="true" placeholder="eg_m@iitr.ac.in" onfocus="this.placeholder=''" onblur="this.placeholder='eg_m@iitr.ac.in'" value="<?php echo $email; ?>">
            </div>
            <br>
            <div class="input-container">
            <label for="password_1"><b>Password</b></label><br>
            <input type="password" name="password_1" id="password_1" required="true" placeholder="Enter password" onfocus="this.placeholder=''" onblur="this.placeholder='Enter password'">
            </div>
            <br>
            <div class="input-container">
            <label for="password_2"><b>Confirm Password</b></label><br>
            <input type="password" name="password_2" id="password_2" required="true" placeholder="Re-enter password" onfocus="this.placeholder=''"onblur="this.placeholder='Re-enter password'">
            </div>
            <br>
            <input type="submit" class="submit-btn" value="Join now" name="reg_user">
            <p>Already  joined? <a href="login.php">login</a></p>
        </form>
        <div class="footer">- MK Production -</div>
    </div>
</body>
</html>