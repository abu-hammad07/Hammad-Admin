<?php
include 'config.php';
global $con;
session_start();
if (!isset($_SESSION['name'])) {
    header('location:login.php');
}
$CourseID_error = false;
$insert = false;
$empty_CourseID = false;
$empty_CourseName = false;
$empty_CourseType = false;
$empty_OfferBy = false;
$empty_FeePermonth = false;
$empty_Duration = false;

if (isset($_POST['submit'])) {
    $CourseID = mysqli_real_escape_string($conn, $_POST['CourseID']);
    $CourseName = mysqli_real_escape_string($conn, $_POST['CourseName']);
    $CourseType = mysqli_real_escape_string($conn, $_POST['CourseType']);
    $OfferBy = mysqli_real_escape_string($conn, $_POST['OfferBy']);
    $FeePermonth = mysqli_real_escape_string($conn, $_POST['FeePermonth']);
    $Duration = mysqli_real_escape_string($conn, $_POST['Duration']);

    if (empty($_POST['CourseID'])) {
        $empty_CourseID = true;
    }
    if (empty($_POST['CourseName'])) {
        $empty_CourseName = true;
    }
    if (empty($_POST['CourseType'])) {
        $empty_CourseType = true;
    }
    if (empty($_POST['OfferBy'])) {
        $empty_OfferBy = true;
    }
    if (empty($_POST['FeePermonth'])) {
        $empty_FeePermonth = true;
    }
    if (empty($_POST['Duration'])) {
        $empty_Duration = true;
    } else {

        $CourseID_check = "SELECT * FROM `courses` WHERE CourseID = '$CourseID' ";

        $CourseID_result = mysqli_query($conn, $CourseID_check);

        $check_CourseID = mysqli_fetch_row($CourseID_result);

        if ($check_CourseID > 0) {
            $CourseID_error = true;
        } else {

            $sql = "INSERT INTO `courses`(`CourseID`, `CourseName`, `CourseType`, `OfferBy`, `FeePermonth`, `Duration`, `create_date`)
            VALUES ('$CourseID', '$CourseName', '$CourseType', '$OfferBy', '$FeePermonth', '$Duration', NOW())";

            $result = mysqli_query($conn, $sql);

            if ($result) {
                $insert = true;
                $CourseID = '';
                $CourseName = '';
                $CourseType = '';
                $OfferBy = '';
                $FeePermonth = '';
                $Duration = '';
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

        $delete_query = "DELETE FROM `courses` WHERE id IN ($extrext_id)";
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

    <title>Courses Admin Dashboard</title>

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
                    if ($CourseID_error) {
                        echo '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>!WARNING</strong> Course ID alrady exit.
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
                        <div class="col-lg-4 course-card ">
                            <div class="card mein-card pb-5 ">
                                <h3 class=" font-inter">Add New Course</h3>
                                <div class="container-fluid">
                                    <form action="" method="POST">
                                        <div class="in py-3">
                                            <input type="text" name="CourseID" class=" input w-100 py-2" placeholder="Course ID" value="<?php if (isset($_POST['submit'])) {
                                                                                                                                            echo $CourseID;
                                                                                                                                        } ?>">
                                            <span id="InsLocation" class="text-danger font"><?php if ($empty_CourseID) {
                                                                                                echo "** Please Fill The Course ID";
                                                                                            } ?></span>
                                        </div>

                                        <div class="in">
                                            <input type="text" name="CourseName" class=" input w-100 py-2" placeholder="Course Name" value="<?php if (isset($_POST['submit'])) {
                                                                                                                                                echo $CourseName;
                                                                                                                                            } ?>">
                                            <span id="InsLocation" class="text-danger font"><?php if ($empty_CourseName) {
                                                                                                echo "** Please Fill The Course Name";
                                                                                            } ?></span>
                                        </div>

                                        <select name="CourseType" id="" class="input  py-2 mt-3 w-100">
                                            <option value=""> Course type</option>
                                            <option value="Web Development"> Web Development</option>
                                            <option value="Grahpihp"> Grahpihp</option>
                                            <option value=" Digital Markiting"> Digital Markiting</option>
                                        </select>
                                        <span id="InsLocation" class="text-danger font"><?php if ($empty_CourseType) {
                                                                                            echo "** Please Fill The Course Type";
                                                                                        } ?></span>

                                        <select name="OfferBy" id="" class="input w-100 py-2 mt-3">
                                            <option value=""> Offer By</option>
                                            <option value="20%"> 20%</option>
                                            <option value="40%"> 40%</option>
                                            <option value="70%"> 70%</option>
                                        </select>
                                        <span id="InsLocation" class="text-danger font"><?php if ($empty_OfferBy) {
                                                                                            echo "** Please Fill The OfferBy";
                                                                                        } ?></span>

                                        <div class="in py-3">
                                            <input type="text" name="FeePermonth" class=" input w-100 py-2" placeholder="Fee Per Month" value="<?php if (isset($_POST['submit'])) {
                                                                                                                                                    echo $FeePermonth;
                                                                                                                                                } ?>">
                                            <span id="InsLocation" class="text-danger font"><?php if ($empty_FeePermonth) {
                                                                                                echo "** Please Fill The Fee Per Month";
                                                                                            } ?></span>
                                        </div>

                                        <div class="in">
                                            <input type="text" name="Duration" class=" input w-100 py-2" placeholder="Duration" value="<?php if (isset($_POST['submit'])) {
                                                                                                                                            echo $Duration;
                                                                                                                                        } ?>">
                                            <span id="InsLocation" class="text-danger font"><?php if ($empty_Duration) {
                                                                                                echo "** Please Fill The Duration";
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
                                            <p class="font student"> Course</p>
                                        </div>
                                        <div class="col-lg-9 col-md-9 py-3 ">
                                            <div class="btn-edit-delete1 text-start px-1">
                                                <button type="submit" class="export-btn delete" name="delete_btn">
                                                    <span class="fa-regular fa-trash-can ">
                                                        <span>Delete</span></span>
                                                </button>
                                                <a href=""> <span class="edit export-btn">Edit</span></a>
                                                <a href="">
                                                    <span class="fa-regular fa-trash-can export export-btn">
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
                                                            <i class="fa-solid fa-plus "></i>
                                                        </th>
                                                        <th>COURSE ID<i class="fa-solid fa-arrow-down px-2"></i></th>
                                                        <th>COURSE NAME<i class="fa-solid fa-arrow-down px-2"></i></th>
                                                        <th>COURSE TYPE<i class="fa-solid fa-arrow-down px-2"></i></th>
                                                        <th>OFFERED BY<i class="fa-solid fa-arrow-down px-2"></i></th>
                                                        <th>FEE PER MONTH<i class="fa-solid fa-arrow-down px-2"></i></th>
                                                        <th>DURATION<i class="fa-solid fa-arrow-down px-2"></i>
                                                        <th>Create Date<i class="fa-solid fa-arrow-down px-2"></i></th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <!-- ==============select qurey============ -->
                                                    <?php

                                                    $select = "SELECT * FROM `courses`";
                                                    $result = mysqli_query($conn, $select);
                                                    $res_num = mysqli_num_rows($result);

                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                        <tr>
                                                            <td><input type="checkbox" class="text-input" name="chack_btn_delete[]" value="<?php echo $row['id']; ?>"></td>
                                                            <td class="font"><?php echo $row['CourseID']; ?></td>
                                                            <td><?php echo $row['CourseName']; ?></td>
                                                            <td><?php echo $row['CourseType']; ?></td>
                                                            <td><?php echo $row['OfferBy']; ?></td>
                                                            <td><?php echo $row['FeePermonth']; ?></td>
                                                            <td><?php echo $row['Duration']; ?></td>
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
                <!-- <div class="container-fluid"> -->
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