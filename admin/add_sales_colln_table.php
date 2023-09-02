<?php
if (isset($_GET['table'])) {
    $tableName = mysqli_real_escape_string($conn, urldecode($_GET['table']));

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
            $err = "<font color='red'>Fill in all the required fields</font>";
        } else {

            $sql = "INSERT INTO $tableName (date, or_num, charged_colln, charged_total, d_sales_for, amount, overage, total, c_total) VALUES (
                '$date', '$or_num', '$charged_colln', '$charged_total', '$d_sales_for', '$amount', '$overage', '$total', '$c_total' )";

            // Execute the SQL query
            if (mysqli_query($conn, $sql)) {
                $err = "<div class='alert alert-success'>Loan has been allotted successfully!</div>";
                header('location:index.php?page=display_sales_colln');
            } else {
                $err = "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
            }
        }
    }
}
?>

<h2 align="center">Add <?php echo str_replace('_', ' ', $tableName) ?> Details</h2>
<form method="post">

    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4"><?php echo @$err; ?></div>
    </div>

    <div class="row" style="margin-top:10px">
        <div class="col-sm-4">Date</div>
        <div class="col-sm-5">
            <input type="date" name="date" class="form-control" />
        </div>
    </div>

    <div class="row" style="margin-top:10px">
        <div class="col-sm-4">OR #</div>
        <div class="col-sm-5">
            <input type="number" name="or_num" class="form-control" />
        </div>
    </div>

    <div class="row" style="margin-top:10px">
        <div class="col-sm-4">Charged Colln</div>
        <div class="col-sm-5">
            <input type="number" name="charged_colln" class="form-control" />
        </div>
    </div>

    <div class="row" style="margin-top:10px">
        <div class="col-sm-4">Total (Charged Colln)</div>
        <div class="col-sm-5">
            <input type="number" name="charged_total" class="form-control" />
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
            <input type="number" name="amount" class="form-control" />
        </div>
    </div>

    <div class="row" style="margin-top:10px">
        <div class="col-sm-4">Overage</div>
        <div class="col-sm-5">
            <input type="number" name="overage" class="form-control" />
        </div>
    </div>

    <div class="row" style="margin-top:10px">
        <div class="col-sm-4">Total</div>
        <div class="col-sm-5">
            <input type="number" name="total" class="form-control" />
        </div>
    </div>

    <div class="row" style="margin-top:10px">
        <div class="col-sm-4">C Total</div>
        <div class="col-sm-5">
            <input type="number" name="c_total" class="form-control" />
        </div>
    </div>

    <div class="row" style="margin-top:10px">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <input type="submit" value="Process New Loan" name="save" class="btn btn-success" />
            <input type="reset" class="btn btn-danger" />
        </div>
        <div class="col-sm-4"></div>
    </div>
</form>