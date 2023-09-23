<?php
if (isset($_GET['table'])) {
    $tableName = mysqli_real_escape_string($conn, urldecode($_GET['table']));

    $search = mysqli_real_escape_string($conn, $_POST['searchCashTable']);

    $q = mysqli_query($conn, "select * from `$tableName` WHERE date = '$search' OR charged_invoice = '$search' ");
    $rr = mysqli_num_rows($q);
    if (!$rr) {
        echo "<div class='alert alert-danger'><h2>No Result Found!</h2></div>";
    } else {
        ?>
        <script>
            function DeleteCash(id, tableName) {
                if (confirm("You want to delete this record?")) {
                    window.location.href = "CASH-TABLE/delete_cash_table.php?id=" + id + "&tableName=" + tableName;
                }
            }
        </script>
        <h2 align="center">Search Results</h2>
        <table class="table table-bordered">

            <tr>
            <!-- header('Location: ' . $_SERVER['HTTP_REFERER']); -->
                <td colspan="16"><a href="index.php?page=display_cash_table&name=<?php echo urlencode($tableName); ?>">Go Back</a></td>
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


            $i = 1;
            while ($row = mysqli_fetch_assoc($q)) {

                echo "<Tr>";
                echo "<td>" . $i . "</td>";
                echo "<td>" . $row['date'] . "</td>";
                echo "<td>" . $row['charged_invoice'] . "</td>";
                echo "<td>" . $row['amount'] . "</td>";
                echo "<td>" . $row['total'] . "</td>";

                ?>

                <Td>

                    <a href="javascript:DeleteCash('<?php echo $row['id']; ?>', '<?php echo urlencode($tableName); ?>')"
                        style='color:Red'><span class='glyphicon glyphicon-trash'></span></a>

                    <a href="index.php?page=update_cash_table&id=<?php echo $row['id']; ?>&name=<?php echo urlencode($tableName); ?>"
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