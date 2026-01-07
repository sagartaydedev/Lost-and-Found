<?php
session_start();

// Sirf admin hi access kar sake
if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit;
}

// ✅ FIXED: DUPLICATE CONNECTION REMOVED
$conn = new mysqli(
    "sql113.infinityfree.com",
    "if0_40477351",
    "8767Sam8767",
    "if0_40477351_lostfound_db"
);

if($conn->connect_error){
    die("Database connection failed");
}

// ---------- ACTIONS ----------

// Delete found item
if(isset($_GET['delete'])){
    $id = (int) $_GET['delete'];
    $conn->query("DELETE FROM found_items WHERE id = $id");
    header("Location: admin_found_items.php");
    exit;
}

// Mark as Claimed
if(isset($_GET['claim'])){
    $id = (int) $_GET['claim'];
    $conn->query("UPDATE found_items SET status = 'Claimed' WHERE id = $id");
    header("Location: admin_found_items.php");
    exit;
}

// ---------- FETCH DATA ----------

$sql = "
    SELECT f.*, u.name AS user_name
    FROM found_items f
    LEFT JOIN users u ON f.user_id = u.id
    ORDER BY f.date_found DESC
";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin | Manage Found Items</title>
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
    background:rgba(0,0,0,0.6);
    backdrop-filter:blur(10px);
    color:white;
    padding:15px 25px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    box-shadow:0 5px 20px rgba(0,0,0,0.4);
}
header h2{margin:0;}
header .admin{
    background:#ffffff20;
    padding:6px 14px;
    border-radius:20px;
}

/* TABLE WRAPPER */
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
    background:#f1f3f6;
}

img{
    width:65px;
    height:65px;
    object-fit:cover;
    border-radius:10px;
    border:2px solid #ddd;
}

/* STATUS */
.status{
    padding:6px 12px;
    border-radius:20px;
    font-size:13px;
    color:white;
}
.pending{background:#f39c12;}
.claimed{background:#27ae60;}

/* BUTTONS */
.actions a{
    display:inline-block;
    padding:7px 12px;
    border-radius:20px;
    font-size:12px;
    color:white;
    text-decoration:none;
}
.claim-btn{background:#9b59b6;}
.delete-btn{background:#e74c3c;}

.claim-btn:hover{background:#8e44ad;}
.delete-btn:hover{background:#c0392b;}
.back{
    display:inline-block;
    margin:15px;
    background:#3498db;
    padding:10px 18px;
    border-radius:20px;
    color:white;
    text-decoration:none;
    font-weight:bold;
}
.back:hover{background:#1f618d;}
</style>

</head>

<body>

<header>
    <h2>FOUND ITEMS MANAGEMENT</h2>
    <div class="admin">👑 <?php echo htmlspecialchars($_SESSION['admin']); ?></div>
</header>

<a class="back" href="admin_dashboard.php">⬅ Admin Dashboard</a>

<div class="container">

<table>
<tr>
    <th>ID</th>
    <th>Image</th>
    <th>Title</th>
    <th>User</th>
    <th>Location</th>
    <th>Date</th>
    <th>Status</th>
    <th>Actions</th>
</tr>

<?php while($row = $result->fetch_assoc()){ 
    $status = $row['status'] ?? 'Pending';
    $class = strtolower($status) == 'claimed' ? 'claimed' : 'pending';
?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td>
        <?php if(!empty($row['photo'])){ ?>
        <img src="uploads/<?php echo htmlspecialchars($row['photo']); ?>">
        <?php } ?>
    </td>
    <td><?php echo htmlspecialchars($row['title']); ?></td>
    <td><?php echo htmlspecialchars($row['user_name'] ?? "Unknown"); ?></td>
    <td><?php echo htmlspecialchars($row['location'] ?? "-"); ?></td>
    <td><?php echo htmlspecialchars($row['date_found']); ?></td>
    <td><span class="status <?php echo $class ?>"><?php echo $status ?></span></td>
    <td class="actions">
        <?php if(strtolower($status) != 'claimed'){ ?>
        <a class="claim-btn" href="?claim=<?php echo $row['id'];?>" 
           onclick="return confirm('Mark as claimed?')">Claim</a>
        <?php } ?>
        <a class="delete-btn" href="?delete=<?php echo $row['id'];?>" 
           onclick="return confirm('Delete item?')">Delete</a>
    </td>
</tr>
<?php } ?>

</table>

</div>

</body>
</html>
