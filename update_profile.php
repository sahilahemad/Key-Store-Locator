<?php
include_once "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("UPDATE stores SET store_name=?, owner_name=?, contact_number=?, store_description=? WHERE username=?");
    $stmt->bind_param("sssss", $store_name, $owner_name, $contact_number, $store_description, $username);

    $store_name = $_POST["store_name"];
    $owner_name = $_POST["owner_name"];
    $contact_number = $_POST["contact_number"];
    $store_description = $_POST["store_description"];
    $username = ['username']; 
    $stmt->execute();

    $stmt->close();

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
            foreach ($file_names as $image) {
                $stmt_images = $conn->prepare("INSERT INTO store_images (store_id, image_path) VALUES (?, ?)");
                $stmt_images->bind_param("is", $store_id, $image_path);

                $store_id = $_SESSION['store_id']; 
                $image_path = $target_dir . $image;
                $stmt_images->execute();

                $stmt_images->close();
            }
        }
    }

    $conn->close();

    header("Location: profile.php?updated=true");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Updated</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.container {
    max-width: 800px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.message {
    padding: 10px 20px;
    background-color: #4caf50;
    color: #fff;
    border-radius: 5px;
    margin-bottom: 20px;
}

.back-button {
    display: inline-block;
    background-color: #333;
    color: #fff;
    text-decoration: none;
    padding: 10px 20px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.back-button:hover {
    background-color: #555;
}

    </style>
</head>
<body>
    <div class="container">
        <?php if (isset($_GET['updated']) && $_GET['updated'] == 'true') : ?>
            <div class="message">
                Profile updated successfully!
            </div>
        <?php endif; ?>
        <a href="store.php" class="back-button">Back to Store</a>
    </div>
</body>
</html>
