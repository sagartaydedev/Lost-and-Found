<?php
session_start();
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

$lost = $conn->query("SELECT * FROM lost_items ORDER BY id DESC");
$found = $conn->query("SELECT * FROM found_items ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Control Panel</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body{
    margin:0;
    font-family:'Segoe UI',sans-serif;
    background: radial-gradient(circle at top, #1f1c2c, #928dab);
    color:white;
}

/* HEADER */
header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:18px 25px;
    background:rgba(0,0,0,.6);
    backdrop-filter:blur(10px);
    box-shadow:0 10px 30px rgba(0,0,0,.6);
}
header h2{margin:0;}
header .admin{
    background:linear-gradient(135deg,#ff512f,#dd2476);
    padding:8px 18px;
    border-radius:30px;
    font-weight:600;
    box-shadow:0 0 15px rgba(255,80,80,.9);
}

/* SECTION */
section{
    padding:25px;
}

/* TABLE BOX */
.box{
    background:rgba(0,0,0,.75);
    border-radius:20px;
    padding:18px;
    margin-bottom:40px;
    box-shadow:0 0 25px rgba(0,0,0,.7);
}

/* TITLE */
h3{
    margin-top:0;
    color:#ffb142;
}

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
    font-size:14px;
}
th,td{
    padding:12px;
}
th{
    text-align:left;
    background:linear-gradient(135deg,#0066ff,#00d2ff);
    color:white;
}
tr:nth-child(even){background:rgba(255,255,255,.05);}

/* IMAGE */
img{
    width:65px;
    border-radius:10px;
    border:2px solid #fff;
}

/* STATUS */
.badge{
    padding:6px 14px;
    border-radius:16px;
    font-size:12px;
    color:white;
}
.Returned{background:#00b894;}
.Claimed{background:#6c5ce7;}
.Pending{background:#fdcb6e;color:black;}

/* BUTTONS */
.actions a{
    display:inline-block;
    padding:8px 14px;
    border-radius:18px;
    text-decoration:none;
    font-size:12px;
    font-weight:600;
    color:white;
    margin-right:5px;
    transition:.3s;
}
.return{background:#2ecc71;}
.claim{background:#6c5ce7;}
.delete{background:#e74c3c;}

.actions a:hover{
    transform:scale(1.1);
    box-shadow:0 0 12px rgba(255,255,255,.7);
}

/* BACK BTN */
.back{
    display:inline-block;
    margin:15px;
    background:#0984e3;
    padding:10px 20px;
    border-radius:20px;
    color:white;
    text-decoration:none;
}
.back:hover{background:#74b9ff;}
</style>
</head>

<body>

<header>
    <h2>ADMIN POWER PANEL</h2>
    <div class="admin">👑 <?php echo $_SESSION['admin']; ?></div>
</header>

<a href="admin_dashboard.php" class="back">⬅ Dashboard</a>

<section>

<div class="box">
<h3>🔴 Lost Items</h3>
<table>
<tr>
    <th>ID</th><th>Image</th><th>Title</th><th>User</th>
    <th>Date</th><th>Status</th><th>Action</th>
</tr>

<?php while($row = $lost->fetch_assoc()){
    $status = $row['status'] ?? 'Pending';
?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><img src="uploads/<?php echo htmlspecialchars($row['photo']); ?>"></td>
    <td><?php echo htmlspecialchars($row['title']); ?></td>
    <td><?php echo $row['user_id']; ?></td>
    <td><?php echo $row['date_lost']; ?></td>
    <td><span class="badge <?php echo $status ?>"><?php echo $status ?></span></td>
    <td class="actions">
        <a class="return"
           href="update_status.php?table=lost_items&id=<?php echo $row['id'];?>&status=Returned">
           Returned
        </a>
        <a class="delete"
           href="delete_item.php?table=lost_items&id=<?php echo $row['id'];?>"
           onclick="return confirm('Delete item?')">
           Delete
        </a>
    </td>
</tr>
<?php } ?>
</table>
</div>

<div class="box">
<h3>🟢 Found Items</h3>
<table>
<tr>
    <th>ID</th><th>Image</th><th>Title</th><th>User</th>
    <th>Date</th><th>Status</th><th>Action</th>
</tr>

<?php while($row = $found->fetch_assoc()){
    $status = $row['status'] ?? 'Pending';
?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><img src="uploads/<?php echo htmlspecialchars($row['photo']); ?>"></td>
    <td><?php echo htmlspecialchars($row['title']); ?></td>
    <td><?php echo $row['user_id']; ?></td>
    <td><?php echo $row['date_found']; ?></td>
    <td><span class="badge <?php echo $status ?>"><?php echo $status ?></span></td>
    <td class="actions">
        <a class="claim"
           href="update_status.php?table=found_items&id=<?php echo $row['id'];?>&status=Claimed">
           Claimed
        </a>
        <a class="delete"
           href="delete_item.php?table=found_items&id=<?php echo $row['id'];?>"
           onclick="return confirm('Delete item?')">
           Delete
        </a>
    </td>
</tr>
<?php } ?>
</table>
</div>

</section>
</body>
</html>
