<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Section</title>
    <style>
        /* CSS styles for the user section */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
        }

        header h1 {
            margin: 0;
        }

        header div a {
            color: #fff;
            text-decoration: none;
            margin-left: 10px;
        }

        header div a:hover {
            text-decoration: underline;
        }

        section {
            margin: 20px;
        }

        section h2 {
            margin-top: 0;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        ul li {
            padding: 10px;
            background-color: #fff;
            border: 1px solid #ccc;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .store-details {
            display: flex;
            align-items: center;
        }

        .store-image {
            width: 50px; /* Adjust image width as needed */
            margin-right: 20px;
        }

        .store-image img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <header>
        <?php
        // Start the session
        session_start();

        // Check if the user is logged in and the username is set in the session
        if(isset($_SESSION['username'])) {
            // Include database connection file
            require_once("connection.php");

            // Fetch the user's name from the database based on the username in the session
            $username = $_SESSION['username'];
            $query = "SELECT name FROM users WHERE username = '$username'";
            $result = mysqli_query($conn, $query);

            if(mysqli_num_rows($result) > 0) {
                // Fetch the user's name
                $row = mysqli_fetch_assoc($result);
                $userName = $row['name'];
                // Display the user's name in the header
                echo "<h1>Welcome, $userName!</h1>";
            }
            // Close the database connection
        } else {
            // If the user is not logged in, display default header
            echo "<h1>User Section</h1>";
        }
        ?>
        <div>
            <a href="edit_profile.php">Edit Profile</a>
            <a href="logout.php">Logout</a>
        </div>
    </header>

    <section id="listings">
        <h2>Store Listings</h2>
        <form action="#" method="GET" id="search_form">
            <label for="location">Search by Location:</label>
            <input type="text" id="location" name="location" placeholder="Enter location">
            <button type="submit">Search</button>
        </form>
        <ul>
            <?php
            // Include database connection file
            require_once("connection.php");

            $whereClause = "";
            $location = "";

            if (isset($_GET['location']) && !empty(trim($_GET['location']))) {
                $location = mysqli_real_escape_string($conn, $_GET['location']);
                $whereClause = " WHERE store_address LIKE '%$location%'";
            }

            $query = "SELECT * FROM stores" . $whereClause;
            $result = mysqli_query($conn, $query);

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<li>";
                    echo '<div class="store-details">';
                    $storeID = $row['store_id'];
                    $imageQuery = "SELECT * FROM store_images WHERE store_id = $storeID LIMIT 1";
                    $imageResult = mysqli_query($conn, $imageQuery);
                    if ($imageResult && mysqli_num_rows($imageResult) > 0) {
                        $imageRow = mysqli_fetch_assoc($imageResult);
                        echo '<div class="store-image"><img src="' . $imageRow['image_path'] . '" alt="Store Image"></div>';
                    }
                    echo "<div>";
                    echo "<strong>Store Name:</strong> " . $row['store_name'] . "<br>";
                    echo "<strong>Owner Name:</strong> " . $row['owner_name'] . "<br>";
                    echo "<strong>Contact:</strong> " . $row['contact_number'] . "<br>";
                    echo "<strong>Address:</strong> " . $row['store_address'];
                    echo "</div>";
                    echo "</div>";
                    echo "</li>";
                }
            } else {
                echo "<li>Error: " . mysqli_error($conn) . "</li>";
            }
            mysqli_close($conn);
            ?>
        </ul>
    </section>
</body>
</html>
