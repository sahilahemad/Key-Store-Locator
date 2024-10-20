<?php
include_once "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("INSERT INTO stores (store_name, owner_name, contact_number, store_address, store_password, username) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $store_name, $owner_name, $contact_number, $store_address, $password, $username);

    $store_name = $_POST["store_name"];
    $owner_name = $_POST["owner_name"];
    $contact_number = $_POST["contact_number"];
    $store_address = $_POST["store_address"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $username = $_POST["username"];
    $stmt->execute();

    $store_id = $stmt->insert_id;


    if (!empty($_FILES["store_images"]["name"][0])) {
        $file_names = [];
        $target_dir = "uploads/";
        $total_files = count($_FILES["store_images"]["name"]);

        for ($i = 0; $i < $total_files; $i++) {
            $file_name = uniqid() . "_" . basename($_FILES["store_images"]["name"][$i]);
            $target_file = $target_dir . $file_name;
            if (move_uploaded_file($_FILES["store_images"]["tmp_name"][$i], $target_file)) {
                $file_names[] = $file_name;
            }
        }

        if (!empty($file_names)) {
            $stmt_images = $conn->prepare("INSERT INTO store_images (store_id, image_path) VALUES (?, ?)");
            $stmt_images->bind_param("is", $store_id, $image_path);

            foreach ($file_names as $image) {
                $image_path = $target_dir . $image;
                $stmt_images->execute();
            }
        }
    }

   $stmt->close();
    if (isset($stmt_images)) {
        $stmt_images->close();
    }
    $conn->close();

   header("Location: registration_success.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store Registration</title>
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

        section {
            padding: 20px;
            text-align: center;
        }

        form {
            margin: 0 auto;
            max-width: 400px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="tel"],
        input[type="password"],
        textarea {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
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

    </style>
</head>
<body>
<header>
    <h1>Store Registration</h1>
</header>
<section>
    <form action="store_register.php" method="POST" enctype="multipart/form-data">
        
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br> 
        
        <label for="store_name">Store Name:</label>
        <input type="text" id="store_name" name="store_name" required><br>

        <label for="owner_name">Owner Name:</label>
        <input type="text" id="owner_name" name="owner_name" required><br>

        <label for="contact_number">Contact Number:</label>
        <input type="tel" id="contact_number" name="contact_number" pattern="[0-9]{10}" required><br>

        <label for="store_address">Store Address:</label>
        <textarea id="store_address" name="store_address" rows="4" required></textarea><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Register Store"><br>

        <br><a href="index.php" class="home-button">Home</a>
    </form>
</section>
</body>
</html>
