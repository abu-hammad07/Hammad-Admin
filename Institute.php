<?php
include 'config.php';
global $conn;
session_start();
if (!isset($_SESSION['name'])) {
    header('location:login.php');
}
$institute_error = false;
$insert = false;
$empty_name = false;
$empty_location = false;

if (isset($_POST['submit'])) {
    $institute_name = mysqli_real_escape_string($conn, $_POST['institute_name']);
    $institute_location = mysqli_real_escape_string($conn, $_POST['institute_location']);

    $institute_check = "SELECT * FROM `institute` WHERE institute_name = '$institute_name' ";

    $institue_result = mysqli_query($conn, $institute_check);

    $check_institute = mysqli_num_rows($institue_result);

    if ($check_institute > 0) {
        $institute_error = true;
    } else {
        if (empty($_POST['institute_name'])) {
            $empty_name = true;
        } elseif (empty($_POST['institute_location'])) {
            $empty_location = true;
        } else {
            $insert_data = "INSERT INTO `institute`(`institute_name`, `institute_location`, `create_date`) 
            VALUES ('$institute_name', '$institute_location', NOW())";

            $sql = mysqli_query($conn, $insert_data);
            if ($sql) {
                $insert = true;
            } else {
                echo '
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>not insert your data </strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
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

        $delete_query = "DELETE FROM `institute` WHERE id IN ($extrext_id)";
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
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Institute Admin Dashboard</title>

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
                    <?php
                    if ($institute_error) {
                        echo '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>!WARNING</strong> Institute name alrady exit.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                    }
                    ?>







                    <div class="row">
                        <div class="col-lg-4 course-card ">
                            <div class="card   pb-5 ">
                                <h3 class=" font-inter text-center">Add New Institute</h3>
                                <div class="container-fluid">
                                    <form action="" method="post" onsubmit="return insForm()">
                                        <div class="in py-3">
                                            <input type="text" name="institute_name" id="insName" class=" input w-100 py-2" placeholder="Institute Name">
                                            <span id="InstituteForm" name="InstituteForm" class="text-danger font"><?php if ($empty_name) {
                                                                                                                        echo "** Please Fill The institue Name";
                                                                                                                    } ?></span>
                                        </div>

                                        <div class="in">
                                            <input type="text" name="institute_location" class=" input w-100 py-2" placeholder="Institute Location" id="insLo">
                                            <span id="InsLocation" class="text-danger font"><?php if ($empty_location) {
                                                                                                echo "** Please Fill The Institute Location";
                                                                                            } ?></span>
                                        </div>

                                        <input type="submit" name="submit" class="save py-2" value="save">
                                    </form>


                                </div>
                            </div>
                        </div>


                        <div class="col-lg-8 ">
                            <div class="card">
                                <form action="" method="POST">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 text-end py-3 px-4">
                                            <p class="font student"> INSTITUTE</p>
                                        </div>
                                        <div class="col-lg-9 col-md-9 py-3 ">
                                            <div class="btn-edit-delete1 text-start px-1">
                                                <button type="submit" class="export-btn delete" name="delete_btn">
                                                    <span class="fa-regular fa-trash-can ">
                                                        <span>Delete</span></span>
                                                </button>
                                                <a href=""> <span class="edit export-btn">Edit</span></a>
                                                <a href="">
                                                    <span class="fa-solid fa-cloud-arrow-down export export-btn">
                                                        <span>Export</span></span></a>
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
                                                            <button class="fa-solid fa-plus " id="selectAllBtn"></button>
                                                        </th>
                                                        <th>INSTITUTE ID<i class="fa-solid fa-arrow-down px-2"></i></th>
                                                        <th>INSTITUTE NAME<i class="fa-solid fa-arrow-down px-2"></i></th>
                                                        <th>LOCATION<i class="fa-solid fa-arrow-down px-2"></i></th>
                                                        <th>Create Date<i class="fa-solid fa-arrow-down px-2"></i></th>
                                                        <!-- <th>OFFERED BY <i class="fa-solid fa-arrow-down px-2"></i></th>
                                                    <th>FEE PER MONTH <i class="fa-solid fa-arrow-down px-2"></i></th>
                                                    <th>DURATION <i class="fa-solid fa-arrow-down px-2"></i>
                                                    </th> -->

                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <!-- ==============select qurey============ -->
                                                    <?php

                                                    $select = "SELECT * FROM `institute`";
                                                    $result = mysqli_query($conn, $select);
                                                    $res_num = mysqli_num_rows($result);

                                                    $no = 1;
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                        <tr>
                                                            <td><input type="checkbox" class="text-input" name="chack_btn_delete[]" value="<?php echo $row['id']; ?>"></td>
                                                            <td class="font"><?php echo $no; ?></td>
                                                            <td><?php echo $row['institute_name']; ?></td>
                                                            <td><?php echo $row['institute_location']; ?></td>
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
                    <!-- End Of Row -->
                </div>
                <!-- End Of container-fluid -->
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