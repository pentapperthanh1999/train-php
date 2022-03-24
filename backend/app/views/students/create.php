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
                <h2 class="header__title">Create Student</h2>
                <div class="header__user">
                    <img src="<?= URLROOT ?>/app/assets/images/user.png" alt="#">
                </div>
            </div>
            <!-- Content -->
            <div class="content">
                <a href="<?= URLROOT ?>/students" class="btn-back">
                    <i class="fa-solid fa-arrow-left"></i>
                    Back
                </a>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                        
                        <form action="<?= URLROOT ?>/students/create" method="POST" class="p-3">
                            <div class="error">
                                <?php
                                    if (!empty($data['message']['duplicate'])) {
                                        echo $data['message']['duplicate'];
                                    }
                                ?>
                            </div>
                            <div class="form-group">
                                <label for="code">Code</label>
                                <input type="text" class="form-control" name="code" placeholder="Enter Code" value="<?php echo isset($_POST["code"]) ? $_POST["code"] : ''; ?>" />
                                <div class="error">
                                    <?php
                                        if (!empty($data['message']['codeError'])) {
                                            echo $data['message']['codeError'];
                                        }
                                    ?>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Name" value="<?php echo isset($_POST["name"]) ? $_POST["name"] : ''; ?>"/>
                                <div class="error">
                                    <?php
                                        if (!empty($data['message']['nameError'])) {
                                            echo $data['message']['nameError'];
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="code">Birthday</label>
                                <input type="date" class="form-control" name="birthday" value="<?php echo isset($_POST["birthday"]) ? $_POST["birthday"] : ''; ?>" />
                                <div class="error">
                                    <?php
                                        if (!empty($data['message']['birthdayError'])) {
                                            echo $data['message']['birthdayError'];
                                        } 
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender:</label>
                                <select class="form-select" name="gender">
                                    <option value="0" <?php if (isset($_POST['gender']) && $_POST['gender'] == 0) echo 'selected'; ?> >Male</option>
                                    <option value="1" <?php if (!empty($_POST['gender']) && $_POST['gender'] == 1) echo 'selected'; ?> >Female</option>
                                    <option value="2" <?php if (!empty($_POST['gender']) && $_POST['gender'] == 2) echo 'selected'; ?> >Undefined</option>
                                </select>
                                <small class="form-text text-muted">Default value is Male. Please choice your gender
                                </small>
                                <div class="error">
                                    <?php
                                        if (!empty($data['message']['genderError'])) {
                                            echo $data['message']['genderError'];
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="code">Address</label>
                                <input type="text" class="form-control" name="address" placeholder="Enter Address" value="<?php echo !empty($_POST["address"]) ? $_POST["address"] : ''; ?>" />
                                <div class="error">
                                    <?php
                                        if (!empty($data['message']['addressError'])) {
                                            echo $data['message']['addressError'];
                                        }
                                    ?>
                                </div>
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

<!-- <div class="modal fade" id="create-student" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create Class</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus architecto cupiditate est nostrum ullam possimus? Quae sequi repudiandae ad dicta distinctio saepe quibusdam ut, cumque quam nostrum deleniti, quod minima incidunt voluptas numquam a animi aperiam expedita velit! Deleniti perferendis doloribus dolorem hic asperiores, aliquam nisi sit assumenda impedit blanditiis.
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
</div> -->