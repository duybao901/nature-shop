<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/harvest.png">
    <title>Naturecircle - Giỏ hàng</title>
    <!-- Style Css -->
    <link rel="stylesheet" href="assets/styles/cart.css?v=<?php echo time(); ?>">
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
$SoDonDH = isset($_GET['sodondh']) ? $_GET['sodondh'] : null;
include_once("./connect.php");
?>

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
            <h1>Giỏ hàng của tôi</h1>
            <div class="breadcrumb__text-box">
                <a href="home.php">Trang chủ</a> <span>/</span>
                <a href="#" class="breadcrumb__text-link">Giỏ hàng</a>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <!-- Cart -->
    <div class="cart">
        <div class="container">
            <div class="cart__table">
                <table>
                    <?php
                    if (isset($_SESSION['carts']) or isset($SoDonDH)) {
                    ?>
                        <thead>
                            <tr>
                                <th class='cart__table-remove'>Xóa</th>
                                <th class='cart__table-img'>Ảnh</th>
                                <th class='cart__table-name'>Sản phẩm</th>
                                <th class='cart__table-price'>Giá</th>
                                <th class='cart__table-quantity'>Số lượng</th>
                                <th class='cart__table-total'>Tổng</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                    }
                        ?>
                        <?php
                        if (isset($_SESSION["carts"])) {
                            $arrId = array();
                            foreach ($_SESSION['carts'] as $id_sp => $quantity) {
                                $arrId[] = $id_sp;
                            }
                            $strId = implode("', '", $arrId);
                            $sql = "SELECT * FROM hanghoa WHERE MSHH IN ('$strId')";
                            $query = mysqli_query($conn, $sql);
                        ?>
                            <?php
                            $totalPrice = 0;
                            $totalPriceAll = 0;
                            $VAT = 1; //5%

                            // Xem chi tiet don                            
                            if (!isset($SoDonDH)) {
                                while ($rows = mysqli_fetch_array($query)) {
                                    $id_sp = $rows['MSHH'];
                                    $totalPrice = $rows['Gia'] * $_SESSION['carts']["$id_sp"];
                                    $totalPriceAll += $totalPrice;
                            ?>
                                    <tr>
                                        <td class='cart__tbody-btn'><a href="addcart.php?id_sp=<?php echo $rows['MSHH'] ?>&type=remove&location=<?php echo $_SERVER['REQUEST_URI'] ?>" style="color:#292929"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                                        <td class='cart__tbody-img'><a href="detail.php?chitiet=<?php echo $rows['MSHH'] ?>"><img src="assets/img/<?php echo $rows['anh'] ?>" alt=""></a></td>
                                        <td class='cart__tbody-name'><?php echo $rows['TenHH'] ?></td>
                                        <td class='cart__tbody-price'><?php echo $rows['Gia'] ?> đ</td>
                                        <td class='cart__tbody-quantity'><?php echo $_SESSION['carts']["$id_sp"] ?></td>
                                        <td class='cart__tbody-total'><?php echo $totalPrice  ?> đ</td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                        <?php
                        } else {
                            if (isset($SoDonDH)) {
                                if ($product = mysqli_fetch_array(mysqli_query(
                                    $conn,
                                    "SELECT * FROM hanghoa WHERE MSHH = (SELECT MSHH FROM chitietdathang WHERE SoDonDH='$SoDonDH')"
                                ))) {
                                    if ($order = mysqli_fetch_array(mysqli_query(
                                        $conn,
                                        "SELECT * FROM `chitietdathang` WHERE SoDonDH='$SoDonDH'"
                                    ))) {
                        ?>
                                    <tr>
                                        <td class='cart__tbody-btn'></td>
                                        <td class='cart__tbody-img'><a href="detail.php?chitiet=<?php echo $product['MSHH'] ?>"><img src="assets/img/<?php echo $product['anh'] ?>" alt=""></a></td>
                                        <td class='cart__tbody-name'><?php echo $product['TenHH'] ?></td>
                                        <td class='cart__tbody-price'><?php echo number_format($product['Gia'], 0, ',', '.'); ?> đ</td>
                                        <td class='cart__tbody-quantity'><?php echo $order['SoLuong'] ?></td>
                                        <td class='cart__tbody-total'><?php echo number_format($order['GiaDatHang'], 0, ',', '.'); ?> đ</td>
                                    </tr>
                    <?php
                                    }
                                }
                            } else {
                                echo "
                                  <p align='center' style='margin:10px 0;font-size:16px;color:#292929'>Giỏ Hàng Trống</p>
                                  <div style='text-align:center'>
                                  <img src='assets/img/empty-cart.png' alt='' style='width:60%;height:100%;object-fit:cover;margin:0 auto;'/>
                                  </div>";
                            }
                        }
                    ?>
                </table>
            </div>
            <?php
            if (isset($_SESSION['carts'])) {
            ?>
                <div class="cart__total">
                    <h2>TỔNG GIỎ HÀNG</h2>
                    <div class="cart__total-row">
                        <span>
                            TỔNG PHỤ
                        </span>
                        <p><?php echo number_format($totalPriceAll, 0, ',', '.'); ?> đ</p>
                    </div>
                    <div class="cart__total-row">
                        <span>
                            VAT (1%)
                        </span>
                        <p><?php echo number_format($totalPriceAll * $VAT / 100, 0, ',', '.'); ?> đ</p>
                    </div>
                    <div class="cart__total-row">
                        <span>
                            SHIPPING
                        </span>
                        <p><?php echo number_format($shipping, 0, ',', '.'); ?> đ</p>
                    </div>
                    <div class="cart__total-row cart__total-row--total">
                        <span class="">
                            TỔNG CỘNG
                        </span>
                        <p>
                            <?php echo number_format($totalPriceAll + $totalPriceAll * $VAT / 100 + $shipping, 0, ',', '.');
                            ?> đ
                        </p>
                    </div>
                    <a href="checkout.php" class="my-btn-primary my-btn-primary--2 cart__total-btn">
                        Đi đến thanh toán
                    </a>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <!-- End Cart -->

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

<!-- Gsap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.0/gsap.min.js"></script>
<!-- Main script -->
<script src="assets/script/cart.js"></script>

</html>