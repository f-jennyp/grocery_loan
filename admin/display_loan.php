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
				if (confirm("You want to delete this Member ?")) {
					window.location.href = "delete_group_member.php?id=" + id;
				}
			}
		</script>
		<h2 align="center">TELCARE, MPC - GROCERY LOAN</h2>

		<table class="table table-bordered table-hover table-striped">
			<!-- Search form -->
			<tr>
				<td colspan="7">
					<!-- Dropdown for selecting group -->
					<select name="seachLoan" class="form-control" required>
						<option value="">Select Group</option>
						<?php
						$q1 = mysqli_query($conn, "select * from groups");
						while ($r1 = mysqli_fetch_assoc($q1)) {
							echo "<option value='" . $r1['group_id'] . "'>" . $r1['group_name'] . "</option>";
						}
						?>
					</select>
				</td>
				<td colspan="5">
					<!-- Print button -->
					<a title="Print all Loan Records" href="print_loan_record.php">
						<button class="btn btn-primary btn-sm">Print <span class="glyphicon glyphicon-print"></span></button>
					</a>
				</td>
			</tr>
			<tr>
				<td colspan="12">

					<a title="Add New Loan Records" href="index.php?page=add_loan&table=<?php echo urlencode($tableName); ?>"><button class="btn btn-success btn-sm">Add
							New Loan <span class="glyphicon glyphicon-plus"></button></a>
					&nbsp; &nbsp;


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