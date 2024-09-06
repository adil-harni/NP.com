<?php
ob_start();
session_start();
include('dbcon.php'); // Database connection
include('functions.php');
include('header.php'); // Header file containing navigation and other includes

// Check if user is logged in
if (isset($_SESSION['posseetango_id'])) {

    // Handle file upload and processing
    if (isset($_POST['upload'])) {
        if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] == 0) {
            $allowed = array('txt' => 'text/plain');
            $filename = $_FILES['fileToUpload']['name'];
            $filetype = $_FILES['fileToUpload']['type'];
            $filesize = $_FILES['fileToUpload']['size'];

            // Verify file extension
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if (!array_key_exists($ext, $allowed)) {
                $upload_error = "Error: Please select a valid file format.";
            } else {
                // Verify file type
                if (in_array($filetype, $allowed)) {
                    // Read file contents
                    $file = fopen($_FILES['fileToUpload']['tmp_name'], 'r');
                    if ($file) {
                        while (($line = fgets($file)) !== false) {
                            $line = trim($line);
                            if (!empty($line)) {
                                $data = explode(',', $line);

                                // Ensure all required fields are present
                                if (count($data) == 7) {
                                    list($PinCode, $SerialCode, $Amount, $Status, $CreatedDate, $UpdatedDate, $UpdatedBy) = $data;

                                    // Escape strings for security
                                    $PinCode = mysqli_real_escape_string($conn, $PinCode);
                                    $SerialCode = mysqli_real_escape_string($conn, $SerialCode);
                                    $Amount = mysqli_real_escape_string($conn, $Amount);
                                    $Status = mysqli_real_escape_string($conn, $Status);
                                    $CreatedDate = mysqli_real_escape_string($conn, $CreatedDate);
                                    $UpdatedDate = mysqli_real_escape_string($conn, $UpdatedDate);
                                    $UpdatedBy = mysqli_real_escape_string($conn, $UpdatedBy);
                                    $event_time = date("Y-m-d H:i:s");

                                    // Insert into database
                                    $sql = "INSERT INTO tbl_pin_codes (PinCode, SerialCode, Amount, Status, CreatedDate, UpdatedDate, UpdatedBy) 
                                            VALUES ('$PinCode', '$SerialCode', '$Amount', '$Status', '$event_time', '', '')";

                                    if (!mysqli_query($conn, $sql)) {
                                        $upload_error = "Error inserting data: " . mysqli_error($conn);
                                        break;
                                    }
                                } else {
                                    $upload_error = "Error: Incorrect data format in file.";
                                    break;
                                }
                            }
                        }
                        fclose($file);

                        if (!isset($upload_error)) {
                            $upload_success = "File uploaded and data imported successfully.";
                        }
                    } else {
                        $upload_error = "Error opening the file.";
                    }
                } else {
                    $upload_error = "Error: There was a problem uploading your file. Please try again.";
                }
            }
        } else {
            $upload_error = "Error: " . $_FILES['fileToUpload']['error'];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pin Code Dashboard</title>
    <!-- Bootstrap CSS -->
</head>
<body>
        

    <div class="container mt-5">
        <br><br><br><br><br>
        <h3 class="mb-4">Pin Code Dashboard</h3>
        <br><br>

        <!-- Display success or error messages -->
        <?php if (isset($upload_success)): ?>
            <div class="alert alert-success" style="background-color: #6A0DAD; color: white;"><?php echo $upload_success; ?></div>
        <?php endif; ?>
        <?php if (isset($upload_error)): ?>
            <div class="alert alert-danger"style="background-color: #6A0DAD; color: white;"><?php echo $upload_error; ?></div>
        <?php endif; ?>

        <!-- Upload Button -->
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#uploadModal"style="background-color: #6A0DAD; color: white;">Upload Pin Codes</button>

        <!-- Upload Modal -->
        <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="uploadModalLabel">Upload Pin Codes</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="fileToUpload">Select .txt File</label>
                                <input type="file" class="form-control-file" id="fileToUpload" name="fileToUpload" accept=".txt" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="upload" class="btn btn-success" style="background-color: #6A0DAD; color: white;">Upload</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                </form>
            </div>
        </div>

        <!-- Data Table -->
        <table class="table table-bordered">
            <thead class="thead-dark">
                <!-- Add table headers here if needed -->
            </thead>
            <tbody>
                <!-- Add table rows here if needed -->
            </tbody>
        </table>
    </div>


</body>
</html>

<?php
    include('footer.php'); // Footer file
} else {
    header("Location: login.php"); // Redirect to login if not logged in
    exit;
}
?>
