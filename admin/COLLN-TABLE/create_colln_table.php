<?php
if (isset($_GET['table'])) {
    $tableName = mysqli_real_escape_string($conn, urldecode($_GET['table']));

    $query = "SELECT charged_total, c_total FROM $tableName ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $lastCharged_total = isset($row['charged_total']) ? $row['charged_total'] : 0;
        $lastC_total = isset($row['c_total']) ? $row['c_total'] : 0;
    } else {
        $lastCharged_total = 0;
        $lastC_total = 0;
    }


    if (isset($_POST['save'])) {

        $date = mysqli_real_escape_string($conn, $_POST['date']);
        $or_num = mysqli_real_escape_string($conn, $_POST['or_num']);
        $charged_colln = mysqli_real_escape_string($conn, $_POST['charged_colln']);
        $charged_total = mysqli_real_escape_string($conn, $_POST['charged_total']);
        $d_sales_for = mysqli_real_escape_string($conn, $_POST['d_sales_for']);
        $amount = mysqli_real_escape_string($conn, $_POST['amount']);
        $overage = mysqli_real_escape_string($conn, $_POST['overage']);
        $total = mysqli_real_escape_string($conn, $_POST['total']);
        $c_total = mysqli_real_escape_string($conn, $_POST['c_total']);


        if (empty($date) || empty($or_num)) {
            $err = "<font color='red'>Fill in all the required fields or enter 0 </font>";
        } else {

            $sql = "INSERT INTO $tableName (date, or_num, charged_colln, charged_total, d_sales_for, amount, overage, total, c_total) VALUES (
                '$date', '$or_num', '$charged_colln', '$charged_total', '$d_sales_for', '$amount', '$overage', '$total', '$c_total' )";

            // Execute the SQL query
            if (mysqli_query($conn, $sql)) {
                header("Location: index.php?page=display_colln_table&name=" . urlencode($tableName));
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
</h2><span style="color: grey;">Please ensure all required fields are filled or enter '0' where applicable.</span>
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
            <input type="date" name="date" class="form-control" required />
        </div>
    </div>

    <div class="row" style="margin-top:10px">
        <div class="col-sm-4">OR #</div>
        <div class="col-sm-5">
            <input type="number" name="or_num" class="form-control" required />
        </div>
    </div>

    <div class="row" style="margin-top:10px">
        <div class="col-sm-4">Charged Colln</div>
        <div class="col-sm-5">
            <input type="float" id="charged_colln" name="charged_colln" class="form-control" />
        </div>
    </div>

    <div class="row" style="margin-top:10px">
        <div class="col-sm-4">Total (Charged Colln)</div>
        <div class="col-sm-5">
            <input type="float" id="charged_total" name="charged_total" class="form-control" readonly />
        </div>
    </div>

    <div class="row" style="margin-top:10px">
        <div class="col-sm-4">D. Sales for</div>
        <div class="col-sm-5">
            <input type="number" name="d_sales_for" class="form-control" />
        </div>
    </div>


    <div class="row" style="margin-top:10px">
        <div class="col-sm-4">Amount</div>
        <div class="col-sm-5">
            <input type="float" id="amount" name="amount" class="form-control" required />
        </div>
    </div>

    <div class="row" style="margin-top:10px">
        <div class="col-sm-4">Overage</div>
        <div class="col-sm-5">
            <input type="float" id="overage" name="overage" class="form-control" required />
        </div>
    </div>

    <div class="row" style="margin-top:10px">
        <div class="col-sm-4">Total</div>
        <div class="col-sm-5">
            <input type="float" id="total" name="total" class="form-control" readonly />
        </div>
    </div>

    <div class="row" style="margin-top:10px">
        <div class="col-sm-4">C Total</div>
        <div class="col-sm-5">
            <input type="float" id="c_total" name="c_total" class="form-control" readonly />
        </div>
    </div>

    <script>
        function calculateTotal() {
            var amount = parseFloat(document.getElementById('amount').value) || 0;
            var overage = parseFloat(document.getElementById('overage').value) || 0;
            var total = amount + overage;
            document.getElementById('total').value = total;
        }
        document.getElementById('overage').addEventListener('input', calculateTotal);
    </script>


    <script>
        function calculateCharged_Total() {
            var charged_colln = parseFloat(document.getElementById('charged_colln').value) || 0;
            var lastCharged_total = parseFloat(<?php echo $lastCharged_total; ?>) || 0;
            var charged_total = lastCharged_total + charged_colln;
            document.getElementById('charged_total').value = charged_total;
        }

        document.getElementById('charged_colln').addEventListener('input', calculateCharged_Total);
    </script>


    <script>
        function calculateC_Total() {
            var amount = parseFloat(document.getElementById('amount').value) || 0;
            var overage = parseFloat(document.getElementById('overage').value) || 0;
            var total = amount + overage;
            var lastC_total = parseFloat(<?php echo $lastC_total; ?>) || 0;
            var c_total = lastC_total + total;
            document.getElementById('c_total').value = c_total;
        }

        document.getElementById('amount').addEventListener('input', calculateC_Total);
        document.getElementById('overage').addEventListener('input', calculateC_Total);
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