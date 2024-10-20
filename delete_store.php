<?php
include 'connection.php';

if(isset($_POST['store_id'])) {
    $store_id = $_POST['store_id'];
        $sql = "DELETE FROM stores WHERE id = $store_id";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php?msg=Store successfully deleted");
    } else {
        header("Location: admin.php?error=Error deleting store: " . $conn->error);
    }
} else {
    header("Location: admin.php");
}
?>
