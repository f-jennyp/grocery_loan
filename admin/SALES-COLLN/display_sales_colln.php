<?php
$q = mysqli_query($conn, "select * from sales_collection_summary");

?>
<script>
	function DeleteTable(id, tableName) {
		if (confirm("You want to delete this table?")) {
			window.location.href = "SALES-COLLN/delete_sales_colln.php?id=" + id + "&tableName=" + tableName;
		}
	}
</script>
<h2>Sales Collection Summary</h2>

<table class="table table-bordered table-hover table-striped">
	<tr>
		<form method="post" action="index.php?page=search_sales_colln">
			<td colspan="5">
				<input type="text" placeholder="Search table" name="searchSalesColln" class="form-control" required />
			</td>
			<td colspan="3">
				<input type="submit" value="Search" name="sub" class="btn btn-warning" />
			</td>
		</form>
	</tr>
	<tr>
		<td colspan="8"><a href="index.php?page=create_sales_colln"><button class="btn btn-success btn-sm"><span
						class="glyphicon glyphicon-plus"></span> Add New Table</button></a></td>
	</tr>
	<Tr class="active">
		<th>NO</th>
		<th>TABLE NAME</th>
		<th>ACTION</th>

	</Tr>
	<?php
	error_reporting(1);
	$rec_limit = 10;

	/* Get total number of records */

	$sql = "SELECT count(id) FROM sales_collection_summary ";
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
	$sql = "SELECT * " . "FROM sales_collection_summary " .
		"LIMIT $offset, $rec_limit";

	$retval = mysqli_query($conn, $sql);

	if (!$retval) {
		die('Could not get data: ' . mysqli_error($conn));
	}

	$inc = 1;
	while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {

		echo "<Tr>";
		echo "<td>" . $inc . "</td>";
		echo "<td>" . $row['table_name'] . "</td>";

		?>

		<Td>
			<a href="javascript:DeleteTable('<?php echo $row['id']; ?>', '<?php echo $row['table_name']; ?>')"
				style='color:Red'><span class='glyphicon glyphicon-trash'></span></a>

			<a href="index.php?page=update_sales_colln&id=<?php echo $row['id']; ?>&table=<?php echo urlencode(str_replace(' ', '_', $row['table_name'])); ?>"
				style='color:green'><span class='glyphicon glyphicon-edit'></span></a>

			<a href="index.php?page=display_colln_table&name=<?php echo urlencode(str_replace(' ', '_', $row['table_name'])); ?>"
				style="color: darkblue;"><span class="glyphicon glyphicon-eye-open"></span></a>


		</td>
		<?php

		echo "</Tr>";
		$inc++;
	}


	//for shoing Pagination
	
	echo "<tr><td colspan='8'>";
	if ($pagi > 0) {
		$last = $pagi - 2;
		echo "<a href = \"index.php?page=display_sales_colln&pagi=$last\">Last 10 Records</a> |";
		echo "<a href = \"index.php?page=display_sales_colln&pagi=$pagi\">Next 10 Records</a>";
	} else if ($pagi == 0) {
		echo "<a href = \"index.php?page=display_sales_colln&pagi=$pagi\">Next 10 Records</a>";
	} else if ($left_rec < $rec_limit) {
		$last = $pagi - 2;
		echo "<a href = \"index.php?page=display_sales_colln&pagi=$last\">Last 10 Records</a>";
	}
	echo "</td></tr>";
	?>

</table>
<?php ?>