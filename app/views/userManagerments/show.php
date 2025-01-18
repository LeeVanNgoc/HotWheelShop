<?php require_once ROOT ."/views/inc/adminHeader.php"; ?>
<?php require_once ROOT ."/views/inc/sidebar.php"; ?>

<div class="container mt-4">

    <?php if (!empty($data['user'])) { ?>
        <div class="card mx-auto w-75">
            <div class="card-header bg-dark text-white text-center">
                    <h2 class="text-center">User Information</h2>
            </div>
            <div class="card-body row">
                <!-- Cột hiển thị thông tin người dùng -->
                <div class="col-md-8">
                    <p><strong>User ID:</strong> <?php echo $data['user']->user_id; ?></p>
                    <p><strong>Full Name:</strong> <?php echo htmlspecialchars($data['user']->full_name); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($data['user']->email); ?></p>
                    <p><strong>Phone:</strong> <?php echo !empty($data['user']->phone) ? $data['user']->phone : 'N/A'; ?></p>
                    <p><strong>Address:</strong> <?php echo !empty($data['user']->address) ? $data['user']->address : 'N/A'; ?></p>
                    <p><strong>Role:</strong> 
                        <?php echo ($data['user']->admin == 1) ? '<span class="text-primary">Admin</span>' : '<span class="text-secondary">User</span>'; ?>
                    </p>
                    <p><strong>Status:</strong> 
                        <?php echo $data['user']->active == 0 
                            ? '<span class="text-danger">Inactive</span>' 
                            : '<span class="text-success">Active</span>'; ?>
                    </p>
                    <p><strong>Created At:</strong> <?php echo $data['user']->created_at; ?></p>
                </div>

                <!-- Cột hiển thị Avatar -->
                <div class='text-center mt-3'>
                    <img style='height:200px;width:200px' class="img-thumbnail rounded-circle card-img-top" src="<?php echo URL ?>/uploads/<?php echo $data['user']->image ?>" alt="Card image cap">                
                </div>


            </div>
            <div class="card-footer text-center">
                <a href="<?php echo URL ?>/userManagerments" class="btn btn-primary btn-sm">Back to List</a>
            </div>
        </div>
    <?php } else { ?>
        <p class="text-center text-danger">
            <span class="btn btn-sm btn-danger" style="border-radius:50%">
                <i class="fa fa-warning"></i>
            </span> User not found.
        </p>
    <?php } ?>
</div>

<?php require_once ROOT ."/views/inc/adminFooter.php"; ?>
