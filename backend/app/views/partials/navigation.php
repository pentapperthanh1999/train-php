<nav class="sidebar-wrapper">
    <div class="sidebar__logo">
        <a href="<?= URLROOT ?>">
        <img src="<?= URLROOT ?>/app/assets/images/logo-removebg-preview.png" alt="#" />
        </a>
        <div class="text-logo">
            <h5>
                <span>Media</span>
            </h5>
            <h5>Monitoring</h5>
            <h5>System.</h6>
        </div>
        <div class="toggle-sidebar">
            <i class="fa-solid fa-arrow-left"></i>
        </div>
    </div>
    <!-- Navbar -->
    <ul class="navbar-block">
        <!-- Navbar Item -->
        <li class="active">
            <a href="<?= URLROOT ?>/pages">
                <i class="fa-solid fa-rectangle-list"></i> 
                <span>Dashboard</span>
                <i class="fa-solid fa-chevron-right dropdown"></i>
            </a>
        </li>
        <!-- Navbar Item -->
        <li>
            <a href="<?= URLROOT ?>/classes/">
                <i class="fa-solid fa-school"></i>
                <span>Classes</span>
                <i class="fa-solid fa-chevron-right dropdown"></i>
            </a>
        </li>
        <!-- Navbar Item -->
        <li>
            <a href="<?= URLROOT ?>/teachers/">
                <i class="fa-solid fa-chalkboard-user"></i>
                <span>Teachers</span>
                <i class="fa-solid fa-chevron-right dropdown"></i>
            </a>
        </li>
        <!-- Navbar Item -->
        <li>
            <a href="<?= URLROOT ?>/students/">
                <i class="fa-solid fa-user"></i>
                <span>Students</span>
                <i class="fa-solid fa-chevron-right dropdown"></i>
            </a>
            <ul class="sub-menu">
                <li>
                    <a href="#">
                        <i class="fa-solid fa-rectangle-list"></i> 
                        <span>Manager Record</span>
                        <i class="fa-solid fa-chevron-right dropdown"></i>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-solid fa-rectangle-list"></i> 
                        <span>Manager Record</span>
                        <i class="fa-solid fa-chevron-right dropdown"></i>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Navbar Item -->
        <li>
            <a href="<?= URLROOT ?>/assignments/">
                <i class="fa-solid fa-user"></i>
                <span>Assignments</span>
                <i class="fa-solid fa-chevron-right dropdown"></i>
            </a>
        </li>
    </ul>
</nav>