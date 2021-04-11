<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/harvest.png">
    <title>Naturecircle - Đăng kí</title>
    <!-- Style Css -->
    <link rel="stylesheet" href="assets/styles/base.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/styles/login.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/styles/register.css?v=<?php echo time(); ?>">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css">
</head>
<?php
ob_start();
session_start();
include_once("connect.php");

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
if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['re_password'])) {
    $email = $_POST['email'];
    $mat_khau = $_POST['password'];
    $re_mat_khau = $_POST['re_password'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $companyname = $_POST['companyname'];
    $phone = $_POST['phone'];

    $sql = "select * from khachhang WHERE Email='$email'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($query);
    if ($row > 0) {
        echo "<div class='alert alert-danger notify'role='alert'>Tài khoản đã tồn tại</div>";
    } else {
        if ($mat_khau != $re_mat_khau) {
            echo "<div class='alert alert-danger notify'role='alert'>Mật khẩu không trùng khớp</div>";
        } else {
            $MSKH = randomId(10);
            $mat_khau_hash = md5($mat_khau);
            $sql = "INSERT INTO 
            `khachhang`(`MSKH`, `HoTenKH`, `TenCongTy`, `DiaChi`, `SoDienThoai`, `Email`, `MatKhau`) 
            VALUES ('$MSKH','$name','$companyname','$address','$phone','$email','$mat_khau_hash')";
            mysqli_query($conn, $sql);

            $MaDC = randomId(5);
            mysqli_query($conn, "INSERT INTO `diachikh`(`MaDC`, `DiaChi`, `MSKH`) VALUES ('$MaDC','$address','$MSKH')");
            header("location: login.php?email=$email");
        }
    };
}

?>

<body>
    <div class="login">
        <div class="login__box">
            <div class="login__img">
                <img src="assets/img/pexels-photo-3629537.jpeg" alt="">
            </div>
            <form action="register.php" method="POST" class='login__form' name="submit">
                <h2>ĐĂNG KÝ</h2>
                <div class="form__group">
                    <label for="name">Họ và Tên *</label>
                    <input type="text" name='name' id="name" required>
                </div>
                <div class="form__group">
                    <label for="email">Email *</label>
                    <input type="email" name='email' id="email" required>
                </div>
                <div class="form__group">
                    <label for="password">Mật khẩu *</label>
                    <input type="password" name='password' id="password" required>
                </div>
                <div class="form__group">
                    <label for="re_password">Nhập Lại Mật khẩu *</label>
                    <input type="password" name='re_password' id="re_password" required>
                </div>
                <div class="form__group" style="display: flex;flex-direction: row;">
                    <div style="width: 50%;margin-right:20px">
                        <label for="companyname">Tên công ty *</label>
                        <input type="text" name='companyname' id="companyname" required>
                    </div>
                    <div style="width: 50%;">
                        <label for="phone">Số điện thoaị *</label>
                        <input type="text" name='phone' id="phone" required>
                    </div>
                </div>
                <div class="form__group">
                    <label for="address">Địa chỉ *</label>
                    <textarea name="address" id="address" cols="30" rows="10" placeholder="Ghi chú về đơn hàng của bạn..." required> </textarea>
                </div>
                <button type="submit" value="Dang nhap" class='form__button'>đăng kÝ</button>
                <div class="" style="clear: right;"></div>
                <a href="home.php" class='goback' style="margin-top: 20px;">
                    Quay trở lại của hàng
                </a>
                <p style="float: right;font-size:14px;margin-top:40px;">
                    Đã có tài khoản? <a href="login.php">đăng nhập tại đây</a>
                </p>
            </form>
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

</html>