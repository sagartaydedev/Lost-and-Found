<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lost & Found System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        body {
            background: linear-gradient(120deg, #1f3c88, #4da8da);
            color: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .main {
            width: 90%;
            max-width: 1100px;
            background: white;
            color: #333;
            border-radius: 18px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.25);
            overflow: hidden;
        }

        .hero {
            display: flex;
            flex-wrap: wrap;
            min-height: 500px;
        }

        .left {
            flex: 1;
            padding: 50px;
        }

        .left h1 {
            font-size: 42px;
            color: #1f3c88;
            margin-bottom: 15px;
        }

        .left p {
            font-size: 17px;
            color: #555;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .buttons button {
            padding: 12px 25px;
            border-radius: 30px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            margin-right: 15px;
            transition: 0.3s;
        }

        .btn-primary {
            background: #1f3c88;
            color: white;
        }

        .btn-primary:hover {
            background: #162c66;
        }

        .btn-outline {
            background: transparent;
            border: 2px solid #1f3c88;
            color: #1f3c88;
        }

        .btn-outline:hover {
            background: #1f3c88;
            color: white;
        }

        .right {
            flex: 1;
            background: linear-gradient(120deg, #4da8da, #1f3c88);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            padding: 30px;
        }

        .right h2 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .right p {
            opacity: 0.9;
        }

        /* FEATURES */
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px,1fr));
            gap: 20px;
            padding: 40px;
            background: #f8f9ff;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 0 15px rgba(0,0,0,0.08);
            text-align: center;
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .card h3 {
            color: #1f3c88;
            margin-bottom: 10px;
        }

        footer {
            background: #1f3c88;
            color: white;
            text-align: center;
            padding: 12px;
            font-size: 14px;
        }

        /* MOBILE */
        @media(max-width: 600px) {
            .left h1 { font-size: 28px; }
            .right h2 { font-size: 24px; }
            .left { padding: 30px; }
        }

    </style>
</head>
<body>

<div class="main">

    <!-- HERO SECTION -->
    <div class="hero">

        <div class="left">
            <h1>Lost & Found System</h1>
            <p>
                A smart platform where students can report lost items  
                and help return found belongings easily & securely.
            </p>

            <div class="buttons">
                <button class="btn-primary" onclick="location.href='login.php'">Login</button>
                <button class="btn-outline" onclick="location.href='register.php'">Register</button>
            </div>
        </div>

        <div class="right">
            <div>
                <h2>Find it. Return it.</h2>
                <p>Technology that helps recover what's important.</p>
            </div>
        </div>

    </div>


    <!-- FEATURES -->
    <div class="features">

        <div class="card">
            <h3>📦 Lost Items</h3>
            <p>Report items you lost quickly.</p>
        </div>

        <div class="card">
            <h3>✅ Found Items</h3>
            <p>Help return items easily.</p>
        </div>

        <div class="card">
            <h3>🔒 Secure Login</h3>
            <p>Safe authentication system.</p>
        </div>

        <div class="card">
            <h3>📱 Mobile Friendly</h3>
            <p>Works on any device.</p>
        </div>

    </div>


    <footer>
        &copy; <?php echo date("Y"); ?> Lost & Found System | All Rights Reserved
    </footer>

</div>

</body>
</html>
