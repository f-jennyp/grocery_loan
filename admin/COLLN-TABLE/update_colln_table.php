<?php

if (isset($_GET['name'])) {
    $tableName = mysqli_real_escape_string($conn, urldecode($_GET['name']));

    $q = mysqli_query($conn, "SELECT * FROM `$tableName`");
    if (!$q) {
        echo "Query Error: " . mysqli_error($conn);
        die();
    }
    $id = intval($_GET['id']);

    $query = "SELECT charged_total, c_total FROM `$tableName` WHERE id < $id ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $lastCharged_total = isset($row['charged_total']) ? $row['charged_total'] : 0;
        $lastC_total = isset($row['c_total']) ? $row['c_total'] : 0;
    } else {
        $lastCharged_total = 0;
        $lastC_total = 0;
    }

    extract($_POST);
    if (isset($save)) {
        $id = intval($_GET['id']);

        mysqli_query($conn, "UPDATE `$tableName` SET  
            `date` ='$date', 
            `or_num` = '$or_num',
            `charged_colln` = '$charged_colln', 
            `charged_total` = '$charged_total', 
            `d_sales_for` = '$d_sales_for', 
            `amount` = '$amount', 
            `overage` = '$overage', 
            `total` = '$total', 
            `c_total` = '$c_total'
            WHERE id='$id'
        ");

        header("Location: index.php?page=display_colln_table&name=" . urlencode($tableName));
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
        <div class="col-sm-4">DATE <span style="color: red;">*</span></div>
        <div class="col-sm-5">
            <input type="date" value="<?php echo $res['date']; ?>" name="date" class="form-control" required />
        </div>
    </div>


    <div class="row" style="margin-top:10px">
        <div class="col-sm-4">OR # <span style="color: red;">*</span></div>
        <div class="col-sm-5">
            <input type="number" value="<?php echo $res['or_num']; ?>" name="or_num" class="form-control" required />
        </div>
    </div>

    <div class="row" style="margin-top:10px">
        <div class="col-sm-4">Charged Colln <span style="color: red;">*</span></div>
        <div class="col-sm-5">
            <input type="float" value="<?php echo $res['charged_colln']; ?>" id="charged_colln" name="charged_colln" class="form-control" required />
        </div>
    </div>

    <div class="row" style="margin-top:10px">
        <div class="col-sm-4">Total (Charged Colln)</div>
        <div class="col-sm-5">
            <input type="float" value="<?php echo $res['charged_total']; ?>" id="charged_total" name="charged_total" class="form-control" readonly />
        </div>
    </div>

    <div class="row" style="margin-top:10px">
        <div class="col-sm-4">D. Sales for</div>
        <div class="col-sm-5">
            <input type="number" value="<?php echo $res['d_sales_for']; ?>" name="d_sales_for" class="form-control" />
        </div>
    </div>

    <div class="row" style="margin-top:10px">
        <div class="col-sm-4">Amount <span style="color: red;">*</span></div>
        <div class="col-sm-5">
            <input type="float" value="<?php echo $res['amount']; ?>" id="amount" name="amount" class="form-control" required />
        </div>
    </div>

    <div class="row" style="margin-top:10px">
        <div class="col-sm-4">Overage <span style="color: red;">*</span></div>
        <div class="col-sm-5">
            <input type="float" value="<?php echo $res['overage']; ?>" id="overage" name="overage" class="form-control" required />
        </div>
    </div>

    <div class="row" style="margin-top:10px">
        <div class="col-sm-4">Total</div>
        <div class="col-sm-5">
            <input type="float" value="<?php echo $res['total']; ?>" id="total" name="total" class="form-control" readonly />
        </div>
    </div>

    <div class="row" style="margin-top:10px">
        <div class="col-sm-4">C Total</div>
        <div class="col-sm-5">
            <input type="float" value="<?php echo $res['c_total']; ?>" id="c_total" name="c_total" class="form-control" readonly />
        </div>
    </div>


    <script>
        function calculateTotal() {
            var amount = parseFloat(document.getElementById('amount').value) || 0;
            var overage = parseFloat(document.getElementById('overage').value) || 0;
            var total = amount + overage;
            document.getElementById('total').value = total.toFixed(2);
        }
        document.getElementById('overage').addEventListener('input', calculateTotal);
    </script>


    <script>
        function calculateCharged_Total() {
            var charged_colln = parseFloat(document.getElementById('charged_colln').value) || 0;
            var lastCharged_total = parseFloat(<?php echo $lastCharged_total; ?>) || 0;
            var charged_total = lastCharged_total + charged_colln;
            document.getElementById('charged_total').value = charged_total.toFixed(2);
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
            document.getElementById('c_total').value = c_total.toFixed(2);;
        }

        document.getElementById('amount').addEventListener('input', calculateC_Total);
        document.getElementById('overage').addEventListener('input', calculateC_Total);
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