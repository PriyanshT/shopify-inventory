<?php
require_once 'database.php';
$conn = db_connect();

// Displaying the record to delete when the method is GET
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

    $title_tag = 'Delete Inventory';
    include_once "header.php";
?>
    <h1 class="text-center display-1 text-danger"><i class="bi bi-x-circle"></i></h1>
    <h1 class="text-center text-uppercase">Delete this record?</h1>
    <div class="row justify-content-center">
        <form class="col-6 mb-5" method="POST">
            <div class="row mb-4">
                <label for="firstName" class="col-4 col-form-label fs-4">Inventory Id</label>
                <div class="col-8">
                    <input class="form-control form-control-lg" type="text" name="inventoryId" value="<?php echo $inventoryId; ?>" readonly>
                </div>
            </div>
            <div class="row mb-4">
                <label for="lastName" class="col-4 col-form-label fs-4">Product Name</label>
                <div class="col-8">
                    <input class="form-control form-control-lg" type="text" name="productName" value="<?php echo $productName; ?>" readonly>
                </div>
            </div>
            <div class="row mb-4">
                <label for="bookName" class="col-4 col-form-label fs-4">Colour</label>
                <div class="col-8">
                    <input class="form-control form-control-lg" type="text" name="colour" value="<?php echo $colour; ?>" readonly>
                </div>
            </div>
            <div class="row mb-4">
                <label for="bookURL" class="col-4 col-form-label fs-4">Cost Price</label>
                <div class="col-8">
                    <input class="form-control form-control-lg" type="text" name="costPrice" value="<?php echo $costPrice; ?>" readonly>
                </div>
            </div>
            <div class="row mb-4">
                <label for="bookYear" class="col-4 col-form-label fs-4">Sell Price</label>
                <div class="col-8">
                    <input class="form-control form-control-lg" type="number" name="sellPrice" value="<?php echo $sellPrice; ?>" readonly>
                </div>
            </div>
            <div class="row mb-4">
                <label for="genre" class="col-4 col-form-label fs-4">Quantity</label>
                <div class="col-8">
                    <input class="form-control form-control-lg" type="text" name="quantity" value="<?php echo $quantity; ?>" readonly>
                </div>
            </div>
            <input class="form-control form-control-lg" type="hidden" name="user_id" value="<?php echo $id; ?>" readonly>
            <div class="d-grid">
                <button class="btn btn-danger btn-lg">Delete Forever</button>
            </div>
        </form>
    </div>

<?php
    include_once "footer.php";
}
// Deleting the data from database and sending to index page when the method is POST
 else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = filter_var($_POST['inventoryId'], FILTER_SANITIZE_NUMBER_INT);

    $sql = "DELETE FROM shopify_inventory WHERE inventoryId=" . $id;

    $cmd = $conn->prepare($sql);
    $cmd->execute();

    header("Location: index.php?t=3&msg=TaskCompleted");
}
