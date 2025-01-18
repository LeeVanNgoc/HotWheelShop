<?php require_once ROOT ."/views/inc/header.php" ?>



<div class="my-4 mx-auto">
    <h3 class='text-center my-4'>Our Products</h3>
    <form action="<?php echo URL ?>/home/search" method='POST' class='d-md-none w-50 mx-auto'>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <button class="input-group-text"><i class="fa fa-search"></i></button>
            </div>
            <input type="text" name='search' class="form-control" placeholder='Search'>
        </div>
    </form>
    <?php require_once ROOT ."/views/inc/slider.php" ?>

    <div class="row">
        <!-- Sidebar (Categories, Brands, Price) -->
        <div class="col-lg-3 col-md-4 col-sm-12">
            <div class="sidebar">
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
        </div>

        <!-- Products -->
        <div class="col-lg-9 col-md-8 col-sm-12">
            <div class="product-list row">
                <?php 
                if($data['products']){
                    foreach ($data['products'] as $pro) {?>
                        <div class="col-lg-4 col-md-6 col-sm-12 my-2">
                            <div class="card position-relative">
                                <span class="badge badge-success position-absolute p-1 "><?php echo $pro->price?>$</span>
                                <img class="img-fluid" src="<?php echo URL ?>/uploads/<?php echo $pro->image ?>" alt="Card image cap">
                                <div class="card-body">
                                    <h6 class="card-title"><?php echo $pro->name ?></h6>
                                    <a href="<?php echo URL ?>/home/show/<?php echo $pro->product_id ?>" class="btn btn-info btn-sm py-1 float-left" >Details</a>
                                    <a href="<?php echo URL ?>/carts/add/<?php echo $pro->product_id ?>/<?php echo $pro->price ?>" class="btn btn-danger btn-sm py-1 float-right" ><i class="fa fa-shopping-cart"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php }
                } else { ?>
                    <p class="text-center text-danger">
                        <span class='btn btn-sm btn-danger' style='border-radius:50%'><i class="fa fa-warning"></i></span> There are no Products
                    </p>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<style>
.product-list .col-lg-4, .product-list .col-md-6, .product-list .col-sm-12 {
    display: flex;
    justify-content: center;
    align-items: stretch;
}

.card {
    display: flex;
    flex-direction: column;
    height: 100%;
    width: 100%; /* Đảm bảo chiều ngang của card luôn chiếm 100% */
    border: 1px solid #ddd; /* Optional: Thêm border để dễ nhìn */
}

.card img {
    object-fit: cover; /* Đảm bảo ảnh không bị biến dạng */
    height: 200px; /* Chiều cao cố định cho ảnh */
    width: 100%; /* Ảnh sẽ luôn rộng như container */
}

.card-body {
    flex-grow: 1; /* Đảm bảo body của card chiếm hết không gian còn lại */
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.card-title {
    font-size: 1rem; /* Điều chỉnh font-size cho vừa vặn */
    margin-bottom: 10px;
}

.btn {
    font-size: 13px;
    padding: 5px 10px;
    margin-top: 5px;
}

.product-list .row {
    display: flex;
    flex-wrap: wrap;
    gap: 15px; /* Khoảng cách giữa các item */
}

.product-list .col-lg-4, .product-list .col-md-6, .product-list .col-sm-12 {
    max-width: 100%; /* Đảm bảo không có phần tử nào vượt quá chiều rộng của container */
    flex-basis: 32%; /* Giới hạn chiều rộng cơ bản để các ô trong mỗi hàng có kích thước đều */
    box-sizing: border-box; /* Đảm bảo không bị thừa padding hoặc margin */
}

@media (max-width: 767px) {
    .product-list .col-sm-12 {
        flex-basis: 100%; /* Chiếm toàn bộ chiều rộng khi màn hình nhỏ */
    }
}


</style>

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
