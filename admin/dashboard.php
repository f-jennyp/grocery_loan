<<<<<<< HEAD
<?php
$q = mysqli_query($conn, "select * from member ");
$r = mysqli_num_rows($q);

$q1 = mysqli_query($conn, "select * from sales_collection_summary ");
$r1 = mysqli_num_rows($q1);

// $q2 = mysqli_query($conn, "select * from loan");
// $r2 = mysqli_num_rows($q2);

// $q8=mysqli_query($conn,"select * from charged-cash-summary");
=======
<?php 
$q=mysqli_query($conn,"select * from member ");
$r=mysqli_num_rows($q);



// $q2=mysqli_query($conn,"select * from member where gender='m'");
// $r2=mysqli_num_rows($q2);


// $q3=mysqli_query($conn,"select * from member where gender='f'");
// $r3=mysqli_num_rows($q3);




// $q1=mysqli_query($conn,"select * from groups ");
// $r1=mysqli_num_rows($q1);

$q7=mysqli_query($conn,"select * from loan");
$r4=mysqli_num_rows($q7);

// $q8=mysqli_query($conn,"select * from payment_history");
>>>>>>> eca9b32f00ce8c5b313e670d77e0cd0ea90f4bad
// $r8=mysqli_num_rows($q8);



?>
<h1 class="page-header">Dashboard</h1>
<div class="row placeholders">
<<<<<<< HEAD

<a href="index.php?page=display_member" class="col-xs-5 col-sm-3 placeholder"> 
    <img src="../images/members.png" width="150" height="150" class="img-responsive" alt="Generic placeholder thumbnail">
    <h4>Members</h4>
    <span class="text-muted"><?php echo $r; ?></span>
</a>
<!-- 
  <div class="col-xs-6 col-sm-3 placeholder" >
    <img src="../images/loan.png" width="150" height="150" class="img-responsive" alt="Generic placeholder thumbnail">
    <h4>Member Loan Alloted</h4>
    <span class="text-muted"><?php echo $r2; ?></span>
  </div> -->

  <a href="index.php?page=display_sales_colln" class="col-xs-5 col-sm-3 placeholder">
    <img src="../images/sales.png" width="150" height="150" class="img-responsive" alt="Generic placeholder thumbnail">
    <h4>Sales Collection</h4>
    <span class="text-muted"><?php echo $r1; ?></span>
</a>

<a href="index.php?page=display_charged_cash" class="col-xs-5 col-sm-3 placeholder">
    <img src="../images/charged-cash.png" width="150" height="150" class="img-responsive" alt="Generic placeholder thumbnail">
    <h4>Charged Cash</h4>
    <!-- <span class="text-muted"><?php echo $r8; ?></span> -->
</a>
  
=======
  <!-- <div class="col-xs-6 col-sm-3 placeholder">
    <img src="../images/groupficn.png" width="150" height="150" class="img-responsive"
      alt="Generic placeholder thumbnail">
    <h4>Total Groups</h4>
    <span class="text-muted"><?php echo $r1; ?></span>
  </div> -->
  <div class="col-xs-6 col-sm-3 placeholder">
    <img src="../images/memberficn.png" width="150" height="150" class="img-responsive"
      alt="Generic placeholder thumbnail">
    <h4>Total Members</h4>
    <span class="text-muted"><?php echo $r; ?></span>
  </div>
  <div class="col-xs-6 col-sm-3">
    <img src="../images/loanficn.png" width="150" height="150" class="img-round" alt="Generic placeholder thumbnail">
    <h4>Loan Alloted</h4>
    <span class="text-muted"><?php echo $r4; ?></span>
  </div>
  <!-- <div class="col-xs-6 col-sm-3 placeholder">
    <img src="../images/paidficn.png" width="150" height="150" class="img-round" alt="Generic placeholder thumbnail">
    <h4>Paid List</h4>
    <span class="text-muted"><?php echo $r8; ?></span>
  </div> -->

>>>>>>> eca9b32f00ce8c5b313e670d77e0cd0ea90f4bad
</div>

<!-- <div class="row placeholders">
  <div class="col-xs-6 col-sm-3 placeholder">
    <img src="../images/menficn.png" width="150" height="150" class="img-responsive"
      alt="Generic placeholder thumbnail">
    <h4>Total Men Members</h4>
    <span class="text-muted"><?php echo $r2; ?></span>
  </div>
  <div class="col-xs-6 col-sm-3 placeholder">
    <img src="../images/womenficn.png" width="150" height="150" class="img-responsive"
      alt="Generic placeholder thumbnail">
    <h4>Total Women Members</h4>
    <span class="text-muted"><?php echo $r3; ?></span>
  </div>
</div> -->