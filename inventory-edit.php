<?php
require_once 'database.php';
$conn = db_connect();

// Displaying the record to edit when the method is GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    $sql = "SELECT * FROM shopify_inventory WHERE inventoryId=" . $id;
    $inventory = db_queryOne($sql, $conn);

    $inventoryId = $inventory['inventoryId'];
    $productName = $inventory['productName'];
    $colour = $inventory['colour'];
    $costPrice = $inventory['costPrice'];
    $sellPrice = $inventory['sellPrice'];
    $quantity = $inventory['quantity'];
}
// Updating the data in the database and sending to index page when the method is POST 
else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $inventoryId = trim(filter_var($_POST['inventoryId'], FILTER_SANITIZE_NUMBER_INT));
    $productName = trim(filter_var($_POST['productName'], FILTER_SANITIZE_STRING));
    $colour = trim(filter_var($_POST['colour'], FILTER_SANITIZE_STRING));
    $costPrice = trim(filter_var($_POST['costPrice'], FILTER_SANITIZE_NUMBER_INT));
    $sellPrice = trim(filter_var($_POST['sellPrice'], FILTER_SANITIZE_NUMBER_INT));
    $quantity = trim(filter_var($_POST['quantity'], FILTER_SANITIZE_NUMBER_INT));
       
    $sql = "UPDATE shopify_inventory SET inventoryId=:inventoryId, ";
    $sql .= "productName=:productName, colour=:colour, costPrice=:costPrice, ";
    $sql .= "sellPrice=:sellPrice, quantity=:quantity ";
    $sql .= "WHERE inventoryId=:inventoryId";

    db_bindAll($sql, $conn, $inventoryId, $productName, $colour, $costPrice, $sellPrice, $quantity);

    db_disconnect($conn);

    header("Location: index.php?t=2&msg=TaskCompleted");
    exit;

}
?>

<?php
$title_tag = 'Edit Inventory';
include_once "header.php";
?>
<div class="container">

    <h1 class="text-center display-1 text-success"></h1>
    <h1 class="text-center text-uppercase">Edit this record?</h1>
    <div class="row mt-5 ms-1">

        <form class="row justify-content-center mb-5" method="POST">
            <div class="col-12 col-md-6">
                <div class="row mb-4">
                    <label for="inventoryId" class="col-4 col-form-label fs-4">Inventory Id</label>
                    <div class="col-8">
                        <input class="form-control form-control-lg" type="text" name="inventoryId" value="<?= $inventoryId ?? ''; ?>">
                    </div>
                </div>                
                <div class="row mb-4">
                    <label for="productName" class="col-4 col-form-label fs-4">Product Name</label>
                    <div class="col-8">
                        <input class="form-control form-control-lg" type="text" name="productName" value="<?= $productName ?? ''; ?>">
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="colour" class="col-4 col-form-label fs-4">Colour</label>
                    <div class="col-8">
                        <input class="form-control form-control-lg" type="text" name="colour" value="<?= $colour ?? ''; ?>">
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="costPrice" class="col-4 col-form-label fs-4">Cost Price</label>
                    <div class="col-8">
                        <input class="form-control form-control-lg" type="text" name="costPrice" value="<?= $costPrice ?? ''; ?>">
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="sellPrice" class="col-4 col-form-label fs-4">Sell Price</label>
                    <div class="col-8">
                        <input class="form-control form-control-lg" type="text" name="sellPrice" value="<?= $sellPrice ?? ''; ?>">
                    </div>
                </div>
                <div class="row mb-4">
                    <label for="quantity" class="col-4 col-form-label fs-4">Quantity</label>
                    <div class="col-8">
                        <input class="form-control form-control-lg" type="text" name="quantity" value="<?= $quantity ?? ''; ?>">
                    </div>
                </div>
                </div>
            </div>

            <input class="form-control form-control-lg" type="hidden" name="user_id" value="<?php echo $id; ?>">
            <div class="d-grid">
                <button class="btn btn-success btn-lg">Update Record</button>
            </div>
        </form>
    </div>

</div>

<?php
include_once "footer.php";
?>