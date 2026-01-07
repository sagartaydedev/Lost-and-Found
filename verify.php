<?php
session_start();
require "db.php";

// FIXED: session variable name changed to verify_email
if(!isset($_SESSION['otp']) || !isset($_SESSION['verify_email'])){
    header("Location: register.php");
    exit;
}

$error = "";

if(isset($_POST['verify'])){
    
    $entered_otp = $_POST['d1'].$_POST['d2'].$_POST['d3'].$_POST['d4'].$_POST['d5'].$_POST['d6'];

    if($entered_otp == $_SESSION['otp']){

        // FIXED
        $email = $_SESSION['verify_email'];

        $sql = $pdo->prepare("UPDATE users SET is_verified = 1 WHERE email = ?");
        $sql->execute([$email]);

        unset($_SESSION['otp']);

        // FIXED
        unset($_SESSION['verify_email']);

        header("Location: login.php?verified=1");
        exit;

    } else {
        $error = "❌ Incorrect OTP! Please try again.";
    }
}

// RESEND OTP
if(isset($_POST['resend'])){
    $otp = rand(100000,999999);
    $_SESSION['otp'] = $otp;

    // FIXED
    $email = $_SESSION['verify_email'];

    mail($email, "Your OTP Verification Code", "Your OTP is: $otp");

    $error = "✔ New OTP has been sent.";
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Verify OTP</title>
<link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">

<style>

body{
    margin:0;
    padding:0;
    background:#eef3ff;
    font-family:"Poppins", sans-serif;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.container{
    width:420px;
    background:white;
    padding:35px;
    border-radius:20px;
    text-align:center;
    box-shadow:0 10px 30px rgba(0,0,0,0.15);
}

h2{
    font-size:28px;
    color:#2b59ff;
    margin-bottom:5px;
}

.sub{
    color:#666;
    font-size:15px;
}

.error{
    color:red;
    font-weight:600;
    margin:10px 0;
}

.otp-box{
    display:flex;
    justify-content:center;
    gap:12px;
    margin:25px 0;
}

.otp-box input{
    width:48px;
    height:58px;
    font-size:22px;
    text-align:center;
    border-radius:12px;
    border:1px solid #d0d0d0;
    background:#f8faff;
    outline:none;
    transition:.2s;
}

.otp-box input:focus{
    border-color:#2b59ff;
    box-shadow:0 0 10px #2b59ff60;
}

button{
    width:100%;
    padding:14px;
    border:none;
    border-radius:12px;
    background:#2b59ff;
    color:white;
    font-size:18px;
    margin-top:10px;
    font-weight:600;
    cursor:pointer;
}

button:hover{
    background:#1e46d8;
}

.resend-btn{
    background:#27ae60;
}

.timer{
    margin-top:15px;
    color:#333;
    font-size:14px;
}

#resendForm{
    display:none;
}

</style>
</head>
<body>

<div class="container">

    <h2>🔐 Verify Email</h2>

    <!-- FIXED -->
    <p class="sub">Enter the 6-digit OTP sent to:<br><b><?php echo $_SESSION['verify_email']; ?></b></p>

    <?php if($error){ echo "<div class='error'>$error</div>"; } ?>

    <form method="POST">

        <div class="otp-box">
            <input type="text" maxlength="1" name="d1" required>
            <input type="text" maxlength="1" name="d2" required>
            <input type="text" maxlength="1" name="d3" required>
            <input type="text" maxlength="1" name="d4" required>
            <input type="text" maxlength="1" name="d5" required>
            <input type="text" maxlength="1" name="d6" required>
        </div>

        <button name="verify">Verify OTP</button>

    </form>

    <form method="POST" id="resendForm">
        <button name="resend" class="resend-btn">Resend OTP</button>
    </form>

    <div class="timer">Resend OTP in <span id="count">60</span>s</div>

</div>


<script>
// Auto move forward/backward
const inputs = document.querySelectorAll(".otp-box input");

inputs.forEach((input, index) => {
    input.addEventListener("keyup", (e) => {
        if(input.value.length === 1 && index < 5){
            inputs[index + 1].focus();
        }
        if(e.key === "Backspace" && index > 0){
            inputs[index - 1].focus();
        }
    });
});

// Timer
let time = 60;
let timer = setInterval(() => {
    time--;
    document.getElementById("count").innerText = time;
    if(time <= 0){
        clearInterval(timer);
        document.getElementById("resendForm").style.display = "block";
        document.querySelector(".timer").style.display = "none";
    }
}, 1000);
</script>

</body>
</html>
