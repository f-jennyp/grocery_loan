<?php
$q = mysqli_query($conn, "select * from member");

?>
<script>
	function DeleteMember(id, memberName) {
		if (confirm("You want to delete this Member ?")) {
			window.location.href = "delete_gl_member.php?id=" + id + "&memberName=" + memberName;
		}
	}
</script>
<h2>All Members | Grocery Loan, RO1</h2>

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
		<td colspan="8"><a href="index.php?page=add_gl_member"><button class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus"></span> Add New Member</button></a></td>
	</tr>
	<Tr class="active">
		<th>NO</th>
		<th>NAME</th>
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

	/* Get total number of records */

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
	$sql = "SELECT * " . "FROM member " .
		"LIMIT $offset, $rec_limit";

	$retval = mysqli_query($conn, $sql);

	if (!$retval) {
		die('Could not get data: ' . mysqli_error($conn));
	}

	$inc = 1;
	while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {

		echo "<Tr>";
		echo "<td>" . $inc . "</td>";
		echo "<td>" . $row['name'] . "</td>";
		echo "<td>" . $row['unp-gl'] . "</td>";
		echo "<td>" . $row['c-gl'] . "</td>";
		echo "<td>" . $row['s/c'] . "</td>";
		echo "<td>" . $row['amount'] . "</td>";
		echo "<td>" . $row['or#'] . "</td>";
		echo "<td>" . $row['date'] . "</td>";
		echo "<td>" . $row['remarks'] . "</td>";

	?>

		<Td>
			<a href="javascript:DeleteMember('<?php echo $row['member_id']; ?>', '<?php echo $row['name']; ?>')" style='color:Red'><span class='glyphicon glyphicon-trash'></span></a>

			<a href="index.php?page=update_gl_member&member_id=<?php echo $row['member_id']; ?>" style='color:green'><span class='glyphicon glyphicon-edit'></span></a>

			<a href="index.php?page=display_loan&name=<?php echo urlencode(str_replace(' ', '_', $row['name'])); ?>" style="color: darkblue;"><span class="glyphicon glyphicon-eye-open"></span></a>


		</td>
	<?php

		echo "</Tr>";
		$inc++;
	}


	//for shoing Pagination

	echo "<tr><td colspan='8'>";
	if ($pagi > 0) {
		$last = $pagi - 2;
		echo "<a href = \"index.php?page=display_gl_member&pagi=$last\">Last 10 Records</a> |";
		echo "<a href = \"index.php?page=display_gl_member&pagi=$pagi\">Next 10 Records</a>";
	} else if ($pagi == 0) {
		echo "<a href = \"index.php?page=display_gl_member&pagi=$pagi\">Next 10 Records</a>";
	} else if ($left_rec < $rec_limit) {
		$last = $pagi - 2;
		echo "<a href = \"index.php?page=display_gl_member&pagi=$last\">Last 10 Records</a>";
	}
	echo "</td></tr>";
	?>

</table>
<?php  ?>