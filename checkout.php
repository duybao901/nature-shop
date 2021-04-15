<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/harvest.png">
    <title>Naturecircle - Tiến hành thanh toán</title>
    <!-- Style Css -->
    <link rel="stylesheet" href="assets/styles/checkout.css?v=<?php echo time(); ?>">
    <link rel=" stylesheet" href="assets/styles/base.css?v=<?php echo time(); ?>">

    <!-- Bootstrap -->
    <link href=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
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
$success = isset($_GET['checkout']) ? $_GET['checkout'] : null;
$MSKH = isset($_SESSION['MSKH']) ? $_SESSION['MSKH'] : '';
if ($user = mysqli_fetch_array(mysqli_query($conn, "SELECT Email FROM khachhang WHERE MSKH='$MSKH'"))) {
    $user_email = $user['Email'];
}
// Sinh ra 1 chuoi ngau nhien 
function randomId($n)
{
    $characters = '0123456789abcxyz';
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
    return $randomString;
}
// Thanh toan don hang
if (isset($_POST['submit'])) {
    if (isset($_SESSION['islogin'])) {
        if (isset($_SESSION['carts'])) {
            $name = $_POST['name'];
            $conpanyName = $_POST['conpanyName'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $zip = $_POST['zip'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $note = $_POST['note'];
            if (isset($_SESSION['carts'])) {
                $arrId = array();
                foreach ($_SESSION['carts'] as $id_sp => $quantity) {
                    $arrId[] = $id_sp;
                }
                $strId = implode("', '", $arrId);
                $totalPrice = 0;
                $sql = "SELECT * FROM hanghoa WHERE MSHH IN ('$strId')";
                $query = mysqli_query($conn, $sql);
                while ($rows = mysqli_fetch_array($query)) {
                    $totalPrice = $rows['Gia'] * $_SESSION['carts'][$rows['MSHH']];
                    $MSHH = $rows['MSHH'];
                    $quantity = $_SESSION['carts'][$rows['MSHH']];
                    $query_user = mysqli_query($conn, "SELECT * FROM khachhang WHERE Email='$user_email'");
                    $SoDonDH = randomId(10);
                    if ($user = mysqli_fetch_array($query_user)) {
                        $sql_insert = "INSERT INTO `dathang`(`SoDonDH`,`MSKH`,`DiaChiDH`) VALUES ('$SoDonDH','$MSKH','$address')";
                        mysqli_query($conn, $sql_insert);
                    }
                    // Insert to chitiethanghoa
                    mysqli_query($conn, "INSERT INTO `chitietdathang`
                        (`SoDonDH`, `MSHH`, `SoLuong`, `GiaDatHang`) 
                        VALUES ('$SoDonDH','$MSHH','$quantity','$totalPrice')");
                }
                // Clear session carts
                unset($_SESSION['carts']);
                echo "<script> 
                            alert('Đặt hàng thành công');
                            window.location.href='/shop/myaccount.php';
                        </script>";
            }
        } else {
            echo "<script> 
            alert('Không có sản phẩm nào để thanh toán!');
            window.location.href='/shop/checkout.php';
        </script>";
        }
    } else {
        echo "<script> 
           alert('Đăng nhập để thanh toán!');
           window.location.href='/shop/login.php';
        </script>";
    }
}
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
            <h1>Tiến hành thanh toán</h1>
            <div class="breadcrumb__text-box">
                <a href="home.php">Trang chủ</a> <span>/</span>
                <a href="#" class="breadcrumb__text-link">Thanh toán</a>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <!-- Checkout -->
    <div class="checkout">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="checkout__form">
                        <h2>Chi tiết thanh toán</h2>
                        <form action="#" method="POST">
                            <div class="checkout__form-group">
                                <label for="name">
                                    Họ và tên <span class='group__require'>*</span>
                                </label>
                                <input type="text" name="name" id="name" required>
                            </div>
                            <div class="checkout__form-group">
                                <label for="conpanyName">
                                    Tên công ty
                                </label>
                                <input type="text" id="conpanyName" name='conpanyName' required>
                            </div>
                            <div class="checkout__form-group">
                                <label for="address">
                                    Địa chỉ <span class='group__require'>*</span>
                                </label>
                                <input type="text" id="address" name="address" required>
                            </div>
                            <div class="checkout__form-group checkout__form-group--row">
                                <div class="">
                                    <label for="city">
                                        Thị trấn / Thành phố *
                                    </label>
                                    <input type="text" placeholder="Thị trấn / Thành phố " id="city" name="city" required>
                                </div>
                                <div class="">
                                    <label for="zip">
                                        Mã bưu điện/ Zip *
                                    </label>
                                    <input type="text" placeholder="Mã bưu điện/ Zip *" id="zip" name="zip" required>
                                </div>
                            </div>
                            <div class="checkout__form-group checkout__form-group--row">
                                <div class="">
                                    <label for="email">
                                        Địa chỉ Email *
                                    </label>
                                    <input type="email" id="email" name="email" required>
                                </div>
                                <div class="">
                                    <label for="phone">
                                        Số Điện thoại *
                                    </label>
                                    <input type="text" id="phone" name="phone" required>
                                </div>
                            </div>
                            <div class="checkout__form-group">
                                <label for="note">Ghi chú đơn hàng</label>
                                <textarea name="note" id="note" cols="30" rows="10" placeholder="Ghi chú về đơn hàng của bạn..." required> </textarea>
                            </div>
                            <button class="my-btn-primary my-btn-primary--4 checkout__form-button" type="submit" name="submit">Đặt hàng</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="checkout__order">
                        <h2>ĐƠN HÀNG CỦA BẠN</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th class="checkout__order-name">
                                        Sản Phẩm
                                    </th>
                                    <th class="checkout__order-total">
                                        Tổng
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_SESSION['carts'])) {
                                    $arrId = array();
                                    foreach ($_SESSION['carts'] as $id_sp => $quantity) {
                                        $arrId[] = $id_sp;
                                    }
                                    $strId = implode("', '", $arrId);
                                    $sql = "SELECT * FROM hanghoa WHERE MSHH IN ('$strId')";
                                    $query = mysqli_query($conn, $sql);
                                    $totalPrice = 0;
                                    $totalPriceAll = 0;
                                    $VAT = 1; //5%
                                    while ($rows = mysqli_fetch_array($query)) {
                                        $totalPrice = $rows['Gia'] * $_SESSION['carts'][$rows['MSHH']];
                                        $totalPriceAll += $totalPrice;
                                ?>
                                        <tr>
                                            <td class="checkout__order-name">
                                                <?php echo $rows['TenHH'] ?> <span>x <?php echo $_SESSION['carts'][$rows['MSHH']] ?> </span>
                                            </td>
                                            <td>
                                                <?php echo number_format($totalPrice, 0, ',', '.'); ?> đ
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="checkout__order-subtotal">
                                        GIỎ HÀNG
                                    </td>
                                    <td class="checkout__order-subtotal">
                                        <?php if (isset($_SESSION['carts'])) {
                                            echo number_format($totalPriceAll, 0, ',', '.');
                                        } else {
                                            echo '0';
                                        } ?> đ
                                    </td>
                                </tr>
                                <tr>
                                    <td class="checkout__order-shipping">
                                        VAT (1%)
                                    </td>
                                    <td class="checkout__order-shipping">
                                        <?php if (isset($_SESSION['carts'])) {
                                            echo number_format($totalPriceAll * $VAT / 100, 0, ',', '.');
                                        } else {
                                            echo '0';
                                        } ?> đ
                                    </td>
                                </tr>
                                <tr>
                                    <td class="checkout__order-shipping">
                                        SHIPPING
                                    </td>
                                    <td class="checkout__order-shipping">
                                        <?php if (isset($_SESSION['carts'])) {
                                            echo number_format($shipping, 0, ',', '.');
                                        } else {
                                            echo '0';
                                        } ?> đ
                                    </td>
                                </tr>
                                <tr>
                                    <td class="checkout__order-tong">
                                        TỔNG ĐƠN HÀNG
                                    </td>
                                    <td class="checkout__order-tong">
                                        <?php if (isset($_SESSION['carts'])) {
                                            echo number_format($totalPriceAll + $shipping + $totalPriceAll * $VAT / 100, 0, ',', '.');
                                        } else {
                                            echo '0';
                                        } ?> đ
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="checkout__payment">
                            <div class="checkout__payment-tab">
                                <a href="#">Thanh toán Paypal</a>
                                <img src="assets/img/paypal.png" alt="">
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End Checkout -->

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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<!-- Main script -->
<script src="assets/script/cart.js"></script>

</html>