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
                            <h2 class="title">Teachers
                                <a href="<?= URLROOT ?>/teachers/create">
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
                                        <th>Id</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Birthday</th>
                                        <th>Gender</th>
                                        <th>Address</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <?php
                                    $i = 1;
                                    foreach($data['teachers'] as $teacher) {
                                ?>
                                <tbody>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $teacher->id ?></td>
                                        <td><?= $teacher->code ?></td>
                                        <td><?= $teacher->name ?></td>
                                        <td><?= $teacher->birthday ?></td>
                                        <td>
                                            <?php 
                                            if ($teacher->gender == 0) {
                                                    echo "Male";
                                                } else if ($teacher->gender == 1) {
                                                    echo "Female";
                                                } else {
                                                    echo "Underfined";
                                                }  
                                            ?>
                                        </td>
                                        <td><?= $teacher->address ?></td>
                                        <td class="action">
                                            <span>...</span>
                                            <div class="action-list">
                                                    <a href="<?= URLROOT .'/teachers/update/'. $teacher->id ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                                <span>
                                                    <form action="<?= URLROOT .'/teachers/delete/'. $teacher->id ?>" method="POST">
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