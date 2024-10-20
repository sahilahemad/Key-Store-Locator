
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        
        
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #3e8f9f 0%, #cfe3f3 100%);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 380px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0px 15px 20px rgba(0,0,1,0.5);
        }
        .container form{
        padding: 10px 30px 50px 30px;
}

.container form .field{
  height: 50px;
  width: 100%;
  margin-top: 20px;
  position: relative;
}
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color:grey;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px 20px;
            margin-bottom: 10px;
            border-radius: 10px;
            box-sizing: border-box;
            box-shadow: 0px 15px 20px rgba(0,0,0,0.1);
        }

        input[type="submit"] {
            color: black;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            width: 100%;
            border-radius: 5px;
            background: linear-gradient(to right, #3e8f9f 0%, #cfe3f3 100%);
            box-shadow: 0px 15px 20px rgba(0,0,0,0.2);
            transition: all 1.0s ease;
        }
        input[type="submit"]:hover {
    background: linear-gradient(to bottom, #cfe3f3 0%, #3e8f9f 100%);
    color: black;
}
        a[class="home-button"]{
            color: black;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            width: 100%;
            border-radius: 5px;
            box-shadow: 0px 15px 20px rgba(0,0,0,0.2);
            background: linear-gradient(to right, #3e8f9f 0%, #cfe3f3 100%);
            transition: all 0.3s ease;
        }
        a[class="home-button"]:hover {
    background: linear-gradient(to bottom, #cfe3f3 0%, #3e8f9f 100%);
    color: black;
}

        input[type="submit"]:active {
            transform: scale(0.95);
        }
        footer {
    background-color: #333;
    color: #fff;
    padding: 10px;
    text-align: center;
    position: fixed;
    bottom: 0;
    width: 100%;
}
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Login"><br>
           <br> <a href="index.php" class="home-button">Home</a>
        </form>
    </div>
    <footer>
        <p>&copy; <?php echo date("Y"); ?>  Key Store Locator Project by Sahil Ahemad MCA(SIOM)</p>
    </footer>
</body>
</html>
<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['role'] = 'admin';
        header("Location: admin.php");
        exit;
    }


    header("Location: login.php");
    exit;
}

$conn->close();
?>
