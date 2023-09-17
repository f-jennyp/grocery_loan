<?php
if (isset($_GET['table'])) {
    $tableName = mysqli_real_escape_string($conn, urldecode($_GET['table']));


    extract($_POST);
    if (isset($save)) {
        $id = intval($_GET['id']);

        // Get the original table name before the update
        $originalTableName = $tableName;


        mysqli_query($conn, "UPDATE charged_cash_sales_summary SET  
		`table_name` = '$table_name'
		WHERE `id`='$id'
		 ");
        
        $tableName = str_replace(' ', '_', $table_name);

        if ($originalTableName !== $tableName) {
            $renameTableQuery = "RENAME TABLE $originalTableName TO $tableName";
            mysqli_query($conn, $renameTableQuery);
        }


        $err = "<font color='blue'>Table Updated</font>";
        header('location:index.php?page=display_charged_cash');
        exit();
    }

    $sql = mysqli_query($conn, "SELECT * FROM charged_cash_sales_summary WHERE id='" . $_GET['id'] . "'");
    $res = mysqli_fetch_array($sql);


?>

    <h2 align="center">Update Table | <?php echo $res['table_name']; ?></h2>
    <form method="post">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <?php echo @$err; ?>
            </div>
        </div>

        <div class="row" style="margin-top:10px">
            <div class="col-sm-4">Table Name</div>
            <div class="col-sm-5">
                <input type="text" value="<?php echo $res['table_name']; ?>" name="table_name" class="form-control" required />
            </div>
        </div>



        <div class="row" style="margin-top:10px">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <input type="submit" value="Update Table" name="save" class="btn btn-success" />
                <input type="reset" class="btn btn-danger" />
            </div>
        </div>
    </form>
<?php
} ?>
