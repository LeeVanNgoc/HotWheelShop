<?php require_once ROOT . "/views/inc/adminHeader.php" ?>
<?php require_once ROOT . "/views/inc/sidebar.php" ?>

<div class="mt-4">
    <h5 class="text-center">User Management</h5>
    <div class="card">
        <div class="card-header">
            <h6>User List</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($data['users']) > 0) : ?>
                        <?php foreach ($data['users'] as $user) : ?>
                            <tr>
                                <td><?php echo $user->user_id ?></td>
                                <td><?php echo $user->name ?></td>
                                <td><?php echo $user->email ?></td>
                                <td>
                                    <?php echo $user->active == 1 ? 
                                        '<span class="badge badge-success">Active</span>' :
                                        '<span class="badge badge-danger">Inactive</span>' ?>
                                </td>
                                <td><?php echo $user->role ?></td>
                                <td>
                                    <a href="<?php echo URL ?>/users/edit/<?php echo $user->user_id ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="<?php echo URL ?>/users/delete/<?php echo $user->user_id ?>" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6" class="text-center">No users found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <a href="<?php echo URL ?>/users/add" class="btn btn-sm btn-primary mt-4">
        <i class="fa fa-plus"></i> Add New User
    </a>

</div>

<?php require_once ROOT . "/views/inc/adminFooter.php" ?>
