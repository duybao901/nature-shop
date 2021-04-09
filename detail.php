<!DOCTYPE html>
<html lang="en">
<?php
ob_start();
session_start();
include_once("./connect.php");
$MSHH = isset($_GET["chitiet"]) ? $_GET["chitiet"] : "TC002";
$sql = "SELECT * FROM hanghoa WHERE MSHH='$MSHH'";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);

$maloaihang = $row['MaLoaiHang'];
$ct_sql = "SELECT TenLoaiHang FROM loaihanghoa WHERE MaLoaiHang='$maloaihang'";
$ct_query = mysqli_query($conn, $ct_sql);

$rl_query = "SELECT * FROM hanghoa WHERE MaLoaiHang='$maloaihang'";
$rl_query = mysqli_query($conn, $rl_query);

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/harvest.png">
    <title>Naturecircle - Chi tiết sản phẩm </title>
    <!-- Style Css -->

    <link rel="stylesheet" href="assets/styles/detail.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/styles/base.css?v=<?php echo time(); ?>">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- Google Fonts -->
    <!-- Fonts: Playfair Display -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Fonts: Oswald -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Slick -->
    <link rel="stylesheet" href="assets/styles/vendor/slick.css">

</head>

<body>
    <!-- Scrolltop button -->
    <a class='scroll-top-btn'>
        <i class="fa fa-angle-up" aria-hidden="true"></i>
    </a>

    <!-- Header -->
    <?php include_once("./header.php") ?>
    <!-- End Header -->

    <!-- Breadcrumb -->
    <div class="breadcrumb-area">
        <div class="breadcrumb__text">
            <h1>Cửa hàng</h1>
            <div class="breadcrumb__text-box">
                <a href="home.php">Trang chủ</a> <span>/</span>
                <a href="#" class="breadcrumb__text-link">Cửa hàng</a>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <!-- Product detail -->
    <div class="product-detail">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="product-detail__img">
                        <img src="assets/img/<?php echo $row["anh"] ?>" alt="">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="product-detail__wrapper">
                        <h2 class="product-detail__text-name">
                            <?php echo $row["TenHH"] ?>
                        </h2>
                        <div class="product-detail__rating">
                            <div class="product-detail__rating-icon">
                                <i class="fa fa-star-o color"></i>
                                <i class="fa fa-star-o color"></i>
                                <i class="fa fa-star-o color"></i>
                                <i class="fa fa-star-o "></i>
                                <i class="fa fa-star-o "></i>
                            </div>
                            <a href="#">(2 đánh giá của khách hàng)</a>
                        </div>
                        <p class='product-detail__price'> <?php echo number_format($row['Gia'], 0, ',', '.'); ?> đ
                            <?php
                            $gia = number_format($row['GiaCu'], 0, ',', '.');
                            if ($row['GiaCu']) {
                                echo "<span class='item__price-old'>$gia đ</span>";
                            } else {
                                echo "";
                            }
                            ?>
                        </p>
                        <div class="product-detail__indicator"></div>
                        <p class="product-detail__text">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa consequuntur perferendis animi
                            quos
                            tempore cum ab quibusdam impedit quasi consectetur placeat error delectus earum cumque nam
                            aliquam
                            iste, pariatur eaque.
                        </p>
                        <div class="product-detail__stock">
                            <div class="product-detail__stock-check">
                                <i class="fa fa-check" aria-hidden="true"></i>
                            </div>
                            <p class="product-detail__stock-text"><?php echo $row["SoLuongHang"] ?> TRONG KHO</p>
                        </div>
                        <div class="product-detail__control">
                            <!-- <form action="POST">                        
                               <input type="number" value="1" disabled> 
                            </form> 
                            -->
                            <a href="addcart.php?id_sp=<?php echo $row["MSHH"] ?>" class="my-btn-primary my-btn-primary--3" style="margin-right: 10px;">Đặt mua hàng</a>
                            <button class="my-btn-ver2 my-btn-ver2--1"><i class="fa fa-heart-o" aria-hidden="true"></i></button>
                            <button class="my-btn-ver2 my-btn-ver2--1"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                        </div>
                        <div class="product-detail__indicator"></div>
                        <div class="product-detail__category">
                            <div class="">
                                <span>Thể loại: </span>
                                <?php
                                while ($ct_row = mysqli_fetch_array($ct_query)) {

                                ?>
                                    <a href="#"><?php echo $ct_row["TenLoaiHang"] ?></a>,
                                <?php
                                }

                                ?>
                            </div>
                            <div class="product-detail__category-tag">
                                <span>Nhãn: </span>
                                <a href="#">
                                    <?php echo $row["MaLoaiHang"] ?>
                                </a>
                            </div>
                        </div>
                        <div class="product-detail__share">
                            <span>CHIA SẺ SẢN PHẨM NÀY: </span>
                            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-google" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End Product detail -->

    <!-- Preview -->
    <div class="preview">
        <div class="container">
            <div class="preview__tab">
                <a onclick="onpenReviewTab(event,'mo-ta')" class="preview__tab-btn" style="margin-right: 70px;" id="mota-click">Mô tả</a>
                <a onclick="onpenReviewTab(event,'danh-gia')" class="preview__tab-btn">Đánh giá (2)</a>
            </div>
            <div class="preview__content">
                <div class="preview__content-tab" id="mo-ta">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus laboriosam omnis quaerat!
                        Magnam tempora corrupti quo ratione rerum a expedita aperiam, fugit voluptatibus consectetur
                        quis accusamus, sit, molestias sapiente odio?
                        <br />
                        <br />
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eos, quo ea rem beatae neque incidunt
                        provident soluta odio. Maiores earum in perferendis officia ducimus, eveniet fugit inventore
                        ipsa repudiandae qui?Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita ex
                        ratione, odit harum praesentium nam natus impedit minus cupiditate quibusdam enim hic
                        consectetur ut, quod, maiores error id accusantium? Distinctio.
                    </p>
                </div>
                <div class="preview__content-tab" id="danh-gia">
                    <h3>2 lượt đánh giá</h3>
                    <div class="preview__wrap">
                        <div class="preview__single">
                            <img src="assets/img/s1mple.jpg" alt="" class="preview__single-logo">
                            <div class="preview__single-text">
                                <div class="text__rating">
                                    <i class="fa fa-star color" aria-hidden="true"></i>
                                    <i class="fa fa-star color" aria-hidden="true"></i>
                                    <i class="fa fa-star color" aria-hidden="true"></i>
                                    <i class="fa fa-star color" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                </div>
                                <div class="text__intro">
                                    <span>admin</span>
                                    – 23/3, 2018
                                </div>
                                <h4>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vero itaque, quo
                                    corrupti
                                    nam
                                    doloremque numquam. Accusantium harum ea in suscipit, similique dicta distinctio
                                    tempora
                                    provident rerum. Nisi soluta tenetur maxime.</h4>
                            </div>
                        </div>
                        <div class="preview__single">
                            <img src="assets/img/niko.jpg" alt="" class="preview__single-logo">
                            <div class="preview__single-text">
                                <div class="text__rating">
                                    <i class="fa fa-star color" aria-hidden="true"></i>
                                    <i class="fa fa-star color" aria-hidden="true"></i>
                                    <i class="fa fa-star color" aria-hidden="true"></i>
                                    <i class="fa fa-star color" aria-hidden="true"></i>
                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                </div>
                                <div class="text__intro">
                                    <span>admin</span>
                                    – 23/3, 2018
                                </div>
                                <h4>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vero itaque, quo
                                    corrupti
                                    nam
                                    doloremque numquam. Accusantium harum ea in suscipit, similique dicta distinctio
                                    tempora
                                    provident rerum. Nisi soluta tenetur maxime.</h4>
                            </div>
                        </div>
                    </div>
                    <form action="#" class="preview__form">
                        <h3>THÊM XẾP HẠNG CỦA BẠN</h3>
                        <div class="preview__form-rating">
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                        </div>
                        <div class="preview__form-group">
                            <label for="your-review">Bạn thấy sản phẩm thế nào</label>
                            <textarea name="review" id="your-review" cols="30" rows="10"></textarea>
                        </div>
                        <div class="preview__form-group">
                            <label for="name">Tên*</label>
                            <input type="text" name="name" id="name">
                        </div>
                        <div class="preview__form-group">
                            <label for="email">Email*</label>
                            <input type="email" name="email" id="email">
                        </div>
                        <button class="my-btn-primary my-btn-primary--2">Gửi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Preview -->

    <!-- Product Related-->
    <div class="related">
        <div class="container">
            <div class="related__heading">
                <img src="assets/img/title.png" alt="">
            </div>
            <h2 class="related__title">
                <span>Sản phẩm</span>
                liên quan
            </h2>
            <div class="related__product">
                <div class="related__product-slide">
                    <?php
                    while ($rl_rows = mysqli_fetch_array($rl_query)) {
                    ?>
                        <div class="slide__item">
                            <img src="assets/img/<?php echo $rl_rows["anh"] ?>" alt="" class="slide__item-img">
                            <div class="slide__item-rate">
                                <i class="fa fa-star-o color"></i>
                                <i class="fa fa-star-o color"></i>
                                <i class="fa fa-star-o color"></i>
                                <i class="fa fa-star-o "></i>
                                <i class="fa fa-star-o "></i>
                            </div>
                            <p class="slide__item-name">
                                <?php echo $rl_rows["TenHH"] ?>
                            </p>
                            <div class="slide__item-price">
                                <span class='slide__item-price-new'> <?php echo number_format($rl_rows["Gia"], 0, ',', '.'); ?> đ</span>
                                <?php
                                $gia = number_format($rl_rows['GiaCu'], 0, ',', '.');
                                if ($rl_rows['GiaCu']) {
                                    echo "<span class='slide__item-price-old'>$gia đ</span>";
                                } else {
                                    echo "";
                                }
                                ?>
                            </div>
                            <div class="slide__item-hover">
                                <a href="detail.php?chitiet=<?php echo $rl_rows["MSHH"] ?>" class="my-btn-primary my-btn-primary--2">Xem chi tiết</a>
                                <div class="slide__item-hover-control">
                                    <button><i class="fa fa-heart-o" aria-hidden="true"></i></button>
                                    <button><i class="fa fa-retweet" aria-hidden="true"></i></button>
                                    <a class="control__link" href="detail.php?chitiet=<?php echo $rl_rows["MSHH"] ?>" class="control__link"><i class="fa fa-search" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <button class="my-btn-ver2 related__prev-btn related__prev-btn-t"><i class="fa fa-angle-left" aria-hidden="true"></i></button>
                <button class="my-btn-ver2 related__next-btn related__next-btn-t"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
            </div>
        </div>
    </div>
    <!-- End Product Related-->

    <!-- Footer -->
    <div class="footer">
        <div class="container">
            <div class="footer__top">
                <div class="footer__header">
                    <h1>
                        Theo dõi bản tin.
                    </h1>
                    <p>
                        Nhận thông tin cập nhật qua e-mail về cửa hàng mới nhất của chúng tôi và các ưu đãi đặc biệt.
                    </p>
                    <form action="" class="header__form">
                        <input type="text" placeholder="Nhập địa chỉ email...">
                        <button class='my-btn-primary my-btn-primary--3'>Subscribe</button>
                    </form>
                    <div class="header__social">
                        <ul class="header__social-list">
                            <li>
                                <a href="#" class="my-btn-ver2 list__item-link"><i class="fa fa-facebook" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="my-btn-ver2 list__item-link"><i class="fa fa-twitter" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="my-btn-ver2 list__item-link"><i class="fa fa-instagram" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="my-btn-ver2 list__item-link"><i class="fa fa-youtube" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="my-btn-ver2 list__item-link"><i class="fa fa-google" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="my-btn-ver2 list__item-link"><i class="fa fa-linkedin" aria-hidden="true"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="footer__service">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="footer__service-single">
                                <img src="assets/img/rocket.png" alt="" style="width: 60px;">
                                <div class="single__text">
                                    <h2>Giao hàng miễn phí</h2>
                                    <p>Chúng tôi cung cấp dịch vụ giao hàng nội thành, chỉ 2h để giúp bạn có được
                                        trải nghiệm mua hàng tốt nhất.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="footer__service-single">
                                <img src="assets/img/money.png" alt="">
                                <div class="single__text">
                                    <h2>Giao dịch an toàn</h2>
                                    <p>Chúng tôi cung cấp dịch vụ giao dich an toàn chất lượng, đem lại cho khác hàng
                                        cảm giác an toàn tuyệt đối.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="footer__service-single">
                                <img src="assets/img/support.png" alt="">
                                <div class="single__text">
                                    <h2>Hỗ trợ trực tuyến</h2>
                                    <p>Chúng tôi cung cấp dịch vụ hỗ trợ trực tuyến 24/7, hỗ trợ khách hàng tuyệt đối.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer__widget">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="footer__widget-single">
                                <img src="assets/img/logo.png" alt="" class='single__logo'>
                                <p>
                                    Đừng bỏ lỡ hàng ngàn sản phẩm và chương trình siêu hấp dẫn từ chúng tôi.
                                </p>
                                <ul class="single__list">
                                    <li class="single__list-item">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        <span class="item__text">Address: Ninh kiều, Cần thơ.</span>
                                    </li>
                                    <li class="single__list-item">
                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                        <span class="item__text">Phone: (+84) 327139348</span>
                                    </li>
                                    <li class="single__list-item">
                                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                        <span class="item__text">Email: duyb1812257@gmail.com</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="footer__widget-single">
                                <h3 class='single__title'>Sản phẩm</h3>
                                <ul class="single__list">
                                    <li class="single__list-item">
                                        <a class="item__text" href="#">Giảm giá</a>
                                    </li>
                                    <li class="single__list-item">
                                        <a class="item__text" href="#">Mua nhiều</a>
                                    </li>
                                    <li class="single__list-item">
                                        <a class="item__text" href="#">Bán chạy</a>
                                    </li>
                                    <li class="single__list-item">
                                        <a class="item__text" href="#">Hàng bán tôt nhât</a>
                                    </li>
                                    <li class="single__list-item">
                                        <a class="item__text" href="#">Đăng ký</a>
                                    </li>
                                    <li class="single__list-item">
                                        <a class="item__text" href="#">Tài khoản của tôi</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="footer__widget-single">
                                <h3 class='single__title'>Công ty của chúng tôi</h3>
                                <ul class="single__list">
                                    <li class="single__list-item">
                                        <a class="item__text" href="#">Vận chuyển</a>
                                    </li>
                                    <li class="single__list-item">
                                        <a class="item__text" href="#">Thông báo pháp lý</a>
                                    </li>
                                    <li class="single__list-item">
                                        <a class="item__text" href="#">Thanh toán an toàn</a>
                                    </li>
                                    <li class="single__list-item">
                                        <a class="item__text" href="#">Liên hệ chúng tôi</a>
                                    </li>
                                    <li class="single__list-item">
                                        <a class="item__text" href="#">Cửa hàng</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="footer__widget-single">
                                <h3 class='single__title'>Instagram</h3>
                                <ul class="single__list single__list-instragram">
                                    <li class="single__list-item">
                                        <a href="#">
                                            <img src="assets/img/1 (5).jpg" alt="">
                                        </a>
                                    </li>
                                    <li class="single__list-item">
                                        <a href="#">
                                            <img src="assets/img/1 (4).jpg" alt="">
                                        </a>
                                    </li>
                                    <li class="single__list-item">
                                        <a href="#">
                                            <img src="assets/img/2 (2).jpg" alt="">
                                        </a>
                                    </li>
                                    <li class="single__list-item">
                                        <a href="#">
                                            <img src="assets/img/3 (3).jpg" alt="">
                                        </a>
                                    </li>
                                    <li class="single__list-item">
                                        <a href="#">
                                            <img src="assets/img/6 (2).jpg" alt="">
                                        </a>
                                    </li>
                                    <li class="single__list-item">
                                        <a href="#">
                                            <img src="assets/img/4 (1).jpg" alt="">
                                        </a>
                                    </li>
                                    <li class="single__list-item">
                                        <a href="#">
                                            <img src="assets/img/7 (2).jpg" alt="">
                                        </a>
                                    </li>
                                    <li class="single__list-item">
                                        <a href="#">
                                            <img src="assets/img/2 (3).jpg" alt="">
                                        </a>
                                    </li>
                                </ul>
                                <a href="" class="single__item-link">
                                    Theo dõi instagram của chúng tôi
                                    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="footer__bottom">
        <div class="container">
            <p>Copyright © Naturecircle. Đã đăng ký Bản quyền</p>
            <img src="assets/img/payment.png" alt="">
        </div>
    </div>
    <!-- End Footer -->


</body>
<!-- Jquery -->
<script src="assets/script/vendor/jquery.min.js"></script>
<script src="assets/script/vendor/jquery.migrate.min.js"></script>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script src="assets/script/vendor/slick.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<!-- Gsap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.0/gsap.min.js"></script>
<!-- Main script -->
<script src="assets/script/detail.js"></script>

</html>