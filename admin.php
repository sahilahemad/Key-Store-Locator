<?php include 'connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.header {
    background-color: #333;
    color: #fff;
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
}

.header img {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    margin-right: 10px;
}

.sidebar {
    background-color: #555;
    color: #fff;
    width: 200px;
    padding: 20px;
    height: 100%;
    position: fixed;
}

.sidebar h2 {
    margin-bottom: 20px;
}

.sidebar ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

.sidebar ul li {
    margin-bottom: 10px;
}

.sidebar ul li a {
    text-decoration: none;
    color: #fff;
    display: block;
    padding: 10px;
    border-radius: 5px;
    background-color: #777;
}

.sidebar ul li a:hover {
    background-color: #999;
}

.content {
    margin-left: 220px;
    padding: 20px;
}

.content h2 {
    margin-bottom: 20px;
}

.logout-btn {
    text-decoration: none;
    color: #c0392b;
}

.logout-btn:hover {
    text-decoration: underline;
}

.profile-btn {
    text-decoration: none;
    color: #fff;
    background-color: #333;
    padding: 5px 10px;
    border-radius: 5px;
}

.profile-btn:hover {
    background-color: #555;
}

.profile-section {
    display: none;
    margin-top: 20px;
}

.profile-section.show {
    display: block;
}

.profile-section input[type="text"],
.profile-section input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    box-sizing: border-box;
}

.profile-section input[type="submit"] {
    background-color: #333;
    color: #fff;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    width: 100%;
}

.user-details {
    border: 1px solid #ccc;
    padding: 10px;
    margin-bottom: 10px;
}

.store-details {
    border: 1px solid #ccc;
    padding: 10px;
    margin-bottom: 10px;
}

    </style>
</head>
<body>
    <div class="header">
        <div>
            <img src="admin_image.jpg" alt="Admin Image">
            <span>Admin</span>
        </div>
        <div>
            <a href="#" class="profile-btn">Profile</a>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </div>

    
    <div class="sidebar">
        <h2>Admin Dashboard</h2>
        <ul>
            <li><a href="#users">Manage Users</a></li>
            <li><a href="#stores">Manage Stores</a></li>
        </ul>
    </div>
    <div class="content profile-section">
        
        <form action="#" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <label for="image">Upload Image:</label>
            <input type="file" id="image" name="image"><br><br>
            <input type="submit" value="Save Changes">
        </form>
    </div>

    <div class="content">
        <div id="users">
            <h2>Manage Users</h2>
            <ul>
                <?php

                $sql_users = "SELECT * FROM users";
                $result_users = $conn->query($sql_users);

                if ($result_users->num_rows > 0) {
                    $counter = 1;
                    
                    while($row_users = $result_users->fetch_assoc()) {
                        echo "<div class='user-details'>";
                        echo "<p>User " . $counter . "</p>";
                        echo "<p>Name: " . $row_users["name"] . "</p>";
                        echo "<p>Username: " . $row_users["username"] . "</p>";
                        echo "<p>Mobile: " . $row_users["mobile"] . "</p>";
                        echo "<p>Address: " . $row_users["address"] . "</p>";
                        echo "<form action='delete_user.php' method='POST'>";
                        echo "<input type='hidden' name='user_id' value='" . $row_users["id"] . "'>";
                        echo "<input type='submit' value='Delete'>";
                        echo "</form>";
                        echo "</div>";
                        
                        
                        $counter++;
                    }
                } else {
                    echo "No users found";
                }
                
                ?>
            </ul>
        </div>

        <div id="stores">
            <h2>Manage Stores</h2>
            <ul>
                <?php
        $counter = 1;
        $sql_stores = "SELECT * FROM stores";
        $result_stores = $conn->query($sql_stores);

        if ($result_stores->num_rows > 0) {
            while($row_stores = $result_stores->fetch_assoc()) {
                echo "<div class='store-details'>";
                echo "<p>Store " . $counter . "</p>";
                echo "<p>Name: " . $row_stores["store_name"] . "</p>";
                echo "<p>Username: " . $row_stores["username"] . "</p>";
                echo "<p>Owner: " . $row_stores["owner_name"] . "</p>";
                echo "<p>Contact: " . $row_stores["contact_number"] . "</p>";
                echo "<p>Address: " . $row_stores["store_address"] . "</p>";
                echo "<form action='delete_store.php' method='POST'>";
                echo "<input type='hidden' name='store_id' value='" . $row_stores["store_id"] . "'>";
                echo "<input type='submit' value='Delete'>";
                echo "</form>";
                echo "</div>";
                $counter++;
            }
        } else {
            echo "No stores found";
        }
                ?>
            </ul>
        </div>
    </div>

    <script>

        document.querySelector('.profile-btn').addEventListener('click', function() {
            document.querySelector('.profile-section').classList.toggle('show');
        });
    </script>
</body>
</html>

