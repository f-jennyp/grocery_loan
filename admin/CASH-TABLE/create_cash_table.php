<?php
if (isset($_GET['table'])) {
    $tableName = mysqli_real_escape_string($conn, urldecode($_GET['table']));

    $query = "SELECT total FROM $tableName ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $lastTotal = isset($row['total']) ? $row['total'] : 0;
    } else {
        $lastTotal = 0;
    }


    if (isset($_POST['save'])) {

        $date = mysqli_real_escape_string($conn, $_POST['date']);
        $charged_invoice = mysqli_real_escape_string($conn, $_POST['charged_invoice']);
        $amount = mysqli_real_escape_string($conn, $_POST['amount']);
        $total = mysqli_real_escape_string($conn, $_POST['total']);


        if (empty($date) || empty($charged_invoice)) {
            $err = "<font color='red'>Fill in all the required fields</font>";
        } else {

            $sql = "INSERT INTO $tableName (date, charged_invoice, amount, total) VALUES (
                '$date', '$charged_invoice', '$amount', '$total')";

            // Execute the SQL query
            if (mysqli_query($conn, $sql)) {
                header("Location: index.php?page=display_cash_table&name=" . urlencode($tableName));
                exit;
            } else {
                $err = "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
            }
        }
    }
}
?>

<h2 align="center">Add
    <?php echo str_replace('_', ' ', $tableName) ?> Details
</h2>
<span style="color: grey;">Please ensure all required fields are filled or enter '0' where applicable.</span>
<form method="post">

    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <?php echo @$err; ?>
        </div>
    </div>

    <div class="row" style="margin-top:10px">
        <div class="col-sm-4">Date</div>
        <div class="col-sm-5">
            <input type="date" name="date" class="form-control" required/>
        </div>
    </div>

    <div class="row" style="margin-top:10px">
        <div class="col-sm-4">Charged Invoice</div>
        <div class="col-sm-5">
            <input type="number" name="charged_invoice" class="form-control" required/>
        </div>
    </div>

    <div class="row" style="margin-top:10px">
        <div class="col-sm-4">Amount</div>
        <div class="col-sm-5">
            <input type="float" id="amount" name="amount" class="form-control" required/>
        </div>
    </div>

    <div class="row" style="margin-top:10px">
        <div class="col-sm-4">Total</div>
        <div class="col-sm-5">
            <input type="float" id="total" name="total" class="form-control" readonly/>
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
            <input type="submit" value="Process New Loan" name="save" class="btn btn-success" />
            <input type="reset" class="btn btn-danger" />
        </div>
        <div class="col-sm-4"></div>
    </div>
</form>