 <?php
    ob_start();
    include_once("./connect.php");
    $MSKH = isset($_SESSION['MSKH']) ? $_SESSION['MSKH'] : '';
    if ($user = mysqli_fetch_array(mysqli_query($conn, "SELECT Email FROM khachhang WHERE MSKH='$MSKH'"))) {
        $user_email = $user['Email'];
    }
    ?>
 <div class="header">
     <div class="header__container">
         <div class="row">
             <div class="header__container-nav col-lg-5">
                 <ul class='nav__list'>
                     <li class="nav__list-item nav__list-item--active">
                         <a href="home.php">Trang Chủ</a>
                     </li>
                     <li class="nav__list-item">
                         <a href="#">Shop <i class="fa fa-angle-down"></i></a>
                     </li>
                     </li>
                     <li class="nav__list-item">
                         <a href="#">Các loại rau <i class="fa fa-angle-down"></i></a>
                         <div class='item__submenu item__mega-menu'>
                             <ul>
                                 <h3>Các loại quả</h3>
                                 <li>Xoài siêu sạch</li>
                                 <li>Cà chua vườn</li>
                                 <li>Nho vườn</li>
                                 <li>Mận mâm xôi</li>
                                 <li>
                                     <img src="assets/img/cac-loai-qua.jpg" alt="">
                                 </li>
                             </ul>
                             <ul>
                                 <h3>Các loại củ</h3>
                                 <li>Cà rốt</li>
                                 <li>Khoai lang</li>
                                 <li>Khoai tây</li>
                                 <li>Củ cải trắng</li>
                                 <li>
                                     <img src="assets/img/cac-loai-cu.jpg" alt="">
                                 </li>
                             </ul>
                             <ul>
                                 <h3>Các loại hạt</h3>
                                 <li>Hạt Macadamia</li>
                                 <li>Hạt hồ đào</li>
                                 <li>Hạnh nhân</li>
                                 <li>Quả hạch Brazil</li>
                                 <li>
                                     <img src="assets/img/cac-loai-hat.jpg" alt="">
                                 </li>
                             </ul>
                         </div>
                     <li class="nav__list-item">
                         <a href="#">Tin Tức <i class="fa fa-angle-down"></i></a>
                         <div class="item__submenu">
                             <ul class=''>
                                 <li>Xoài giảm giá</li>
                                 <li>Cà chua siêu sạch</li>
                                 <li>Hạt có thuốc</li>
                                 <li>Hạnh nhân hết hàng</li>
                                 <li>Cà rốt ngọt liệm</li>
                             </ul>
                         </div>
                     </li>
                     <li class="nav__list-item">
                         <a href="#">Liên hệ <i class="fa fa-angle-down"></i></a>
                     </li>
                 </ul>
             </div>
             <div class="header__container-logo col-lg-2" align="center">
                 <img src="./assets/img/logo.png" alt="logo">
             </div>
             <div class="header__container-right col-lg-5">
                 <div class="right__search">
                     <i class="fa fa-search" aria-hidden="true"></i>
                     <div class="right__wrapper right__search-wrapper">
                         <form action="" class="">
                             <input type="text" name="" id="" placeholder="Nhập để tìm kiếm...">
                             <button class="my-btn-primary">Search</button>
                         </form>
                     </div>
                 </div>
                 <div class="right__menu">
                     <i class="fa fa-bars" aria-hidden="true"></i>
                     <div class="right__wrapper right__menu-wrapper">
                         <h3>My Account
                             <i class="fa fa-angle-down"></i>
                         </h3>
                         <ul>
                             <?php
                                if (!isset($_SESSION['islogin'])) {
                                ?>
                                 <li><a href="login.php">Đăng nhập</a></li>
                                 <li><a href="register.php">Đăng ký</a></li>
                             <?php
                                } else {
                                ?>
                                 <li><a href="myaccount.php"><?php echo $user_email ?></a></li>
                                 <li><a href="home.php?user_logout=true"><?php echo "Đăng xuất" ?> </a></li>
                             <?php
                                }
                                ?>
                         </ul>
                         <h3>Currentcy: USD
                             <i class="fa fa-angle-down"></i>
                         </h3>
                         <ul>
                             <li><a href="#">€ Euro</a></li>
                             <li><a href="#">£ Pound Sterling</a></li>
                             <li><a href="#">$ Us Dollar</a></li>

                         </ul>
                         <h3>Language: en-gb
                             <i class="fa fa-angle-down"></i>
                         </h3>
                         <ul>
                             <li><a href="#"><img src="assets/img/flag-1.png" alt="" style="margin-right: 10px;">English</a></li>
                             <li><a href="#"><img src="assets/img/flag-2.png" alt="" style="margin-right: 10px;">Germany</a></li>
                         </ul>
                     </div>
                 </div>
                 <div class="right__cart">
                     <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                     <span class="right__cart-number">
                         <?php
                            if (isset($_SESSION["carts"])) {
                                echo count($_SESSION["carts"]);
                            } else {
                                echo 0;
                            }
                            ?>
                     </span>
                     <div class="right__wrapper right__cart-wrapper">
                         <ul class="right__cart-list">
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
                                    $shipping = 2000;
                                    while ($rows = mysqli_fetch_array($query)) {
                                        $id_sp = $rows['MSHH'];
                                        $totalPrice = $rows['Gia'] * $_SESSION['carts']["$id_sp"];
                                        $totalPriceAll += $totalPrice;
                                    ?>
                                     <li>

                                         <a href="addcart.php?id_sp=<?php echo $rows['MSHH'] ?>&type=remove&location=<?php echo $_SERVER['REQUEST_URI'] ?>">
                                             <i class="fa fa-close"></i>
                                         </a>
                                         <div>
                                             <a href="detail.php?chitiet=<?php echo $rows['MSHH'] ?>">
                                                 <img src="<?php echo $rows["anh"] ?>" alt="">
                                             </a>
                                             <div class="right__cart-info">
                                                 <a href="detail.php?chitiet=<?php echo $rows['MSHH'] ?>"><?php echo $rows["TenHH"] ?></a>
                                                 <span class='info__qantity'>x<?php echo $_SESSION['carts']["$id_sp"] ?></span>
                                                 <span class='info__price'><?php echo number_format($totalPrice, 0, ',', '.'); ?>đ</span>
                                             </div>
                                         </div>
                                     </li>
                                 <?php
                                    }
                                    ?>
                             <?php
                                } else {
                                    echo "
                              <p align='center' style='margin:10px 0;font-size:16px;color:#292929'>Giỏ Hàng Trống</p>
                              <img src='assets/img/empty.png' alt='' style='width:100%;height:100%;object-fit:cover;'/>";
                                }
                                ?>
                         </ul>

                         <?php
                            if (isset($_SESSION['carts'])) {
                            ?>
                             <ul class="right__cart-total">
                                 <li>
                                     <span>Tổng cộng :</span>
                                     <span><?php echo number_format($totalPriceAll, 0, ',', '.'); ?>đ</span>
                                 </li>
                            
                                 <li>
                                     <span>VAT (1%) :</span>
                                     <span><?php echo number_format($totalPriceAll * $VAT / 100, 0, ',', '.'); ?>đ</span>
                                 </li>
                                 <li>
                                     <span>Shipping :</span>
                                     <span><?php echo number_format($shipping, 0, ',', '.'); ?>đ</span>
                                 </li>
                                 <li style="margin-top: 15px;font-weight: 600;">
                                     <span style="font-size: 16px;">Tổng :</span>
                                     <span style="font-size: 16px;"><?php echo number_format($totalPriceAll + $totalPriceAll * $VAT / 100, 0, ',', '.'); ?>đ</span>
                                 </li>
                             </ul>
                         <?php
                            } ?>

                         <div class="right__cart-links">
                             <a class="my-btn-primary my-btn-primary--1" href="cart.php">Xem Giỏ hàng</a>
                             <a class="my-btn-primary my-btn-primary--1" href="checkout.php">Thanh toán</a>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>