<!doctype html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login | aranoz</title>
    <link rel="icon" href="img/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- animate CSS -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="css/all.css">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="css/magnific-popup.css">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="css/slick.css">
    <!-- style CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    include("config.php");
    session_start();
    
    if (isset($_POST['register']) && ($_POST['password'] == $_POST['conf_pass'])) {
        $em = $_POST['email'];
        $password = $_POST['password'];
        $fname = $_POST['first_name'];
        $lname = $_POST['last_name'];
        $phone = $_POST['phone'];
        $city = $_POST['city'];
        $address = $_POST['address'];
        $pincode = $_POST['pincode'];

        $query = "select email_id from users";
        $email = mysqli_query($dbh, $query);
        if (!$email) {
            echo "Try again!!";
        } else {
            $emfetch = mysqli_fetch_all($email, MYSQLI_ASSOC);
        }
        if (in_array($em, $emfetch)) {
            echo "User already exists";
        } else {
            $finquery = "INSERT INTO users VALUES ('',1, '$em', '$password', '$fname', '$lname', '$phone', '$city', '$address', '$pincode')";
            $reg = mysqli_query($dbh, $finquery);
            if (!$reg) {
                echo mysqli_error($dbh);
            } else {
                echo "<script>alert('Registered successfully!!')</script>";
            }
        }
    }

    if (isset($_POST['login'])) {
        $email = $_POST['name'];
        $password = $_POST['password'];
        
        $search = "SELECT * FROM users WHERE email_id = '" . $email . "' AND password = '" . $password . "'";
        $dosearch = mysqli_query($dbh, $search);
        $userinfo = mysqli_fetch_assoc($dosearch);
        $num_rows  = mysqli_num_rows($dosearch);

        if ($num_rows) {
            $_SESSION['login_status'] = 1;
            $_SESSION['user_id'] = $userinfo['user_id'];
            $_SESSION['first_name'] = $userinfo['first_name'];
            $_SESSION['last_name'] = $userinfo['last_name'];
            $_SESSION['email'] = $email;
            $_SESSION['phone'] = $userinfo['phone'];
            $_SESSION['city'] = $userinfo['city'];
            $_SESSION['address'] = $userinfo['address'];
            $_SESSION['pin_code'] = $userinfo['pin_code'];
            header("location: index.php");
        } else {
            echo "<script>alert('Please try again');</script>";
        }
    }

    ?>
    <!--::header part start::-->
    <?php include("header.php"); ?>
    <!-- Header part end-->


    <!-- breadcrumb start-->
    <!-- <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                            <h2>Tracking Order</h2>
                            <p>Home <span>-</span> Tracking Order</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- breadcrumb start-->

    <!--================login_part Area =================-->
    <section class="login_part padding_top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="login_part_text text-center">
                        <div class="login_part_text_iner">
                            <h2>New to our Shop?</h2>
                            <p>There are advances being made in science and technology
                                everyday, and a good example of this is the</p>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn_3" data-toggle="modal" data-target="#exampleModalCenter">
                                Create an account
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Register</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post" action="#">
                                <div class="modal-body">

                                    <div class="mt-10">
                                        <input type="text" name="first_name" placeholder="First Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'First Name'" required class="single-input">
                                    </div>
                                    <div class="mt-10 ">
                                        <input type="text" name="last_name" placeholder="Last Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Last Name'" required class="single-input">
                                    </div>

                                    <div class="mt-10 ">
                                        <input type="email" name="email" placeholder="Email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email address'" required class="single-input">
                                    </div>
                                    <div class="mt-10 ">
                                        <input type="text" name="phone" placeholder="Phone Number" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Address'" required class="single-input">
                                    </div>

                                    <div class="mt-10">
                                        <input type="textarea" name="address" placeholder="Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Address'" required class="single-input">
                                    </div>


                                    <div class="mt-10 ">
                                        <input type="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required class="single-input">
                                    </div>
                                    <div class="mt-10 ">
                                        <input type="password" name="conf_pass" placeholder="Confirm Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Confirm Password'" required class="single-input">
                                    </div>


                                    <div class="mt-10 ">
                                        <input type="text" name="pincode" placeholder="Pincode" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Pincode'" required class="single-input">
                                    </div>

                                    <div class="input-group-icon mt-10">
                                        <div class="icon"><i class="fa fa-plane" aria-hidden="true"></i></div>
                                        <div class="form-select" id="default-select">
                                            <select name="city">
                                                <option value="City" selected>City</option>
                                                <option value="Belagavi">Belagavi</option>
                                                <option value="Delhi">Delhi</option>
                                                <option value="Mumbai">Mumbai</option>
                                                <option value="Bengaluru">Bengaluru</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="input-group-icon mt-10">
                                        <div class="icon"><i class="fa fa-globe" aria-hidden="true"></i></div>
                                        <div class="form-select" id="default-select_1">
                                            <select>
                                                <option value="1" selected>Country</option>
                                                <option value="1">Bangladesh</option>
                                                <option value="1">India</option>
                                                <option value="1">England</option>
                                                <option value="1">Srilanka</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn_3" data-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn_3" name="register" value="Register" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="login_part_form">
                        <div class="login_part_form_iner">
                            <h3>Welcome Back ! <br>
                                Please Sign in now</h3>
                            <form class="row contact_form" action="#" method="post" novalidate="novalidate">
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="name" name="name" value="" placeholder="Username">
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="password" class="form-control" id="password" name="password" value="" placeholder="Password">
                                </div>
                                <div class="col-md-12 form-group">
                                    <div class="creat_account d-flex align-items-center">
                                        <input type="checkbox" id="f-option" name="selector">
                                        <label for="f-option">Remember me</label>
                                    </div>
                                    <input type="submit" value="submit" class="btn_3" name="login" />
                                    <a class="lost_pass" href="#">forgot password?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================login_part end =================-->

    <!--::footer_part start::-->
    <?php include("footer.php"); ?>
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
</body>

</html>