<?php
session_start();
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

    // Photo Upload
    $photo = $_FILES['photo']['name'];
    $tmp = $_FILES['photo']['tmp_name'];

    $folder = "uploads/" . $photo;

    // Create uploads folder if not exists
    if(!is_dir("uploads")){
        mkdir("uploads");
    }

    move_uploaded_file($tmp, $folder);

    // Insert into DB
    $sql = "INSERT INTO lost_items(title,description,category,photo,date_lost,user_id)
            VALUES('$title','$description','$category','$folder','$date_lost',1)";

    $conn->query($sql);

    echo "<script>alert('Lost Item Submitted Successfully!');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Report Lost Item</title>

<style>
body{
    background:#eef1f5;
    font-family: Arial;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.form-box{
    width:450px;
    background:white;
    padding:30px;
    border-radius:12px;
    box-shadow:0 0 14px rgba(0,0,0,0.2);
}

h2{
    text-align:center;
    color:#2c3e50;
}

input, select, textarea{
    width:100%;
    padding:10px;
    margin:10px 0;
    border-radius:6px;
    border:1px solid #ccc;
}

button{
    width:100%;
    padding:12px;
    background:#3498db;
    border:none;
    border-radius:8px;
    color:white;
    font-size:16px;
}
button:hover{
    background:#2980b9;
}
</style>

</head>
<body>

<div class="form-box">
    <h2>Report Lost Item</h2>

    <form method="POST" enctype="multipart/form-data">

        <input type="text" name="title" placeholder="Item Name" required>

        <textarea name="description" placeholder="Describe the item..." required></textarea>

        <select name="category" required>
            <option value="">Select Category</option>
            <option>Electronics</option>
            <option>Books</option>
            <option>Cards / IDs</option>
            <option>Accessories</option>
            <option>Others</option>
        </select>

        <input type="date" name="date_lost" required>

        <input type="file" name="photo" required>

        <button name="submit">Submit</button>
    </form>
</div>

</body>
</html>
