<?php
$conn = new mysqli(
    "sql113.infinityfree.com",
    "if0_40477351",
    "8767Sam8767",
    "if0_40477351_lostfound_db"
);

$lost  = $conn->query("SELECT * FROM lost_items ORDER BY id DESC");
$found = $conn->query("SELECT * FROM found_items ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
<title>All Items</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
/* BACKGROUND */
body{
    margin:0;
    min-height:100vh;
    background:
      radial-gradient(circle at 10% 10%, #ff6fd8 0%, transparent 40%),
      radial-gradient(circle at 90% 10%, #1cb5e0 0%, transparent 35%),
      linear-gradient(135deg,#0f2027,#203a43,#2c5364);
    font-family:"Segoe UI",sans-serif;
    color:#fff;
}

/* HEADER */
header{
    padding:20px;
    text-align:center;
    background:rgba(0,0,0,.3);
    backdrop-filter:blur(10px);
}

/* GRID */
.grid{
    margin:20px;
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
    gap:25px;
}

/* CARD */
.card{
    background: rgba(255,255,255,.10);
    backdrop-filter: blur(14px);
    border-radius:22px;
    padding:16px;
    transition:.4s;
    box-shadow:0 0 30px rgba(0,0,0,.4);
    border:1px solid rgba(255,255,255,.15);
}
.card:hover{
    transform:scale(1.05);
}
.card img{
    width:100%;
    height:200px;
    object-fit:contain;
    border-radius:18px;
    background:#ffffff20;
    padding:8px;
    cursor:pointer;
}

/* CONTENT */
.title{font-size:20px;font-weight:700;}
.badge-lost{background:#e17055;padding:6px 14px;border-radius:14px;font-size:13px;}
.badge-found{background:#00b894;padding:6px 14px;border-radius:14px;font-size:13px;}
.date{opacity:.85;font-size:13px;margin-top:8px}

/* FULL IMAGE VIEW */
#imgModal{
    display:none;
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.9);
    z-index:999;
    justify-content:center;
    align-items:center;
}
#imgModal img{
    max-width:95%;
    max-height:95%;
    border-radius:20px;
}
#imgModal span{
    position:absolute;
    top:20px; right:30px;
    font-size:35px;
    cursor:pointer;
    color:white;
}
</style>
</head>

<body>

<header>
    <h2>📂 All Lost & Found Items</h2>
</header>

<h3 style="margin-left:20px">🔴 Lost Items</h3>
<div class="grid">
<?php while($item=$lost->fetch_assoc()){ ?>
<div class="card">
    <img src="<?php echo htmlspecialchars($item['photo']); ?>" onclick="openImage(this.src)">
    <div class="title"><?php echo htmlspecialchars($item['title']); ?></div>
    <span class="badge-lost"><?php echo htmlspecialchars($item['category']); ?></span>
    <div class="date">Lost On: <?php echo htmlspecialchars($item['date_lost']); ?></div>
</div>
<?php } ?>
</div>

<h3 style="margin-left:20px">🟢 Found Items</h3>
<div class="grid">
<?php while($item=$found->fetch_assoc()){ ?>
<div class="card">
    <img src="<?php echo htmlspecialchars($item['photo']); ?>" onclick="openImage(this.src)">
    <div class="title"><?php echo htmlspecialchars($item['title']); ?></div>
    <span class="badge-found"><?php echo htmlspecialchars($item['category']); ?></span>
    <div class="date">Found On: <?php echo htmlspecialchars($item['date_found']); ?></div>
</div>
<?php } ?>
</div>

<!-- IMAGE POPUP -->
<div id="imgModal" onclick="closeImage()">
    <span>&times;</span>
    <img id="fullImg">
</div>

<script>
function openImage(src){
    document.getElementById("imgModal").style.display="flex";
    document.getElementById("fullImg").src = src;
}
function closeImage(){
    document.getElementById("imgModal").style.display="none";
}
</script>

</body>
</html>
