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
                <h2 class="header__title">Create Class</h2>
                <div class="header__user">
                    <img src="<?= URLROOT ?>/app/assets/images/user.png" alt="#">
                </div>
            </div>
            <!-- Content -->
            <div class="content">
                <a href="<?= URLROOT ?>/classes" class="btn-back">
                    <i class="fa-solid fa-arrow-left"></i>
                    Back
                </a>
                <div class="container">

                    <div class="row">
                        <div class="col-md-6">
                        
                        <form action="<?= URLROOT ?>/classes/create" method="POST" class="p-3">
                            <div class="error"><?= $data['duplicate'] ?></div>
                            <div class="form-group">
                                <label for="code">Code</label>
                                <input type="text" class="form-control" name="code" id="code" placeholder="Enter Code" value="<?php echo isset($_POST["code"]) ? $_POST["code"] : ''; ?>" />
                            </div>
                            <div class="error"><?= $data['codeError'] ?></div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" value="<?php echo isset($_POST["name"]) ? $_POST["name"] : ''; ?>"/>
                            </div>
                            <div class="error"><?= $data['nameError'] ?></div>
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