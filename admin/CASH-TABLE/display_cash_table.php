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
		function DeleteCash(id, tableName) {
			if (confirm("You want to delete this record?")) {
				window.location.href = "CASH-TABLE/delete_cash_table.php?id=" + id + "&tableName=" + tableName;
			}
		}
	</script>
	<h2 align="center"><?php echo str_replace('_', ' ', $tableName) ?></h2>

	<table class="table table-bordered table-hover table-striped">
		<!-- Search form -->
		<tr>
			<form method="post" action="index.php?page=search_cash_table&table=<?php echo urlencode($tableName); ?>">
				<td colspan="5">
					<input type="text" placeholder="Search date or charged invoice" name="searchCashTable" class="form-control" required />
				</td>
				<td colspan="3">
					<input type="submit" value="Search" name="sub" class="btn btn-warning" />
				</td>
			</form>

		</tr>
		<tr>
			<td colspan="8">

				<a title="Add New Sales Record" href="index.php?page=create_cash_table&table=<?php echo urlencode($tableName); ?>"><button class="btn btn-success btn-sm">Add
						New <span class="glyphicon glyphicon-plus"></button></a>
				&nbsp; &nbsp;

				<a title="Print all Charged Cash Record"
					href="CASH-TABLE/print_cash_table.php?table=<?php echo urlencode($tableName); ?>">
					<button class="btn btn-primary btn-sm">Print <span class="glyphicon glyphicon-print"></span></button>
				</a>
			</td>
		</tr>

		<Tr class="active">
			<th>#</th>
			<th>Date</th>
			<th>Charged Invoice</th>
			<th>Amount</th>
			<th>Total</th>
            <th>Action</th>

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
			echo "<td>" . $row['charged_invoice'] . "</td>";
			echo "<td>" . $row['amount'] . "</td>";
			echo "<td>" . $row['total'] . "</td>";
		?>
		<Td>
			<a href="javascript:DeleteCash('<?php echo $row['id']; ?>', '<?php echo urlencode($tableName); ?>')" style='color:Red'><span class='glyphicon glyphicon-trash'></span></a>

			<a href="index.php?page=update_cash_table&id=<?php echo $row['id']; ?>&name=<?php echo urlencode($tableName); ?>" style='color:green'><span class='glyphicon glyphicon-edit'></span></a>

		</td>

		<?php

			echo "</Tr>";
			$inc++;
		}


		//for shoing Pagination

		echo "<tr><td colspan='8'>";
		if ($pagi > 0) {
			$last = $pagi - 2;
			echo "<a href=\"index.php?page=display_cash_table&name=" . urlencode($tableName) . "&pagi=$last\">Last 10 Records</a> | ";
			echo "<a href=\"index.php?page=display_cash_table&name=" . urlencode($tableName) . "&pagi=$pagi\">Next 10 Records</a>";
		} else if ($pagi == 0) {
			echo "<a href=\"index.php?page=display_cash_table&name=" . urlencode($tableName) . "&pagi=$pagi\">Next 10 Records</a>";
		} else if ($left_rec < $rec_limit) {
			$last = $pagi - 2;
			echo "<a href=\"index.php?page=display_cash_table&name=" . urlencode($tableName) . "&pagi=$last\">Last 10 Records</a>";
		}
		echo "</td></tr>";
		?>

	</table>
<?php
} ?>
<?php  ?>