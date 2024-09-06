<?php 
ob_start();
session_start();
include('functions.php'); 
include('dbcon.php');

if(isset($_SESSION['posseetango_id'])) {
    include('header.php');
?>

    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    
    <!--side-menu-->

    <div class="app-content my-3 my-md-5">
        <div class="side-app">
            <div class="page-header">
                <h3 class="page-title">Dashboard</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </div>

            <!-- form to add data -->
            <div class="row">  
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="row">
                        <div class="col-md-12 col-xl-12 col-lg-12">
                            <div class="card bg-success text-center">
                                <div class="card-body">
                                    <h1><p class="mb-0">NassPay & Cardhouzz</p></h1>
                                </div>
                            </div>
                        </div>
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
