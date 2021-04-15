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


// Kiem tra neu chua login bang admin thi phai login
$isAdmin = isset($_SESSION['isAdmin']) ? $_SESSION['isAdmin'] : false;
if (!$isAdmin) {
    echo "<script> 
      window.location.href='/shop/login.php';
    </script>";
}

// Dat lai trang thai cac don hang
$trangthai = isset($_GET['trangthai']) ? $_GET['trangthai'] : null;
$sodondh = isset($_GET['sodondh']) ? $_GET['sodondh'] : null;
if (isset($trangthai) and isset($sodondh)) {
    $so_luong = 0;
    $so_luong_trong_kho = 0;
    $so_luong_hien_tai  = 0;
    $mshh = "";
    $trang_thai_don_hang = 1;

    if ($chitietdonhang = mysqli_fetch_array(mysqli_query($conn, "SELECT MSHH,SoLuong,TrangThai FROM chitietdathang WHERE SoDonDH='$sodondh'"))) {
        $so_luong = $chitietdonhang['SoLuong'];
        $mshh = $chitietdonhang['MSHH'];
        $trang_thai_don_hang = $chitietdonhang['TrangThai'];
    }
    // Lay so luong hien tai cua don hang
    if ($hanghoa = mysqli_fetch_array(mysqli_query($conn, "SELECT SoLuongHang FROM hanghoa WHERE MSHH='$mshh'"))) {
        $so_luong_trong_kho = $hanghoa['SoLuongHang'];
    }
    // 1 pendding, 2 delivered, 3 cancel
    // pendding -> cancel
    // pendding -> delivered
    // delivered -> cancel
    // cancel -> deliverd

    if ($trang_thai_don_hang == 1) {
        if ($trangthai == 2) {
            $so_luong_hien_tai = $so_luong_trong_kho - $so_luong;
        } else {
            $so_luong_hien_tai = $so_luong_trong_kho;
        }
    } else {
        if ($trang_thai_don_hang == 2 and $trangthai == 3) {
            $so_luong_hien_tai = $so_luong_trong_kho + $so_luong;
        } else {
            $so_luong_hien_tai = $so_luong_trong_kho - $so_luong;
        }
    }

    if($trang_thai_don_hang != $trangthai){
        if (
            mysqli_query($conn, "UPDATE `chitietdathang` SET `TrangThai`='$trangthai' WHERE SoDonDH='$sodondh'")
            and
            mysqli_query($conn, "UPDATE `hanghoa` SET `SoLuongHang`='$so_luong_hien_tai' WHERE MSHH='$mshh'")
        ) {
            echo "<script> 
                alert('Cập nhật thành công');
                window.location.href='/shop/admin.php';
            </script>";
        }
    }
}
// Tao chuoi string ngau nhien
function randomId($n)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
    return $randomString;
}

// Them 1 san pham
if (isset($_POST['addproduct'])) {
    $tenhanghoa = $_POST['tenhanghoa'];
    $quycach = $_POST['quycach'];
    $giacu = $_POST['giacu'];
    $giamoi = $_POST['giamoi'];
    $soluonghang = $_POST['soluonghang'];
    $maloaihang = $_POST['maloaihang'];

    // Xu ly anh
    $target_dir = "assets/img/";
    $target_file = $target_dir . basename($_FILES["anh"]["name"]); // assets/img/nameimage.(png,jpg,...);
    $file_name =
        basename($_FILES["anh"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $upload_ok = true;
    $is_exist = false;
    if ($_FILES['anh']['name'] == '') { // 1Mb
        echo "<script>
                alert('Ảnh không được để trống!');
                window.location.href = 'admin.php';
            </script>";
        $upload_ok = false;
    }
    // Kiem tra file co ton tai hay chua neu ton tai thi ko luu anh
    if (file_exists($target_file)) {
        $is_exist = true;
    }

    // Kiem do size
    if ($_FILES['anh']['size'] > 1024 * 1024) { // 1Mb
        echo "<script>
                alert('Size ảnh không được quá 1MB');
                window.location.href = 'admin.php';
            </script>";
        $upload_ok = false;
    }

    //Kiem tra type
    if ($imageFileType != 'jpg' and $imageFileType != "png" and $imageFileType != "jpeg") {
        echo "<script>
                alert('Định dạnh file không hợp lệ');
                window.location.href = 'admin.php';
            </script>";
        $upload_ok = false;
    }


    if ($is_exist == false) {
        if (move_uploaded_file($_FILES["anh"]["tmp_name"], $target_file)) {
            $MSHH = randomId(5);
            $sql = "INSERT INTO `hanghoa`
                    (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `GiaCu`, `SoLuongHang`, `MaLoaiHang`, `anh`) 
                    VALUES 
                    ('$MSHH','$tenhanghoa','$quycach','$giamoi','$giacu','$soluonghang','$maloaihang','$file_name')";
            if (mysqli_query($conn, $sql)) {
                echo "<script>
                            alert('Thêm sản phẩm thành công');
                            window.location.href = 'admin.php';
                        </script>";
            }
        }
    } else {
        $MSHH = randomId(5);
        $sql = "INSERT INTO `hanghoa`
                    (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `GiaCu`, `SoLuongHang`, `MaLoaiHang`, `anh`) 
                    VALUES 
                    ('$MSHH','$tenhanghoa','$quycach','$giamoi','$giacu','$soluonghangng','$maloaihang','$file_name')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>
                            alert('Thêm sản phẩm thành công');
                            window.location.href = 'admin.php';
                        </script>";
        }
    }
}



// Xoa 1 san pham
$onremove = isset($_GET['remove']) ? $_GET['remove'] : false;
if ($onremove == true) {
    $mshh = isset($_GET['mshh']) ? $_GET['mshh'] : "false";
    if (mysqli_query($conn, "DELETE FROM `hanghoa` WHERE MSHH='$mshh'")) {
        echo "<script>
                        alert('Xóa sản phẩm thành công');
                        window.location.href = 'admin.php';
                    </script>";
    }
}

// Chinh Sua San Pham
if (isset($_POST['updateproduct'])) {
    $mshh = $_POST['MSHH'];
    $tenhanghoa = $_POST['tenhanghoa'];
    $quycach = $_POST['quycach'];
    $giacu = $_POST['giacu'];
    $giamoi = $_POST['giamoi'];
    $soluonghang = $_POST['soluonghang'];
    $maloaihang = $_POST['maloaihang'];
    $trangthai = $_POST['trangthai'];

    // Xu ly anh
    $target_dir = "assets/img/";
    $target_file = $target_dir . basename($_FILES["anh"]["name"]); // assets/img/nameimage.(png,jpg,...);
    $file_name =
        basename($_FILES["anh"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $upload_ok = true;
    $is_exist = false;

    if ($_FILES['anh']['name'] == '') { // 1Mb
        echo "<script>
                alert('Ảnh không được để trống!');
                window.location.href = 'admin.php';
            </script>";
        $upload_ok = false;
    }

    // Kiem tra file co ton tai hay chua neu ton tai thi ko luu anh
    if (file_exists($target_file)) {
        $is_exist = true;
    }

    // Kiem do size
    if ($_FILES['anh']['size'] > 1024 * 1024) { // 1Mb
        echo "<script>
                alert('Size ảnh không được quá 1MB');
                window.location.href = 'admin.php';
            </script>";
        $upload_ok = false;
    }

    //Kiem tra type
    if ($imageFileType != 'jpg' and $imageFileType != "png" and $imageFileType != "jpeg") {
        echo "<script>
                alert('Định dạnh file không hợp lệ');
                window.location.href = 'admin.php';
            </script>";
        $upload_ok = false;
    }

    if ($upload_ok == true) {
        if ($is_exist == false) {
            if (move_uploaded_file($_FILES["anh"]["tmp_name"], $target_file)) {
                $sql = "UPDATE `hanghoa` SET 
                    `MSHH` = '$mshh',
                    `TenHH`='$tenhanghoa',
                    `QuyCach`='$quycach',
                    `Gia`='$giamoi',
                    `GiaCu`='$giacu',
                    `SoLuongHang`='$soluonghang',
                    `MaLoaiHang`='$maloaihang',
                    `anh`='$file_name',
                    `type` ='$trangthai' WHERE MSHH='$mshh'";
                if (mysqli_query($conn, $sql)) {
                    echo "<script>
                            alert('Chỉnh sửa thành công');
                            window.location.href = 'admin.php';
                        </script>";
                }
            }
        } else {
            $sql = "UPDATE `hanghoa` SET 
            `MSHH` = '$mshh',
            `TenHH`='$tenhanghoa',
            `QuyCach`='$quycach',
            `Gia`='$giamoi',
            `GiaCu`='$giacu',
            `SoLuongHang`='$soluonghang',
            `MaLoaiHang`='$maloaihang',
            `anh`='$file_name',
            `type`='$trangthai' WHERE MSHH='$mshh'";
            if (mysqli_query($conn, $sql)) {
                echo "<script>
                            alert('Chỉnh sửa thành công');
                            window.location.href = 'admin.php';
                        </script>";
            }
        }
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
                                <span>0</span>
                            </div>
                            <div class="control__group-message">
                                <i class="far fa-comment-alt"></i>
                                <span>0</span>
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
                    <div class="content__body-box content__body-dashboard content__body-order" id='dashboard'>
                        <?php
                        $onedit = isset($_GET['onedit']) ? $_GET['onedit'] : false;
                        if ($onedit == false) {
                        ?>
                            <div class="dashboard__heading">
                                <h1 class="order__title">Danh Sách Hàng Hóa</h1>
                                <a href="admin.php?onedit=1" class="dashboard__heading-btn" data-toggle="modal" data-target="#themhanghoa">Thêm Hàng Hóa</a>
                            </div>
                            <div class="customer__table order__table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="order__table-id" style="width: 160px;padding-left:25px;">MSHH</th>
                                            <th class="order__table-name" style="width: 300px;">Tên Hàng Hóa</th>
                                            <th class="order__table-n-price" style="width: 150px;">Giá Mới</th>
                                            <th class="order__table-o-rice" style="width: 150px;">Giá Cũ</th>
                                            <th class="order__table-quantity" style="width: 150px;">Số Lượng</th>
                                            <th class="order__table-mlh" style="width: 150px;">Mã Loại Hàng</th>
                                            <th class="order__table-image" style="width: 280px;text-align: center;">Ảnh</th>
                                            <th class="order__table-type" style="width: 180px;">Loại</th>
                                            <th class="order__table-edit" style="width: 100px;text-align: center;"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM `hanghoa` WHERE 1";
                                        $query = mysqli_query($conn, $sql);
                                        while ($hanghoa = mysqli_fetch_array($query)) {
                                        ?>
                                            <tr>
                                                <td class="order__tabel-id" style="width: 160px;"><?php echo $hanghoa['MSHH'] ?></td>
                                                <td class="order__tabel-name" style="width: 300px;"><?php echo $hanghoa['TenHH'] ?></td>
                                                <td class="order__tabel-n-price" style="width: 150px;"><?php echo number_format($hanghoa['Gia'], 0, ',', '.') ?>đ</td>
                                                <td class="order__tabel-0-price" style="width: 150px;"><?php echo isset($hanghoa['GiaCu']) ? number_format($hanghoa['GiaCu'], 0, ',', '.') : "" ?>đ</td>
                                                <td class="order__tabel-quantity" style="width: 150px;"><?php echo $hanghoa['SoLuongHang'] ?></td>
                                                <td class="order__tabel-mlh" style="width: 150px;"><?php echo $hanghoa['MaLoaiHang'] ?></td>
                                                <td class="order__tabel-image" style="width: 280px;text-align: center;">
                                                    <img src="assets/img/<?php echo $hanghoa['anh'] ?>" alt="" style="width: 80px;height:80px;object-fit: cover;">
                                                </td>
                                                <td class="order__tabel-type" style="width: 180px;">
                                                    <?php $type = $hanghoa['type'];
                                                    switch ($type) {
                                                        case '1':
                                                            echo "Bán chạy";
                                                            break;
                                                        case '2':
                                                            echo "Mới về";
                                                            break;
                                                        case '3':
                                                            echo "Xem nhiều";
                                                            break;
                                                        default:
                                                            # code...
                                                            break;
                                                    } ?></td>
                                                <td class="order__tabel-edit" style="width: 100px;text-align: center;">
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary" style="background-color:transparent;border:none;" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-h" style="font-size: 16px;color:black;"></i>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                            <li><a class="dropdown-item" href="admin.php?onedit=true&mshh=<?php echo $hanghoa["MSHH"]; ?>" style="font-size: 14px;">Chỉnh sửa sản phẩm</a></li>
                                                            <a class="dropdown-item" href="admin.php?remove=true&mshh=<?php echo $hanghoa['MSHH']; ?>" style="font-size: 14px;">Xóa sản phẩm này</a>

                                                        </ul>
                                                    </div>
                                                </td>

                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php } else {
                            $mshh = isset($_GET['mshh']) ? $_GET['mshh'] : "";
                            $sql = "SELECT `MSHH`, `TenHH`, `QuyCach`, `Gia`, `GiaCu`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `anh`, `type` FROM `hanghoa` WHERE MSHH='$mshh'";
                            $query = mysqli_query($conn, $sql);
                            if ($row = mysqli_fetch_array($query)) {
                            ?>
                                <div class="dashboard__heading">
                                    <h1 class="order__title">Chỉnh Sửa Hàng Hóa</h1>
                                </div>
                                <form action="admin.php" method="POST" class='addproduct__form' enctype="multipart/form-data">
                                    <div class="form__group">
                                        <label for="MSHH">Mã Số Hàng Hóa</label>
                                        <input type="text" id='MSHH' name='MSHH' value="<?php echo $row['MSHH'] ?>">
                                    </div>
                                    <div class="form__group">
                                        <label for="tenhanghoa">Tên Hàng Hóa</label>
                                        <input type="text" id='tenhanghoa' name='tenhanghoa' value="<?php echo $row['TenHH'] ?>">
                                    </div>
                                    <div class="form__group">
                                        <label for="quycach">Quỷ Cách</label>
                                        <input type="text" id='quycach' name='quycach' value="<?php echo $row['QuyCach'] ?>">
                                    </div>
                                    <div class="form__group">
                                        <label for="giacu">Giá Cũ</label>
                                        <input type="number" id='giacu' name='giacu' value="<?php echo $row['GiaCu'] ?>">
                                    </div>
                                    <div class="form__group">
                                        <label for="giamoi">Giá Mới</label>
                                        <input type="number" id='giamoi' name='giamoi' value="<?php echo $row['Gia'] ?>">
                                    </div>
                                    <div class="form__group">
                                        <label for="soluonghang">Số Lượng Hàng</label>
                                        <input type="number" id='soluonghang' name='soluonghang' value="<?php echo $row['SoLuongHang'] ?>">
                                    </div>
                                    <div class="form__group">
                                        <label for="maloaihang">Loại Hàng Hóa</label>
                                        <select name="maloaihang" id="maloaihang">
                                            <option value="TC" <?php if ($row['MaLoaiHang'] == 'TC') echo ("selected") ?>>
                                                Trái Cây
                                            </option>
                                            <option value="R" <?php if ($row['MaLoaiHang'] == "R") echo ("selected") ?>>
                                                Rau
                                            </option>
                                            <option value="NE" <?php if ($row['MaLoaiHang'] == "NE") echo ("selected") ?>>
                                                Nước Ép
                                            </option>
                                            <option value="T" <?php if ($row['MaLoaiHang'] == "T") echo ("selected") ?>>
                                                Trà
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form__group">
                                        <label for="trangthai">Trạng Thái </label>
                                        <select name="trangthai" id="trangthai">
                                            <option value="1" selected ?>
                                                Bán Chạy
                                            </option>
                                            <option value="2">
                                                Mới Về
                                            </option>
                                            <option value="3">
                                                Xem Nhiều
                                            </option>
                                        </select>

                                    </div>
                                    <div class="form__group">
                                        <label for="anh">Ảnh</label>
                                        <input type="file" id='anh' name='anh'">
                                    </div>
                                    <div class="" style=" float:right;">
                                        <a type="button" class="btn btn-secondary" data-dismiss="modal" style="width: 100px;height:35px;font-size: 14px;margin-right: 5px;">Hủy</a>
                                        <button href="addmin.php" type="submit" class="btn btn-primary" name='updateproduct' style="width: 100px;height:35px;font-size: 14px;">Lưu</button>
                                    </div>
                                </form>
                        <?php }
                        } ?>

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
                                                <p><?php echo isset($donhang['amount']) ? number_format($donhang['amount'], 0, ',', '.') : 0;
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

    <!-- Modal Them Hang Hoa -->
    <div class="modal fade" id="themhanghoa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content addproduct__heading">
                <div class="modal-header">
                    <h5>
                        Thêm Hàng Hóa
                    </h5>
                    <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="admin.php" method="POST" class='addproduct__form' enctype="multipart/form-data">
                        <div class="form__group">
                            <label for="tenhanghoa">Tên Hàng Hóa</label>
                            <input type="text" id='tenhanghoa' name='tenhanghoa' required>
                        </div>
                        <div class="form__group">
                            <label for="quycach">Quỷ Cách</label>
                            <input type="text" id='quycach' name='quycach'>
                        </div>
                        <div class="form__group">
                            <label for="giacu">Giá Cũ</label>
                            <input type="number" id='giacu' name='giacu' required>
                        </div>
                        <div class="form__group">
                            <label for="giamoi">Giá Mới</label>
                            <input type="number" id='giamoi' name='giamoi' required>
                        </div>
                        <div class="form__group">
                            <label for="soluonghang">Số Lượng Hàng</label>
                            <input type="number" id='soluonghang' name='soluonghang' required>
                        </div>
                        <div class="form__group">
                            <label for="maloaihang">Loại Hàng Hóa</label>
                            <select name="maloaihang" id="maloaihang" required>
                                <option value="TC">
                                    Trái Cây
                                </option>
                                <option value="R">
                                    Rau
                                </option>
                                <option value="NE">
                                    Nước Ép
                                </option>
                                <option value="T">
                                    Trà
                                </option>
                            </select>
                        </div>
                        <div class="form__group">
                            <label for="anh">Ảnh</label>
                            <input type="file" id='anh' name='anh' required>
                        </div>
                        <div class="" style="float:right;">
                            <a type="button" class="btn btn-secondary" data-dismiss="modal" style="width: 100px;height:35px;font-size: 14px;margin-right: 5px;">Hủy</a>
                            <button href="addmin.php?" type="submit" class="btn btn-primary" name='addproduct' style="width: 100px;height:35px;font-size: 14px;">Lưu</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="assets/script/admin.js?v=<?php echo time(); ?>"></script>

</html>