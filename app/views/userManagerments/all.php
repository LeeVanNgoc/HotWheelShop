<?php require_once ROOT ."/views/inc/adminHeader.php" ?>
<?php require_once ROOT ."/views/inc/sidebar.php" ?>

<div class="text-center mt-4">
    <h5>User Management</h5>
    <input type="text" id="search_user" class="form-control w-50 mx-auto" placeholder="Search">

    <span class="float-right m-3">
        <a href="<?php echo URL ?>/userManagerments/add" class="btn btn-sm btn-success">Add new user +</a>
    </span>

    <?php if ($data['userManagerments']) { ?>
    <table class="table table-dark table-responsive-md searched">
        <thead>
            <tr>
                <th>Serial</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $i = 0;
                foreach ($data['userManagerments'] as $user) {
                    $i++;
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td>
                    <a href="<?php echo URL ?>/userManagerments/show/<?php echo $user->user_id ?>" class="text-danger">
                        <?php echo $user->full_name ?>
                    </a>
                </td>
                <td><?php echo $user->email ?></td>
                <td>
                    <a href="<?php echo URL ?>/userManagerments/toggleStatus/<?php echo $user->user_id ?>">
                        <?php echo $user->active == 0 ? '<i class="fa fa-thumbs-down text-secondary"></i>' : '<i class="fa fa-thumbs-up text-success"></i>' ?>
                    </a>
                </td>
                <td>
                    <form class="d-inline" action="<?php echo URL ?>/userManagerments/delete/<?php echo $user->user_id ?>" method="GET">
                        <input type="hidden" name="csrf" value="<?php new Csrf(); echo Csrf::get() ?>">
                        <button class="btn btn-danger delete btn-sm py-0" type="submit">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                    <a href="<?php echo URL ?>/userManagerments/edit/<?php echo $user->user_id ?>" class="btn btn-info btn-sm py-0">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="<?php echo URL ?>/userManagerments/show/<?php echo $user->user_id ?>" class="btn btn-info btn-sm py-0">
                        <i class="fa fa-eye"></i>
                    </a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php } else { ?>
    <p class="text-center text-danger">
        <span class="btn btn-sm btn-danger" style="border-radius:50%">
            <i class="fa fa-warning"></i>
        </span> There are no users yet.
    </p>
    <?php } ?>
</div>

<?php require_once ROOT ."/views/inc/adminFooter.php" ?>
