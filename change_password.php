<?php
session_start();
require "db.php";

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

$msg = "";

if(isset($_POST['change'])){
    $old = $_POST['old'];
    $new = $_POST['new'];
    $confirm = $_POST['confirm'];

    // get user from DB
    $stmt = $pdo->prepare("SELECT * FROM users WHERE name=?");
    $stmt->execute([$_SESSION['user']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!password_verify($old, $user['password'])){
        $msg = "❌ Old password is wrong!";
    }
    elseif($new != $confirm){
        $msg = "❌ Passwords do not match!";
    }
    else{
        $newPass = password_hash($new, PASSWORD_BCRYPT);
        $update = $pdo->prepare("UPDATE users SET password=? WHERE name=?");
        $update->execute([$newPass, $_SESSION['user']]);

        $msg = "✅ Password updated successfully!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Change Password</title>
<style>
body{
    background:#eef2ff;
    font-family:"Segoe UI";
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.box{
    background:white;
    width:400px;
    padding:30px;
    border-radius:14px;
    box-shadow:0 10px 20px rgba(0,0,0,0.2);
}

h2{text-align:center;color:#1f3c88;}

input{
    width:100%;
    padding:10px;
    margin:10px 0;
    border-radius:6px;
    border:1px solid #ccc;
}

button{
    width:100%;
    padding:12px;
    background:#9b59b6;
    border:none;
    color:white;
    border-radius:8px;
}

.msg{text-align:center;font-weight:600;margin-bottom:10px;}
a{display:block;text-align:center;margin-top:10px;}
</style>
</head>
<body>

<div class="box">
<h2>Change Password</h2>

<?php if($msg) echo "<div class='msg'>$msg</div>"; ?>

<form method="POST">
    <input type="password" name="old" placeholder="Old Password" required>
    <input type="password" name="new" placeholder="New Password" required>
    <input type="password" name="confirm" placeholder="Confirm Password" required>
    <button name="change">Update Password</button>
</form>

<a href="profile.php">← Back to Profile</a>
</div>

</body>
</html>
