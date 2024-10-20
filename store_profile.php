<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <style>
        /* Body Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        /* Form Container Styles */
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Form Styles */
        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="file"] {
            margin-top: 5px;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Your Store Profile</h1>
        <form method="post" enctype="multipart/form-data">
            <label for="store_name">Store Name:</label>
            <input type="text" id="store_name" name="store_name" value="">

            <label for="owner_name">Owner Name:</label>
            <input type="text" id="owner_name" name="owner_name" value="">

            <label for="contact_number">Contact Number:</label>
            <input type="text" id="contact_number" name="contact_number" value="">

            <label for="store_address">Store Address:</label>
            <input type="text" id="store_address" name="store_address" value="">

            <label for="store_image1">Upload Store Image 1:</label>
            <input type="file" id="store_image1" name="store_image1">

            <label for="store_image2">Upload Store Image 2:</label>
            <input type="file" id="store_image2" name="store_image2">

            <label for="store_description">Store Description:</label>
            <textarea id="store_description" name="store_description"></textarea>

            <input type="submit" value="Save Changes">
        </form>
    </div>
    <?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if all required fields are filled
        if (isset($_POST['store_name']) && isset($_POST['owner_name']) && isset($_POST['contact_number']) && isset($_POST['store_address']) && isset($_POST['store_description'])) {
            // Include database connection file
            include_once "connection.php";

            // Escape user inputs for security
            $store_name = $conn->real_escape_string($_POST['store_name']);
            $owner_name = $conn->real_escape_string($_POST['owner_name']);
            $contact_number = $conn->real_escape_string($_POST['contact_number']);
            $store_address = $conn->real_escape_string($_POST['store_address']);
            $store_description = $conn->real_escape_string($_POST['store_description']);

            // File upload handling for store images
            $store_image1 = $_FILES['store_image1']['name'];
            $store_image2 = $_FILES['store_image2']['name'];
            $target_dir = "uploads/"; // Directory where images will be stored
            // Move uploaded files to the target directory
            move_uploaded_file($_FILES['store_image1']['tmp_name'], $target_dir . $store_image1);
            move_uploaded_file($_FILES['store_image2']['tmp_name'], $target_dir . $store_image2);

            // Insert/update store profile data into the database
            $sql = "INSERT INTO stores (store_name, owner_name, contact_number, store_address, store_description, store_image1, store_image2) VALUES ('$store_name', '$owner_name', '$contact_number', '$store_address', '$store_description', '$store_image1', '$store_image2')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Store profile updated successfully.')</script>";
            } else {
                echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "')</script>";
            }

            // Close database connection
            $conn->close();
        } else {
            echo "<script>alert('All fields are required.')</script>";
        }
    }
    ?>
</body>
</html>
