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
		function DeleteLoan(id, tableName) {
			if (confirm("You want to delete this record?")) {
				window.location.href = "LOAN-MEMBER/delete_loan.php?id=" + id + "&tableName=" + tableName;
			}
		}
	</script>
	<h2 align="center">TELCARE, MPC - GROCERY LOAN |
		<?php echo str_replace('_', ' ', $tableName) ?>
	</h2>

	<table class="table table-bordered table-hover table-striped">
		<!-- Search form -->
		<tr>
			<form method="post" action="index.php?page=search_loan&table=<?php echo urlencode($tableName); ?>">
				<td colspan="15">
					<input type="text" placeholder="Search Date or Payment OR#" name="searchLoan" class="form-control"
						required />
				</td>
				<td colspan="3">
					<input type="submit" value="Search" name="sub" class="btn btn-warning" />
				</td>
			</form>

		</tr>
		<tr>
			<td colspan="18">

				<a title="Add New Loan Records"
					href="index.php?page=create_loan&table=<?php echo urlencode($tableName); ?>"><button
						class="btn btn-success btn-sm">Add
						New Loan <span class="glyphicon glyphicon-plus"></button></a>
				&nbsp; &nbsp;

				<!-- Print button -->
				<a title="Print all Loan Records"
					href="LOAN-MEMBER/print_loan.php?table=<?php echo urlencode($tableName); ?>">
					<button class="btn btn-primary btn-sm">Print <span class="glyphicon glyphicon-print"></span></button>
				</a>
			</td>
		</tr>

		<Tr class="active">
			<th>#</th>
			<th>Date</th>
			<th>Loan Amount</th>
			<th>Payment Amount</th>
			<th>Payment OR#</th>
			<th>Payment Date</th>
			<th>Amount Balance</th>
			<th>Laon Balance</th>
			<th>SC Starts</th>
			<th>@ 4%</th>
			<th>SC Dates</th>
			<th>#Mos.</th>
			<th>4% SC</th>
			<th>SC Payments</th>
			<th>SC OR#</th>
			<th>SC Date</th>
			<th>SC Balance</th>
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
			echo "<td>" . $row['loan_amount'] . "</td>";
			echo "<td>" . $row['payment_amount'] . "</td>";
			echo "<td>" . $row['or_num'] . "</td>";
			echo "<td>" . $row['or_date'] . "</td>";
			echo "<td>" . $row['amount_balance'] . "</td>";
			echo "<td>" . $row['loan_balance'] . "</td>";
			echo "<td>" . $row['sc_starts'] . "</td>";
			echo "<td>" . $row['four_percent'] . "</td>";
			echo "<td>" . $row['sc_dates'] . "</td>";
			echo "<td>" . $row['months'] . "</td>";
			echo "<td>" . $row['four_percent_sc'] . "</td>";
			echo "<td>" . $row['sc_payments'] . "</td>";
			echo "<td>" . $row['sc_payments_or_num'] . "</td>";
			echo "<td>" . $row['sc_payments_date'] . "</td>";
			echo "<td>" . $row['sc_balance'] . "</td>";
			?>
			<Td>
				<a href="javascript:DeleteLoan('<?php echo $row['id']; ?>', '<?php echo urlencode($tableName); ?>')"
					style='color:Red'><span class='glyphicon glyphicon-trash'></span></a>

				<a href="index.php?page=update_loan&id=<?php echo $row['id']; ?>&name=<?php echo urlencode($tableName); ?>"
					style='color:green'><span class='glyphicon glyphicon-edit'></span></a>

			</td>

			<?php

			echo "</Tr>";
			$inc++;
		}


		//for shoing Pagination
	

		echo "<tr><td colspan='18'>";
		if ($pagi > 0) {
			$last = $pagi - 2;
			echo "<a href=\"index.php?page=display_loan&name=" . urlencode($tableName) . "&pagi=$last\">Last 10 Records</a> | ";
			echo "<a href=\"index.php?page=display_loan&name=" . urlencode($tableName) . "&pagi=$pagi\">Next 10 Records</a>";
		} else if ($pagi == 0) {
			echo "<a href=\"index.php?page=display_loan&name=" . urlencode($tableName) . "&pagi=$pagi\">Next 10 Records</a>";
		} else if ($left_rec < $rec_limit) {
			$last = $pagi - 2;
			echo "<a href=\"index.php?page=display_loan&name=" . urlencode($tableName) . "&pagi=$last\">Last 10 Records</a>";
		}
		echo "</td></tr>";
		?>

	</table>
	<?php
} ?>
<?php ?>