<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/harvest.png">
    <title>Naturecircle - Tài khoản của tôi</title>
    <!-- Style Css -->
    <link rel="stylesheet" href="assets/styles/myaccount.css?v=<?php echo time(); ?>">
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
$MSKH = isset($_SESSION['MSKH']) ? $_SESSION['MSKH'] : '';
if (!isset($_SESSION['islogin'])) {
    header('location: home.php');
}


if (isset($_POST['submit-address'])) {
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $flag = 0;
    // Nhap truong nao thi thay doi truong do
    if (!empty($address)) {
        $sql = "UPDATE `khachhang` 
        SET `DiaChi`='$address' WHERE MSKH='$MSKH'";
        if (mysqli_query($conn, $sql)) {
            $flag = 1;
        }
    }
    if (!empty($phone)) {
        $sql = "UPDATE `khachhang` 
        SET `SoDienThoai`='$phone' WHERE MSKH='$MSKH'";
        if (mysqli_query($conn, $sql)) {
            $flag = 1;
        }
    }
    if ($flag == 1) {
        echo "<script> 
                alert('Thay đổi thành công');
                window.location.href='/shop/myaccount.php';
            </script>";
    }
}
if (isset($_POST['submit-info'])) {
    $flag = 0;
    $name = $_POST['name'];
    if (!empty($name)) {
        $sql = "UPDATE `khachhang` 
    SET `HoTenKH`='$name' WHERE MSKH='$MSKH'";
        if (mysqli_query($conn, $sql)) {
            $flag = 1;
        }
    }

    $email = $_POST['email'];
    if (!empty($email)) {
        $sql_email = "SELECT Email FROM khachhang";
        $query_email = mysqli_query($conn, $sql_email);
        while ($rows = mysqli_fetch_array($query_email)) {
            echo $rows['Email'];
            if ($email === $rows['Email']) {
                echo "<script> 
            alert('Email đã được sử dụng!');
            window.location.href='/shop/myaccount.php';
        </script>";
            }
        }
        $sql = "UPDATE `khachhang` 
        SET `Email`='$email' WHERE MSKH='$MSKH'";
        if (mysqli_query($conn, $sql)) {
            $flag = 1;
        }
    }


    $user_password;
    $cr_password = $_POST['cr_password'];
    $new_password = $_POST['new_password'];
    $re_password = $_POST['re_password'];

    if (!empty($cr_password)) {
        // Lay mat khau hien tai tu db
        if ($row = mysqli_fetch_array(mysqli_query($conn, "SELECT MatKhau FROM khachhang WHERE MSKH='$MSKH'"))) {
            $user_password = $row['MatKhau'];
        }
        if (empty($new_password) or (empty($re_password))) {
            echo "<script> 
            alert('Mật khẩu mới hoặc Nhập lại mật khẩu không được trống!');
            window.location.href='/shop/myaccount.php';
        </script>";
        } else {
            if ($new_password !== $re_password) {
                echo "<script> 
            alert('Mật khẩu không khớp!');
            window.location.href='/shop/myaccount.php';
        </script>";
            }
        }
        if ($user_password !== md5($cr_password)) {
            echo "<script> 
            alert('Sai mật khẩu hiện tại!');
            window.location.href='/shop/myaccount.php';
        </script>";
        }
        $new_password_hash = md5($new_password);
        $sql = "UPDATE `khachhang` 
        SET `MatKhau`='$new_password_hash' WHERE MSKH='$MSKH'";
        if (mysqli_query($conn, $sql)) {
            $flag = 1;
        }
    }
    if ($flag == 1) {
        echo "<script> 
            alert('Thay đổi thành công');
            window.location.href='/shop/myaccount.php';
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
            <h1>Tài khoản của tôi</h1>
            <div class="breadcrumb__text-box">
                <a href="home.php">Trang chủ</a> <span>/</span>
                <a href="#" class="breadcrumb__text-link">Tài khoản</a>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <!-- Order -->
    <div class="order">
        <div class="container" style="display: flex;">
            <div class="order__tab">
                <a class="order__tab-link" id='order-tab-defalt-open' onclick="openTab(event,'orders')"><i class="fa fa-cart-arrow-down"></i>Đơn hàng</a>
                <a class="order__tab-link" onclick="openTab(event,'address')"><i class="fa fa-map-marker"></i>Địa chỉ thanh toán</a>
                <a class="order__tab-link" onclick="openTab(event,'detail-account')"><i class="fa fa-user"></i>Chi tiết tài khoản</a>
                <a href="home.php?user_logout=true" class="order__tab-link"><i class="fa fa-sign-out"></i>Exit</a>
            </div>
            <div class="order__wrapper">
                <div class="order__content" id='orders'>
                    <h2>Đơn hàng</h2>
                    <table class='table table-bordered'>
                        <thead>
                            <tr>
                                <th>
                                    Đơn hàng
                                </th>
                                <th style="max-width: 224px;width:224px;">
                                    Ngày lập
                                </th>
                                <th style="max-width: 185px;width: 185px;">
                                    Trạng thái
                                </th>
                                <th style="max-width: 135px;width: 135px;">
                                    Tổng
                                </th>
                                <th style="max-width: 142px;width: 142px;">
                                    Hành động
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $MSKH = isset($_SESSION['MSKH']) ? $_SESSION['MSKH'] : '';
                            $sql = "SELECT a.* , b.* 
                            FROM `chitietdathang` as a, `dathang` as b
                            WHERE a.SoDonDH = b.SoDonDH
                            GROUP BY a.SoDonDH ORDER BY b.NgayDH DESC";
                            $query = mysqli_query($conn, $sql);                    
                            while ($rows = mysqli_fetch_array($query)) {
                            ?>
                                <tr>
                                    <td>
                                        #<?php echo $rows['SoDonDH'] ?>
                                    </td>
                                    <td style="max-width: 224px;">
                                        <p>
                                            <?php                                                                                       
                                                echo $rows['NgayDH'];                                        
                                            ?>
                                        </p>
                                    </td>
                                    <td style="max-width: 185px;">
                                        <?php
                                        $status = $rows['TrangThai'];
                                        switch ($status) {
                                            case '1':
                                                echo "<p class='order__pending'>Đang Xử Lý</p>";
                                                break;
                                            case '2':
                                                echo "<p class='order__delivered'>Đã giao hàng</p>";
                                                break;
                                            case '3':
                                                echo "<p class='order__cancel'>Hủy đơn hàng</p>";
                                                break;
                                            default:
                                                echo "<p class='order__pending'>Đang Xử Lý</p>";
                                                break;
                                        }
                                        ?>
                                    </td>
                                    <td style="max-width: 135px;">
                                        <p>
                                            <?php echo number_format($rows['GiaDatHang'], 0, ',', '.') ?>đ
                                        </p>
                                    </td>
                                    <td style="max-width: 142px;">
                                        <a href="cart.php?sodondh=<?php echo $rows['SoDonDH'] ?>">Xem</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="order__content order__address" id='address'>
                    <h2>Địa chỉ thanh toán</h2>
                    <?php
                    $MSKH = $_SESSION['MSKH'];
                    $sql = "SELECT * FROM khachhang WHERE MSKH='$MSKH'";
                    $query = mysqli_query($conn, $sql);
                    if ($row = mysqli_fetch_array($query)) {
                    ?>
                        <p class="order__address-name"><?php echo $row['HoTenKH'] ?></p>
                        <p class="order__address-text"><?php echo $row['DiaChi'] ?></p>
                        <p class="order__address-phone" style="letter-spacing: 1px;">Mobile:(+84) <?php echo $row['SoDienThoai'] ?></p>
                    <?php
                    }
                    ?>
                    <a href="" data-toggle="modal" data-target="#addressModel">
                        <i class="fa fa-edit"></i> Chỉnh sửa địa chỉ
                    </a>
                </div>
                <div class="order__content " id='detail-account'>
                    <h2>Chi tiết tài khoản</h2>
                    <form action="myaccount.php" class="order__account" method="POST">
                        <div class='order__account-group'>
                            <label for="name">Họ và Tên</label>
                            <input type="text" name='name' id='name'>
                        </div>
                        <div class='order__account-group'>
                            <label for="email">Địa chỉ Email</label>
                            <input type="email" name='email' id='email'>
                        </div>
                        <h3>Thay đổi mật khẩu</h3>
                        <div class='order__account-group'>
                            <label for="cr_password">Mật khẩu hiện tại</label>
                            <input type="password" name='cr_password' id='cr_password'>
                        </div>
                        <div class='order__account-group order__account-group--row'>
                            <div class="">
                                <label for="new_password">Mật khẩu mới</label>
                                <input type="password" name='new_password' id='new_password'>
                            </div>
                            <div class="">
                                <label for="re_password">Nhập lại mật khẩu</label>
                                <input type="password" name='re_password' id='re_password'>
                            </div>
                        </div>
                        <button type="submit" name="submit-info" class='order__account-btn'>Lưu thay đổi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Order -->

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
    <!-- Modal -->
    <div class="modal linear" id="addressModel" tabindex="-1" role="dialog" aria-labelledby="addressModel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="font-size: 16px;font-weight: 600;">Chỉnh sửa địa chỉ</h5>
                    <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" class='modal__address-form'>
                        <div class="form__group">
                            <label for="address">Địa chỉ</label>
                            <input type="text" id='address' name='address'>
                        </div>
                        <div class="form__group">
                            <label for="phone">Số điện thoại</label>
                            <input type="text" id='phone' name='phone'>
                        </div>
                        <div class="" style="float:right;">
                            <a type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</a>
                            <button href="myaccount.php?" type="submit" class="btn btn-primary" name='submit-address'>Lưu thay đổi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
<!-- Jquery -->
<script src="assets/script/vendor/jquery.min.js"></script>
<script src="assets/script/vendor/jquery.migrate.min.js"></script>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="assets/script/vendor/slick.min.js"></script>

<!-- Gsap -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.0/gsap.min.js"></script>
<!-- Main script -->
<script src="assets/script/myaccount.js"></script>

</html>