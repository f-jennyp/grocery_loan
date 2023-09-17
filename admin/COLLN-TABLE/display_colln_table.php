<?php
if (isset($_GET['name'])) {
	$tableName = mysqli_real_escape_string($conn, urldecode($_GET['name']));

	$q = mysqli_query($conn, "SELECT * FROM `$tableName`");
	if (!$q) {
		echo "Query Error: " . mysqli_error($conn);
		die();
	}

	?>
	<script>
		function DeleteCollnTable(id, tableName) {
			if (confirm("You want to delete this record?")) {
				window.location.href = "COLLN-TABLE/delete_colln_table.php?id=" + id + "&tableName=" + tableName;
			}
		}
	</script>
	<h2 align="center">
		<?php echo str_replace('_', ' ', $tableName) ?>
	</h2>

	<table class="table table-bordered table-hover table-striped">
		<!-- Search form -->
		<tr>
			<form method="post" action="index.php?page=search_colln_table&table=<?php echo urlencode($tableName); ?>">
				<td colspan="9">
					<input type="text" placeholder="Search Date" name="searchCollnTable" class="form-control" required />
				</td>
				<td colspan="3">
					<input type="submit" value="Search" name="sub" class="btn btn-warning" />
				</td>
			</form>
		</tr>
		<tr>
			<td colspan="12">

				<a title="Add New Sales Colln Record"
					href="index.php?page=create_colln_table&table=<?php echo urlencode($tableName); ?>"><button
						class="btn btn-success btn-sm">Add
						New <span class="glyphicon glyphicon-plus"></button></a>
				&nbsp; &nbsp;

				<a title="Print all Sales Colln Record"
					href="COLLN-TABLE/print_colln_table.php?table=<?php echo urlencode($tableName); ?>">
					<button class="btn btn-primary btn-sm">Print <span class="glyphicon glyphicon-print"></span></button>
				</a>
			</td>
		</tr>

		<Tr class="active">
			<th>#</th>
			<th>Date</th>
			<th>OR #</th>
			<th>Charged Colln</th>
			<th>Total (Charged Colln)</th>
			<th>D. Sales for</th>
			<th>Amount</th>
			<th>Overage</th>
			<th>Total</th>
			<th>C. Total</th>
			<th>Actions</th>

		</Tr>
		<?php
		error_reporting(1);
		$rec_limit = 10;

		/* Get total number of records */

		$sql = "SELECT count(id) FROM `$tableName` ";
		$retval = mysqli_query($conn, $sql);

		if (!$retval) {
			die('Could not get data: ' . mysqli_error($conn));
		}
		$row = mysqli_fetch_array($retval, MYSQLI_NUM);
		$rec_count = $row[0];

		if (isset($_GET['pagi'])) {
			$pagi = $_GET['pagi'] + 1;
			$offset = $rec_limit * $pagi;
		} else {
			$pagi = 0;
			$offset = 0;
		}


		$left_rec = $rec_count - ($pagi * $rec_limit);
		$sql = "SELECT * " . "FROM `$tableName` " .
			"LIMIT $offset, $rec_limit";

		$retval = mysqli_query($conn, $sql);

		if (!$retval) {
			die('Could not get data: ' . mysqli_error($conn));
		}

		$inc = 1;
		while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {

			echo "<Tr>";
			echo "<td>" . $inc . "</td>";
			echo "<td>" . $row['date'] . "</td>";
			echo "<td>" . $row['or_num'] . "</td>";
			echo "<td>" . $row['charged_colln'] . "</td>";
			echo "<td>" . $row['charged_total'] . "</td>";
			echo "<td>" . $row['d_sales_for'] . "</td>";
			echo "<td>" . $row['amount'] . "</td>";
			echo "<td>" . $row['overage'] . "</td>";
			echo "<td>" . $row['total'] . "</td>";
			echo "<td>" . $row['c_total'] . "</td>";
			?>
			<Td>
				<a href="javascript:DeleteCollnTable('<?php echo $row['id']; ?>', '<?php echo urlencode($tableName); ?>')"
					style='color:Red'><span class='glyphicon glyphicon-trash'></span></a>

				<a href="index.php?page=update_colln_table&id=<?php echo $row['id']; ?>&name=<?php echo urlencode($tableName); ?>"
					style='color:green'><span class='glyphicon glyphicon-edit'></span></a>

			</td>

			<?php

			echo "</Tr>";
			$inc++;
		}


		//for shoing Pagination
	
		echo "<tr><td colspan='12'>";
		if ($pagi > 0) {
			$last = $pagi - 2;
			echo "<a href=\"index.php?page=display_colln_table&name=" . urlencode($tableName) . "&pagi=$last\">Last 10 Records</a> | ";
			echo "<a href=\"index.php?page=display_colln_table&name=" . urlencode($tableName) . "&pagi=$pagi\">Next 10 Records</a>";
		} else if ($pagi == 0) {
			echo "<a href=\"index.php?page=display_colln_table&name=" . urlencode($tableName) . "&pagi=$pagi\">Next 10 Records</a>";
		} else if ($left_rec < $rec_limit) {
			$last = $pagi - 2;
			echo "<a href=\"index.php?page=display_colln_table&name=" . urlencode($tableName) . "&pagi=$last\">Last 10 Records</a>";
		}
		echo "</td></tr>";
		?>

	</table>
	<?php
} ?>
<?php ?>