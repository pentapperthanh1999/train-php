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
                <h2 class="header__title">Update Assignment</h2>
                <div class="header__user">
                    <img src="<?= URLROOT ?>/app/assets/images/user.png" alt="#">
                </div>
            </div>
            <!-- Content -->
            <div class="content">
                <a href="<?= URLROOT ?>/assignments" class="btn-back">
                    <i class="fa-solid fa-arrow-left"></i>
                    Back
                </a>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                        
                        <form action="<?= URLROOT .'/assignments/update/'. $data['assign']->id ?>" method="POST" class="p-3">
                            <div class="form-group d-bw">
                                <label for="gender">Assignment Student:</label>
                                <select class="form-select" name="student_code">
                                    <option selected disabled>Choose Student Here</option>
                                    <?php 
                                        foreach($data['students'] as $student) {
                                    ?>
                                        <option value="<?= $student->code ?>" 
                                            <?php
                                                if ($student->code == $data['assign']->student_code) {
                                                    echo "selected";
                                                }
                                            ?>
                                        >
                                            <?= $student->name ?>
                                            - <span> <?= $student->code ?></span>
                                        </option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group d-bw">
                                <label for="gender">Assignment Class:</label>
                                <select class="form-select" name="class_code">
                                    <option selected disabled>Choose Class Here</option>
                                    <?php 
                                        foreach($data['classes'] as $class) {
                                    ?>
                                        <option value="<?= $class->code ?>" 
                                            <?php
                                                if ($class->code == $data['assign']->class_code) {
                                                    echo "selected";
                                                }
                                            ?>
                                        >
                                            <?= $class->name ?>
                                            - <span> <?= $class->code ?></span>
                                        </option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group d-bw">
                                <label for="gender">Assignment Teacher:</label>
                                <select class="form-select" name="teacher_code">
                                    <option selected disabled>Choose Teacher Here</option>
                                    <?php 
                                        foreach($data['teachers'] as $teacher) {
                                    ?>
                                        <option value="<?= $teacher->code ?>" 
                                            <?php
                                                if ($teacher->code == $data['assign']->teacher_code) {
                                                    echo "selected";
                                                }
                                            ?>
                                        >
                                            <?= $teacher->name ?>
                                            - <span> <?= $teacher->code ?></span>
                                        </option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>    
                        </form>
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
