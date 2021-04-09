<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/harvest.png">
    <title>Naturecircle - Cửa hàng</title>
    <!-- Style Css -->
    <!-- <link rel="stylesheet" href="assets/styles/home.css"> -->
    <link rel="stylesheet" href="assets/styles/home.css?v=<?php echo time(); ?>">
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
<?php
ob_start();
session_start();
include_once("./connect.php");

$islogout = isset($_GET['user_logout']) ? isset($_GET['user_logout']) : false;
if ($islogout) {
    unset($_SESSION['user_email']);
    unset($_SESSION['islogin']);
    unset($_SESSION['MSKH']);
    unset($_SESSION['carts']);
    header("Location: home.php");
}


?>

<body>
    <!-- Scrolltop  button-->
    <a class='scroll-top-btn'>
        <i class="fa fa-angle-up" aria-hidden="true"></i>
    </a>

    <!-- Header -->
    <?php include_once("./header.php") ?>
    <!-- End Header -->

    <!-- Slide -->
    <div class="slides">
        <div class="slide">
            <div class="slide__item">
                <div class="slide__item-content slide__item-content--1">
                    <h2>Quy Trình Lạnh Hữu Cơ</h2>
                    <h1>Quả Tươi Ngon</h1>
                    <p class="slide__item-detail">
                        Naturecircle ra đời với sứ mệnh trở thành nhà cung cấp các sản phầm tự nhiên
                        an toàn, tư vấn và định hướng lối sống lành mạnh, hướng tới một cộng đồng có cuộc
                        sống khỏe mạnh toàn diện và hạnh phúc
                    </p>
                    <a href="" class="my-btn-primary my-btn-primary--2">Shop now</a>
                </div>
                <div class="slide__item-img slide__item-img-1">
                    <img src="assets/img/2.jpg" alt="">
                </div>
            </div>
            <div class="slide__item">
                <div class="slide__item-content slide__item-content--2">
                    <h2>Sale 30% Rau Củ Quả Tươi Ngon</h2>
                    <h1>Trái Cây Sạch <br> An Toàn</h1>
                    <p class="slide__item-detail">
                        Chúng tôi tự hào là đơn vị cung cấp thực phẩm sạch hàng đầu tại Việt Nam.
                        Với kinh nghiệm nhiều năm phục
                        vụ các khách hàng khó tính nhất, chúng tôi đã có những chính sách riêng biệt giúp hai bên
                        đi đến tiếng nói chung trong vấn đề cung cấp hàng hóa.
                    </p>
                    <a href="" class="my-btn-primary my-btn-primary--2">Shop now</a>
                </div>
                <div class="slide__item-img slide__item-img-2">
                    <img src="assets/img/10.jpg" alt="">
                </div>
            </div>
        </div>
        <button class="my-btn-ver2 slides__prev-btn"><i class="fa fa-angle-left" aria-hidden="true"></i></button>
        <button class="my-btn-ver2 slides__next-btn"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
    </div>
    <!-- End Slide -->

    <!-- Food Category -->
    <div class="food-cg">
        <div class="container">
            <img src="assets/img/text.png" alt="" class="food-cg__img">
            <p class="food-cg__detail">Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita, veniam.
                Suscipit mollitia, provident
                doloremque vel voluptatem, magnam sit labore, dolore sunt voluptatum dolor quidem! Tempore atque velit
                dicta laborum hic.</p>
            <div class="food-cg__slide-wrapper">
                <div class="slide-wrapper__slide">
                    <a href="#" class="slide__item">
                        <img src="assets/img/burger.png" alt="" class='slide__item-icon'>
                        <img src="assets/img/border.png" alt="" class='slide__item-border'>
                        <p>Burger</p>
                        <span>
                            (12 mặt hàng)
                        </span>
                    </a>
                    <a href="#" class="slide__item">
                        <img src="assets/img/fruit.png" class='slide__item-icon'>
                        <img src="assets/img/border.png" alt="" class='slide__item-border'>
                        <p>Trái cây</p>
                        <span>
                            (12 mặt hàng)
                        </span>
                    </a>
                    <a href="#" class="slide__item">
                        <img src="assets/img/tea.png" alt="" class='slide__item-icon'>
                        <img src="assets/img/border.png" alt="" class='slide__item-border'>
                        <p>Trà</p>
                        <span>
                            (12 mặt hàng)
                        </span>
                    </a>
                    <a href="#" class="slide__item">
                        <img src="assets/img/vegetable.png" alt="" class='slide__item-icon'>
                        <img src="assets/img/border.png" alt="" class='slide__item-border'>
                        <p>Rau</p>
                        <span>
                            (27 mặt hàng)
                        </span>
                    </a>
                    <a href="#" class="slide__item">
                        <img src="assets/img/drinks.png" class='slide__item-icon'>
                        <img src=" assets/img/border.png" alt="" class='slide__item-border'>
                        <p>Nước ép</p>
                        <span>
                            (12 mặt hàng)
                        </span>
                    </a>
                    <a href="#" class="slide__item">
                        <img src="assets/img/burger.png" alt="" class='slide__item-icon'>
                        <img src="assets/img/border.png" alt="" class='slide__item-border'>
                        <p>Burger</p>
                        <span>
                            (12 mặt hàng)
                        </span>
                    </a>
                    <a href="#" class="slide__item">
                        <img src="assets/img/fruit.png" class='slide__item-icon'>
                        <img src="assets/img/border.png" alt="" class='slide__item-border'>
                        <p>Trái cây</p>
                        <span>
                            (12 mặt hàng)
                        </span>
                    </a>
                    <a href="#" class="slide__item">
                        <img src="assets/img/tea.png" alt="" class='slide__item-icon'>
                        <img src="assets/img/border.png" alt="" class='slide__item-border'>
                        <p>Trà</p>
                        <span>
                            (12 mặt hàng)
                        </span>
                    </a>
                    <a href="#" class="slide__item">
                        <img src="assets/img/vegetable.png" alt="" class='slide__item-icon'>
                        <img src="assets/img/border.png" alt="" class='slide__item-border'>
                        <p>Rau</p>
                        <span>
                            (27 mặt hàng)
                        </span>
                    </a>
                    <a href="#" class="slide__item">
                        <img src="assets/img/drinks.png" class='slide__item-icon'>
                        <img src=" assets/img/border.png" alt="" class='slide__item-border'>
                        <p>Nước ép</p>
                        <span>
                            (12 mặt hàng)
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Food Category -->

    <!-- Our Products -->
    <div class="products">
        <div class="container">
            <div class="products_heading">
                <img src="assets/img/title.png" alt="">
            </div>
            <h2 class="products__title">
                <span>Sản phẩm</span>
                đang bán
            </h2>
            <div class="products__container">
                <div class="products__tab">
                    <div>
                        <button href="#" class="products__tab-link products__tab-link--active" onclick="openTab(event,'content__trai-cay')" id='traicay'>Trái
                            cây</button>
                        <button href="#" class="products__tab-link" onclick="openTab(event,'content__rau') " id='rau'>Rau</button>
                    </div>
                    <div>
                        <button href="#" class="products__tab-link" onclick="openTab(event,'content__nuoc-ep')" id='nuocep'>Nước
                            ép</button>
                        <button href="#" class="products__tab-link" onclick="openTab(event,'content__tra')" id='tra'>Trà</button>
                    </div>
                </div>
                <div class="products__tab-content">
                    <div class="slide-wrapper" id="content__trai-cay">
                        <div class="content__slide content__slide-traicay">
                            <?php
                            $sql = "SELECT * FROM hanghoa WHERE MaLoaiHang='TC' ORDER BY MSHH LIMIT 8";
                            $query = mysqli_query($conn, $sql);
                            while ($rows = mysqli_fetch_array($query)) {
                            ?>
                                <div class="content__slide-item">
                                    <img src="<?php echo $rows['anh'] ?>" alt="" class="item__img">
                                    <div class="item__rate">
                                        <i class="fa fa-star-o color"></i>
                                        <i class="fa fa-star-o color"></i>
                                        <i class="fa fa-star-o color"></i>
                                        <i class="fa fa-star-o "></i>
                                        <i class="fa fa-star-o "></i>
                                    </div>

                                    <p class="item__name">
                                        <?php echo $rows['TenHH'];
                                        ?>
                                    </p>
                                    <div class="item__price">
                                        <span class='item__price-new'><?php echo number_format($rows['Gia'], 0, ',', '.'); ?>đ</span>
                                        <?php
                                        $gia = number_format($rows['GiaCu'], 0, ',', '.');
                                        if ($rows['GiaCu']) {
                                            echo "<span class='item__price-old'>$gia đ</span>";
                                        } else {
                                            echo "";
                                        }
                                        ?>
                                    </div>
                                    <div class="item__hover">
                                        <a href="detail.php?chitiet=<?php echo $rows["MSHH"] ?>" class="my-btn-primary my-btn-primary--2">Xem Chi Tiết</a>
                                        <div class="item__hover-control">
                                            <button><i class="fa fa-heart-o" aria-hidden="true"></i></button>
                                            <button><i class="fa fa-retweet" aria-hidden="true"></i></button>
                                            <a href="detail.php?chitiet=<?php echo $rows["MSHH"] ?>" class="control__link"><i class="fa fa-search" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <button class="my-btn-ver2 content__prev-btn content__prev-btn-t"><i class="fa fa-angle-left" aria-hidden="true"></i></button>
                        <button class="my-btn-ver2 content__next-btn content__next-btn-t"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
                    </div>
                    <div class="slide-wrapper" id="content__rau">
                        <div class="content__slide content__slide-rau">
                            <?php
                            $sql = "SELECT * FROM hanghoa WHERE MaLoaiHang='R' ORDER BY MSHH LIMIT 8";
                            $query = mysqli_query($conn, $sql);
                            while ($rows = mysqli_fetch_array($query)) {
                            ?>
                                <div class="content__slide-item">
                                    <img src="<?php echo $rows['anh'] ?>" alt="" class="item__img">
                                    <div class="item__rate">
                                        <i class="fa fa-star-o color"></i>
                                        <i class="fa fa-star-o color"></i>
                                        <i class="fa fa-star-o color"></i>
                                        <i class="fa fa-star-o "></i>
                                        <i class="fa fa-star-o "></i>
                                    </div>
                                    <p class="item__name">
                                        <?php echo $rows['TenHH'] ?>
                                    </p>
                                    <div class="item__price">
                                        <span class='item__price-new'><?php echo number_format($rows['Gia'], 0, ',', '.'); ?>đ</span>
                                        <?php
                                        $gia = number_format($rows['GiaCu'], 0, ',', '.');
                                        if ($rows['GiaCu']) {
                                            echo "<span class='item__price-old'>$gia đ</span>";
                                        } else {
                                            echo "";
                                        }
                                        ?>
                                    </div>
                                    <div class="item__hover">
                                        <a href="detail.php?chitiet=<?php echo $rows["MSHH"] ?>" class="my-btn-primary my-btn-primary--2">Xem Chi Tiết</a>
                                        <div class="item__hover-control">
                                            <button><i class="fa fa-heart-o" aria-hidden="true"></i></button>
                                            <button><i class="fa fa-retweet" aria-hidden="true"></i></button>
                                            <a href="detail.php?chitiet=<?php echo $rows["MSHH"] ?>" class="control__link"><i class="fa fa-search" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <button class="my-btn-ver2 content__prev-btn content__prev-btn-rau"><i class="fa fa-angle-left" aria-hidden="true"></i></button>
                        <button class="my-btn-ver2 content__next-btn content__next-btn-rau"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
                    </div>
                    <div class="slide-wrapper" id="content__nuoc-ep">
                        <div class="content__slide content__slide-nuocep">
                            <?php
                            $sql = "SELECT * FROM hanghoa WHERE MaLoaiHang='NE' ORDER BY MSHH";
                            $query = mysqli_query($conn, $sql);
                            while ($rows = mysqli_fetch_array($query)) {
                            ?>
                                <div class="content__slide-item">
                                    <img src="<?php echo $rows['anh'] ?>" alt="" class="item__img">
                                    <div class="item__rate">
                                        <i class="fa fa-star-o color"></i>
                                        <i class="fa fa-star-o color"></i>
                                        <i class="fa fa-star-o color"></i>
                                        <i class="fa fa-star-o "></i>
                                        <i class="fa fa-star-o "></i>
                                    </div>
                                    <p class="item__name">
                                        <?php echo $rows['TenHH'] ?>
                                    </p>
                                    <div class="item__price">
                                        <span class='item__price-new'><?php echo number_format($rows['Gia'], 0, ',', '.'); ?>đ</span>
                                        <?php
                                        $gia = number_format($rows['GiaCu'], 0, ',', '.');
                                        if ($rows['GiaCu']) {
                                            echo "<span class='item__price-old'>$gia đ</span>";
                                        } else {
                                            echo "";
                                        }
                                        ?>
                                    </div>
                                    <div class="item__hover">
                                        <a href="detail.php?chitiet=<?php echo $rows["MSHH"] ?>" class="my-btn-primary my-btn-primary--2">Xem Chi Tiết</a>
                                        <div class="item__hover-control">
                                            <button><i class="fa fa-heart-o" aria-hidden="true"></i></button>
                                            <button><i class="fa fa-retweet" aria-hidden="true"></i></button>
                                            <a href="detail.php?chitiet=<?php echo $rows["MSHH"] ?>" class="control__link"><i class="fa fa-search" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <button class="my-btn-ver2 content__prev-btn content__prev-btn-nuocep"><i class="fa fa-angle-left" aria-hidden="true"></i></button>
                        <button class="my-btn-ver2 content__next-btn content__next-btn-nuocep"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
                    </div>
                    <div class="slide-wrapper" id="content__tra">
                        <div class="content__slide content__slide-tra">
                            <?php
                            $sql = "SELECT * FROM hanghoa WHERE MaLoaiHang='T' ORDER BY MSHH";
                            $query = mysqli_query($conn, $sql);
                            while ($rows = mysqli_fetch_array($query)) {
                            ?>
                                <div class="content__slide-item">
                                    <img src="<?php echo $rows['anh'] ?>" alt="" class="item__img">
                                    <div class="item__rate">
                                        <i class="fa fa-star-o color"></i>
                                        <i class="fa fa-star-o color"></i>
                                        <i class="fa fa-star-o color"></i>
                                        <i class="fa fa-star-o "></i>
                                        <i class="fa fa-star-o "></i>
                                    </div>
                                    <p class="item__name">
                                        <?php echo $rows['TenHH'] ?>
                                    </p>
                                    <div class="item__price">
                                        <span class='item__price-new'><?php echo number_format($rows['Gia'], 0, ',', '.'); ?>đ</span>
                                        <?php
                                        $gia = number_format($rows['GiaCu'], 0, ',', '.');
                                        if ($rows['GiaCu']) {
                                            echo "<span class='item__price-old'>$gia đ</span>";
                                        } else {
                                            echo "";
                                        }
                                        ?>
                                    </div>
                                    <div class="item__hover">
                                        <a href="detail.php?chitiet=<?php echo $rows["MSHH"] ?>" class="my-btn-primary my-btn-primary--2">Xem Chi Tiết</a>
                                        <div class="item__hover-control">
                                            <button><i class="fa fa-heart-o" aria-hidden="true"></i></button>
                                            <button><i class="fa fa-retweet" aria-hidden="true"></i></button>
                                            <a href="detail.php?chitiet=<?php echo $rows["MSHH"] ?>" class="control__link"><i class="fa fa-search" aria-hidden="true"></i></a>

                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <button class="my-btn-ver2 content__prev-btn content__prev-btn-tra"><i class="fa fa-angle-left" aria-hidden="true"></i></button>
                        <button class="my-btn-ver2 content__next-btn content__next-btn-tra"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Our Products -->

    <!-- Savon -->
    <div class="savon">
        <div class="container">
            <div class="savon__content">
                <div class="savon__content-text">
                    <h3>Quy trình lạnh <span>hữu cơ</span></h3>
                    <h1>SAVON HỮU CƠ </h1>
                    <h2>
                        <img src="assets/img/mark.png" alt="">
                        <span>BUY 1 GET 1 FREE</span>
                    </h2>
                    <p>
                        Các loại hộp trái cây nhập khẩu có sẵn sang trọng và đảm bảo chất lượng, phù hợp với mọi nhu
                        cầu.Ngoài ra, Naturecircle sẽ là nhịp cầu đưa các sản phẩm trái cây ngoại nhập với chất lượng
                        cao, đảm bảo an toàn vệ sinh
                        thực phẩm đến tay người tiêu dùng.
                    </p>
                    <button class="my-btn-primary my-btn-primary--2">Shop Now</button>
                </div>
                <div class="savon__content-img">
                    <img src="assets/img/1 (2).jpg" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- End Savon -->

    <!-- Feature -->
    <div class="feature">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-4 feature__box feature__newarrivals">
                    <h2>Hàng mới về</h2>
                    <div class="feature__button-group">
                        <button class="my-btn-ver2 feature__new-arrivals-btn feature__new-arrivals-prev-btn"><i class="fa fa-angle-left" aria-hidden="true"></i></button>
                        <button class="my-btn-ver2 feature__new-arrivals-btn feature__new-arrivals-next-btn"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
                    </div>
                    <div class="feature__slide newarrivals__wrapper">
                        <div class="feature__slide-slide newarrivals__wrapper-slide">
                            <div class="slide__item-wrapper">
                                <?php
                                $sql = "SELECT * FROM hanghoa WHERE type='1' LIMIT 4";
                                $query = mysqli_query($conn, $sql);
                                while ($rows = mysqli_fetch_array($query)) {
                                ?>
                                    <div class="slide__item">
                                        <a href="detail.php?chitiet?=<?php echo $rows["MSHH"] ?>">
                                            <img src="<?php echo $rows["anh"] ?>" alt="" class='slide__item-img'>
                                        </a>
                                        <div class="slide__item-info">
                                            <div class="slide__item-rate">
                                                <i class="fa fa-star-o color"></i>
                                                <i class="fa fa-star-o color"></i>
                                                <i class="fa fa-star-o color"></i>
                                                <i class="fa fa-star-o "></i>
                                                <i class="fa fa-star-o "></i>
                                            </div>
                                            <a href="detail.php?chitiet=<?php echo $rows["MSHH"] ?>" class="slide__item-name"><?php echo $rows["TenHH"] ?></a>
                                            <h3 class="slide__item-price">
                                                <?php echo number_format($rows['Gia'], 0, ',', '.'); ?> đ
                                                <?php
                                                $gia = number_format($rows['GiaCu'], 0, ',', '.');
                                                if ($rows['GiaCu']) {
                                                    echo "<span class='item__price-old'>$gia đ</span>";
                                                } else {
                                                    echo "";
                                                }
                                                ?>
                                            </h3>
                                        </div>
                                        <a href="addcart.php?id_sp=<?php echo $rows["MSHH"] ?>" class="slide__item-addtocart">
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="slide__item-wrapper">
                                <?php
                                $sql = "SELECT * FROM hanghoa WHERE type='1' LIMIT 4 OFFSET 4";
                                $query = mysqli_query($conn, $sql);
                                while ($rows = mysqli_fetch_array($query)) {
                                ?>
                                    <div class="slide__item">
                                        <a href="detail.php?chitiet?=<?php echo $rows["MSHH"] ?>">
                                            <img src="<?php echo $rows["anh"] ?>" alt="" class='slide__item-img'>
                                        </a>
                                        <div class="slide__item-info">
                                            <div class="slide__item-rate">
                                                <i class="fa fa-star-o color"></i>
                                                <i class="fa fa-star-o color"></i>
                                                <i class="fa fa-star-o color"></i>
                                                <i class="fa fa-star-o "></i>
                                                <i class="fa fa-star-o "></i>
                                            </div>
                                            <a href="detail.php?chitiet=<?php echo $rows["MSHH"] ?>" class="slide__item-name"><?php echo $rows["TenHH"] ?></a>
                                            <h3 class="slide__item-price">
                                                <?php echo number_format($rows['Gia'], 0, ',', '.'); ?> đ
                                                <?php
                                                $gia = number_format($rows['GiaCu'], 0, ',', '.');
                                                if ($rows['GiaCu']) {
                                                    echo "<span class='item__price-old'>$gia đ</span>";
                                                } else {
                                                    echo "";
                                                }
                                                ?>
                                            </h3>
                                        </div>
                                        <a href="addcart.php?id_sp=<?php echo $rows["MSHH"] ?>" class="slide__item-addtocart">
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 feature__box feature__bestseller">
                    <h2>Hàng bán chạy</h2>
                    <div class="feature__button-group">
                        <button class="my-btn-ver2 feature__bestseller-btn feature__bestseller-prev-btn"><i class="fa fa-angle-left" aria-hidden="true"></i></button>
                        <button class="my-btn-ver2 feature__bestseller-btn feature__bestseller-next-btn"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
                    </div>
                    <div class="feature__slide bestseller__wrapper">
                        <div class="feature__slide-slide bestseller__wrapper-slide">
                            <div class="slide__item-wrapper">
                                <?php
                                $sql = "SELECT * FROM hanghoa WHERE type='2' LIMIT 4";
                                $query = mysqli_query($conn, $sql);
                                while ($rows = mysqli_fetch_array($query)) {
                                ?>
                                    <div class="slide__item">
                                        <a href="detail.php?chitiet?=<?php echo $rows["MSHH"] ?>">
                                            <img src="<?php echo $rows["anh"] ?>" alt="" class='slide__item-img'>
                                        </a>
                                        <div class="slide__item-info">
                                            <div class="slide__item-rate">
                                                <i class="fa fa-star-o color"></i>
                                                <i class="fa fa-star-o color"></i>
                                                <i class="fa fa-star-o color"></i>
                                                <i class="fa fa-star-o "></i>
                                                <i class="fa fa-star-o "></i>
                                            </div>
                                            <a href="detail.php?chitiet=<?php echo $rows["MSHH"] ?>" class="slide__item-name"><?php echo $rows["TenHH"] ?></a>
                                            <h3 class="slide__item-price">
                                                <?php echo number_format($rows['Gia'], 0, ',', '.'); ?> đ
                                                <?php
                                                $gia = number_format($rows['GiaCu'], 0, ',', '.');
                                                if ($rows['GiaCu']) {
                                                    echo "<span class='item__price-old'>$gia đ</span>";
                                                } else {
                                                    echo "";
                                                }
                                                ?>
                                            </h3>
                                        </div>
                                        <a href="addcart.php?id_sp=<?php echo $rows["MSHH"] ?>" class="slide__item-addtocart">
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="slide__item-wrapper">
                                <?php
                                $sql = "SELECT * FROM hanghoa WHERE type='2' LIMIT 4 OFFSET 2";
                                $query = mysqli_query($conn, $sql);
                                while ($rows = mysqli_fetch_array($query)) {
                                ?>
                                    <div class="slide__item">
                                        <a href="detail.php?chitiet?=<?php echo $rows["MSHH"] ?>">
                                            <img src="<?php echo $rows["anh"] ?>" alt="" class='slide__item-img'>
                                        </a>
                                        <div class="slide__item-info">
                                            <div class="slide__item-rate">
                                                <i class="fa fa-star-o color"></i>
                                                <i class="fa fa-star-o color"></i>
                                                <i class="fa fa-star-o color"></i>
                                                <i class="fa fa-star-o "></i>
                                                <i class="fa fa-star-o "></i>
                                            </div>
                                            <a href="detail.php?chitiet=<?php echo $rows["MSHH"] ?>" class="slide__item-name"><?php echo $rows["TenHH"] ?></a>
                                            <h3 class="slide__item-price">
                                                <?php echo number_format($rows['Gia'], 0, ',', '.'); ?> đ
                                                <?php
                                                $gia = number_format($rows['GiaCu'], 0, ',', '.');
                                                if ($rows['GiaCu']) {
                                                    echo "<span class='item__price-old'>$gia đ</span>";
                                                } else {
                                                    echo "";
                                                }
                                                ?>
                                            </h3>
                                        </div>
                                        <a href="addcart.php?id_sp=<?php echo $rows["MSHH"] ?>" class="slide__item-addtocart">
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 feature__box feature__mostviewer">
                    <h2>Hàng xem nhiều</h2>
                    <div class="feature__button-group">
                        <button class="my-btn-ver2 feature__mostviewer-btn feature__mostviewer-prev-btn"><i class="fa fa-angle-left" aria-hidden="true"></i></button>
                        <button class="my-btn-ver2 feature__mostviewer-btn feature__mostviewer-next-btn"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
                    </div>
                    <div class="feature__slide mostviewer__wrapper">
                        <div class="feature__slide-slide mostviewer__wrapper-slide">
                            <div class="slide__item-wrapper">
                                <?php
                                $sql = "SELECT * FROM hanghoa WHERE type='3' LIMIT 4";
                                $query = mysqli_query($conn, $sql);
                                while ($rows = mysqli_fetch_array($query)) {
                                ?>
                                    <div class="slide__item">
                                        <a href="detail.php?chitiet?=<?php echo $rows["MSHH"] ?>">
                                            <img src="<?php echo $rows["anh"] ?>" alt="" class='slide__item-img'>
                                        </a>
                                        <div class="slide__item-info">
                                            <div class="slide__item-rate">
                                                <i class="fa fa-star-o color"></i>
                                                <i class="fa fa-star-o color"></i>
                                                <i class="fa fa-star-o color"></i>
                                                <i class="fa fa-star-o "></i>
                                                <i class="fa fa-star-o "></i>
                                            </div>
                                            <a href="detail.php?chitiet=<?php echo $rows["MSHH"] ?>" class="slide__item-name"><?php echo $rows["TenHH"] ?></a>
                                            <h3 class="slide__item-price">
                                                <?php echo number_format($rows['Gia'], 0, ',', '.'); ?> đ
                                                <?php
                                                $gia = number_format($rows['GiaCu'], 0, ',', '.');
                                                if ($rows['GiaCu']) {
                                                    echo "<span class='item__price-old'>$gia đ</span>";
                                                } else {
                                                    echo "";
                                                }
                                                ?>
                                            </h3>
                                        </div>
                                        <a href="addcart.php?id_sp=<?php echo $rows["MSHH"] ?>" class="slide__item-addtocart">
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="slide__item-wrapper">
                                <?php
                                $sql = "SELECT * FROM hanghoa WHERE type='3' LIMIT 4 OFFSET 4";
                                $query = mysqli_query($conn, $sql);
                                while ($rows = mysqli_fetch_array($query)) {
                                ?>
                                    <div class="slide__item">
                                        <a href="detail.php?chitiet?=<?php echo $rows["MSHH"] ?>">
                                            <img src="<?php echo $rows["anh"] ?>" alt="" class='slide__item-img'>
                                        </a>
                                        <div class="slide__item-info">
                                            <div class="slide__item-rate">
                                                <i class="fa fa-star-o color"></i>
                                                <i class="fa fa-star-o color"></i>
                                                <i class="fa fa-star-o color"></i>
                                                <i class="fa fa-star-o "></i>
                                                <i class="fa fa-star-o "></i>
                                            </div>
                                            <a href="detail.php?chitiet=<?php echo $rows["MSHH"] ?>" class="slide__item-name"><?php echo $rows["TenHH"] ?></a>
                                            <h3 class="slide__item-price">
                                                <?php echo number_format($rows['Gia'], 0, ',', '.'); ?> đ
                                                <?php
                                                $gia = number_format($rows['GiaCu'], 0, ',', '.');
                                                if ($rows['GiaCu']) {
                                                    echo "<span class='item__price-old'>$gia đ</span>";
                                                } else {
                                                    echo "";
                                                }
                                                ?>
                                            </h3>
                                        </div>
                                        <a href="addcart.php?id_sp=<?php echo $rows["MSHH"] ?>" class="slide__item-addtocart">
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Feature -->

    <!-- Testimonial -->
    <div class="testimonial">
        <div class="testimonial__container">
            <div class="testimonial__wrapper">
                <button class="my-btn-ver2 testimonial-btn testimonial-prev-btn"><i class="fa fa-angle-left" aria-hidden="true "></i></button>
                <button class="my-btn-ver2 testimonial-btn testimonial-next-btn"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
                <div class="testimonial__slide-text">
                    <div class="testimonial__slide-item">
                        <img src="assets/img/quote.png" alt="" class="testimonial__slide-quote">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa doloremque soluta neque.
                            Libero
                            quis
                            voluptates ea natus nesciunt a necessitatibus, praesentium voluptatem quibusdam eaque
                            deleniti
                            reiciendis hic, in fuga nobis.</p>
                        <img src="assets/img/1.png" alt="" class="testimonial__slide-image">
                        <h2>Steerner</h2>
                    </div>
                    <div class="testimonial__slide-item">
                        <img src="assets/img/quote.png" alt="" class="testimonial__slide-quote">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa doloremque soluta neque.
                            Libero
                            quis
                            voluptates ea natus nesciunt a necessitatibus, praesentium voluptatem quibusdam eaque
                            deleniti
                            reiciendis hic, in fuga nobis.</p>
                        <img src="assets/img/2.png" alt="" class="testimonial__slide-image">
                        <h2>Dermot</h2>
                    </div>
                    <div class="testimonial__slide-item">
                        <img src="assets/img/quote.png" alt="" class="testimonial__slide-quote">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa doloremque soluta neque.
                            Libero
                            quis
                            voluptates ea natus nesciunt a necessitatibus, praesentium voluptatem quibusdam eaque
                            deleniti
                            reiciendis hic, in fuga nobis.</p>
                        <img src="assets/img/2.png" alt="" class="testimonial__slide-image">
                        <h2>BUNT</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Testimonial -->

    <!-- Our Blog -->
    <div class="blog">
        <div class="container">
            <div class="blog__heading">
                <img src="assets/img/title.png" alt="">
            </div>
            <h2 class="blog__title">
                <span>Blog</span>
                của chúng tôi
            </h2>
            <div class="blog__wrapper">
                <button class="my-btn-ver2 blog-btn blog-prev-btn"><i class="fa fa-angle-left" aria-hidden="true "></i></button>
                <button class="my-btn-ver2 blog-btn blog-next-btn"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
                <div class="blog__slide">
                    <div class="blog__slide-post">
                        <a href="#" class='post__img'>
                            <img src="assets/img/1 (4).jpg" alt="">
                        </a>
                        <div class="post__box">
                            <a href="#" class='post__box-title'>Dừa cải thiện tim và khả năng miễn dịch</a>
                            <p class='post__box-by'>Đăng bởi: <span class='post__box__by-name'>Your name</span> -
                                30/2021<span></span></p>
                            <p class='post__box-text'>
                                Nước cốt dừa là một trong những thực phẩm lành mạnh nhất trên thế giới, những lợi ích
                                sức
                                khỏe của nước cốt dừa khiến nó
                                trở nên khá phổ biến.
                            </p>
                            <button class='my-btn-primary my-btn-primary--2 post__box-btn'>Read more</button>
                        </div>
                    </div>
                    <div class="blog__slide-post">
                        <a href="#" class='post__img'>
                            <img src="assets/img/2 (2).jpg" alt="">
                        </a>
                        <div class="post__box">
                            <a href="#" class='post__box-title'>Dừa cải thiện tim và khả năng miễn dịch</a>
                            <p class='post__box-by'>Đăng bởi: <span class='post__box__by-name'>Your name</span> -
                                30/2021<span></span></p>
                            <p class='post__box-text'>
                                Nước cốt dừa là một trong những thực phẩm lành mạnh nhất trên thế giới, những lợi ích
                                sức
                                khỏe của nước cốt dừa khiến nó
                                trở nên khá phổ biến.
                            </p>
                            <button class='my-btn-primary my-btn-primary--2 post__box-btn'>Read more</button>
                        </div>
                    </div>
                    <div class="blog__slide-post">
                        <a href="#" class='post__img'>
                            <img src="assets/img/3.jpg" alt="">
                        </a>
                        <div class="post__box">
                            <a href="#" class='post__box-title'>Dừa cải thiện tim và khả năng miễn dịch</a>
                            <p class='post__box-by'>Đăng bởi: <span class='post__box__by-name'>Your name</span> -
                                30/2021<span></span></p>
                            <p class='post__box-text'>
                                Nước cốt dừa là một trong những thực phẩm lành mạnh nhất trên thế giới, những lợi ích
                                sức
                                khỏe của nước cốt dừa khiến nó
                                trở nên khá phổ biến.
                            </p>
                            <button class='my-btn-primary my-btn-primary--2 post__box-btn'>Read more</button>
                        </div>
                    </div>
                    <div class="blog__slide-post">
                        <a href="#" class='post__img'>
                            <img src="assets/img/1 (4).jpg" alt="">
                        </a>
                        <div class="post__box">
                            <a href="#" class='post__box-title'>Dừa cải thiện tim và khả năng miễn dịch</a>
                            <p class='post__box-by'>Đăng bởi: <span class='post__box__by-name'>Your name</span> -
                                30/2021<span></span></p>
                            <p class='post__box-text'>
                                Nước cốt dừa là một trong những thực phẩm lành mạnh nhất trên thế giới, những lợi ích
                                sức
                                khỏe của nước cốt dừa khiến nó
                                trở nên khá phổ biến.
                            </p>
                            <button class='my-btn-primary my-btn-primary--2 post__box-btn'>Read more</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Our Blog -->

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
            <p>Copyright © Naturecircle. sĐã đăng ký Bản quyền</p>
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
<script src="assets/script/main.js"></script>



</html>