<?php
include "config.php";
session_start();
if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $cinc = $_POST['cnic'];
    $email = $_POST['email'];
    
    $select = "SELECT * FROM user WHERE email='$email' ";
    $email_pass = mysqli_query($conn, $select);
    $email_num_row = mysqli_num_rows($email_pass);


    if ($email_num_row) {
        $email_fach = mysqli_fetch_assoc($email_pass);
        $_SESSION['name'] = $email_fach['name'];
        $cnic_fach = $email_fach['cnic'];
        if ($cnic_fach) {
            header("location:index.php");
        } else {
            echo "name incropt";
        }
    } else {
        echo "email envalid";
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

    <title>Admin Dashboard</title>

    <!-- Custom fonts for this template-->
    <!-- <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> -->
    <script src="https://kit.fontawesome.com/488fa6f7e5.js" crossorigin="anonymous"></script>

    <!-- --------------google font----------- -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

</head>
<style>
    .inputDesign {
        padding: 10px;
        border: 2px solid #ccc;
        border-radius: 7px;
        font-size: 16px;
        outline: none;
    }

    .inputDesign:focus {
        border-color: #0055b8;
        animation: inputFocusAnimation 0.3s;
    }

    @keyframes inputFocusAnimation {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }

        100% {
            transform: scale(1);
        }
    }
</style>


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->

        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content ">
                <div class="container-fluid ">
                    <div class="row d-flex ">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6  pt-5 mb-5 pb-5 course-card">
                            <div class="card text-center mein-card  mb-5">
                                <h3 class=" font-inter py-4">Login</h3>
                                <div class="container-fluid">
                                    <form action="" method="post">
                                        <!-- <div class="in ">
                                            <input type="text" class=" input w-100 py-2" placeholder="Full Name">
                                        </div> -->

                                        <div class="in py-3">
                                            <input type="text" name="name" id="name" class=" inputDesign w-100 py-2" placeholder="Full Name">
                                        </div>

                                        <div class="in ">
                                            <input type="text" name="cnic" id="cnic" class=" inputDesign w-100 py-2" placeholder="CNIC">
                                        </div>

                                        <div class="in py-3">
                                            <input type="email" name="email" id="email" class=" inputDesign w-100 py-2" placeholder="Email">
                                        </div>

                                        <button type="submit" name="submit" class="save py-2">Login</button>
                                    </form>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>

            </div>
            <!-- End of Content Wrapper -->

        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/chart-area-demo.js"></script>
        <script src="js/demo/chart-pie-demo.js"></script>
        <script src="js/index.js"></script>


</body>

</html>