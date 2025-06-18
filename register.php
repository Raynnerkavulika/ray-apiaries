<?php
include "config.php";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register page</title>
</head>
<body>
    <section class="form-container">
        <form action="" method="post" enctype="multipart/form-data">
            <input type="text" placeholder="enter your full names" class="box" name="name" required autocomplete="off">
            <input type="email" placeholder="enter your email" class="box" name="email" required autocomplete="off">
            <input type="password" placeholder="enter your password" class="box" name="password" required autocomplete="off">
            <input type="password" placeholder="confirm your password" class="box" name="cpassword" required autocomplete="off">
            <input type="file" name="image" class="box" accept="image/png,image/jpg,image/jpeg">
            <input type="submit" name="submit" class="btn" value="register now">
        </form>
    </section>
</body>
</html>
