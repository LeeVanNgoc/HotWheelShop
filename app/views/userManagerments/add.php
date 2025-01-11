<?php require_once ROOT ."/views/inc/adminHeader.php" ?>
<?php require_once ROOT ."/views/inc/sidebar.php" ?>

<div class="container">
    <div class="row">
        <div class="col-10 col-md-6 m-auto">

            <div class="card my-4">
                <div class="card-header">
                    <h5 class='text-muted text-center'>Add New User</h5>
                </div>

                <div class="card-body">
                    <form action="<?php echo URL ?>/userManagerments/add" method="POST">

                        <!-- Name Field -->
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Enter user name" class="form-control <?php echo isset($data['errName']) ? 'is-invalid' : '' ?>">
                            <?php echo isset($data['errName']) ? '<div class="invalid-feedback">'.$data['errName'].'</div>' : '' ?>
                        </div>

                        <!-- Email Field -->
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Enter email" class="form-control <?php echo isset($data['errEmail']) ? 'is-invalid' : '' ?>">
                            <?php echo isset($data['errEmail']) ? '<div class="invalid-feedback">'.$data['errEmail'].'</div>' : '' ?>
                        </div>

                        <!-- Password Field -->
                        <div class="form-group">
                            <input type="password" name="password" placeholder="Enter password" class="form-control <?php echo isset($data['errPassword']) ? 'is-invalid' : '' ?>">
                            <?php echo isset($data['errPassword']) ? '<div class="invalid-feedback">'.$data['errPassword'].'</div>' : '' ?>
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="form-group">
                            <input type="password" name="confirm_password" placeholder="Confirm password" class="form-control <?php echo isset($data['errConfirmPassword']) ? 'is-invalid' : '' ?>">
                            <?php echo isset($data['errConfirmPassword']) ? '<div class="invalid-feedback">'.$data['errConfirmPassword'].'</div>' : '' ?>
                        </div>

                        <!-- Role Select -->
                        <div class="input-group mb-3">
                            <select class="custom-select <?php echo isset($data['errRole']) ? 'is-invalid' : '' ?>" name="admin">
                                <option selected>Choose admin...</option>
                                <option value="1">Admin</option>
                                <option value="0">User</option>
                            </select>
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="admin">Role</label>
                            </div>
                            <?php echo isset($data['errRole']) ? '<div class="invalid-feedback">'.$data['errRole'].'</div>' : '' ?>
                        </div>

                        <!-- CSRF Token -->
                        <input type="hidden" name="csrf" value="<?php new Csrf(); echo Csrf::get()?>">

                        <!-- Submit & Go Back Button -->
                        <div class="form-group">
                            <a href='<?php echo URL ?>/userManagerments' class="btn btn-sm btn-secondary">
                                <i class="fa fa-arrow-left"></i>
                                Go Back
                            </a>
                            <input type="submit" name="addUser" value="Add" class="btn btn-success btn-sm">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once ROOT ."/views/inc/adminFooter.php" ?>
