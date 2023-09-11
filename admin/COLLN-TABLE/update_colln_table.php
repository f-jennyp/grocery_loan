<?php

if (isset($_GET['name'])) {
    $tableName = mysqli_real_escape_string($conn, urldecode($_GET['name']));

    $q = mysqli_query($conn, "SELECT * FROM $tableName");
    if (!$q) {
        echo "Query Error: " . mysqli_error($conn);
        die();
    }

    extract($_POST);
    if (isset($save)) {
		$id = intval($_GET['id']);

        mysqli_query($conn, "UPDATE $tableName SET  
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

        $err = "<font color='blue'>Loan records updated</font>";
    }

    $sql = mysqli_query($conn, "SELECT * FROM $tableName WHERE id='" . $_GET['id'] . "'");
    $res = mysqli_fetch_array($sql);
}
?>
<h2 align="center">Update Allotted Loan Records</h2>
<form method="post">

    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4"><?php echo @$err; ?></div>
    </div>

    <div class="row" style="margin-top:10px">
        <div class="col-sm-4">DATE</div>
        <div class="col-sm-5">
            <input type="date" value="<?php echo $res['date']; ?>" name="date" class="form-control" />
        </div>
    </div>


    <div class="row" style="margin-top:10px">
        <div class="col-sm-4">OR #</div>
        <div class="col-sm-5">
            <input type="number" value="<?php echo $res['or_num']; ?>" name="or_num" class="form-control" />
        </div>
    </div>

    <div class="row" style="margin-top:10px">
        <div class="col-sm-4">Charged Colln</div>
        <div class="col-sm-5">
            <input type="number" value="<?php echo $res['charged_colln']; ?>" name="charged_colln" class="form-control" />
        </div>
    </div>

    <div class="row" style="margin-top:10px">
        <div class="col-sm-4">Total (Charged Colln)</div>
        <div class="col-sm-5">
            <input type="number" value="<?php echo $res['charged_total']; ?>" name="charged_total" class="form-control" />
        </div>
    </div>

    <div class="row" style="margin-top:10px">
        <div class="col-sm-4">D. Sales for</div>
        <div class="col-sm-5">
            <input type="number" value="<?php echo $res['d_sales_for']; ?>" name="d_sales_for" class="form-control" />
        </div>
    </div>

    <div class="row" style="margin-top:10px">
        <div class="col-sm-4">Amount</div>
        <div class="col-sm-5">
            <input type="number" value="<?php echo $res['amount']; ?>" name="amount" class="form-control" />
        </div>
    </div>

    <div class="row" style="margin-top:10px">
        <div class="col-sm-4">Overage</div>
        <div class="col-sm-5">
            <input type="number" value="<?php echo $res['overage']; ?>" name="overage" class="form-control" />
        </div>
    </div>

    <div class="row" style="margin-top:10px">
        <div class="col-sm-4">Total</div>
        <div class="col-sm-5">
            <input type="number" value="<?php echo $res['total']; ?>" name="total" class="form-control" />
        </div>
    </div>

    <div class="row" style="margin-top:10px">
        <div class="col-sm-4">C Total</div>
        <div class="col-sm-5">
            <input type="number" value="<?php echo $res['c_total']; ?>" name="c_total" class="form-control" />
        </div>
    </div>


	<div class="row" style="margin-top:10px">
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
			<input type="submit" value="Update Loan" name="save" class="btn btn-success" />
			<input type="reset" class="btn btn-danger" />
		</div>
		<div class="col-sm-4"></div>
	</div>
</form>


