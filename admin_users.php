<?php
session_start();

// ✅ Admin only
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

$conn = new mysqli(
    "sql113.infinityfree.com",
    "if0_40477351",
    "8767Sam8767",
    "if0_40477351_lostfound_db"
);

if($conn->connect_error){
    die("Database connection failed");
}

// ✅ Fetch Admin (only one)
$admin = $conn->query("SELECT * FROM users WHERE role='admin' LIMIT 1")->fetch_assoc();

// ✅ Fetch Users
$users = $conn->query("SELECT * FROM users WHERE role!='admin' ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin | Manage Users</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body{
    margin:0;
    font-family:'Segoe UI',sans-serif;
    background:linear-gradient(135deg,#0f2027,#203a43,#2c5364);
}

/* HEADER */
header{
    background:rgba(0,0,0,.6);
    backdrop-filter: blur(8px);
    color:white;
    padding:15px 25px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

/* BOX */
.box{
    max-width:1100px;
    margin:30px auto;
    background:white;
    border-radius:18px;
    padding:20px;
    box-shadow:0 10px 30px rgba(0,0,0,.4);
}

/* title */
h3{
    margin:10px 0 15px;
    color:#1f3c88;
}

/* table */
table{
    width:100%;
    border-collapse:collapse;
    font-size:14px;
}
th,td{
    padding:12px;
}
th{
    background:#1f3c88;
    color:white;
}
tr:nth-child(even){ background:#f4f7fb; }

/* badge */
.badge{
    padding:6px 14px;
    border-radius:14px;
    font-size:12px;
    color:white;
}
.admin-badge{ background:#9b59b6; }
.user-badge{ background:#3498db; }

/* admin row highlight */
.admin-row{
    background:#f5e9ff;
    font-weight:bold;
}

/* back button */
.back{
    margin:15px;
    display:inline-block;
    background:#3498db;
    color:white;
    text-decoration:none;
    padding:10px 18px;
    border-radius:16px;
}
.back:hover{ background:#1f618d; }
</style>
</head>

<body>

<header>
    <h2>USERS MANAGEMENT</h2>
    <div>👑 <?php echo htmlspecialchars($_SESSION['admin']); ?></div>
</header>

<a class="back" href="admin_dashboard.php">⬅ Back to Dashboard</a>

<div class="box">

<!-- ADMIN SECTION -->
<h3>👑 Admin Account</h3>

<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Role</th>
</tr>

<?php if($admin){ ?>
<tr class="admin-row">
    <td><?php echo $admin['id']; ?></td>
    <td><?php echo htmlspecialchars($admin['name']); ?></td>
    <td><?php echo htmlspecialchars($admin['email']); ?></td>
    <td><span class="badge admin-badge">ADMIN</span></td>
</tr>
<?php } ?>
</table>

<br>

<!-- USER SECTION -->
<h3>👥 Users List</h3>

<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Role</th>
</tr>

<?php while($u = $users->fetch_assoc()){ ?>
<tr>
    <td><?php echo $u['id']; ?></td>
    <td><?php echo htmlspecialchars($u['name']); ?></td>
    <td><?php echo htmlspecialchars($u['email']); ?></td>
    <td><span class="badge user-badge">USER</span></td>
</tr>
<?php } ?>

</table>

</div>

</body>
</html>
