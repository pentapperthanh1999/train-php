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
                <h2 class="header__title">Create Assignment</h2>
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
                        
                        <form action="<?= URLROOT ?>/assignments/create" method="POST" class="p-3">
                            <div class="form-group d-bw">
                                <label for="gender">Assignment Student:</label>
                                <select class="form-select" name="student_code">
                                    <option selected disabled>Choose Student Here</option>
                                    <?php 
                                    foreach($data['students'] as $student) {
                                        ?>
                                        <option value="<?= $student->code ?>"
                                        <?php 
                                            if (isset($_POST['student_code']) && $_POST['student_code'] == $student->code) {
                                                echo 'selected';
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
                                <!-- Error Student -->
                                <div class="error">
                                    <?php
                                        if (!empty($data['message']['student_code_error'])) {
                                            echo $data['message']['student_code_error'];
                                        }
                                    ?>
                                </div>
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
                                            if (isset($_POST['class_code']) && $_POST     ['class_code'] == $class->code) {
                                                echo 'selected';
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
                                <!-- Error Class -->
                                <div class="error">
                                    <?php
                                        if (!empty($data['message']['class_code_error'])) {
                                            echo $data['message']['class_code_error'];
                                        }
                                    ?>
                                </div>
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
                                            if (isset($_POST['teacher_code']) && $_POST['teacher_code'] == $teacher->code) {
                                                echo 'selected';
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
                                <!-- Error Teacher -->
                                <div class="error">
                                    <?php
                                        if (!empty($data['message']['teacher_code_error'])) {
                                            echo $data['message']['teacher_code_error'];
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="error">
                                <?php
                                    if (!empty($data['message']['exist'])) {
                                        echo $data['message']['exist'];
                                    }
                                ?>
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
