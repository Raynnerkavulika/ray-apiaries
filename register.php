<?php
include('config.php');

if(isset($_POST['submit'])){
    
    $name = $_POST['name'];
    $name = filter_var($name,FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email,FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $password = filter_var($password,FILTER_SANITIZE_STRING);
    $cpassword = $_POST['cpassword'];
    $cpassword = filter_var($cpassword,FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/'.$image;

    $select = $conn->prepare("SELECT * FROM users WHERE email=?" );
    $select->execute([$email]);

    if($select->rowCount()>0){
        $message[] = 'user already exist';
    }else{
        if($password != $cpassword){
            $message[] = 'confirm password does not match';
        }else{
            $insert = $conn->prepare("INSERT INTO users(name,email,password,image) VALUES(?,?,?,?)");
            $insert->execute([$name,$email,$password,$image]);

            if($insert){
                if($image_size>2000000){
                    $message[] = 'image size too large';
                }else{
                    move_uploaded_file($image_tmp_name,$image_folder);
                    header('location:login.php');
                    $message[] = 'registered successfully';
                }
            }
        }
    }
}


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
