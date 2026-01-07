<?php
session_start();
$conn = new mysqli(
    "sql113.infinityfree.com",
    "if0_40477351",
    "8767Sam8767",
    "if0_40477351_lostfound_db"
);


$type = $_GET['type'];
$id = $_GET['id'];

if($type == "lost"){
    $conn->query("DELETE FROM lost_items WHERE id=$id");
}
else if($type == "found"){
    $conn->query("DELETE FROM found_items WHERE id=$id");
}

header("Location: admin_manage_items.php");
exit;
?>
