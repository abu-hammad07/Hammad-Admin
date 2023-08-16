<!-- Sidebar -->
<ul class="navbar-nav  sidebar accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
            <img class="img-fluid" src="img/logo-hunar.png" alt="">
            <!-- <i class="fas fa-laugh-wink"></i> -->
        </div>
        <!-- <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div> -->
    </a>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item mt-4  ">
        <a class="nav-link side-color" href="index.php">
            <i class="fa-solid fa-house"></i>
            <span class="">Dashboard</span></a>
    </li>

    <!-- Nav Item - Institutes -->
    <li class="nav-item ">
        <a class="nav-link side-color" href="Institute.php">
            <i class="fa-solid fa-user"></i>
            <span>Institutes</span></a>
    </li>

    <!-- Nav Item - Courses -->
    <li class="nav-item  ">
        <a class="nav-link side-color" href="courses.php">
            <i class="fa-solid fa-briefcase "></i>
            <span>Courses</span></a>
    </li>

    <!-- Nav Item - Account -->
    <li class="nav-item ">
        <a class="nav-link side-color" href="student.php">
            <i class="fa-solid fa-folder-closed"></i>
            <span>Student</span></a>
    </li>

    <!-- Nav Item - Account -->
    <li class="nav-item ">
        <a class="nav-link side-color" href="Acount.php">
            <i class="fa-solid fa-folder-closed"></i>
            <span>Account</span></a>
    </li>

    <!-- Nav Item - Users -->
    <li class="nav-item ">
        <a class="nav-link side-color" href="User.php">
            <i class="fa-solid fa-sack-dollar"></i>
            <span>Users</span></a>
    </li>

    <!-- Nav Item - Sections -->
    <li class="nav-item ">
        <a class="nav-link side-color" href="Section.php">
            <i class="fa-solid fa-sack-dollar"></i>
            <span>Sections</span></a>
    </li>

    <!-- Nav Item - Exam -->
    <li class="nav-item ">
        <a class="nav-link side-color" href="Exam.php">
            <i class="fa-solid fa-sack-dollar"></i>
            <span>Exam</span></a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->


<script>
    /*
    //  =============sidebar================
    const links = document.querySelectorAll(".nav-link");

    links.forEach((link) => {
        link.addEventListener("click", function(event) {
            event.preventDefault();

            // Remove 'active' class from all links
            links.forEach((link) => {
                link.classList.remove("active");
            });

            // Add 'active' class to the clicked link
            this.classList.add("active");
        });
    });
    */

    
        // Get all sidebar links
        const sidebarLinks = document.querySelectorAll('.sidebar a');

        // Add click event listener to each link
        sidebarLinks.forEach(link => {
            link.addEventListener('click', function (event) {
                // Prevent default link behavior
                event.preventDefault();

                // Remove 'active' class from all links
                sidebarLinks.forEach(link => link.classList.remove('active'));

                // Add 'active' class to clicked link
                this.classList.add('active');

                // Get the target page from the link's href attribute
                const targetPage = this.getAttribute('href');

                // Simulate navigation by changing location hash
                window.location.href = targetPage;
            });
        });
    
</script>