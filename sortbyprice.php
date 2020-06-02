<?php
include("config.php");
session_start();
$category = $_SESSION['category'];

$from = $_GET['from'];
$to = $_GET['to'];
$price_cond = "BETWEEN " . $from . " AND " . $to;

if ($category == 1) {
    $category_cond = "1";
} else {
    $category_cond = "cat_name = '" . $category . "'";
}

$query_stmt = "SELECT product_id,name,buying_price,renting_price_per_day,cat_name FROM products p,categories c WHERE buying_price " . $price_cond . " AND " . $category_cond . " AND p.category_id = c.category_id";
//echo $query_stmt;
$query_obj = mysqli_query($dbh, $query_stmt);
if (!$query_obj) {
    echo mysqli_error($dbh);
} else {
    $result = mysqli_fetch_all($query_obj, MYSQLI_ASSOC);
}

if(!$result)
{
    echo "<p>No product matches your search, please try again!!!</p>";
} else {
    for ($i = 1; $i <= mysqli_num_rows($query_obj); $i++) { ?>
            <div class="id col-lg-4 col-sm-6">
                <div class="single_product_item">
                    <form method="post" action="single-product.php">
                        <button type="submit" name="id" value="<?php echo $result[$i - 1]['product_id'] ?>">
                            <img src="img/product/categories/<?php echo $result[$i - 1]['cat_name'] ?>/<?php echo $result[$i - 1]['name'] ?>/<?php echo $result[$i - 1]['name'] ?> (1).jpeg" alt="" />
                        </button>
                    </form>
                    <div class="single_product_text">
                        <h4><?php echo $result[$i - 1]['name'] ?></h4>
                        <h3>&#8377;<?php echo $result[$i - 1]['buying_price'] ?></h3>
                        <a data-value="<?php echo $result[$i - 1]['product_id'] ?>" onclick="addToCart(this.dataset.value)" href="#" class="add_cart" data-toggle="modal" data-target="#exampleModal">+ add to cart<i class="ti-heart"></i></a>
                    </div>
                </div>
            </div>
        <?php }  ?>
        
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cart Status</h5>
                        </button>
                    </div>
                    <div class="modal-body">
        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-12">
            <div class="pageination">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <i class="ti-angle-double-left"></i>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                        <li class="page-item"><a class="page-link" href="#">6</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <i class="ti-angle-double-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    <?php } ?>
        <!-- echo "<div class="col-lg-4 col-sm-6">
                <div class="single_product_item">
                    <form method="post" action="single-product.php">
                        <button type="submit" name="id" value="".$i."">
                            <img src="img/product/" .$category. "_" .$i. ".png" alt="" />
                        </button>
                    </form>
                    <div class="single_product_text">
                        <h4>Quartz Belt Watch</h4>
                        <h3>&#8377;150.00</h3>
                        <a href="#" class="add_cart">+ add to cart<i class="ti-heart"></i></a>
                    </div>
                </div>
            </div>";  
         } ?> -->