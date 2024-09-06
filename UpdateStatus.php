<?php 
ob_start();
session_start();
include('functions.php'); 
include('dbcon.php');
if(isset($_SESSION['posseetango_id'])) {


$posseetangoid=$_SESSION['posseetango_id'];
$accounts= "SELECT * FROM account_table   WHERE account_id='".$_SESSION['posseetango_id']."' ";
$resultlists = mysqli_query($conn,$accounts);
if(mysqli_num_rows($resultlists) > 0)
{
    while($rowi= mysqli_fetch_array($resultlists))
{   
    $accountid=$_SESSION['posseetango_id'];
    $accountname=$rowi['account_full_name'];


    include('header.php');  

    if(isset($_POST['Updatename'])) {
        $Categore = mysqli_real_escape_string($conn, $_POST['Categore']);
        $cCategore = htmlspecialchars($Categore, ENT_QUOTES);

        $productname = mysqli_real_escape_string($conn, $_POST['productname']);
        $cproductname = htmlspecialchars($productname, ENT_QUOTES);

        $price = mysqli_real_escape_string($conn, $_POST['price']);
        $cprice = htmlspecialchars($price, ENT_QUOTES);

        $Status = mysqli_real_escape_string($conn, $_POST['Status']);
        $cStatus = htmlspecialchars($Status, ENT_QUOTES);

        $product = mysqli_real_escape_string($conn, $_GET['product']);
        $cproduct = htmlspecialchars($product, ENT_QUOTES);
    }

    if(isset($_POST['Updatename']) && !empty($_POST['Status'])) {
        $event_time = date("Y-m-d H:i:s");
        $query126 = "UPDATE `tbl_pin_codes` SET `Status`='$cStatus', UpdatedDate='$event_time', UpdatedBy='$accountname' WHERE pin_id='$cproduct'";
        if($conn->query($query126) === TRUE) {
            echo "<script>window.location.assign('search.php')</script>";
        }
    }
}}
    ?>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <!--side-menu-->
    <div class="app-content my-3 my-md-5">
        <div class="side-app">
            <div class="page-header">
                <h3 class="page-title">Product Dashboard</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="product.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Product</li>
                </ol>
            </div>
            <?php
            $product = mysqli_real_escape_string($conn, $_GET['product']);
            $cproduct = htmlspecialchars($product, ENT_QUOTES);
            
            $projectlist = "SELECT * FROM tbl_pin_codes WHERE pin_id='$cproduct'";
            $resultclist = mysqli_query($conn, $projectlist);
            if(mysqli_num_rows($resultclist) > 0) {
                while($rows = mysqli_fetch_array($resultclist)) {
            ?>
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Update Form</div>
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="inputName" class="col-md-3 col-form-label">PIN Code</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="inputName" name="productname" placeholder="<?php echo $rows['PinCode'];?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputName" class="col-md-3 col-form-label">Serial Code</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="inputName" name="productname" placeholder="<?php echo $rows['SerialCode'];?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-md-3 col-form-label">Amount</label>
                            <div class="col-md-9">
                                <input type="number" class="form-control" id="inputName" name="price" placeholder="<?php echo $rows['Amount'];?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-md-3 col-form-label">Status</label>  
                            <div class="col-md-9">
                                <select name="Status" id="Status" class="form-control custom-select">
                                    <option value="">--<?php echo $rows['Status'];?>--</option>
                                    <option value="Used">Used</option>
                                </select>
                            </div>
                        </div>
                        <?php  
                        }
                    }              
                    ?>  
                    <div class="form-group mb-0 mt-2 row justify-content-end">
                        <div class="col-md-9">
                            <button type="submit" name="Updatename" class="btn btn-primary" id='Update'>Save Update</button> &nbsp
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--footer-->
<?php include('footer.php'); ?>
<?php
    ob_end_flush();
} else {
    echo "<script>window.location.assign('index.php')</script>";
}
?>
