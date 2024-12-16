
<?php require_once ROOT ."/views/inc/header.php" ?>
<div class="  my-4 mx-auto">
    <?php require_once ROOT ."/views/inc/slider.php" ?>
        <h3 class='text-center my-4'><?php echo $data['title1'] ?> Prouducts</h3>
        <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3">
        <h5>Categories</h5>
                <ul class="list-unstyled" id="category-list">
                <?php 
                if($data['categories']){
                    $count = 0;
                    foreach ($data['categories'] as $cat) {
                        $count++;
                        $hiddenClass = $count > 3 ? 'd-none more-categories' : '';
                        ?>
                        <li class="<?php echo $hiddenClass; ?>">
                            <a href="<?php echo URL ?>/home/getProByCat/<?php echo $cat->cat_id ?>"><?php echo $cat->cat_name ?></a>
                        </li>
                    <?php }
                } else { ?>
                    <p class="text-center text-danger">
                        <span class='btn btn-sm btn-danger' style='border-radius:50%'>
                            <i class="fa fa-warning"></i>
                        </span> There is no categories
                    </p>
                <?php } ?>
                </ul>
                <?php if(count($data['categories']) > 3): ?>
                    <button class="btn btn-link p-0" id="toggle-categories">Show More</button>
                <?php endif; ?>
            <hr class='bg-dark'>
            <h5>Brands</h5>
                <ul class="list-unstyled" id="brand-list">
                <?php 
                if($data['manufactures']){
                    $count = 0;
                    foreach ($data['manufactures'] as $man) {
                        $count++;
                        $hiddenClass = $count > 3 ? 'd-none more-brands' : '';
                        ?>
                        <li class="<?php echo $hiddenClass; ?>">
                            <a href="<?php echo URL ?>/home/getProByMan/<?php echo $man->man_id ?>"><?php echo $man->man_name ?></a>
                        </li>
                    <?php }
                } else { ?>
                    <p class="text-center text-danger">
                        <span class='btn btn-sm btn-danger' style='border-radius:50%'>
                            <i class="fa fa-warning"></i>
                        </span> There is no Brands
                    </p>
                <?php } ?>
                </ul>
                <?php if(count($data['manufactures']) > 3): ?>
                    <button class="btn btn-link p-0" id="toggle-brands">Show More</button>
                <?php endif; ?>
            <hr class='bg-dark'>
                <h5>Price Ranges</h5>
                <ul class="list-unstyled">
                    <?php foreach ($data['price_ranges'] as $range): ?>
                        <li>
                            <a href="<?php echo URL ?>/home/filterByPrice/<?php echo $range['min'] ?>/<?php echo $range['max'] ?>">
                                <?php echo $range['label']; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <hr class='bg-dark'>
            </div>
            
            <?php 
                if($data['products']){

                foreach ($data['products'] as $pro) {?>
                    <div class="col-lg-3 col-md-4 col-sm-4 my-2">
                        <div class="card position-relative" >
                            <span class="badge badge-success position-absolute p-1 "><?php echo $pro->price?>$</span>
                            <img style='height:200px' class="img-fluid" src="<?php echo URL ?>/uploads/<?php echo $pro->image ?>" alt="Card image cap">
                            <div class="card-body">
                                <h6 class="card-title"><?php echo $pro->name ?></h6>
                                <a href="<?php echo URL ?>/home/show/<?php echo $pro->product_id ?>" class="btn btn-info btn-sm py-1 float-left" style="font-size:13px">Details</a>
                                <a href="<?php echo URL ?>/carts/add/<?php echo $pro->product_id ?>/<?php echo $pro->price ?>" class="btn btn-danger btn-sm py-1 float-right" style="font-size:13px"><i class="fa fa-shopping-cart"></i></a>
                            </div>
                        </div>
                    </div>
                <?php }
                }else {?>
                    <p class="text-center text-danger"><span class='btn btn-sm btn-danger' style='border-radius:50%'><i class="fa fa-warning"></i></span> There is no any products under this category</p>
                <?php  }
             ?>
        </div>
    </div>
    <script>
document.addEventListener('DOMContentLoaded', function () {
    const toggleCategoriesBtn = document.getElementById('toggle-categories');
    const toggleBrandsBtn = document.getElementById('toggle-brands');

    if (toggleCategoriesBtn) {
        toggleCategoriesBtn.addEventListener('click', function () {
            const categories = document.querySelectorAll('.more-categories');
            categories.forEach(cat => cat.classList.toggle('d-none'));
            this.textContent = this.textContent === 'Show More' ? 'Show Less' : 'Show More';
        });
    }

    if (toggleBrandsBtn) {
        toggleBrandsBtn.addEventListener('click', function () {
            const brands = document.querySelectorAll('.more-brands');
            brands.forEach(brand => brand.classList.toggle('d-none'));
            this.textContent = this.textContent === 'Show More' ? 'Show Less' : 'Show More';
        });
    }
});


</script>
<?php require_once ROOT ."/views/inc/footer.php" ?>