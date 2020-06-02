<!doctype html>
<html lang="zxx">
<?php session_start(); ?>

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>aranaz</title>
  <link rel="icon" href="img/favicon.png">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- animate CSS -->
  <link rel="stylesheet" href="css/animate.css">
  <!-- owl carousel CSS -->
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <!-- nice select CSS -->
  <link rel="stylesheet" href="css/nice-select.css">
  <!-- font awesome CSS -->
  <link rel="stylesheet" href="css/all.css">
  <!-- flaticon CSS -->
  <link rel="stylesheet" href="css/flaticon.css">
  <link rel="stylesheet" href="css/themify-icons.css">
  <!-- font awesome CSS -->
  <link rel="stylesheet" href="css/magnific-popup.css">
  <!-- swiper CSS -->
  <link rel="stylesheet" href="css/slick.css">
  <link rel="stylesheet" href="css/price_rangs.css">
  <!-- style CSS -->
  <link rel="stylesheet" href="css/style.css">

  <link rel="stylesheet" href="css/quantity.css" />
  <script>
    function updateCart(id, qty, months) {
      var priceId = 'price' + id;
      if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
      } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          /* var mod = document.getElementsByTagName('tbody');
          mod[0].innerHTML = this.responseText; */
          update = JSON.parse(this.responseText);
          document.getElementById(priceId).innerHTML = '&#8377;' + update.total_price;
          document.getElementById('grand_total').innerHTML = '&#8377;' + update.grand_total;
          console.log(update);
        }
      };
      xmlhttp.open("GET", "carthandler.php?id=" + id + "&oper=update&qty=" + qty + "&months=" + months, true);
      xmlhttp.send();
    }

    function deleteProduct(id) {
      if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
      } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var mod = document.getElementsByTagName('tbody');
          mod[0].innerHTML = this.responseText;
        }
      };
      xmlhttp.open("GET", "carthandler.php?id=" + id + "&oper=delete", true);
      xmlhttp.send();
    }
  </script>
</head>

<body>
  <!--::header part start::-->
  <?php include("header.php");
  $grand_total = 0;
  ?>
  <!-- Header part end-->


  <!--================Home Banner Area =================-->
  <!-- breadcrumb start-->
  <section class="breadcrumb breadcrumb_bg">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="breadcrumb_iner">
            <div class="breadcrumb_iner_item">
              <h2>Cart Products</h2>
              <p>Home <span>-</span>Cart Products</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- breadcrumb start-->

  <!--================Cart Area =================-->
  <section class="cart_area padding_top">
    <div class="container">
      <?php if (isset($_SESSION['login_status'])) { ?>
        <div class="cart_inner">
          <div class="table-responsive">
            <table class="table">
              <?php if (isset($_SESSION['cart']) && !(empty($_SESSION['cart']))) { ?>
                <thead>
                  <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">No. of Months</th>
                    <th scope="col">Total</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  //print_r($_SESSION['cart']);
                  foreach ($_SESSION['cart'] as $value) {
                  ?>
                    <tr>
                      <td>
                        <div class="media">
                          <div class="d-flex">
                            <img width="100px" height="160px" src="img/product/categories/<?php echo $value['cat_name'] ?>/<?php echo $value['product_name'] ?>/<?php echo $value['product_name'] ?> (1).jpeg" alt="" />
                          </div>
                        </div>
                      </td>
                      <td>
                        <p><?php echo $value['product_name'] ?></p>
                      </td>
                      <td>
                        <h5>&#8377;<?php echo $value['renting_price'] ?></h5>
                      </td>
                      <td>
                        <div class="quantity buttons_added">
                          <input type="button" value="-" class="minus">
                          <input onchange="updateCart(<?php echo $value['product_id'] ?>,
                      document.getElementById('<?php echo 'quantity ' . $value['product_id']; ?>').value, 
                      document.getElementById('<?php echo 'months ' . $value['product_id']; ?>').value);" id="<?php echo 'quantity ' . $value['product_id'] ?>" type="number" step="1" min="1" max="" name="quantity" value="<?php echo $value['quantity']; ?>" title="Qty" class="input-text qty text" size="4" pattern="" inputmode="">
                          <input type="button" value="+" class="plus">
                        </div>
                      </td>
                      <td>
                        <div class="quantity buttons_added">
                          <input type="button" value="-" class="minus">
                          <input onchange="updateCart(<?php echo $value['product_id'] ?>,
                      document.getElementById('<?php echo 'quantity ' . $value['product_id'] ?>').value, 
                      document.getElementById('<?php echo 'months ' . $value['product_id']; ?>').value);" id="<?php echo 'months ' . $value['product_id'] ?>" type="number" step="1" min="1" max="" name="noofmonths" value="<?php echo $value['no_of_months']; ?>" title="Months" class="input-text qty text" size="4" pattern="" inputmode="">
                          <input type="button" value="+" class="plus">
                        </div>
                      </td>
                      <td>
                        <h5 id="price<?php echo $value['product_id'] ?>">&#8377;<?php echo $value['total_price'] ?></h5>
                      </td>
                      <td>
                        <button onclick="deleteProduct(<?php echo $value['product_id'] ?>)"><i class="fas fa-trash-alt"></i></button>
                      </td>
                    </tr>
                  <?php } ?>
                  <!-- <tr class="bottom_button">
                <td>
                  <a class="btn_1" href="#">Update Cart</a>
                </td>
                <td></td>
                <td></td>
                <td>
                  <div class="cupon_text float-right">
                    <a class="btn_1" href="#">Close Coupon</a>
                  </div>
                </td>
              </tr> -->
                  <tr>
                    <td></td>
                    <td></td>
                    <td>
                      <h5>Subtotal</h5>
                    </td>
                    <td>
                      <h5 id="grand_total">&#8377;<?php echo $_SESSION['grand_total']; ?></h5>
                    </td>
                  </tr>
                  <!-- <tr class="shipping_area">
                <td></td>
                <td></td>
                <td>
                  <h5>Shipping</h5>
                </td>
                <td>
                  <div class="shipping_box">
                    <ul class="list">
                      <li>
                        <a href="#">Flat Rate: $5.00</a>
                      </li>
                      <li>
                        <a href="#">Free Shipping</a>
                      </li>
                      <li>
                        <a href="#">Flat Rate: $10.00</a>
                      </li>
                      <li class="active">
                        <a href="#">Local Delivery: $2.00</a>
                      </li>
                    </ul>
                    <h6>
                      Calculate Shipping
                      <i class="fa fa-caret-down" aria-hidden="true"></i>
                    </h6>
                    <select class="shipping_select">
                      <option value="1">Bangladesh</option>
                      <option value="2">India</option>
                      <option value="4">Pakistan</option>
                    </select>
                    <select class="shipping_select section_bg">
                      <option value="1">Select a State</option>
                      <option value="2">Select a State</option>
                      <option value="4">Select a State</option>
                    </select>
                    <input type="text" placeholder="Postcode/Zipcode" />
                    <a class="btn_1" href="#">Update Details</a>
                  </div>
                </td>
              </tr> -->
                </tbody>
              <?php } else {
                echo "<h4 align = \"center\">Sorry, no items in the cart!!</h4>";
              }
              ?>
            </table>
            <div class="checkout_btn_inner float-right">
              <a class="btn_1" href="#" onclick="history.back(-1);">Continue Shopping</a>
              <?php if (isset($_SESSION['cart']) && !(empty($_SESSION['cart']))) { ?>
                <a class="btn_1 checkout_btn_1" href="checkout.php">Proceed to checkout</a>
              <?php } ?>
            </div>
          </div>
        </div>
      <?php } else { ?>
        <div align="center" class="checkout_btn_inner">
          <h3>You are not logged in. Please log in </h3><br><br>
          <a class="btn_2" href="login.php">Log In</a>
        </div>
      <?php  } ?>
  </section>
  <!--================End Cart Area =================-->

  <!--::footer_part start::-->
  <?php include("footer.php") ?>
  <!--::footer_part end::-->

  <!-- jquery plugins here-->
  <!-- jquery -->
  <script src="js/jquery-1.12.1.min.js"></script>
  <!-- popper js -->
  <script src="js/popper.min.js"></script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.min.js"></script>
  <!-- easing js -->
  <script src="js/jquery.magnific-popup.js"></script>
  <!-- swiper js -->
  <script src="js/swiper.min.js"></script>
  <!-- swiper js -->
  <script src="js/masonry.pkgd.js"></script>
  <!-- particles js -->
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.nice-select.min.js"></script>
  <!-- slick js -->
  <script src="js/slick.min.js"></script>
  <script src="js/jquery.counterup.min.js"></script>
  <script src="js/waypoints.min.js"></script>
  <script src="js/contact.js"></script>
  <script src="js/jquery.ajaxchimp.min.js"></script>
  <script src="js/jquery.form.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <script src="js/mail-script.js"></script>
  <script src="js/stellar.js"></script>
  <script src="js/price_rangs.js"></script>
  <!-- custom js -->
  <script src="js/custom.js"></script>
  <script src="js/script.js"></script>
</body>

</html>