<?php
session_start();

// Only admin can update status
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


// Required parameters
$table  = $_GET['table'];     // lost_items OR found_items
$id     = $_GET['id'];        // item id
$status = $_GET['status'];    // new status value

// Validate table name for security
if($table != "lost_items" && $table != "found_items"){
    die("Invalid table!");
}

// Update status query
$sql = "UPDATE $table SET status='$status' WHERE id=$id";

if($conn->query($sql)){
    
    // REDIRECT BACK TO CORRECT PAGE
    if($table == "lost_items"){
        header("Location: admin_lost_items.php?msg=updated");
    } 
    else if($table == "found_items"){
        header("Location: admin_found_items.php?msg=updated");
    }
    exit;

} else {
    echo "Error updating status: " . $conn->error;
}
?>
