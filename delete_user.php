<?php
include 'connection.php';

if(isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    
    $sql = "DELETE FROM users WHERE id = $user_id";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php?msg=User successfully deleted");
    } else {
        header("Location: admin.php?error=Error deleting user: " . $conn->error);
    }
} else {
    header("Location: admin.php");
}
?>
