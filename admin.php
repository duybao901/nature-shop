<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/harvest.png">
    <title>Naturecircle - Admin</title>
    <!-- Style Css -->
    <link rel="stylesheet" href="assets/styles/base.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/styles/admin.css?v=<?php echo time(); ?>">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css">
</head>
<?php
ob_start();
session_start();
include_once("./connect.php");
$trangthai = isset($_GET['trangthai']) ? $_GET['trangthai'] : null;
$sodondh = isset($_GET['sodondh']) ? $_GET['sodondh'] : null;

if (isset($trangthai) and isset($sodondh)) {
    if (mysqli_query($conn, "UPDATE `chitietdathang` SET `TrangThai`='$trangthai' WHERE SoDonDH='$sodondh' ")) {
        echo "<script> 
                alert('Cập nhật thành công');
                window.location.href='/shop/admin.php';
            </script>";
    }
}
?>

<body>
    <div class="wrapper">
        <div class="row">
            <div class="menu col-lg-2">
                <div class="menu__wrapper">
                    <div class="menu__logo">
                        <img src="assets/img/logo.png" alt="">
                    </div>
                    <ul class="menu__list">
                        <li class='menu__list--active' onclick="openTab(event,'dashboard')" id='tabDefaultOpen'>
                            <a>
                                <i class="fas fa-tachometer-alt"></i> Bảng Điều Khiển
                            </a>
                        </li>
                        <li onclick="openTab(event,'order') ">
                            <a>
                                <i class="fas fa-clipboard-list"></i> Đơn Hàng
                            </a>
                        </li>
                        <li onclick="openTab(event,'customer') ">
                            <a>
                                <i class="fas fa-users"></i> Khách Hàng
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="content col-lg-10">
                <div class="content__header">
                    <div class="content__header-navbar">
                        <i class="fas fa-bars navbar__icon"></i>
                        <form action="" class="navbar__form">
                            <div class="navbar__form-group">
                                <input type="text" placeholder="Tìm kiếm đây...">
                                <button><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="content__header-control">
                        <div class="control__group">
                            <div class="control__group-notify">
                                <i class="far fa-bell"></i>
                                <span>4</span>
                            </div>
                            <div class="control__group-message">
                                <i class="far fa-comment-alt"></i>
                                <span>21</span>
                            </div>
                        </div>
                        <div class="control__info">
                            <div class="control__info-img">
                                <img src="assets/img/harvest.png" alt="">
                            </div>
                            <a href="home.php" class="control__info-exit">
                                Thoát
                            </a>
                        </div>
                    </div>
                </div>
                <div class="content__body">
                    <div class="content__body-box content__body-dashboard" id='dashboard'>
                        <h1 class="order__title">Danh Sách Khách hàng</h1>
                        <div class="customer__table order__table">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="order__tabel-id" style="width: 160px;">MSKH</th>
                                        <th class="order__tabel-name" style="width: 200px;">Tên Khách Hàng</th>
                                        <th class="order__tabel-company" style="width: 200px;">Tên Công Ty</th>
                                        <th class="order__tabel-address" style="width: 380px;">Đia Chỉ</th>
                                        <th>Tổng chi</th>
                                        <th class="order__tabel-edit" style="width: 100px;text-align: center;"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td class="order__tabel-id">
                                            <p style="margin-bottom: 0;">a</p>
                                        </td>
                                        <td class="order__tabel-name">
                                            <p>b</p>
                                        </td>
                                        <td class="order__tabel-company">
                                            <p>c</p>
                                        </td>
                                        <td class="order__tabel-address">
                                            <p>d</p>
                                        </td>
                                        <td class="order__tabel-amount">
                                            <p>eđ</p>
                                        </td>
                                        <td class="order__tabel-edit" style="width: 100px;text-align: center;">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="content__body-box content__body-order" id='order'>
                        <h1 class="order__title">Danh Sách Các Đơn Hàng</h1>
                        <div class="order__table">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="order__tabel-id">Số Đơn</th>
                                        <th class="order__tabel-date">Ngày</th>
                                        <th class="order__tabel-name">Tên Khách Hàng</th>
                                        <th class="order__tabel-location">Địa Chỉ</th>
                                        <th class="order__tabel-amount">Số Tiền</th>
                                        <th class="order__tabel-status" style="width: 100px;text-align: center;">Trạng Thái Đơn Hàng</th>
                                        <th class="order__tabel-edit" style="width: 100px;text-align: center;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Lấy chi tiết đơn hàng
                                    $sql = "SELECT a.* , b.* 
                                            FROM `chitietdathang` as a, `dathang` as b
                                            WHERE a.SoDonDH = b.SoDonDH
                                            GROUP BY a.SoDonDH ORDER BY b.NgayDH DESC";
                                    $query = mysqli_query($conn, $sql);
                                    while ($chitietdonhang = mysqli_fetch_array($query)) {
                                        $MSKH = $chitietdonhang['MSKH'];
                                        $SoDonDH = $chitietdonhang['SoDonDH'];
                                        $khachhang = mysqli_fetch_array(
                                            mysqli_query(
                                                $conn,
                                                "SELECT * FROM khachhang WHERE MSKH='$MSKH'"
                                            )
                                        );
                                    ?>
                                        <tr>
                                            <td class="order__tabel-id"># <span><?php echo $chitietdonhang['SoDonDH']; ?></span></td>
                                            <td class="order__tabel-date">
                                                <p><?php $NgayDH = new DateTime($chitietdonhang['NgayDH']);
                                                    echo date_format($NgayDH, "d-m-Y H:i a");; ?></p>
                                            </td>
                                            <td class="order__tabel-name">
                                                <p><?php echo $khachhang['HoTenKH'] ?></p>
                                            </td>
                                            <td class="order__tabel-location">
                                                <p><?php echo $khachhang['DiaChi'] ?></p>
                                            </td>
                                            <td class="order__tabel-amount"><?php echo number_format($chitietdonhang['GiaDatHang'], 0, ',', '.') ?>đ</td>
                                            <td class="order__tabel-status" style="width: 100px;text-align: center;">
                                                <?php
                                                $type = $chitietdonhang['TrangThai'];
                                                switch ($type) {
                                                    case '1':
                                                        echo "  <a class='status__buton status--pending' id='<?php echo $SoDonDH; ?>'>
                                                        pending
                                                    </a>";
                                                        break;
                                                    case '2':
                                                        echo "  <a class='status__buton status--delivery' id='<?php echo $SoDonDH; ?>'>
                                                        Delivered
                                                    </a>";
                                                        break;
                                                    case '3':
                                                        echo "  <a class='status__buton status--cancel' id='<?php echo $SoDonDH; ?>'>
                                                        Cancel
                                                    </a>";
                                                        break;
                                                    default:
                                                        echo "  <a class='status__buton status--pending' id='<?php echo $SoDonDH; ?>'>
                                                        pending
                                                    </a>";
                                                        break;
                                                }
                                                ?>

                                                <div class="status__control" style="width: 150px;">
                                                    <a href="admin.php?trangthai=2&sodondh=<?php echo $SoDonDH ?>" class="status__control-item" id="accept" data-status="delivered" data-id="<?php echo $chitietdonhang['SoDonDH']; ?>">
                                                        <img src="assets/img/check.png" alt="">
                                                        Accept Order
                                                    </a>
                                                    <a href="admin.php?trangthai=3&sodondh=<?php echo $SoDonDH ?>" class="status__control-item" id="reject" data-status="cancel" data-id="<?php echo $chitietdonhang['SoDonDH']; ?>">
                                                        <img src="assets/img/cross.png" alt="">
                                                        Reject Order
                                                    </a>
                                                    <div class="status__control-close">
                                                        x
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="order__tabel-edit" style="width: 100px;text-align: center;">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="content__body-box content__body-customer content__body-order" id='customer'>
                        <h1 class="order__title">Danh Sách Khách hàng</h1>
                        <div class="customer__table order__table">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="order__tabel-id" style="width: 160px;">MSKH</th>
                                        <th class="order__tabel-name" style="width: 200px;">Tên Khách Hàng</th>
                                        <th class="order__tabel-company" style="width: 200px;">Tên Công Ty</th>
                                        <th class="order__tabel-address" style="width: 380px;">Đia Chỉ</th>
                                        <th>Tổng chi</th>
                                        <th class="order__tabel-edit" style="width: 100px;text-align: center;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT  a.*
                                            FROM   `khachhang` as a";
                                    $query = mysqli_query($conn, $sql);
                                    while ($khachhang = mysqli_fetch_array($query)) {
                                        $MSKH = $khachhang['MSKH'];
                                        $donhang = mysqli_fetch_array(
                                            mysqli_query(
                                                $conn,
                                                "SELECT a.*, sum(b.GiaDatHang) as amount
                                                FROM `dathang` as a, `chitietdathang` as b
                                                WHERE a.SoDonDH = b.SoDonDH and a.MSKH = '$MSKH'
                                                GROUP BY a.MSKH
                                                "
                                            )
                                        )
                                    ?>
                                        <tr>
                                            <td class="order__tabel-id">
                                                <p style="margin-bottom: 0;"><?php echo $khachhang['MSKH']; ?></p>
                                            </td>
                                            <td class="order__tabel-name">
                                                <p><?php echo $khachhang['HoTenKH']
                                                    ?></p>
                                            </td>
                                            <td class="order__tabel-company">
                                                <p><?php echo $khachhang['TenCongTy']
                                                    ?></p>
                                            </td>
                                            <td class="order__tabel-address">
                                                <p><?php echo $khachhang['DiaChi']
                                                    ?></p>
                                            </td>
                                            <td class="order__tabel-amount">
                                                <p><?php echo isset($donhang['amount']) ? $donhang['amount'] : 0;
                                                    ?>đ</p>
                                            </td>
                                            <td class="order__tabel-edit" style="width: 100px;text-align: center;">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="assets/script/admin.js?v=<?php echo time(); ?>"></script>

</html>