<?php
include 'config.php';
global $con;
session_start();
if (!isset($_SESSION['name'])) {
    header('location:login.php');
}
$insert = false;
$CNIC_error = false;
$email_error = false;
$contact_error = false;
$empty_fullName = false;
$empty_fatherName = false;
$empty_CNIC = false;
$empty_email = false;
$empty_contactNumber = false;

if (isset($_POST['submit'])) {
    $fullName = mysqli_real_escape_string($conn, $_POST['fullName']);
    $fatherName = mysqli_real_escape_string($conn, $_POST['fatherName']);
    $CNIC = mysqli_real_escape_string($conn, $_POST['CNIC']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contactNumber = mysqli_real_escape_string($conn, $_POST['contactNumber']);

    if (empty($_POST['fullName'])) {
        $empty_fullName = true;
    }
    if (empty($_POST['fatherName'])) {
        $empty_fatherName = true;
    }
    if (empty($_POST['CNIC'])) {
        $empty_CNIC = true;
    }
    if (empty($_POST['email'])) {
        $empty_email = true;
    }
    if (empty($_POST['contactNumber'])) {
        $empty_contactNumber = true;
    } else {

        $CNIC_check = "SELECT * FROM `newstudents` WHERE CNIC = '$CNIC' ";

        $CNIC_result = mysqli_query($conn, $CNIC_check);

        $check_CNIC = mysqli_num_rows($CNIC_result);

        if ($check_CNIC > 0) {
            $CNIC_error = true;
        } else {
            $email_check = "SELECT * FROM `newstudents` WHERE email = '$email' ";

            $email_result = mysqli_query($conn, $email_check);

            $check_email = mysqli_num_rows($email_result);

            if ($check_email > 0) {
                $email_error = true;
            } else {
                $contact_check = "SELECT * FROM `newstudents` WHERE contactNumber = '$contactNumber' ";

                $contact_result = mysqli_query($conn, $contact_check);

                $check_contact = mysqli_num_rows($contact_result);

                if ($check_contact > 0) {
                    $contact_error = true;
                } else {
                    $sql = "INSERT INTO `newstudents`(`fullName`, `fatherName`, `CNIC`, `email`, `contactNumber`, `create_date`)
            VALUES ('$fullName', '$fatherName', '$CNIC', '$email', '$contactNumber', NOW())";

                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        $insert = true;
                        $fullName = '';
                        $fatherName = '';
                        $CNIC = '';
                        $email = '';
                        $contactNumber = '';
                    } else {
                        echo '
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>not Insert your data </strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                    }
                }
            }
        }
    }
}

?>


<!-- ===============DElete qurey=============== -->
<?php
if (isset($_POST['delete_btn'])) {
    if (!isset($_POST['chack_btn_delete']) || empty($_POST['chack_btn_delete'])) {
        $_SESSION['delete_chacke'] = "Please check the checkboxes to delete";

        // You might want to redirect back to the previous page or handle this case accordingly.
    } else {
        $all_id = $_POST['chack_btn_delete'];
        $extrext_id = implode(',', $all_id);

        $delete_query = "DELETE FROM `newstudents` WHERE id IN ($extrext_id)";
        $sql = mysqli_query($conn, $delete_query);

        if ($sql) {
            $_SESSION['Delete'] = "Data Delete Successfully!";
        } else {
            $_SESSION['Delete'] = "Failed to delete data!";
        }
    }
}

?>







<!DOCTYPE html>
<html lang="ur">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Students Admin Dashboard</title>

    <!-- Header Link -->
    <?php
    include 'headerLink.php';
    ?>
    <!-- Header Link End -->

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
        include 'sidebar.php';
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php
                include 'navbar.php';
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->


                <div class="container-fluid">


                    <?php
                    if (isset($_SESSION['Delete'])) {
                        echo '
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>!</strong> ' . $_SESSION['Delete'] . '.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                        unset($_SESSION['Delete']);
                    }
                    if (isset($_SESSION['delete_chacke'])) {
                        echo '
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>!WARNING</strong> ' . $_SESSION['delete_chacke'] . '.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                        unset($_SESSION['delete_chacke']);
                    }
                    ?>

                    <?php
                    if ($CNIC_error) {
                        echo '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>!WARNING</strong> CNIC alrady exit.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                    }
                    ?>
                    <?php
                    if ($email_error) {
                        echo '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>!WARNING</strong> Email alrady exit.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                    }
                    ?>
                    <?php
                    if ($contact_error) {
                        echo '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>!WARNING</strong> Contact Number alrady exit.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                    }
                    ?>
                    <?php
                    if ($insert) {
                        echo '
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                <strong>!Succses</strong>   insert your data. 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                    }
                    ?>





                    <div class="row">
                        <div class="col-lg-4 course-card">
                            <div class="card mein-card mb-5">
                                <h3 class=" font-inter py-4">Add New Student</h3>
                                <div class="container-fluid">
                                    <form action="" method="POST">
                                        <div class="in">
                                            <input type="text" class="input w-100 py-2" name="fullName" placeholder="Full Name" value="<?php if (isset($_POST['submit'])) {
                                                                                                                                            echo $fullName;
                                                                                                                                        } ?>">
                                            <span id="InsLocation" class="text-danger font"><?php if ($empty_fullName) {
                                                                                                echo "** Please Fill The Full Name";
                                                                                            } ?></span>
                                        </div>

                                        <div class="in py-3">
                                            <input type="text" class="input w-100 py-2" name="fatherName" placeholder="Father Name" value="<?php if (isset($_POST['submit'])) {
                                                                                                                                                echo $fatherName;
                                                                                                                                            } ?>">
                                            <span id="InsLocation" class="text-danger font"><?php if ($empty_fatherName) {
                                                                                                echo "** Please Fill The Father Name";
                                                                                            } ?></span>
                                        </div>

                                        <div class="in pb-3">
                                            <input type="text" class="input w-100 py-2" name="CNIC" placeholder="CNIC" value="<?php if (isset($_POST['submit'])) {
                                                                                                                                    echo $CNIC;
                                                                                                                                } ?>">
                                            <span id="InsLocation" class="text-danger font"><?php if ($empty_CNIC) {
                                                                                                echo "** Please Fill The CNIC";
                                                                                            } ?></span>
                                        </div>

                                        <div class="in pb-3">
                                            <input type="text" class="input w-100 py-2" name="email" placeholder="Email" value="<?php if (isset($_POST['submit'])) {
                                                                                                                                    echo $email;
                                                                                                                                } ?>">
                                            <span id="InsLocation" class="text-danger font"><?php if ($empty_email) {
                                                                                                echo "** Please Fill The Email";
                                                                                            } ?></span>
                                        </div>

                                        <div class="in">
                                            <input type="number" class="input w-100 py-2" name="contactNumber" placeholder="Contact Number" value="<?php if (isset($_POST['submit'])) {
                                                                                                                                                        echo $contactNumber;
                                                                                                                                                    } ?>">
                                            <span id="InsLocation" class="text-danger font"><?php if ($empty_contactNumber) {
                                                                                                echo "** Please Fill The Contact Number";
                                                                                            } ?></span>
                                        </div>

                                        <!-- <div class="in">
                                            <input type="text" class="input w-100 py-2" placeholder="Location">
                                        </div> -->

                                        <button type="submit" name="submit" class="save py-2">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-8 ">
                            <div class="card">
                                <form action="" method="POST">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 text-end py-3 px-4">
                                            <p class="font student"> Student</p>
                                        </div>
                                        <div class="col-lg-9 col-md-9 py-3 ">
                                            <div class="btn-edit-delete text-start px-1">
                                                <button type="submit" class="export-btn delete" name="delete_btn">
                                                    <span class="fa-regular fa-trash-can ">
                                                        <span>Delete</span></span>
                                                </button>
                                                <a href=""> <span class="edit export-btn">Edit</span></a>
                                                <a href="">
                                                    <span class="fa-solid fa-cloud-arrow-down export export-btn"> <span>Export</span></span></a>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="m-0 ">

                                    <div class="dov">
                                        <div class="table-wrapper">
                                            <table class="contain-table">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <!-- <input class="chack" type="checkbox"> -->
                                                            <i class="fa-solid fa-plus "></i>
                                                        </th>
                                                        <th>ID<i class="fa-solid fa-arrow-down px-2"></i></th>
                                                        <th>FULL NAME <i class="fa-solid fa-arrow-down px-2"></i></th>
                                                        <th>FATHER <i class="fa-solid fa-arrow-down px-2"></i></th>
                                                        <th>CNIC<i class="fa-solid fa-arrow-down px-2"></i></th>
                                                        <th>Email<i class="fa-solid fa-arrow-down px-2"></i></th>
                                                        <th>Contact <i class="fa-solid fa-arrow-down px-2"></i></th>
                                                        <th>Create Date <i class="fa-solid fa-arrow-down px-2"></i></th>

                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <!-- ==============select qurey============ -->
                                                    <?php
                                                    $select = "SELECT * FROM `newstudents`";
                                                    $result = mysqli_query($conn, $select);
                                                    $res_num = mysqli_num_rows($result);

                                                    $no = 1;
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                        <tr>
                                                            <td><input type="checkbox" name="chack_btn_delete[]" class="text-input" value="<?php echo $row['id']; ?>"></td>
                                                            <td class="font"><?php echo  $no ?></td>

                                                            <td><?php echo  $row['fullName']; ?></td>
                                                            <td><?php echo  $row['fatherName']; ?></td>
                                                            <td><?php echo  $row['CNIC']; ?></td>
                                                            <td><?php echo  $row['email']; ?></td>
                                                            <td><?php echo  $row['contactNumber']; ?></td>
                                                            <td><?php echo $row['create_date']; ?></td>
                                                        </tr>
                                                    <?php
                                                        $no = $no + 1;
                                                    }

                                                    ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of container-fluid -->
            </div>
            <!-- End of Content Main -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->



    <!-- Body End Link -->
    <?php
    include 'bodyEndLink.php';
    ?>
    <!-- Body End Link End -->
</body>

</html>