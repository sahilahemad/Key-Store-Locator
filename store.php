<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        header .buttons {
            display: flex;
        }

        header .buttons a {
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
            margin-left: 10px;
            border: 1px solid #fff;
            border-radius: 5px;
        }

        header .buttons a:hover {
            background-color: #555;
        }

        main {
            padding: 20px;
        }


        .images {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }

        .images img {
            width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <header>
        <div>
            <img src="css/store_icon.png" alt="icon">
        </div>
        <div class="buttons">
            <a href="store_profile.php">Profile</a>
            <a href="logout.php">Logout</a>
            
        </div>
    </header>
    <main>
        <h1>Welcome to Your Store</h1>
        <div class="images">
            <img src="css/store1.jpg" alt="Store Image 1">
            <img src="css/store2.jpg" alt="Store Image 2">
        </div>
    </main>
</body>
</html>
