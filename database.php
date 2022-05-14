<?php

require_once 'db_cred.php';

function db_query($sql, $conn)
{
    try {
        $cmd = $conn->prepare($sql);
        $cmd->execute();
        $inventories = $cmd->fetchall();
        return $inventories;
    } catch (Exception $e) {
        echo "Exception Occured.";
    }
}

function db_queryOne($sql, $conn)
{
    try {
        $cmd = $conn->prepare($sql);
        $cmd->execute();
        $inventories = $cmd->fetch();
        return $inventories;
    } catch (Exception $e) {
        echo "Exception Occured.";
    }
}

function db_bindAll($sql, $conn, $inventoryId, $productName, $colour, $costPrice, $sellPrice, $quantity)
{
    try {
        // Create command object and fill with form values
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':inventoryId', $inventoryId, PDO::PARAM_INT);
        $cmd->bindParam(':productName', $productName, PDO::PARAM_STR, 45);
        $cmd->bindParam(':colour', $colour, PDO::PARAM_STR, 45);
        $cmd->bindParam(':costPrice', $costPrice, PDO::PARAM_INT);
        $cmd->bindParam(':sellPrice', $sellPrice, PDO::PARAM_INT);
        $cmd->bindParam(':quantity', $quantity, PDO::PARAM_INT);

        // Execute the command
        $cmd->execute();
    } catch (Exception $e) {
        echo "Exception Occured.";
    }
}

// to connect with the database
function db_connect()
{
    $conn = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_USER, DB_NAME, DB_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $conn;
}

// to disconnect
function db_disconnect($conn)
{
    if (isset($conn)) {
        $conn = null;
    }
}

// displaying toast based on the success code msg
// 1 - when data is added, 2 - when data is edited, 3 - when data is deleted
function display_toast($t, $msg)
{
    if (!($t && $msg)) {
        return;
    }

    $msgs = [];
    $msgs[1] = "Successfully Added!";
    $msgs[2] = "Successfully Edited!";
    $msgs[3] = "Successfully Deleted!";

    echo <<<EOL
    <div class="toast bottom-0 end-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-dark text-light">
            <strong class="me-auto">$msgs[$t]</strong>
            <small>11 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body bg-dark text-light">
            $msg
        </div>
    </div>
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            var toastElList = [].slice.call(document.querySelectorAll('.toast'))
            var toastList = toastElList.map(function (toastEl) {
                return new bootstrap.Toast(toastEl);
            });
            toastList.forEach(toast => toast.show());
        });
    </script>
    EOL;
}