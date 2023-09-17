<?php
$search = $_POST['searchSalesColln'];
$q = mysqli_query($conn, "select * from sales_collection_summary where table_name='$search'");
$rr = mysqli_num_rows($q);
if (!$rr) {
	echo "<div class='alert alert-danger'><h2>No Result Found!</h2></div>";
} else {
	?>
	<script>
		function DeleteTable(id, tableName) {
			if (confirm("You want to delete this table?")) {
				window.location.href = "SALES-COLLN/delete_sales_colln.php?id=" + id + "&tableName=" + tableName;
			}
		}
	</script>
	<h2 align="center">Search Results</h2>
	<table class="table table-bordered">

		<tr>
			<td colspan="16"><a href="index.php?page=display_sales_colln">Go Back</a></td>
		</tr>
		<Tr class="active">
			<th>NO</th>
			<th>TABLE NAME</th>
			<th>ACTION</th>
		</Tr>
		<?php


		$i = 1;
		while ($row = mysqli_fetch_assoc($q)) {

			echo "<Tr>";
			echo "<td>" . $i . "</td>";
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
			$i++;
		}
		?>

	</table>
<?php } ?>