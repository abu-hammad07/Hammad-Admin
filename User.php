<?php
include "config.php";
session_start();
if (!isset($_SESSION['name'])) {
    header("location:login.php");
}
$insert = false;
$email_error = false;
$cnic_error = false;
$phone_error = false;
if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $cnic = mysqli_real_escape_string($conn,  $_POST['cnic']);
    $phone = mysqli_real_escape_string($conn,  $_POST['phone']);
    $email = mysqli_real_escape_string($conn,  $_POST['email']);
    $location = mysqli_real_escape_string($conn,  $_POST['location']);

    $email_chacke = "SELECT * FROM user WHERE email='$email'";

    $email_result = mysqli_query($conn, $email_chacke);

    $check_email = mysqli_num_rows($email_result);
    if ($check_email > 0) {
        $email_error = true;
    } else {
        $cnic_chacke = "SELECT * FROM user WHERE cnic='$cnic'";

        $cnic_result = mysqli_query($conn, $cnic_chacke);

        $check_cnic = mysqli_num_rows($cnic_result);
        if ($check_cnic > 0) {
            $cnic_error = true;
        } else {
            $phone_chacke = "SELECT * FROM user WHERE mobile='$phone'";

            $phone_result = mysqli_query($conn, $phone_chacke);

            $check_phone = mysqli_num_rows($phone_result);
            if ($check_phone > 0) {
                $phone_error = true;
            } else {

                $isert_data = "INSERT INTO user (`name` , `cnic` , `mobile` , `email` , `location`, `create_date` ) 
                VALUES ('$name' , '$cnic', '$phone' , '$email' , '$location' , NOW())";


                $sql = mysqli_query($conn, $isert_data);
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

        $delete_query = "DELETE FROM user WHERE id IN ($extrext_id)";
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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>User Admin Dashboard</title>

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
                    if ($email_error) {
                        echo '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>!WARNING</strong> Email User alrady exit.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                    }
                    ?>
                    <?php
                    if ($cnic_error) {
                        echo '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>!WARNING</strong> Cnic Alrady Exits.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                    }
                    ?>
                    <?php
                    if ($phone_error) {
                        echo '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>!WARNING</strong> Mobile Num Alrady Exits.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                    }
                    ?>
                    <div class="row">
                        <div class="col-lg-4 course-card">
                            <div class="card text-center mein-card mb-5">
                                <h3 class=" font-inter py-4">Add New User</h3>
                                <div class="container-fluid">
                                    <form action="" method="post">
                                        <!-- <div class="in ">
                                            <input type="text" class=" input w-100 py-2" placeholder="Full Name">
                                        </div> -->

                                        <div class="in py-3">
                                            <input type="text" name="name" id="name" class=" input w-100 py-2" placeholder="Full Name" required>
                                        </div>

                                        <div class="in">
                                            <input type="text" name="cnic" id="cnic" class=" input w-100 py-2" placeholder="CNIC" required>
                                        </div>

                                        <div class="py-3">
                                            <input type="text" name="phone" id="phone" class="input w-100 py-2" placeholder="Phone Number" required>
                                        </div>
                                        <!-- <div class="py-3 ">
                                            <input type="tel" name="phone" class="telephone text-dark  py-2" id="phone">
                                        </div> -->

                                        <!-- <div class="py-3 ">
                                            <input type="tel" name="phone" class="telephone text-dark  py-2" id="phone">
                                        </div> -->

                                        <div class="in pb-3">
                                            <input type="email" name="email" id="email" class=" input w-100 py-2 " placeholder="Email" required>
                                        </div>

                                        <div class="in">
                                            <input type="text" name="location" id="location" class="  input w-100 py-2" placeholder="Location (Optional)" required>
                                        </div>

                                        <button type="submit" name="submit" class="save py-2">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-8 ">
                            <div class="card">
                                <form method="post">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 text-end py-3 px-4">
                                            <p class="font student"> User</p>
                                        </div>

                                        <div class="col-lg-9 col-md-9 py-3 ">

                                            <div class="btn-edit-delete text-start px-1">
                                                <button type="submit" name="delete_btn" class="btn export-btn delete">
                                                    <span class="fa-regular fa-trash-can">
                                                        <span>Delete</span></span>
                                                </button>
                                                <button type="submit" class="btn" name="btn_edit">
                                                    <span class="edit export-btn">Edit</span>
                                                </button>
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
                                                        <th>CNIC<i class="fa-solid fa-arrow-down px-2"></i></th>
                                                        <th>Role Type <i class="fa-solid fa-arrow-down px-2"></i></th>
                                                        <th>Contact <i class="fa-solid fa-arrow-down px-2"></i>
                                                        <th>Email<i class="fa-solid fa-arrow-down px-2"></i></th>
                                                        <th>Location<i class="fa-solid fa-arrow-down px-2"></i></th>
                                                        <th>Create By <i class="fa-solid fa-arrow-down px-2"></i></th>
                                                        <th>Create Date <i class="fa-solid fa-arrow-down px-2"></i></th>
                                                        </th>
                                                        <th class="px-2"></th>

                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <!-- ==============select qurey============ -->
                                                    <?php
                                                    $select = "SELECT * FROM `user`";
                                                    $result = mysqli_query($conn, $select);
                                                    $res_num = mysqli_num_rows($result);

                                                    $no = 1;
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                        <tr>
                                                            <td><input type="checkbox" name="chack_btn_delete[]" class="text-input" value="<?php echo $row['id']; ?>"></td>
                                                            <td class="font"><?php echo  $no ?></td>

                                                            <td><?php echo  $row['name']; ?></td>
                                                            <td><?php echo  $row['cnic']; ?></td>
                                                            <td><?php echo  $_SESSION['name']; ?></td>
                                                            <td><?php echo  $row['mobile']; ?></td>
                                                            <td><?php echo  $row['email']; ?></td>
                                                            <td><?php echo  $row['location']; ?></td>
                                                            <td><?php echo  $_SESSION['name']; ?></td>
                                                            <td><?php echo  $row['create_date']; ?></td>
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