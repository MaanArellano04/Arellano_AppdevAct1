<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
</head>
<body>
    <div>
        <div>
            <h1>Create Product</h1>
        </div>

        <?php
        if ($_POST) {
            include 'C:\xampp\htdocs\Arellano_AppDev1\database.php';
            try {
               
                $query = "INSERT INTO products SET name=:name, description=:description, price=:price, quantity=:quantity, created_at=:created_at";
                
                $stmt = $con->prepare($query);

                $name = htmlspecialchars(strip_tags($_POST['name']));
                $description = htmlspecialchars(strip_tags($_POST['description']));
                $price = htmlspecialchars(strip_tags($_POST['price']));
                $quantity = htmlspecialchars(strip_tags($_POST['quantity']));
                $created = date("Y-m-d H:i:s");

                $stmt->bindParam(":name", $name);
                $stmt->bindParam(":description", $description);
                $stmt->bindParam(":price", $price);
                $stmt->bindParam(":quantity", $quantity);
                $stmt->bindParam(":created_at", $created);

                
                if ($stmt->execute()) {
                } else {
                    echo "Unable to create product.";
                }
            } catch (PDOException $e) {
                die('ERROR: ' . $e->getMessage());
            }
        }
        ?>
       
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <table>
                <tr>
                    <td>Name</td>
                    <td><input type='text' name='name' class='form-control' /></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><textarea name="description" class='form-control'></textarea></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><input name='price' class='form-control'/></td>
                </tr>
                <tr>
                    <td>Quantity</td>
                    <td><input type='number' name='quantity' class='form-control'/></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save' class='btn btn-primary' />
                        <a href="index.php">Back to read products</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
