<?php
$conn = new mysqli(
    "sql113.infinityfree.com",
    "if0_40477351",
    "8767Sam8767",
    "if0_40477351_lostfound_db"
);



if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $date_lost = $_POST['date_lost'];
    $user_id = 1; // abhi manually rakho

    // PHOTO UPLOAD
    $photo = "";
    if(isset($_FILES['photo'])){
        $photo = "uploads/" . time() . "_" . $_FILES['photo']['name'];
        move_uploaded_file($_FILES['photo']['tmp_name'], $photo);
    }

    $sql = "INSERT INTO lost_items(title, description, category, photo, date_lost, user_id)
            VALUES('$title', '$description', '$category', '$photo', '$date_lost', '$user_id')";

    if($conn->query($sql)){
        echo "<script>alert('Lost Item Added Successfully!');</script>";
    } else {
        echo "<script>alert('Error: ".$conn->error."');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Report Lost Item</title>
<style>
form{
    width:350px;
    margin:auto;
    background:white;
    padding:25px;
    border-radius:12px;
    box-shadow:0 0 10px rgba(0,0,0,0.2);
}
input, textarea, select{
    width:100%;
    padding:10px;
    margin:10px 0;
    border-radius:6px;
    border:1px solid #ccc;
}
button{
    width:100%;
    padding:10px;
    background:#3498db;
    border:none;
    color:white;
    border-radius:6px;
}
</style>
</head>
<body>

<h2 style="text-align:center;">Report Lost Item</h2>

<form method="POST" enctype="multipart/form-data">
    Title:
    <input type="text" name="title" required>

    Description:
    <textarea name="description" required></textarea>

    Category:
    <select name="category" required>
        <option>Electronics</option>
        <option>Books</option>
        <option>Accessories</option>
        <option>ID Cards</option>
        <option>Others</option>
    </select>

    Upload Photo:
    <input type="file" name="photo">

    Date Lost:
    <input type="date" name="date_lost" required>

    <button name="submit">Submit Lost Item</button>
</form>

</body>
</html>
