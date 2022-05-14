<?php
require_once 'database.php';
$conn = db_connect();

// Adding the data to database and sending to index page when the method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $inventoryId = trim(filter_var($_POST['inventoryId'], FILTER_SANITIZE_NUMBER_INT));
    $productName = trim(filter_var($_POST['productName'], FILTER_SANITIZE_STRING));
    $colour = trim(filter_var($_POST['colour'], FILTER_SANITIZE_STRING));
    $costPrice = trim(filter_var($_POST['costPrice'], FILTER_SANITIZE_NUMBER_INT));
    $sellPrice = trim(filter_var($_POST['sellPrice'], FILTER_SANITIZE_NUMBER_INT));
    $quantity = trim(filter_var($_POST['quantity'], FILTER_SANITIZE_STRING));

    $sql = "INSERT into shopify_inventory (inventoryId, productName, colour, costPrice, sellPrice, quantity) VALUES (:inventoryId, :productName , :colour, :costPrice, :sellPrice, :quantity)";

    db_bindAll($sql, $conn, $inventoryId, $productName, $colour, $costPrice, $sellPrice, $quantity);

    db_disconnect($conn);

    header("Location: index.php?t=1&msg=TaskCompleted");
    exit;
}
?>

<?php
$title_tag = 'Add Inventory';
include_once "header.php";
?>

<div class="container">

    <h1 class="text-center mt-5">Add New Inventory</h1>
    <div class="row mt-5 ms-1">
        <form class="row justify-content-center mb-5" method="POST">
            <div class="col-12 col-md-6">
                <div class="row mb-4">
                    <label for="firstName" class="col-4 col-form-label fs-4">Inventory ID</label>
                    <div class="col-8">
                        <input class="form-control form-control-lg" type="text" name="inventoryId" value="<?= $inventoryId ?? ''; ?>" required>
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="firstName" class="col-4 col-form-label fs-4">Product Name</label>
                    <div class="col-8">
                        <input class="form-control form-control-lg" type="text" name="productName" value="<?= $productName ?? ''; ?>" required>
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="firstName" class="col-4 col-form-label fs-4">Colour</label>
                    <div class="col-8">
                        <input class="form-control form-control-lg" type="text" name="colour" value="<?= $colour ?? ''; ?>" required>
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="firstName" class="col-4 col-form-label fs-4">Cost Price</label>
                    <div class="col-8">
                        <input class="form-control form-control-lg" type="text" name="costPrice" value="<?= $costPrice ?? ''; ?>" required>
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="firstName" class="col-4 col-form-label fs-4">Actual Price</label>
                    <div class="col-8">
                        <input class="form-control form-control-lg" type="text" name="sellPrice" value="<?= $sellPrice ?? ''; ?>" required>
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="firstName" class="col-4 col-form-label fs-4">Quantity</label>
                    <div class="col-8">
                        <input class="form-control form-control-lg" type="text" name="quantity" value="<?= $quantity ?? ''; ?>" required>
                    </div>
                </div>
                
            </div>

            <div class="d-grid">
                <button class="btn btn-success btn-lg">Submit</button>
            </div>
        </form>
    </div>
</div>

<?php
include_once "footer.php";
?>