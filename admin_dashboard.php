<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

require_once 'db.php';

try {
    $users = (int)$pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
    $lost  = (int)$pdo->query("SELECT COUNT(*) FROM lost_items")->fetchColumn();
    $found = (int)$pdo->query("SELECT COUNT(*) FROM found_items")->fetchColumn();
    $total = $lost + $found;
} catch (PDOException $e) {
    $users = $lost = $found = $total = 0;
    $dbError = "Unable to load stats.";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
/* BACKGROUND */
body{
    margin:0;
    min-height:100vh;
    background:
      radial-gradient(circle at 10% 10%, #ff6fd8 0%, transparent 35%),
      radial-gradient(circle at 90% 20%, #1cb5e0 0%, transparent 35%),
      linear-gradient(135deg,#0f2027,#203a43,#2c5364);
    font-family:'Segoe UI',sans-serif;
    color:#fff;
    overflow-x:hidden;
}

/* HEADER */
header{
    position:sticky; top:0;
    backdrop-filter: blur(18px);
    background: rgba(0,0,0,.35);
    padding:16px 24px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    box-shadow:0 10px 30px rgba(0,0,0,.4);
    z-index:9;
}
header h2{margin:0; letter-spacing:1px;}
header .user{
    padding:8px 14px;
    background:#ffffff18;
    border-radius:30px;
}

/* MAIN */
.dashboard{
    max-width:1200px;
    margin:40px auto;
    padding:20px;
}

/* STATS */
.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(240px,1fr));
    gap:25px;
}

.card{
    border-radius:22px;
    background: rgba(255,255,255,.12);
    backdrop-filter: blur(15px);
    box-shadow:0 0 40px rgba(0,0,0,.4);
    padding:26px;
    text-align:center;
    transition:.4s;
    border:1px solid rgba(255,255,255,.15);
    position:relative;
    overflow:hidden;
}

.card::after{
    content:"";
    position:absolute;
    inset:-50%;
    background:linear-gradient(90deg,transparent,rgba(255,255,255,.25),transparent);
    transform:rotate(25deg);
    transition:.8s;
}

.card:hover::after{
    inset:150%;
}

.card:hover{
    transform:scale(1.05);
    box-shadow:0 0 60px rgba(255,255,255,.3);
}

.card i{
    font-size:45px;
    margin-bottom:12px;
    color:#ffdd40;
}

.number{
    font-size:40px;
    font-weight:800;
}

.label{
    opacity:.9;
}

/* ACTION BUTTONS */
.actions{
    margin-top:50px;
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
    gap:20px;
}

.action-btn{
    text-decoration:none;
    text-align:center;
    padding:16px;
    border-radius:14px;
    background: linear-gradient(135deg,#ff512f,#dd2476);
    color:white;
    font-weight:bold;
    box-shadow:0 10px 30px rgba(0,0,0,.5);
    transition:.3s;
}

.action-btn:hover{
    transform:translateY(-5px);
    box-shadow:0 15px 45px rgba(255,0,128,.7);
}

.blue { background:linear-gradient(135deg,#2193b0,#6dd5ed); }
.green{ background:linear-gradient(135deg,#11998e,#38ef7d); }
.purple{background:linear-gradient(135deg,#7f00ff,#e100ff);}
.orange{background:linear-gradient(135deg,#ff8008,#ffc837);}
.dark  {background:linear-gradient(135deg,#141e30,#243b55);}
.red   {background:linear-gradient(135deg,#e52d27,#b31217);}

/* ERROR */
.error{color:red;text-align:center;}
</style>
</head>

<body>

<header>
    <h2>ADMIN CONTROL PANEL</h2>
    <div class="user">👑 <?php echo htmlspecialchars($_SESSION['admin']); ?></div>
</header>

<div class="dashboard">

<?php if(!empty($dbError)) echo "<p class='error'>$dbError</p>"; ?>

<div class="cards">

<div class="card">
  <i class="fa-solid fa-users"></i>
  <div class="number"><?php echo $users; ?></div>
  <div class="label">Users</div>
</div>

<div class="card">
  <i class="fa-solid fa-box"></i>
  <div class="number"><?php echo $lost; ?></div>
  <div class="label">Lost</div>
</div>

<div class="card">
  <i class="fa-solid fa-location-crosshairs"></i>
  <div class="number"><?php echo $found; ?></div>
  <div class="label">Found</div>
</div>

<div class="card">
  <i class="fa-solid fa-layer-group"></i>
  <div class="number"><?php echo $total; ?></div>
  <div class="label">Total</div>
</div>

</div>

<div class="actions">
  <a href="admin_users.php" class="action-btn blue">👥 Users</a>
  <a href="admin_lost_items.php" class="action-btn orange">📦 Lost</a>
  <a href="admin_found_items.php" class="action-btn green">🔍 Found</a>
  <a href="view_items.php" class="action-btn purple">🗂 View</a>
  <a href="admin_manage_items.php" class="action-btn dark">⚙ Manage</a>
  <a href="logout.php" class="action-btn red">🚪 Logout</a>
</div>

</div>

</body>
</html>
