<?php require_once ROOT ."/views/inc/adminHeader.php" ?>
<?php require_once ROOT ."/views/inc/sidebar.php" ?>

<div class="mt-4">
    <h1 class="text-center">Brand Information</h1>
    <div class="card">
        <div class="card-header">
            <h6><?php echo $data['manufacture']->man_name ?></h6>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Cột thông tin (chiếm 8 phần) -->
                <div class="col-lg-8">
                    <ul class="list-unstyled">
                        <li>
                            <strong><i class="fa fa-tag"></i> Manufacture: </strong> <?php echo $data['manufacture']->man_name ?>
                        </li>
                        <li>
                            <strong><i class="fa fa-id-card"></i> ID: </strong> <?php echo $data['manufacture']->man_id ?>
                        </li>
                        <li>
                            <strong><i class="fa fa-list-alt"></i> Description: </strong> <?php echo $data['manufacture']->description ?>
                        </li>
                        <li>
                            <strong><i class="fa fa-lock"></i> Status: </strong> 
                            <?php echo $data['manufacture']->active == 1 
                                ? '<span class="badge badge-success">Active</span>' 
                                : '<span class="badge badge-danger">InActive</span>' ?>
                        </li>
                        <li>
                            <strong><i class="fa fa-user"></i> Creator: </strong> <?php echo $data['manufacture']->creator ?>
                        </li>
                        <li>
                            <strong><i class="fa fa-calendar"></i> Date: </strong> <?php echo $data['manufacture']->created_at ?>
                        </li>
                    </ul>
                </div>

                <!-- Cột hình ảnh (chiếm 4 phần) -->
                <div class="col-lg-4 text-center">
                    <div class="card-image p-3" style="border: 2px solid #ddd;">
                        <?php if (!empty($data['manufacture']->image)): ?>
                            <img src="<?php echo URL . '/public/uploads/manufactures/' . $data['manufacture']->image ?>" 
                                 alt="<?php echo $data['manufacture']->man_name ?>" 
                                 class="img-fluid" 
                                 style="width: 100%; height: 300px; background-color: #ffffff; object-fit: cover; border-radius: 8px;">
                        <?php else: ?>
                            <img src="<?php echo URL . '/public/uploads/Cutoe-pegy1733410574.jpg' ?>" 
                                 alt="Default Image" 
                                 class="img-fluid" 
                                 style="width: 100%; height: 300px; background-color: #ffffff; object-fit: cover; border-radius: 8px;">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a href='<?php echo URL ?>/manufactures' class="btn btn-sm btn-secondary mt-2">
        <i class="fa fa-arrow-left"></i>
        Go Back
    </a>
</div>


<?php require_once ROOT ."/views/inc/adminFooter.php" ?>
