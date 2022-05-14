<?php
require_once 'database.php';
$conn = db_connect();
?>

<?php
$title_tag = 'Shopify Inventory';
include_once "header.php";

// query to display all the data
$sql = "SELECT * FROM shopify_inventory";

$inventories = db_query($sql, $conn);

?>

<table class="sortable table table-secondary table-striped fs-5 mt-3">
    <thead class="thead-dark">
        <tr>
            <th scope="col" class="text-center">ID</th>
            <th scope="col" class="text-center">Product Name</th>
            <th scope="col" class="text-center">Colour</th>
            <th scope="col" class="text-center">Cost Price</th>
            <th scope="col" class="text-center">Actual Price</th>
            <th scope="col" class="text-center">Quantity</th>
            <th scope="col" class="text-center">Edit</th>
            <th scope="col" class="text-center">Delete</th>
        </tr>
    </thead>
    <tbody>
        <!-- looping to display each data in the table -->
        <?php foreach ($inventories as $inventory) { ?>
            <tr>
                <th class="text-center" scope="row"><?php echo $inventory['inventoryId']; ?></th>
                <td class="text-center"><?php echo $inventory['productName']; ?></td>
                <td class="text-center"><?php echo $inventory['colour']; ?></td>
                <td class="text-center"><?php echo $inventory['costPrice']; ?></td>
                <td class="text-center"><?php echo $inventory['sellPrice']; ?></td>
                <td class="text-center"><?php echo $inventory['quantity']; ?></td>
                <td class="text-center"><a class="btn btn-secondary" href="inventory-edit.php?id=<?php echo $inventory['inventoryId']; ?>" role="button">Edit <i class="bi bi-pencil-square"></i></a></td>
                    <td class="text-center"><a class="btn btn-danger" href="inventory-delete.php?id=<?php echo $inventory['inventoryId']; ?>" role="button">Delete <i class="bi bi-trash"></i></a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php
// displaying toast based on the success code
$t = filter_var($_GET['t'] ?? '', FILTER_SANITIZE_STRING);
$msg = filter_var($_GET['msg'] ?? '', FILTER_SANITIZE_STRING);
display_toast($t, $msg);
include_once "footer.php";
?>