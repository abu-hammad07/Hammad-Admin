<!DOCTYPE html>
<html lang="ur">

<head>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Exam Admin Dashboard</title>

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
                    <div class="row">

                        <div class="col-lg-12 ">
                            <div class="card">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 text-end py-3 px-4">
                                        <p class="font student"> EXAM</p>
                                    </div>
                                    <div class="col-lg-9 col-md-9 py-3 ">
                                        <div class="btn-edit-delete text-start px-1">
                                            <a href="">
                                                <span class="fa-regular fa-trash-can export-btn delete">
                                                    <span>Delete</span></span></a>
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
                                                        <i class="fa-solid fa-plus "></i>
                                                    </th>
                                                    <th>STD ID<i class="fa-solid fa-arrow-down px-2"></i></th>
                                                    <th>Student Name <i class="fa-solid fa-arrow-down px-2"></i></th>
                                                    <th>Voucher <i class="fa-solid fa-arrow-down px-2"></i></th>
                                                    <th>CNIC<i class="fa-solid fa-arrow-down px-2"></i></th>
                                                    <th>Optained Marks<i class="fa-solid fa-arrow-down px-2"></i></th>
                                                    <th>Percentage<i class="fa-solid fa-arrow-down px-2"></i>
                                                    </th>
                                                    <th>Status<i class="fa-solid fa-arrow-down px-2"></i>
                                                    </th>
                                                    <th>Course<i class="fa-solid fa-arrow-down px-2"></i>
                                                    </th>
                                                    <th class="px-2"></th>

                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    <td><input type="checkbox" class="text-input"></td>
                                                    <td class="font">Bold text column</td>
                                                    <td>Regular text column</td>
                                                    <td>Regular text column</td>
                                                    <td>Regular text column</td>
                                                    <td>Regular text column</td>
                                                    <td>Regular text column</td>
                                                    <td>
                                                        <li class="paid"><span class="paid-step">Paid</span> </li>
                                                    </td>
                                                    <td>Regular text column</td>
                                                    <td>
                                                        <div class="bt dropdown show">
                                                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                                            </a>

                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                <a class="dropdown-item" href="#">Action</a>
                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                <a class="dropdown-item" href="#">Something else
                                                                    here</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td><input type="checkbox" class="text-input"></td>
                                                    <td class="font">Bold text column</td>
                                                    <td>Regular text column</td>
                                                    <td>Regular text column</td>
                                                    <td>Regular text column</td>
                                                    <td>Regular text column</td>
                                                    <td>Regular text column</td>
                                                    <td>
                                                        <li class="un-paid"><span class="unpaid-step">UnPaid</span> </li>
                                                    </td>
                                                    <td>Regular text column</td>
                                                    <td>
                                                        <div class="bt dropdown show">
                                                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                                            </a>

                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                <a class="dropdown-item" href="#">Action</a>
                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                <a class="dropdown-item" href="#">Something else
                                                                    here</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td><input type="checkbox" class="text-input"></td>
                                                    <td class="font">Bold text column</td>
                                                    <td>Regular text column</td>
                                                    <td>Regular text column</td>
                                                    <td>Regular text column</td>
                                                    <td>Regular text column</td>
                                                    <td>Regular text column</td>
                                                    <td>
                                                        <li class="paid"><span class="paid-step">Paid</span> </li>
                                                    </td>
                                                    <td>Regular text column</td>
                                                    <td>
                                                        <div class="bt dropdown show">
                                                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                                            </a>

                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                <a class="dropdown-item" href="#">Action</a>
                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                <a class="dropdown-item" href="#">Something else
                                                                    here</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td><input type="checkbox" class="text-input"></td>
                                                    <td class="font">Bold text column</td>
                                                    <td>Regular text column</td>
                                                    <td>Regular text column</td>
                                                    <td>Regular text column</td>
                                                    <td>Regular text column</td>
                                                    <td>Regular text column</td>
                                                    <td>
                                                        <li class="paid"><span class="paid-step">Paid</span> </li>
                                                    </td>
                                                    <td>Regular text column</td>
                                                    <td>
                                                        <div class="bt dropdown show">
                                                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                                            </a>

                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                <a class="dropdown-item" href="#">Action</a>
                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                <a class="dropdown-item" href="#">Something else
                                                                    here</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td><input type="checkbox" class="text-input"></td>
                                                    <td class="font">Bold text column</td>
                                                    <td>Regular text column</td>
                                                    <td>Regular text column</td>
                                                    <td>Regular text column</td>
                                                    <td>Regular text column</td>
                                                    <td>Regular text column</td>
                                                    <td>
                                                        <li class="un-paid"><span class="unpaid-step">UnPaid</span> </li>
                                                    </td>
                                                    <td>Regular text column</td>
                                                    <td>
                                                        <div class="bt dropdown show">
                                                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                                            </a>

                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                <a class="dropdown-item" href="#">Action</a>
                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                <a class="dropdown-item" href="#">Something else
                                                                    here</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td><input type="checkbox" class="text-input"></td>
                                                    <td class="font">Bold text column</td>
                                                    <td>Regular text column</td>
                                                    <td>Regular text column</td>
                                                    <td>Regular text column</td>
                                                    <td>Regular text column</td>
                                                    <td>Regular text column</td>
                                                    <td>
                                                        <li class="paid"><span class="paid-step">Paid</span> </li>
                                                    </td>
                                                    <td>Regular text column</td>
                                                    <td>
                                                        <div class="bt dropdown show">
                                                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                                            </a>

                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                <a class="dropdown-item" href="#">Action</a>
                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                <a class="dropdown-item" href="#">Something else
                                                                    here</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td><input type="checkbox" class="text-input"></td>
                                                    <td class="font">Bold text column</td>
                                                    <td>Regular text column</td>
                                                    <td>Regular text column</td>
                                                    <td>Regular text column</td>
                                                    <td>Regular text column</td>
                                                    <td>Regular text column</td>
                                                    <td>
                                                        <li class="un-paid"><span class="unpaid-step">UnPaid</span> </li>
                                                    </td>
                                                    <td>Regular text column</td>
                                                    <td>
                                                        <div class="bt dropdown show">
                                                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                                            </a>

                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                <a class="dropdown-item" href="#">Action</a>
                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                <a class="dropdown-item" href="#">Something else
                                                                    here</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
    <!-- End of Page Wrapper -->ِ




    <!-- Body End Link -->
    <?php
    include 'bodyEndLink.php';
    ?>
    <!-- Body End Link End -->


</body>

</html>