<?php
if (isset($_GET['table'])) {
    $tableName = mysqli_real_escape_string($conn, urldecode($_GET['table']));

    $search = mysqli_real_escape_string($conn, $_POST['searchCollnTable']);

    $q = mysqli_query($conn, "select * from $tableName WHERE date = '$search'");
    $rr = mysqli_num_rows($q);
    if (!$rr) {
        echo "<div class='alert alert-danger'><h2>No Result Found!</h2></div>";
    } else {
        ?>
        <script>
            function DeleteCollnTable(id, tableName) {
                if (confirm("You want to delete this record?")) {
                    window.location.href = "COLLN-TABLE/delete_colln_table.php?id=" + id + "&tableName=" + tableName;
                }
            }
        </script>
        <h2 align="center">Search Results</h2>
        <table class="table table-bordered">

            <tr>
                <td colspan="16"><a href="index.php?page=display_colln_table&name=<?php echo urlencode($tableName); ?>">Go Back</a></td>
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


            $i = 1;
            while ($row = mysqli_fetch_assoc($q)) {

                echo "<Tr>";
                echo "<td>" . $i . "</td>";
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
                $i++;
            }
            ?>

        </table>
    <?php }
} ?>