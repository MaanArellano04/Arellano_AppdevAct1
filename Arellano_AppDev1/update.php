<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div>
        <div>
            <h1>Update Product</h1>
        </div>

        <?php

        $id = isset($_GET["id"]) ? $_GET["id"] : die("ERROR: INVALID");
        include 'C:\xampp\htdocs\Arellano_AppDev1\database.php';
        try {
            $query = "SELECT id, name, description, price, quantity FROM products WHERE id = ? LIMIT 0,1";
            $stmt = $con->prepare($query);
            $stmt->bindParam(1, $id);
            $stmt->execute();

            $row = $stmt-> fetch(PDO::FETCH_ASSOC);
            $name = $row['name'];
            $description = $row['description'];
            $price = $row['price'];
            $quantity = $row['quantity'];
        }catch (PDOException$e) {
            die('ERROR:' .$e->getMessage());
        }
        ?>

        <?php
        if ($_POST) {
            try{
                $query = "UPDATE products Set name=:name, description=:description, price=:price, quantity=:qunatity, update_at=:update_at WHERE id= :id";
                $stmt = $con->prepare($query);
                $name = htmlspecialchars(strip_tags($_POST['name']));
                $description = htmlspecialchars(strip_tags($_POST['description']));
                $price = htmlspecialchars(strip_tags($_POST['price']));
                $quantity = htmlspecialchars(strip_tags($_POST['quantity']));

                $stmt->bindParam("name", $name);
                $stmt->bindParam("description", $description);
                $stmt->bindParam("price", $price);
                $stmt->bindParam("quantity", $quantity);

                $created = date ("Y-m-d H:i:s");
                $stmt->bindParam("updated_at", $updated);

                $stmt->bindParam(":id", $id);

                if ($stmt->execute()) {
                    echo "New product updated successfully";
                }else{
                    echo "Unable to update product";
                }
            }catch (PDOException $e) {
                die('ERROR: '  . $e->getMessage());
            }
        }
        ?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}"); ?>" method="post">
            <table>
                <tr>
                    <td>Name</td>
                    <td><input type='text' name='name' value="<?php echo htmlspecialchars($name, ENT_QUOTES);  ?>" class='form-control' /></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><textarea name='description' class='form-control'><?php echo htmlspecialchars($description, ENT_QUOTES);  ?></textarea></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><input type='text' name='price' value="<?php echo htmlspecialchars($price, ENT_QUOTES);  ?>" class='form-control' /></td>
                </tr>
                <tr>
                <tr>
                    <td>Quantity</td>
                    <td><input type='text' name='quantity' value="<?php echo htmlspecialchars($quantity, ENT_QUOTES);  ?>" class='form-control' /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save Changes' class='btn btn-primary' />
                        <a href='index.php' class='btn btn-danger'>Back to read products</a>
                    </td>
                </tr>
            </table>
        </form>

    </div>
    
</body>
</html>