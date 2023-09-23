<?php
$q = mysqli_query($conn, "select * from member");

function getLastPaymentAmount($conn, $tableName)
{
	$query = "SELECT payment_amount FROM `$tableName` ORDER BY date DESC LIMIT 1";
	$result = mysqli_query($conn, $query);

	if ($result && mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		return $row['payment_amount'];
	} else {
		// If no payment_amount found or empty, return 0
		return 0;
	}
}

?>
<script>
	function DeleteMember(id, memberName) {
		if (confirm("You want to delete this member?")) {
			window.location.href = "MEMBER/delete_member.php?id=" + id + "&memberName=" + memberName;
		}
	}
</script>

<h2>Members | Grocery Loan, RO1</h2>

<table class="table table-bordered table-hover table-striped">
	<tr>
		<form method="post" action="index.php?page=search_member">
			<td colspan="8">
				<input type="text" placeholder="Search Member" name="searchMember" class="form-control" required />
			</td>
			<td colspan="5">
				<input type="submit" value="Search Member" name="sub" class="btn btn-warning" />
			</td>
		</form>
	</tr>
	<tr>
		<td colspan="8"><a href="index.php?page=create_member"><button class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus"></span> Add New Member</button></a></td>
	</tr>
	<Tr class="active">
		<th>NO</th>
		<th><?php
			$currentSort = isset($_GET['sort']) ? $_GET['sort'] : '';
			$currentOrder = isset($_GET['order']) ? $_GET['order'] : '';

			if ($currentSort == 'name' && $currentOrder == 'asc') {
				echo "<a href=\"?page=display_member&sort=name&order=desc\">NAME ▼</a>";
			} else {
				echo "<a href=\"?page=display_member&sort=name&order=asc\">NAME ▲</a>";
			}
			?></th>
		<th>UNP-GL</th>
		<th>C-GL</th>
		<th>S/C</th>
		<th>AMOUNT</th>
		<th>OR#</th>
		<th>DATE</th>
		<th>REMARKS</th>
		<th>ACTIONS</th>

	</Tr>
	<?php
	error_reporting(1);
	$rec_limit = 10;

	$sql = "SELECT count(member_id) FROM member ";
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

	$sort = isset($_GET['sort']) ? $_GET['sort'] : 'name';
	$order = isset($_GET['order']) ? $_GET['order'] : 'asc';

	$sql = "SELECT * FROM member ORDER BY $sort $order LIMIT $offset, $rec_limit";

	$retval = mysqli_query($conn, $sql);

	if (!$retval) {
		die('Could not get data: ' . mysqli_error($conn));
	}
	$inc = 1;
	while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {

		echo "<Tr>";
		echo "<td>" . $inc . "</td>";
		echo "<td>" . $row['name'] . "</td>";
		//echo "<td>" . $row['unp-gl'] . "</td>";
		echo "<td>";

		$tableName = str_replace(' ', '_', $row['name']);

		$lastPaymentAmount = getLastPaymentAmount($conn, $tableName);

		echo empty($lastPaymentAmount) ? 0 : $lastPaymentAmount;

		echo "</td>";
		echo "<td>" . $row['c-gl'] . "</td>";
		echo "<td>" . $row['s/c'] . "</td>";
		echo "<td>" . $row['amount'] . "</td>";
		echo "<td>" . $row['or#'] . "</td>";
		echo "<td>" . $row['date'] . "</td>";
		echo "<td>" . $row['remarks'] . "</td>";

	?>

		<Td>
			<a href="javascript:DeleteMember('<?php echo $row['member_id']; ?>', '<?php echo $row['name']; ?>')" style='color:Red'><span class='glyphicon glyphicon-trash'></span></a>

			<a href="index.php?page=update_member&member_id=<?php echo $row['member_id']; ?>&name=<?php echo urlencode(str_replace(' ', '_', $row['name'])); ?>" style='color:green'><span class='glyphicon glyphicon-edit'></span></a>

			<a href="index.php?page=display_loan&name=<?php echo urlencode(str_replace(' ', '_', $row['name'])); ?>" style="color: darkblue;"><span class="glyphicon glyphicon-eye-open"></span></a>


		</td>
	<?php

		echo "</Tr>";
		$inc++;
	}


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
<?php ?>