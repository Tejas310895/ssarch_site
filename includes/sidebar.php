<!-- partial -->
<div class="container-fluid page-body-wrapper">
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <?php
            $user_role = get_user($_SESSION['user']);
            $user_role = array_shift($user_role);
            if ($user_role['user_role'] == 'site_incharge') {
            ?>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#error" aria-expanded="false" aria-controls="error">
                        <i class="icon-grid menu-icon"></i>
                        <span class="menu-title">Summary</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="error">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="?tasks_report"> Tasks </a></li>
                            <li class="nav-item"> <a class="nav-link" href="?measurements_report"> Measurements </a></li>
                        </ul>
                    </div>
            </li>
            <?php } ?>
        </ul>
    </nav>
    <!-- partial -->