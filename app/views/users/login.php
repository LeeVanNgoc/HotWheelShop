<?php require_once ROOT . "/views/inc/header.php"; ?>

<div class="">
    <div class="row">
        <div class="col-8 m-auto">

            <?php 
            // Khởi tạo class Session và gọi các thông báo nếu tồn tại
            if (class_exists('Session')) {
                // Hiển thị thông báo lỗi và thành công
                Session::danger("danger");
                Session::success("success");
            } else {
                echo "<div class='alert alert-danger'>Session class is not loaded correctly!</div>";
            }

            // Hiển thị lỗi xác minh tài khoản nếu có
            if (isset($data['errNotVerified'])) {
                echo '<div class="alert alert-danger">' . htmlspecialchars($data['errNotVerified']) . '</div>';
            }
            ?>

            <div class="card my-4">
                <div class="card-header">
                    <h5 class="text-muted text-center">Login To Your Account</h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo URL ?>/users/login" method="POST">

                        <!-- Trường Email -->
                        <div class="form-group">
                            <input type="text" 
                                   name="email" 
                                   placeholder="Email" 
                                   class="form-control <?php echo isset($data['errEmail']) ? 'is-invalid' : ''; ?>">
                            <?php 
                            if (isset($data['errEmail'])) {
                                echo '<div class="invalid-feedback">' . htmlspecialchars($data['errEmail']) . '</div>';
                            }
                            ?>
                        </div>

                        <!-- Trường Password -->
                        <div class="form-group">
                            <input type="password" 
                                   name="password" 
                                   placeholder="Password" 
                                   class="form-control <?php echo isset($data['errPassword']) ? 'is-invalid' : ''; ?>">
                            <?php 
                            if (isset($data['errPassword'])) {
                                echo '<div class="invalid-feedback">' . htmlspecialchars($data['errPassword']) . '</div>';
                            }
                            ?>
                        </div>

                        <!-- Link Forgot Password -->
                        <div class="mb-3">
                            <a href="<?php echo URL ?>/users/forgotPassword">Forgot Password?</a>
                        </div>

                        <!-- Nút Submit -->
                        <div class="form-group">
                            <input type="submit" 
                                   name="login" 
                                   value="Login" 
                                   class="btn btn-success btn-block">
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<?php // require_once ROOT . "/views/inc/footer.php"; ?>
