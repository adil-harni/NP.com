<?php 
ob_start();
session_start();
include('functions.php'); 
include('dbcon.php');

// Check if user is logged in
if (isset($_SESSION['posseetango_id'])) {

    include('header.php');

    // Handle form submission
    if (isset($_POST['savenew'])) {
        $PinCode = mysqli_real_escape_string($conn, $_POST['PinCode']);
        $cPinCode = htmlspecialchars($PinCode, ENT_QUOTES);

        $SerialCode = mysqli_real_escape_string($conn, $_POST['SerialCode']);
        $cSerialCode = htmlspecialchars($SerialCode, ENT_QUOTES);

        $Amount = mysqli_real_escape_string($conn, $_POST['Amount']);
        $cAmount = htmlspecialchars($Amount, ENT_QUOTES);

        $Status = mysqli_real_escape_string($conn, $_POST['Status']);
        $cStatus = htmlspecialchars($Status, ENT_QUOTES);

        $CreatedDate = mysqli_real_escape_string($conn, $_POST['CreatedDate']);
        $cCreatedDate = htmlspecialchars($CreatedDate, ENT_QUOTES);

        $UpdatedDate = mysqli_real_escape_string($conn, $_POST['UpdatedDate']);
        $cUpdatedDate = htmlspecialchars($UpdatedDate, ENT_QUOTES);

        $UpdatedBy = mysqli_real_escape_string($conn, $_POST['UpdatedBy']);
        $cUpdatedBy = htmlspecialchars($UpdatedBy, ENT_QUOTES);

        // Handle file upload
        $allowed = array('txt');
        $filename = $_FILES['filetoUpload']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        
        if (!in_array($ext, $allowed)) {
            echo 'error image: ';
            $_FILES['filetoUpload'] = 0;
        }

        $newfilename = date('dmYHis') . str_replace(" ", "", basename($_FILES["filetoUpload"]["name"]));
        $finename = strtolower($newfilename);
        move_uploaded_file($_FILES["filetoUpload"]["tmp_name"], "productimage/" . $finename);
        $a = $finename;
        $l = "productimage/";
        $filename = $l . '' . $a;

        $sqlinsert = "INSERT INTO `tbl_pin_codes`(`pin_id`, `PinCode`, `SerialCode`, `Amount`, `Status`, `CreatedDate`, `UpdatedDate`, `UpdatedBy`) 
                      VALUES ('','$cPinCode','$cSerialCode','$cAmount','$cStatus','$cCreatedDate','$cUpdatedDate','$cUpdatedBy')";

        $result = mysqli_query($conn, $sqlinsert);

        echo "<script>window.location.assign('data.php')</script>";
    }
?>

    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    
    <!--side-menu-->
    <div class="app-content my-3 my-md-5">
        <div class="side-app">
            <div class="page-header">
                <h3 class="page-title">Search</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Product</li>
                </ol>
            </div>

            <!-- Modal for file upload -->
            <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                    <div class="modal-content bg-primary">
                        <div class="modal-body">
                            <div class="card bg-primary shadow border-0 mb-0">
                                <div class="card-body px-lg-5 py-lg-5">
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <!-- Other form fields here -->
                                        <div class="form-group mb-3">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-stream"></i></span>
                                                </div>
                                                <select name="Status" id="Status" required class="form-control custom-select">
                                                    <option value="">Product Status</option>
                                                    <option value="Active">Active</option>
                                                    <option value="Deactive">Deactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <input class="form-control" placeholder="File Upload" name="filetoUpload" id="filetoUpload" type="file">
                                        </div>
                                        <button type="submit" class="btn btn-white" name="savenew">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search Form -->
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card">
                        

                        <!-- Table to display search results -->
                        <div class="card-body">  
                            <div class="table-responsive">
                                <table id="example-2" class="table table-bordered key-buttons text-nowrap">
                                    <thead>
                                        <tr>
                                            <th width="5" class="bg-primary">#</th>
                                            <th class="bg-primary">Pin Code</th>
                                            <th class="bg-primary">Serial Code</th>
                                            <th class="bg-primary">Amount</th>
                                            <th class="bg-primary">Status</th>
                                            <th class="bg-primary">Created Date</th>
                                            <th class="bg-primary">Updated Date</th>
                                            <th class="bg-primary">Updated By</th>
                                            <th class="bg-primary">Update</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $counter = 1;                   
                                            $projectlist = "SELECT * FROM `tbl_pin_codes` WHERE 1";
                                            $resultclist = mysqli_query($conn, $projectlist);
                                            if (mysqli_num_rows($resultclist) > 0) {
                                                while ($rows = mysqli_fetch_array($resultclist)) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $counter++; ?></td>
                                                        <td><?php echo $rows["PinCode"]; ?></td>
                                                        <td><?php echo $rows["SerialCode"]; ?></td>
                                                        <td><?php echo $rows["Amount"]; ?></td>
                                                        <td><?php echo $rows["Status"]; ?></td>
                                                        <td><?php echo $rows["CreatedDate"]; ?></td>
                                                        <td><?php echo $rows["UpdatedDate"]; ?></td>
                                                        <td><?php echo $rows["UpdatedBy"]; ?></td>
                                                        <td>
                                                            <a href="UpdateStatusAdmin.php?product=<?php echo $rows["pin_id"];?>">
                                                                <button type="button" class="btn btn-danger btn-sm">Update</button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                        }                            
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Include the footer -->
    <?php include('footer.php'); ?>

<?php
    ob_end_flush();

?>
