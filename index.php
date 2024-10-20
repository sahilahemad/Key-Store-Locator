<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Key Store Locator</title>
    <link rel="stylesheet" href="styles.css">
<style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-image: url('css/index.png');
    background-size: cover;
    background-position: center;
}

header {
    background-color: #333;
    color: #fff;
    padding: 2px;
    text-align: center;
    display: flex;
    justify-content: space-between;
    align-items: center;
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
    color: black;
    text-decoration: none;
    font-weight: bold;
    padding: 10px 20px;
    margin: 0 10px;
    border-radius: 5px;
    background-color: grey;
    border: 1px solid #ccc;
    transition: background-color 0.3s ease;
}

nav ul li a:hover {
    background-color: #555;
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


</style>
</head>
<body>
    <header>
        <h1>Welcome to Key Store Locator</h1>
        <a href="about.php" style="color: white; border: 1px solid white;">About</a>
        <a href="login.php"><img src="css/admin_i.png" alt="Admin Icon"></a>
    </header>
    <nav>
        <ul>
            <li><a href="login_selection.php">Login</a></li>
            <li><a href="register_selection.php">Register</a></li>
        </ul>
    </nav>
    <section>
        <p>Find the nearest key store around you!</p>
    </section>
    <footer>
        <p>&copy; <?php echo date("Y"); ?>  Key Store Locator Project by Sahil Ahemad MCA(SIOM)</p>
    </footer>
</body>
</html>

