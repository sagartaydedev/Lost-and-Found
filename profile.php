<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>My Profile</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<style>
body{
    margin:0;
    font-family:"Segoe UI",sans-serif;
    background:linear-gradient(to right,#1f3c88,#4da8da);
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

.profile-box{
    background:white;
    width:95%;
    max-width:900px;
    border-radius:20px;
    box-shadow:0 15px 35px rgba(0,0,0,0.25);
    overflow:hidden;
}

/* HEADER */
.profile-header{
    background:linear-gradient(135deg,#1abc9c,#16a085);
    padding:25px;
    color:white;
    display:flex;
    align-items:center;
    justify-content:space-between;
}

.profile-header h2{
    margin:0;
}

.back-btn{
    text-decoration:none;
    background:#0e6655;
    padding:8px 15px;
    color:white;
    border-radius:20px;
    font-size:14px;
}

.back-btn:hover{
    background:#0b5345;
}

/* PROFILE SECTION */
.profile-content{
    display:flex;
    flex-wrap:wrap;
    padding:40px;
    gap:30px;
    background:#f5f7ff;
}

/* LEFT SIDE */
.profile-left{
    flex:1;
    min-width:250px;
    text-align:center;
}

.avatar{
    width:120px;
    height:120px;
    border-radius:50%;
    background:#3498db;
    display:flex;
    align-items:center;
    justify-content:center;
    margin:auto;
    font-size:50px;
    color:white;
}

.username{
    margin-top:15px;
    font-size:22px;
    color:#1f3c88;
    font-weight:600;
}

.role{
    margin-top:5px;
    color:#777;
    font-size:14px;
}

/* RIGHT SIDE */
.profile-right{
    flex:2;
    min-width:280px;
}

.profile-card{
    background:white;
    border-radius:16px;
    padding:25px;
    box-shadow:0 6px 15px rgba(0,0,0,0.1);
}

/* ROW */
.row{
    display:flex;
    margin-bottom:12px;
    font-size:16px;
}

.label{
    width:140px;
    font-weight:600;
    color:#555;
}

.value{
    color:#333;
}

/* BUTTONS */
.buttons{
    margin-top:20px;
    display:flex;
    gap:15px;
    flex-wrap:wrap;
}

.btn{
    text-decoration:none;
    padding:10px 18px;
    border-radius:18px;
    color:white;
    font-weight:600;
    font-size:14px;
    transition:.3s;
}

.edit{ background:#3498db; }
.change{ background:#9b59b6; }
.logout{ background:#e74c3c; }

.edit:hover{ background:#2471a3; }
.change:hover{ background:#7d3c98; }
.logout:hover{ background:#c0392b; }

/* MOBILE */
@media(max-width:600px){
    .label{ width:120px; }
}
</style>

</head>
<body>

<div class="profile-box">

    <!-- HEADER -->
    <div class="profile-header">
        <h2>My Profile</h2>
        <a class="back-btn" href="dashboard.php">← Dashboard</a>
    </div>

    <!-- BODY -->
    <div class="profile-content">

        <!-- LEFT -->
        <div class="profile-left">
            <div class="avatar">
                <?php echo strtoupper(substr($_SESSION['user'],0,1)); ?>
            </div>
            <div class="username"><?php echo htmlspecialchars($_SESSION['user']); ?></div>
            <div class="role">User Account</div>
        </div>

        <!-- RIGHT -->
        <div class="profile-right">
            <div class="profile-card">

                <div class="row">
                    <div class="label">Username</div>
                    <div class="value"><?php echo htmlspecialchars($_SESSION['user']); ?></div>
                </div>

                <div class="row">
                    <div class="label">Account Type</div>
                    <div class="value">User</div>
                </div>

                <div class="row">
                    <div class="label">Status</div>
                    <div class="value">Active</div>
                </div>

                <div class="row">
                    <div class="label">Joined</div>
                    <div class="value"><?php echo date("d M Y"); ?></div>
                </div>

                <div class="buttons">
    <a href="edit_profile.php" class="btn edit">Edit Profile</a>
    <a href="change_password.php" class="btn change">Change Password</a>
    <a href="logout.php" class="btn logout">Logout</a>
</div>

            </div>
        </div>

    </div>

</div>

</body>
</html>
