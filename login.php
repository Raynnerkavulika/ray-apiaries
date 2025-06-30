
<?php
include('config.php');
session_start();

if(isset($_POST['submit'])){
   
    $email = $_POST['email'];
    $email = filter_var($email,FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $password = filter_var($password,FILTER_SANITIZE_STRING);

    $select = $conn->prepare("SELECT * FROM users WHERE email=? AND password=?" );
    $select->execute([$email,$password]);
    $row = $select->fetch(PDO::FETCH_ASSOC);

    if($select->rowCount()>0){
        if($row['user_type'] == 'admin'){

            $_SESSION['admin_id'] = $row['id'];
            header('location:admin_page.php');

        }elseif($row['user_type'] == 'user'){

            $_SESSION['user_id'] = $row['id'];
            header('location:index.php');

    }else{
        $message[] = 'user does not exist';
    }
}else{
    echo'wrong email or password';
}
}

?>
