<?php

if (isset($_POST['save'])) {

	$table_name = mysqli_real_escape_string($conn, $_POST['table_name']);

	if (empty($table_name)) {
		$err = "<font color='red'>Fill in all the required fields</font>";
	} else {
		$sql = mysqli_query($conn, "SELECT * FROM sales_collection_summary WHERE table_name='$table_name'");
		$r = mysqli_num_rows($sql);
		if ($r != true) {
			mysqli_query($conn, "INSERT INTO sales_collection_summary VALUES('', '$table_name')");

			$newTableName = str_replace(' ', '_', $table_name);
			$newTableName = mysqli_real_escape_string($conn, $newTableName); // Escape special characters

			$collnTableQuery = "CREATE TABLE `$newTableName` (
				`id` INT AUTO_INCREMENT PRIMARY KEY,
				`date` DATE,
				`or_num` INT,
				`charged_colln` FLOAT,
				`charged_total` FLOAT,
				`d_sales_for` FLOAT,
				`amount` FLOAT,
				`overage` FLOAT,
				`total` FLOAT,
				`c_total` FLOAT,
				UNIQUE (`or_num`)
			)";

			mysqli_query($conn, $collnTableQuery);

			$err = "<div class='alert alert-success'>New member has been added successfully</div>";
			header('location:index.php?page=display_sales_colln');
		} else {
			$err = "<div class='alert alert-danger'>This member already exists</div>";
		}
	}
}
?>

<h2 class="text-center">Add New Table | Sales Collection</h2>
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
			<input type="text" name="table_name" class="form-control" required />
		</div>
	</div>


	<div class="row" style="margin-top:10px">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">


			<input type="submit" value="Add New Table" name="save" class="btn btn-success" />
			<input type="reset" class="btn btn-danger" />
		</div>
		<div class="col-sm-4"></div>
	</div>
</form>