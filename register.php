<?php
error_reporting(E_ALL);
ini_set("display_errors",1);
session_start();
require "db.php";

$error = "";

if(isset($_POST['register'])){

    $name   = trim($_POST['name']);
    $email  = trim($_POST['email']);
    $mobile = trim($_POST['mobile']);
    $pass   = $_POST['password'];

    $hash = password_hash($pass, PASSWORD_BCRYPT);

    $check = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $check->execute([$email]);

    if($check->rowCount() > 0){
        $error = "Email already registered!";
    } else {

        $stmt = $pdo->prepare("INSERT INTO users(name,email,mobile,password,role) 
                                VALUES(?,?,?,?, 'user')");
        if($stmt->execute([$name,$email,$mobile,$hash])){
            header("Location: login.php");
            exit;
        } else {
            $error = "Registration Failed!";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<style>
body{background:#eef2ff;font-family:Arial;display:flex;justify-content:center;align-items:center;height:100vh;}
.box{background:white;width:350px;padding:30px;border-radius:12px;box-shadow:0 0 15px rgba(0,0,0,0.15);}
h2{text-align:center;color:#1f3c88;}
input{width:100%;padding:10px;margin:10px 0;border-radius:6px;border:1px solid #ccc;}
button{width:100%;padding:12px;background:#27ae60;color:white;border:none;border-radius:6px;}
button:hover{background:#1e8449;}
.error{color:red;text-align:center;margin-bottom:10px;}
a{display:block;text-align:center;margin-top:10px;color:#1f3c88;text-decoration:none;}
</style>
</head>
<body>

<div class="box">
<h2>Register</h2>

<?php if($error) echo "<div class='error'>$error</div>"; ?>

<form method="POST">
<input type="text" name="name" placeholder="Full Name" required>
<input type="email" name="email" placeholder="Email Address" required>
<input type="text" name="mobile" placeholder="Mobile Number" required>
<input type="password" name="password" placeholder="Create Password" required>
<button name="register">Register</button>
</form>

<a href="login.php">Already have account? Login</a>
</div>

</body>
</html>
