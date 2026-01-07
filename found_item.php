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
    $date_found = $_POST['date_found'];
    $user_id = 1;

    // Photo Upload
    $photo = "";
    if(isset($_FILES['photo'])){
        $photo = "uploads/" . time() . "_" . $_FILES['photo']['name'];
        move_uploaded_file($_FILES['photo']['tmp_name'], $photo);
    }

    $sql = "INSERT INTO found_items(title, description, category, photo, date_found, user_id)
            VALUES('$title', '$description', '$category', '$photo', '$date_found', '$user_id')";

    if($conn->query($sql)){
        echo "<script>alert('Found Item Added Successfully');</script>";
    } else {
        echo "<script>alert('Error: ".$conn->error."');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Report Found Item</title>

<style>
body{
    margin:0;
    padding:0;
    background:#eef2f3;
    font-family: "Segoe UI", sans-serif;
}

.container{
    width:400px;
    margin:60px auto;
    background:white;
    padding:35px;
    border-radius:18px;
    box-shadow:0 8px 28px rgba(0,0,0,0.15);
    animation: fadeIn 0.4s ease;
}

@keyframes fadeIn{
    from{opacity:0; transform:translateY(20px);}
    to{opacity:1; transform:translateY(0);}
}

h2{
    text-align:center;
    margin-bottom:20px;
    color:#2c3e50;
}

input, textarea, select{
    width:100%;
    padding:12px;
    margin:12px 0;
    border:1px solid #d0d0d0;
    border-radius:10px;
    font-size:15px;
    background:#fafafa;
    transition:0.2s;
}

input:focus, textarea:focus, select:focus{
    outline:none;
    border-color:#3498db;
    background:white;
    box-shadow:0 0 6px rgba(52,152,219,0.3);
}

button{
    width:100%;
    padding:14px;
    border:none;
    border-radius:12px;
    background:linear-gradient(135deg, #2ecc71, #27ae60);
    color:white;
    font-size:17px;
    cursor:pointer;
    margin-top:10px;
    transition:0.2s;
    font-weight:600;
}

button:hover{
    transform:translateY(-2px);
    box-shadow:0 8px 15px rgba(0,0,0,0.15);
}

label{
    font-weight:600;
    color:#34495e;
}
</style>

</head>

<body>

<div class="container">
    <h2>Report Found Item</h2>

    <form method="POST" enctype="multipart/form-data">

        <label>Item Title</label>
        <input type="text" name="title" placeholder="e.g. Wallet, Phone, ID Card" required>

        <label>Description</label>
        <textarea name="description" rows="3" placeholder="Describe the item..." required></textarea>

        <label>Category</label>
        <select name="category" required>
            <option value="">Select Category</option>
            <option>Electronics</option>
            <option>Books</option>
            <option>Accessories</option>
            <option>ID Cards</option>
            <option>Others</option>
        </select>

        <label>Upload Photo</label>
        <input type="file" name="photo">

        <label>Date Found</label>
        <input type="date" name="date_found" required>

        <button name="submit">Submit Found Item</button>
    </form>
</div>

</body>
</html>
