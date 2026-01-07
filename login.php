<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

$conn = new mysqli(
    "sql113.infinityfree.com",
    "if0_40477351",
    "8767Sam8767",
    "if0_40477351_lostfound_db"
);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

if(isset($_POST['login'])){
    $email = trim($_POST['email']);
    $pass  = trim($_POST['password']);

    // ✅ FIX: only check by email
    $sql = "SELECT * FROM users WHERE TRIM(email)='$email'";
    $q = $conn->query($sql);

    if(!$q){
        die("SQL Error: " . $conn->error);
    }

    if($q->num_rows == 1){
        $data = $q->fetch_assoc();

        // ✅ FIX: verify hashed password
        if(password_verify($pass, $data['password'])){

            $role = strtolower(trim($data['role']));

            if($role == "admin"){
                $_SESSION['admin'] = $data['name'];
                header("Location: admin_dashboard.php");

                exit;
            } else {
                $_SESSION['user'] = $data['name'];
                header("Location: dashboard.php");
                exit;
            }

        } else {
            $error = "Invalid email or password!";
        }

    } else {
        $error = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


<style>
body{
    margin:0;
    font-family:'Segoe UI', Arial;
    background:linear-gradient(135deg,#0a3d62,#1e3799);
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}
.login-box{
    background:white;
    width:360px;
    padding:30px;
    border-radius:14px;
    box-shadow:0 10px 25px rgba(0,0,0,0.3);
}
.login-box h2{
    text-align:center;
    color:#1e3799;
}
.field{ margin-top:15px; }
.field input{
    width:100%;
    padding:12px;
    border-radius:8px;
    border:1px solid #ccc;
    font-size:15px;
}
.pass-box{ position:relative; }
.pass-box i{
    position:absolute;
    right:12px;
    top:50%;
    transform:translateY(-50%);
    cursor:pointer;
    color:#666;
}
button{
    width:100%;
    padding:13px;
    background:#1e3799;
    border:none;
    color:white;
    border-radius:8px;
    margin-top:15px;
    font-size:16px;
    transition:0.3s;
}
button:hover{ background:#0c2461; }
.error{
    color:red;
    text-align:center;
    margin-top:10px;
}
.register{
    text-align:center;
    margin-top:15px;
    font-size:14px;
}
.register a{
    color:#1e3799;
    text-decoration:none;
    font-weight:bold;
}
.register a:hover{ text-decoration:underline; }
</style>
</head>

<body>

<div class="login-box">
    <h2>Login</h2>

    <?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>

    <form method="POST">
        <div class="field">
            <input type="email" name="email" placeholder="Enter Email" required>
        </div>

        <div class="field pass-box">
            <input type="password" id="password" name="password" placeholder="Enter Password" required>
            <i class="fas fa-eye" onclick="togglePassword()"></i>
        </div>

        <button name="login">Login</button>
    </form>

    <div class="register">
        If you are not registered?  
        <a href="register.php">Create Account</a>
    </div>
</div>

<script>
function togglePassword() {
    var x = document.getElementById("password");
    x.type = (x.type === "password") ? "text" : "password";
}
</script>

</body>
</html>
