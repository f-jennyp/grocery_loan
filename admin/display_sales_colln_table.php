<?php
if (isset($_GET['name'])) {
	$tableName = mysqli_real_escape_string($conn, urldecode($_GET['name']));

	$q = mysqli_query($conn, "SELECT * FROM $tableName");
	if (!$q) {
		echo "Query Error: " . mysqli_error($conn);
		die();
	}

?>
	<script>
		function DeleteMember(id) {
			if (confirm("You want to delete this row? ?")) {
				window.location.href = "delete_sales_colln_table.php?id=" + id;
			}
		}
	</script>
	<h2 align="center"><?php $tableName ?></h2>

	<table class="table table-bordered table-hover table-striped">
		<!-- Search form -->
		<tr>
			<form method="post" action="index.php?page=search_loan">
				<td colspan="12">
					<input type="text" placeholder="Search" name="searchMember" class="form-control" required />
				</td>
				<td colspan="5">
					<input type="submit" value="Search" name="sub" class="btn btn-warning" />
				</td>
			</form>

		</tr>
		<tr>
			<td colspan="5">

				<a title="Add New Loan Records" href="index.php?page=add_loan&table=<?php echo urlencode($tableName); ?>"><button class="btn btn-success btn-sm">Add
						New Loan <span class="glyphicon glyphicon-plus"></button></a>
				&nbsp; &nbsp;

				<!-- Print button -->
				<a title="Print all Loan Records" href="print_loan_record.php">
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
			<th>c. Total</th>
			<th>Actions</th>

		</Tr>
		<?php
		error_reporting(1);
		$rec_limit = 10;

		/* Get total number of records */

		$sql = "SELECT count(id) FROM $tableName ";
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
		$sql = "SELECT * " . "FROM $tableName " .
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
			<a href="javascript:DeleteMember('<?php echo $row['member_id']; ?>', '<?php echo $row['name']; ?>')" style='color:Red'><span class='glyphicon glyphicon-trash'></span></a>

			<a href="index.php?page=update_group_member&member_id=<?php echo $row['member_id']; ?>" style='color:green'><span class='glyphicon glyphicon-edit'></span></a>

		</td>

		<?php

			echo "</Tr>";
			$inc++;
		}


		//for shoing Pagination

		echo "<tr><td colspan='8'>";
		if ($pagi > 0) {
			$last = $pagi - 2;
			echo "<a href = \"index.php?page=display_member&pagi=$last\">Last 10 Records</a> |";
			echo "<a href = \"index.php?page=display_member&pagi=$pagi\">Next 10 Records</a>";
		} else if ($pagi == 0) {
			echo "<a href = \"index.php?page=display_member&pagi=$pagi\">Next 10 Records</a>";
		} else if ($left_rec < $rec_limit) {
			$last = $pagi - 2;
			echo "<a href = \"index.php?page=display_member&pagi=$last\">Last 10 Records</a>";
		}
		echo "</td></tr>";
		?>

	</table>
<?php
} ?>
<?php  ?>