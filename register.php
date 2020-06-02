<?php

$errors = array();      // array to hold validation errors
$jsonf = file_get_contents('php://input');
$json = json_decode($jsonf);
 
echo $json;
/* 
if (empty($_POST['name']))
    $errors['name'] = 'Name is required.';

if (empty($_POST['email']))
    $errors['email'] = 'Email is required.';

if (empty($_POST['superheroAlias']))
    $errors['superheroAlias'] = 'Superhero alias is required.';

if (!empty($errors)) {

    // if there are items in our errors array, return those errors
    $data['success'] = false;
    $data['errors']  = $errors;
} else {
    $em = $_POST['email'];
    $password = $_POST['password'];
    $uname = $_POST['first_name'] . " " . $_POST['last_name'];
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
      $finquery = "INSERT INTO users VALUES ('',1, '$em', '$password', '$uname', '$phone', '$city', '$address', '$pincode')";
      $reg = mysqli_query($dbh, $finquery);
      if (!$reg) {
        echo mysqli_error($dbh);
      } else {
        $_SESSION['login_status'] = 1;
        $_SESSION['user_name'] = $uname;
        $_SESSION['email'] = $em;
        $_SESSION['phone'] = $phone;
        $_SESSION['city'] = $city;
        $_SESSION['address'] = $address;
        $_SESSION['pin_code'] = $pincode;
      }
    }

    $data['success'] = true;
    $data['message'] = 'Success!';
}

echo json_encode($data);
 */