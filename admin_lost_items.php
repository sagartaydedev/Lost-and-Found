<?php
session_start();

// ✅ Only admin
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

// ✅ DB connection
$conn = new mysqli(
    "sql113.infinityfree.com",
    "if0_40477351",
    "8767Sam8767",
    "if0_40477351_lostfound_db"
);

if($conn->connect_error){
    die("Database connection failed");
}

// ✅ Fetch data
$data = $conn->query("SELECT * FROM lost_items ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin | Manage Lost Items</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body{
    margin:0;
    font-family:'Segoe UI',sans-serif;
    background:linear-gradient(135deg,#0f2027,#203a43,#2c5364);
}

header{
    background:rgba(0,0,0,.5);
    backdrop-filter:blur(10px);
    color:white;
    padding:15px 25px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}
.container{
    max-width:1200px;
    margin:30px auto;
    background:white;
    border-radius:18px;
    padding:20px;
    box-shadow:0 10px 30px rgba(0,0,0,.4);
}
table{
    width:100%;
    border-collapse:collapse;
    font-size:14px;
}
th,td{
    padding:12px;
    text-align:center;
}
th{
    background:#1f3c88;
    color:white;
}
tr:nth-child(even){
    background:#f4f7fb;
}
img{
    width:70px;
    height:70px;
    object-fit:cover;
    border-radius:10px;
    border:2px solid #ddd;
}
.status{
    padding:6px 12px;
    border-radius:14px;
    font-size:13px;
    color:white;
}
.Pending{ background:#f39c12; }
.Returned{ background:#27ae60; }

.actions a{
    display:inline-block;
    padding:7px 12px;
    border-radius:14px;
    text-decoration:none;
    color:white;
    font-size:12px;
}
.return{ background:#2ecc71; }
.delete{ background:#e74c3c; }

.return:hover{ background:#27ae60;}
.delete:hover{ background:#c0392b;}

.back{
    margin:15px;
    display:inline-block;
    background:#3498db;
    color:white;
    text-decoration:none;
    padding:10px 18px;
    border-radius:16px;
}
.back:hover{background:#1f618d;}
</style>
</head>

<body>

<header>
    <h2>LOST ITEMS MANAGEMENT</h2>
    <div>👑 <?php echo htmlspecialchars($_SESSION['admin']); ?></div>
</header>

<a class="back" href="admin_dashboard.php">⬅ Back to Dashboard</a>

<div class="container">

<table>
<tr>
    <th>ID</th>
    <th>Image</th>
    <th>Title</th>
    <th>User</th>
    <th>Date</th>
    <th>Status</th>
    <th>Actions</th>
</tr>

<?php while($row = $data->fetch_assoc()){
    $status = $row['status'] ?? 'Pending';
?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td>
        <img src="<?php echo htmlspecialchars($row['photo']); ?>" alt="">
    </td>
    <td><?php echo htmlspecialchars($row['title']); ?></td>
    <td><?php echo htmlspecialchars($row['user_name'] ?? 'Unknown'); ?></td>
    <td><?php echo htmlspecialchars($row['date_lost']); ?></td>
    <td><span class="status <?php echo $status ?>"><?php echo $status ?></span></td>
    <td class="actions">
        <a class="return"
           href="update_status.php?table=lost_items&id=<?php echo $row['id']; ?>&status=Returned"
           onclick="return confirm('Mark item as returned?')">Returned</a>

        <a class="delete"
           href="delete_item.php?type=lost&id=<?php echo $row['id']; ?>"
           onclick="return confirm('Delete item?')">Delete</a>
    </td>
</tr>
<?php } ?>

</table>

</div>

</body>
</html>
