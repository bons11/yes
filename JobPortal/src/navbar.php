<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
            <a href="index.php" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
                <h1 class="m-0 text-primary">EBB</h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="index.php" class="nav-item nav-link">Home</a>
                    <a href="mission.php" class="nav-item nav-link">About</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Jobs</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="category.php" class="dropdown-item">Job Category</a>
                            <a href="job-list.php" class="dropdown-item">Job List</a>
                        </div>
                    </div>
                    <a href="contacts.php" class="nav-item nav-link">Contact</a>
                    <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <?php
                        if (isset($_SESSION['name'])) {
                            // User is logged in, display their name
                            echo $_SESSION['name'];
                        } else {
                            // User is not logged in, show default "Signin"
                            echo "Login";
                        }
                        ?>
                    </a>

                    <div class="dropdown-menu rounded-0 m-0">
                        <?php
                        if (isset($_SESSION['name'])) {
                            // If user is logged in, show profile, settings, and logout options
                            echo "<a href='#' class='dropdown-item' onclick='confirmLogout()'>Logout</a>";
                        } else {
                            // If user is not logged in, show regular signin options
                            echo "<a href='auth/login.php' class='dropdown-item'>User Login</a>";
                            echo "<a href='admin/index.php' class='dropdown-item'>Admin Login</a>";
                        }
                        ?>
                    </div>
                   </div>
                   <?php
                if (isset ($_SESSION['role']) && $_SESSION['role']  == "representative") {
                    ?>
                    <a href="#" id="applyJobOwner" class="nav-link" data-bs-toggle="modal" data-bs-target="#myModal" >Post a job</a>
                   <?php
                 } else  {
                    ?>
                    
                   <?php
                }
                ?>
                <?php
                if (isset ($_SESSION['name'])) {
                    ?>
                   <a href="job-list.php" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Apply job<i class="fa fa-arrow-right ms-3"></i></a>
                   <?php
                 } else  {
                    ?>
                    <a href="auth/login.php" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Create account<i class="fa fa-arrow-right ms-3"></i></a>
                   <?php
                }
                ?>
                    
                </div>
            </div>
        </nav>

        <?php include 'job_modal.php'; ?>