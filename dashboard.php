<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>User Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:"Segoe UI",sans-serif;
}

/* BACKGROUND */
body{
    background: linear-gradient(to right, #1f3c88, #4da8da);
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

/* MAIN BOX */
.main{
    background:white;
    width:95%;
    max-width:1100px;
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 15px 40px rgba(0,0,0,0.25);
}

/* TOP NAVBAR */
.navbar{
    background:linear-gradient(135deg,#1abc9c,#16a085);
    color:white;
    padding:14px 22px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.navbar h2{
    font-weight:600;
}

/* right buttons (profile + logout) */
.nav-right{
    display:flex;
    align-items:center;
    gap:10px;
}

.nav-btn{
    display:flex;
    align-items:center;
    gap:6px;
    color:white;
    text-decoration:none;
    background:#0e6655;
    padding:8px 14px;
    border-radius:20px;
    font-size:14px;
    transition:.3s;
}

.nav-btn .material-icons{
    font-size:18px;
}

.nav-btn:hover{
    background:#0b5345;
}

/* HERO SECTION */
.hero{
    display:flex;
    flex-wrap:wrap;
    padding:40px;
}

/* LEFT */
.left{
    flex:1;
    padding:20px;
}

.left h1{
    font-size:32px;
    color:#1f3c88;
}

.left p{
    margin-top:10px;
    color:#555;
}

/* RIGHT */
.right{
    flex:1;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:20px;
}

.highlight{
    background:linear-gradient(120deg,#4da8da,#1f3c88);
    padding:35px;
    border-radius:18px;
    color:white;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
}

/* CARDS */
.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:25px;
    padding:40px;
    background:#f5f7ff;
}

.card{
    background:white;
    padding:25px;
    border-radius:18px;
    text-align:center;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
    transition:.3s;
}

.card:hover{
    transform:translateY(-6px);
    box-shadow:0 12px 25px rgba(0,0,0,0.2);
}

.card .material-icons{
    font-size:45px;
    color:#3498db;
    margin-bottom:12px;
}

.card h3{
    color:#1f3c88;
}

.card a{
    display:inline-block;
    margin-top:15px;
    padding:10px 18px;
    border-radius:20px;
    background:#3498db;
    color:white;
    text-decoration:none;
    transition:.3s;
    font-weight:600;
}

.card a:hover{
    background:#1f618d;
}

/* FOOTER */
footer{
    text-align:center;
    padding:12px;
    background:#1f3c88;
    color:white;
    font-size:14px;
}

/* MOBILE */
@media(max-width:600px){
    .left h1{font-size:24px;}
}
</style>
</head>
<body>

<div class="main">

    <!-- NAVBAR -->
    <div class="navbar">
        <h2>Lost & Found Dashboard</h2>

        <div class="nav-right">
            <!-- My Profile button -->
            <a href="profile.php" class="nav-btn">
                <span class="material-icons">account_circle</span>
                <span>My Profile</span>
            </a>

            <!-- Logout button -->
            <a href="logout.php" class="nav-btn">
                <span class="material-icons">logout</span>
                <span>Logout</span>
            </a>
        </div>
    </div>

    <!-- HERO -->
    <div class="hero">

        <div class="left">
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?> 👋</h1>
            <p>
                Manage your lost & found items easily. Report items,
                track updates and help return belongings.
            </p>
        </div>

        <div class="right">
            <div class="highlight">
                <h2>Find it. Return it.</h2>
                <p>Helping people connect with lost belongings.</p>
            </div>
        </div>

    </div>

    <!-- CARDS -->
    <div class="cards">

        <div class="card">
            <span class="material-icons">search_off</span>
            <h3>Report Lost</h3>
            <p>Lost something? Add details here.</p>
            <a href="lost_item.php">Report</a>
        </div>

        <div class="card">
            <span class="material-icons">find_in_page</span>
            <h3>Report Found</h3>
            <p>Found something? Help return it.</p>
            <a href="found_item.php">Submit</a>
        </div>

        <div class="card">
            <span class="material-icons">view_list</span>
            <h3>All Items</h3>
            <p>Browse lost & found items list.</p>
            <a href="view_items.php">View</a>
        </div>

        <div class="card">
            <span class="material-icons">help_outline</span>
            <h3>Help & Support</h3>
            <p>Need assistance?</p>
            <a href="#">Support</a>
        </div>

    </div>

    <footer>
        &copy; <?php echo date("Y"); ?> Lost & Found System
    </footer>

</div>

</body>
</html>
