<?php
session_start();

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $pass = $_POST['password'];

    // Hardcoded admin login
    if($email == "admin@lostfound.com" && $pass == "admin123"){
        $_SESSION['admin'] = "admin";
        header("Location: admin_dashboard.php");
    } else {
        $error = "Invalid Credentials!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>

<style>
body{
    background:#eef2f3;
    font-family:"Segoe UI", sans-serif;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

form{
    width:330px;
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 5px 20px rgba(0,0,0,0.1);
}

h2{
    text-align:center;
    margin-bottom:20px;
}

input{
    width:100%;
    padding:12px;
    margin:10px 0;
    border:1px solid #ccc;
    border-radius:10px;
}

button{
    width:100%;
    padding:12px;
    background:#3498db;
    border:none;
    color:white;
    font-size:18px;
    border-radius:10px;
    cursor:pointer;
}
</style>
</head>

<body>

<form method="POST">
    <h2>Admin Login</h2>

    <?php if(isset($error)){ echo "<p style='color:red;'>$error</p>"; } ?>

    <input type="text" name="email" placeholder="Admin Email" required>
    <input type="password" name="password" placeholder="Password" required>

    <button name="login">Login</button>
</form>

</body>
</html>
