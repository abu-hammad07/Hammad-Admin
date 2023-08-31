<?php
include "config.php";
session_start();
if (!isset($_SESSION['name'])) {
    header("location:login.php");
}
$insert = false;
$sectionID_error = false;
$cnic_error = false;
$phone_error = false;
$empty_sectionID = false;
$empty_sectionName = false;
$empty_sectionTrade = false;

if (isset($_POST['submit'])) {
    $sectionID = mysqli_real_escape_string($conn, $_POST['sectionID']);
    $sectionName = mysqli_real_escape_string($conn,  $_POST['sectionName']);
    $sectionTrade = mysqli_real_escape_string($conn,  $_POST['sectionTrade']);

    if (empty($_POST['sectionID'])) {
        $empty_sectionID = true;
    }
    if (empty($_POST['sectionName'])) {
        $empty_sectionName = true;
    }
    if (empty($_POST['sectionTrade'])) {
        $empty_sectionTrade = true;
    } else {

        $sectionID_chacke = "SELECT * FROM section WHERE sectionID='$sectionID'";

        $sectionID_result = mysqli_query($conn, $sectionID_chacke);

        $check_sectionID = mysqli_num_rows($sectionID_result);
        if ($check_sectionID > 0) {
            $sectionID_error = true;
        } else {
            $isert_data = "INSERT INTO section (`sectionID` , `sectionName` , `sectionTrade` , `create_date` ) 
                VALUES ('$sectionID' , '$sectionName', '$sectionTrade', NOW())";


            $sql = mysqli_query($conn, $isert_data);
            if ($sql) {
                $insert = true;
                $sectionID = '';
                $sectionName = '';
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

        $delete_query = "DELETE FROM section WHERE id IN ($extrext_id)";
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

    <title>Section Admin Dashboard</title>

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
                    if ($sectionID_error) {
                        echo '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>!WARNING</strong> Section ID alrady exit.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                    }
                    ?>





                    <div class="row">
                        <div class="col-lg-4 course-card ">
                            <div class="card text-center  pb-5 ">
                                <h3 class=" font-inter">Add New Section</h3>
                                <div class="container-fluid">
                                    <form action="" method="POST">
                                        <div class="in py-3">
                                            <input type="text" name="sectionID" class=" input w-100 py-2" placeholder="Section ID" value="<?php if (isset($_POST['sectionID'])) {
                                                                                                                                                echo $sectionID;
                                                                                                                                            } ?>">
                                            <span id="InsLocation" class="text-danger font"><?php if ($empty_sectionID) {
                                                                                                echo "** Please Fill The Section ID";
                                                                                            } ?></span>
                                        </div>

                                        <div class="in">
                                            <input type="text" name="sectionName" class=" input w-100 py-2" placeholder="Section Name" value="<?php if (isset($_POST['sectionName'])) {
                                                                                                                                                    echo $sectionName;
                                                                                                                                                } ?>">
                                            <span id="InsLocation" class="text-danger font"><?php if ($empty_sectionName) {
                                                                                                echo "** Please Fill The Section Name";
                                                                                            } ?></span>
                                        </div>

                                        <select name="sectionTrade" id="" class="input  py-2 mt-3 w-100">
                                            <option value=""> Section Trade</option>
                                            <option value="Web Development"> Web Development</option>
                                            <option value="Grahpihp"> Grahpihp</option>
                                            <option value=" Digital Markiting"> Digital Markiting</option>
                                        </select>
                                        <span id="InsLocation" class="text-danger font"><?php if ($empty_sectionTrade) {
                                                                                            echo "** Please Fill The Section Trade";
                                                                                        } ?></span>



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
                                            <p class="font student"> Section</p>
                                        </div>
                                        <div class="col-lg-9 col-md-9 py-3 ">
                                            <div class="btn-edit-delete1 text-start px-1">
                                                <button type="submit" name="delete_btn" class="btn export-btn delete">
                                                    <span class="fa-regular fa-trash-can">
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
                                                        <th>Section ID<i class="fa-solid fa-arrow-down px-2"></i></th>
                                                        <th>Section NAME <i class="fa-solid fa-arrow-down px-2"></i></th>
                                                        <th>Section Course <i class="fa-solid fa-arrow-down px-2"></i></th>
                                                        <th>ADDED BY <i class="fa-solid fa-arrow-down px-2"></i></th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <!-- ==============select qurey============ -->
                                                    <?php

                                                    $select = "SELECT * FROM `section`";
                                                    $result = mysqli_query($conn, $select);
                                                    $res_num = mysqli_num_rows($result);

                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                        <tr>
                                                            <td><input type="checkbox" class="text-input" name="chack_btn_delete[]" value="<?php echo $row['id']; ?>"></td>
                                                            <td class="font"><?php echo $row['sectionID']; ?></td>
                                                            <td><?php echo $row['sectionName']; ?></td>
                                                            <td><?php echo $row['sectionTrade']; ?></td>
                                                            <td><?php echo $row['create_date']; ?></td>
                                                        </tr>
                                                    <?php
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