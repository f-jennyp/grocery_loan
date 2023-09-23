<?php
$search = $_POST['searchMember'];
$q = mysqli_query($conn, "SELECT * FROM member WHERE name LIKE '%$search%'");
$rr = mysqli_num_rows($q);
if (!$rr) {
	echo "<div class='alert alert-danger'><h2>No Result Found!</h2></div>";
} else {
?>
	<script>
		function DeleteMember(id, memberName) {
			if (confirm("You want to delete this member?")) {
				window.location.href = "MEMBER/delete_member.php?id=" + id + "&memberName=" + memberName;
			}
		}
	</script>
	<h2 align="center">Search Results</h2>
	<table class="table table-bordered">

		<tr>
			<td colspan="16"><a href="index.php?page=display_member">Go Back</a></td>
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


		$i = 1;
		while ($row = mysqli_fetch_assoc($q)) {

			echo "<Tr>";
			echo "<td>" . $i . "</td>";
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

				<a href="index.php?page=update_member&member_id=<?php echo $row['member_id']; ?>&name=<?php echo urlencode(str_replace(' ', '_', $row['name'])); ?>" style='color:green'><span class='glyphicon glyphicon-edit'></span></a>

				<a href="index.php?page=display_loan&name=<?php echo urlencode(str_replace(' ', '_', $row['name'])); ?>" style="color: darkblue;"><span class="glyphicon glyphicon-eye-open"></span></a>


			</td>
		<?php

			echo "</Tr>";
			$i++;
		}
		?>

	</table>
<?php } ?>