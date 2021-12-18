<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary">

    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="<?php echo BASE_PATH; ?>dist/img/PlayScraperLogo.png" alt="PlayScraper Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Play Scraper</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo BASE_PATH; ?>dist/img/profile.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $name; ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?php echo BASE_PATH;?>dashboard" class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo BASE_PATH;?>application" class="nav-link {{ request()->is('application*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-font"></i>
                        <p>
                            Applications
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo BASE_PATH;?>admin" class="nav-link {{ request()->is('admin*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-circle"></i>
                        <p>
                            Admin
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo BASE_PATH;?>admin/logout" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            log out
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
