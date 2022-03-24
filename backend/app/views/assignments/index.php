<?php
    require APPROOT . '/views/partials/header.php';
    session_start();
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
    }
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
                <div class="header__user">
                    <img src="<?= URLROOT ?>/app/assets/images/user.png" alt="#">
                </div>
            </div>
            <!-- Content -->
            <div class="content">
                <!-- Data Table -->
                <div class="data-table">
                
                    <div class="data-table-wrapper">
                        <div class="data-table__top">
                            <h2 class="title">Assignments
                                <a href="<?= URLROOT ?>/assignments/create">
                                    <i class="fa-solid fa-circle-plus"></i>
                                </a>
                            </h2>
                            <a href="#" class="view-more">
                                <span>View More</span>
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                        <div class="data-table__content">
                            <table>
                                <thead>
                                    <tr><th>STT</th>
                                        <th>Student Code</th>
                                        <th>Class Code</th>
                                        <th>Teacher Code</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <?php
                                    $i = 1;
                                    foreach($data['assignments'] as $assign => $key) {
                                ?>
                                <tbody>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td class="assign-box">
                                            <a href="#" data-type="getstudent" data-code="<?= $key->student_code ?>">  <?= $key->student_code ?>
                                            </a>
                                            <div class="assign-info">
                                                <h2 class="heading">Student Information</h2>
                                                <div class="content">
                                                    
                                                </div>
                                            </div>
                                        </td>
                                        <td class="assign-box">
                                            <a href="#" data-type="getclass" data-code="<?= $key->class_code ?>">
                                                <?= $key->class_code ?>
                                            </a>
                                            <div class="assign-info">
                                                <h2 class="heading">Class Information</h2>
                                                <div class="content">
                                                    
                                                </div>
                                            </div>
                                        </td>
                                        <td class="assign-box">
                                            <a href="#" data-type="getteacher" data-code="<?= $key->teacher_code ?>">
                                                <?= $key->teacher_code ?>
                                            </a>
                                            <div class="assign-info">
                                                <h2 class="heading">Teacher Information</h2>
                                                <div class="content">
                                                    
                                                </div>
                                            </div>
                                        </td>
                                        <td class="action">
                                            <span>...</span>
                                            <div class="action-list">
                                                    <a href="<?= URLROOT .'/assignments/update/'. $key->id ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                                <span>
                                                    <form action="<?= URLROOT .'/assignments/delete/'. $key->id ?> " method="POST">
                                                        <button type="submit" class="btn-delete" onclick="return confirm('Are you sure?')">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </span>
                                                <span>
                                                    <i class="fa-solid fa-eye"></i>
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                                <?php        
                                    }
                                ?>
                            </table>
                            <div class="pagination">
                                <div class="pagination-item">
                                    <i class="fa-solid fa-chevron-left"></i>
                                </div>
                                <div class="pagination-item active">
                                    1
                                </div>
                                <div class="pagination-item">
                                    2
                                </div>
                                <div class="pagination-item">
                                    3
                                </div>
                                <div class="pagination-item">
                                    <i class="fa-solid fa-chevron-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal-Box -->
            </div>
        </div>
    </div>
</body>
<?php
    require APPROOT . '/views/partials/footer.php';
?>