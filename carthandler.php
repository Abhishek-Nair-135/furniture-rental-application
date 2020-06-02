<?php
include("config.php");
session_start();

$prod_id = $_GET['id'];

$quantity = 1;
$no_of_months = 1;
$from_date = 0;
$to_date = 0;

if (isset($_GET['qty']))
  $quantity = intval($_GET['qty']);

$operation = $_GET['oper'];

if (isset($_GET['months'])) {
  $no_of_months = intval($_GET['months']);
}

if (!isset($_SESSION['cart']))
  $_SESSION['cart'] = [];

$grand_total = 0;

if ($operation == 'add') {
  if (isset($_SESSION['login_status'])) {
    if (!array_key_exists($prod_id, $_SESSION['cart'])) {
      $prod_fetch_stmt = "SELECT name,renting_price_per_day,cat_name FROM products p,categories c WHERE product_id = '" . $prod_id . "' AND p.category_id=c.category_id";
      $prod_fetch_result = mysqli_query($dbh, $prod_fetch_stmt);
      $prod_info = mysqli_fetch_assoc($prod_fetch_result);

      $renting_price = $prod_info['renting_price_per_day'];
      $total_price = $no_of_months * $quantity * $renting_price;

      $_SESSION['cart'][$prod_id] = array(
        "product_id" => $prod_id,
        "quantity" => $quantity,
        "renting_price" => $renting_price,
        "total_price" => $total_price,
        "cat_name" => $prod_info['cat_name'],
        "product_name" => $prod_info['name'],
        "no_of_months" => $no_of_months
      );

      foreach ($_SESSION['cart'] as $value)
        $grand_total += $value['total_price'];

      $_SESSION['grand_total'] = $grand_total;

      if ($prod_id) {
        echo "<p>Product added successfully!!!</p>";
      } else {
        echo "<p>Something went wrong</p>";
      }
    } else {
      if ($prod_id) {
        echo "<p>Product already in cart!!!</p>";
      } else {
        echo "<p>Something went wrong</p>";
      }
    }
  } else {
    echo "<p>You are not logged in!!</p>";
  }
}

if ($operation == 'update') {
  $_SESSION['cart'][$prod_id]['quantity'] = $quantity;
  $total_price = $no_of_months * $quantity * $_SESSION['cart'][$prod_id]['renting_price'];
  $_SESSION['cart'][$prod_id]['total_price'] = $total_price;

  $_SESSION['cart'][$prod_id]['no_of_months'] = $no_of_months;

  foreach ($_SESSION['cart'] as $value)
    $grand_total += $value['total_price'];

  $_SESSION['grand_total'] = $grand_total;

  $temp = $_SESSION['cart'][$prod_id];
  $temp['grand_total'] = $grand_total;

  $update = json_encode($temp);
  echo $update;
}

if ($operation == 'delete') {
  if (array_key_exists($prod_id, $_SESSION['cart'])) {
    unset($_SESSION['cart'][$prod_id]);
  }
  if (isset($_SESSION['cart']) && !(empty($_SESSION['cart']))) {
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
          document.getElementById('<?php echo 'quantity ' . $value['product_id'] ?>').value, 
          document.getElementById('<?php echo 'months ' . $value['product_id']; ?>').value);" id="<?php echo 'quantity ' . $value['product_id'] ?>" type="number" step="1" min="1" max="" name="quantity" value="<?php echo $value['quantity'] ?>" title="Qty" class="input-text qty text" size="4" pattern="" inputmode="">
            <input type="button" value="+" class="plus">
          </div>
        </td>
        <td>
          <div class="quantity buttons_added">
            <input type="button" value="-" class="minus">
            <input onchange="updateCart(<?php echo $value['product_id'] ?>,
          document.getElementById('<?php echo 'quantity ' . $value['product_id'] ?>').value, 
          document.getElementById('<?php echo 'months ' . $value['product_id']; ?>').value)" id="<?php echo 'months ' . $value['product_id'] ?>" type="number" step="1" min="1" max="" name="noofmonths" value="<?php echo $value['no_of_months']; ?>" title="Months" class="input-text qty text" size="4" pattern="" inputmode="">
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
    <?php
      $grand_total += $value['total_price'];
    } ?>
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
        <h5 id="grand_total">&#8377;<?php echo $grand_total ?></h5>
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

<?php
    $_SESSION['grand_total'] = $grand_total;
  }
}
