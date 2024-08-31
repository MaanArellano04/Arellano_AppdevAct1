<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
</head>
<body>
    <div>
        <div>
            <h1>Product List</h1>
            <hr>
        </div> <!--header-->

        <?php
        include 'C:\xampp\htdocs\Arellano_AppDev1\database.php';

        $action = isset($_GET['action']) ? $_GET['action'] : "";
        if ($action == "deleted") {
            echo "Product deleted successfully.";
        }

        $query = "SELECT id, name, description, price, quantity, created_at, update_at FROM products ORDER BY id DESC";
        $stmt = $con->prepare($query);
        $stmt->execute();
        $num = $stmt->rowCount();

        echo "<a href='create.php'>Create New Product</a>";

        if ($num > 0) {
            echo "<table>";
            echo "<tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                  </tr>";

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {  // Corrected from $strmt to $stmt
                extract($row);
                echo "<tr>
                            <td>{$id}</td>
                            <td>{$name}</td>
                            <td>{$description}</td>
                            <td>{$price}</td>
                            <td>{$quantity}</td>
                            <td>{$created_at}</td>
                            <td>{$update_at}</td>";
                echo "<td>";
                echo "<a href='update.php?id={$id}'>Edit</a>";
                echo "<hr>";
                echo "<a href='delete.php?id={$id}'>Delete</a>";
                echo "</td>";
                echo "</tr>";       
            }
            echo "</table>";
        } else {
            echo "No records found.";
        }
        ?>
    </div>
</body>
</html>
