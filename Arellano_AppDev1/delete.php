<?php
include 'C:\xampp\htdocs\Arellano_AppDev1\database.php';
try {
    $id = isset($_GET["id"]) ? $_GET["id"] : die("ERROR: Invalid");

    // Corrected the SQL syntax
    $query = "DELETE FROM products WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bindParam(1, $id);

    if ($stmt->execute()) {
        header("Location: index.php?action=Deleted");
        exit(); // Ensure the script stops executing after the redirect
    } else {
        die('Unable to delete. Please try again.');
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
