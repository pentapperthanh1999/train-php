<?php
    require APPROOT . '/views/partials/header.php';
?>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php
            require APPROOT . '/views/partials/navigation.php';
        ?>
        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <div class="header">
                <h2 class="header__title">Dashboard</h2>
                <div class="header__user">
                    <img src="<?= URLROOT ?>/app/assets/images/user.png" alt="#">
                </div>
            </div>
            <!-- Content -->
            <div class="content">
                <div class="statistical pd-30">
                    <!-- Statistical item -->
                    <div class="statistical-item">
                        <h2>Students</h2>
                        <div class="number">
                            <span><?= $data['countStudents'] ?></span>
                        </div>
                    </div>
                    <!-- Statistical item -->
                    <div class="statistical-item">
                        <h2>Classes</h2>
                        <div class="number">
                            <span><?= $data['countClasses'] ?></span>
                        </div>
                    </div>
                    <!-- Statistical item -->
                    <div class="statistical-item">
                        <h2>Teachers</h2>
                        <div class="number">
                            <span><?= $data['countTeachers'] ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php
    require APPROOT . '/views/partials/footer.php';
?>