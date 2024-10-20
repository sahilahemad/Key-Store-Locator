<?php
include 'connection.php';

$name = $username = $password = $mobile = $address = '';
$errors = array();
$success_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);
    $mobile = test_input($_POST["mobile"]);
    $address = test_input($_POST["address"]);

    $check_username = "SELECT * FROM users WHERE username=?";
    $stmt = $conn->prepare($check_username);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $errors[] = "Username already exists.";
    }

    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $insert_query = "INSERT INTO users (name, username, password, mobile, address) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("sssss", $name, $username, $hashed_password, $mobile, $address);

        if ($stmt->execute()) {
            $success_message = "Registration successful. You can now login.";
        } else {
            $errors[] = "Failed to register user. Please try again later.";
        }
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <style>
       body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #3e8f9f 0%, #cfe3f3 100%);
        }
        

        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
        nav ul li a :hover{
            color: blue;
        }

        section {
            padding: 20px;
            text-align: center;
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

        form {
            margin: 0 auto;
            max-width: 400px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        form label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        form input[type="text"],
        form input[type="password"],
        form input[type="tel"],
        form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 10px;
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
            transition: all 0.3s ease;
        }
        input[type="submit"]:hover {
    background: linear-gradient(to bottom, #cfe3f3 0%, #3e8f9f 100%);
    color: black;
}

        .btn-container {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .btn-container a {
            color: black;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            width: 100%;
            border-radius: 5px;
            background: linear-gradient(to right, #3e8f9f 0%, #cfe3f3 100%);
            box-shadow: 0px 15px 20px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }

        .btn-container a:hover {
            background: linear-gradient(to bottom, #cfe3f3 0%, #3e8f9f 100%);
    color: black;
        }
    </style>
</head>
<body>
    <header>
        <h1>User Registration</h1>
        <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
        </ul>
    </nav>
    </header>

    <section>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>

            <label for="mobile">Mobile Number:</label>
            <input type="tel" id="mobile" name="mobile" pattern="[0-9]{10}" required><br>

            <label for="address">Address:</label>
            <textarea id="address" name="address" rows="4" required></textarea><br>

            <div class="btn-container">
                <input type="submit" value="Register">
                <a href="user_login.php">Login</a>
            </div>
        </form>
        <?php
        if (!empty($success_message)) {
            echo '<p style="color: green;">' . $success_message . '</p>';
        }
        if (!empty($errors)) {
            echo '<div>';
            foreach ($errors as $error) {
                echo '<p style="color: red;">' . $error . '</p>';
            }
            echo '</div>';
        }
        ?>
    </section>
    <footer>
        <p>&copy; <?php echo date("Y"); ?>  Key Store Locator Project by Sahil Ahemad MCA(SIOM)</p>
    </footer>
</body>
</html>