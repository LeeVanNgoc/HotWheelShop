<?php require_once ROOT ."/views/inc/adminHeader.php" ?>
<?php require_once ROOT ."/views/inc/sidebar.php" ?>

<div class="mt-4">
    <h1 class="text-center">Edit Brand Information</h1>
    <div class="card">
        <div class="card-header">
            <h6><?php echo $data['manufacture']->man_name ?></h6>
        </div>
        <div class="card-body">
            <form action="<?php echo URL?>/manufactures/update/<?php echo $data['manufacture']->man_id ?>" method="POST" enctype="multipart/form-data">
    
                <div class="row">
                    <!-- Các trường nhập liệu (8/12) -->
                    <div class="col-md-8">
                        <!-- Manufacture Name -->
                        <div class="form-group">
                            <input 
                                value="<?php echo $data['manufacture']->man_name ?>"
                                type="text" 
                                name="manufacture" 
                                placeholder="Enter manufacture name" 
                                class="form-control <?php echo isset($data['errMan']) ? 'is-invalid' : '' ?>"
                            >
                            <input type="hidden" name="man_id" value="<?php echo $data['manufacture']->man_id ?>">
                            <?php echo isset($data['errMan']) ? '<div class="invalid-feedback">'.$data['errMan'].'</div>' : '' ?>
                        </div>

                        <!-- Description -->
                        <div class="form-group mb-2">
                            <textarea 
                                name="description" 
                                placeholder="Enter description"
                                class="form-control <?php echo isset($data['errDes']) ? 'is-invalid' : '' ?>"
                            ><?php echo $data['manufacture']->description ?></textarea>
                            <?php echo isset($data['errDes']) ? '<div class="invalid-feedback">'.$data['errDes'].'</div>' : '' ?>
                        </div>

                        <!-- Brand -->
                        <div class="form-group">
                            <input 
                                value="<?php echo $data['manufacture']->brand ?>"
                                type="text" 
                                name="brand" 
                                placeholder="Enter brand name" 
                                class="form-control <?php echo isset($data['errBrand']) ? 'is-invalid' : '' ?>"
                            >
                            <?php echo isset($data['errBrand']) ? '<div class="invalid-feedback">'.$data['errBrand'].'</div>' : '' ?>
                        </div>
                    </div>

                    <!-- Phần ảnh (4/12) -->
                    <div class="col-md-4">
                        <div class="form-group text-center">
                            <?php if (!empty($data['manufacture']->image)): ?>
                                <div class="mt-2">
                                    <img src="<?php echo URL . '/public/uploads/manufactures/' . $data['manufacture']->image ?>" alt="Current Image" class="img-fluid" style="max-width: 200px; margin-bottom: 10px;">
                                </div>
                            <?php else: ?>
                                <div class="mt-2">
                                    <p>No image uploaded.</p>
                                </div>
                            <?php endif; ?>

                            <div class="custom-file text-center">
                                <input 
                                    type="file" 
                                    name="image" 
                                    class="form-control-file <?php echo isset($data['errImg']) ? 'is-invalid' : '' ?>" 
                                    id="image"
                                >
                                <?php echo isset($data['errImg']) ? '<div class="invalid-feedback">'.$data['errImg'].'</div>' : '' ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="form-group">
                    <input type="hidden" name="csrf" value="<?php new Csrf(); echo Csrf::get()?>">
                    <a href='<?php echo URL ?>/manufactures' class="btn btn-sm btn-secondary">
                        <i class="fa fa-arrow-left"></i> Go Back
                    </a>
                    <input type="submit" name='editManufacture' value='Edit' class="btn btn-success btn-sm">
                </div>

            </form>
        </div>
    </div>
</div>

<?php require_once ROOT ."/views/inc/adminFooter.php" ?>
