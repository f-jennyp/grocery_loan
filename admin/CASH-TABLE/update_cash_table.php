<?php

if (isset($_GET['name'])) {
    $tableName = mysqli_real_escape_string($conn, urldecode($_GET['name']));

    $q = mysqli_query($conn, "SELECT * FROM `$tableName`");
    if (!$q) {
        echo "Query Error: " . mysqli_error($conn);
        die();
    }
    $id = intval($_GET['id']);

    $query = "SELECT total FROM `$tableName` WHERE id < $id ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $lastTotal = isset($row['total']) ? $row['total'] : 0;
    } else {
        $lastTotal = 0;
    }

    extract($_POST);
    if (isset($save)) {
        $id = intval($_GET['id']);

        mysqli_query($conn, "UPDATE `$tableName` SET  
            `date` ='$date', 
            `charged_invoice` = '$charged_invoice', 
            `amount` = '$amount', 
            `total` = '$total'
            WHERE id='$id'
        ");

        header("Location: index.php?page=display_cash_table&name=" . urlencode($tableName));
        exit;
    }

    $sql = mysqli_query($conn, "SELECT * FROM `$tableName` WHERE id='" . $_GET['id'] . "'");
    $res = mysqli_fetch_array($sql);
}
?>
<h2 align="center">Update
    <?php echo str_replace('_', ' ', $tableName) ?> record
</h2><span style="color: grey;">Please ensure all required fields are filled or enter '0' where applicable.</span>
<form method="post">

    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <?php echo @$err; ?>
        </div>
    </div>

    <div class="row" style="margin-top:10px">
        <div class="col-sm-4">DATE</div>
        <div class="col-sm-5">
            <input type="date" value="<?php echo $res['date']; ?>" name="date" class="form-control" required/>
        </div>
    </div>


    <div class="row" style="margin-top:10px">
        <div class="col-sm-4">Charged Invoice</div>
        <div class="col-sm-5">
            <input type="number" value="<?php echo $res['charged_invoice']; ?>" name="charged_invoice"
                class="form-control" required/>
        </div>
    </div>

    <div class="row" style="margin-top:10px">
        <div class="col-sm-4">Amount</div>
        <div class="col-sm-5">
            <input type="float" value="<?php echo $res['amount']; ?>" id="amount" name="amount" class="form-control" required/>
        </div>
    </div>

    <div class="row" style="margin-top:10px">
        <div class="col-sm-4">Total</div>
        <div class="col-sm-5">
            <input type="float" value="<?php echo $res['total']; ?>" id="total" name="total" class="form-control" readonly/>
        </div>
    </div>

    <script>
        function calculateTotal() {
            var amount = parseFloat(document.getElementById('amount').value) || 0;
            var lastTotal = parseFloat(<?php echo $lastTotal; ?>) || 0;
            var total = lastTotal + amount;
            document.getElementById('total').value = total;
        }
        document.getElementById('amount').addEventListener('input', calculateTotal);
    </script>

    <div class="row" style="margin-top:10px">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <input type="submit" value="Update Loan" name="save" class="btn btn-success" />
            <input type="reset" class="btn btn-danger" />
        </div>
        <div class="col-sm-4"></div>
    </div>
</form>