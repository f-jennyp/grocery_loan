<?php
$q = mysqli_query($conn, "select * from member ");
$r = mysqli_num_rows($q);

$q1 = mysqli_query($conn, "select * from sales_collection_summary ");
$r1 = mysqli_num_rows($q1);

$q2 = mysqli_query($conn, "select * from charged_cash_sales_summary ");
$r2 = mysqli_num_rows($q1);

?>
<h1 class="page-header">Dashboard</h1>
<div class="row placeholders">

<a href="index.php?page=display_member" class="col-xs-5 col-sm-3 placeholder"> 
    <img src="../images/members.png" width="150" height="150" class="img-responsive" alt="Generic placeholder thumbnail">
    <h4>Members</h4>
    <span class="text-muted"><?php echo $r; ?></span>
</a>

  <a href="index.php?page=display_sales_colln" class="col-xs-5 col-sm-3 placeholder">
    <img src="../images/sales.png" width="150" height="150" class="img-responsive" alt="Generic placeholder thumbnail">
    <h4>Sales Collection</h4>
    <span class="text-muted"><?php echo $r1; ?></span>
</a>

<a href="index.php?page=display_charged_cash" class="col-xs-5 col-sm-3 placeholder">
    <img src="../images/charged-cash.png" width="150" height="150" class="img-responsive" alt="Generic placeholder thumbnail">
    <h4>Charged Cash</h4>
    <span class="text-muted"><?php echo $r2; ?></span>
</a>
  
</div>
