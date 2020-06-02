<html>

  <head></head>

  <body>
    <?php include("logic.php"); 
      session_start();
      if(!isset($_SESSION['visited']))
        $_SESSION['visited'] = [];

    ?>
    <h1>CRUD Operations</h1>
    <h3>Enter the details</h3>
    <form method="post" action="logic.php">
      <label for="name">Name:</label>
      <input type="text" name="name" /><br /><br /><br />
      <label for="add">Address:</label>
      <input type="text" name="add" /><br /><br /><br />
      <label for="mob">Mob No:</label>
      <input type="text" name="mob" />
      <input type="submit" name="submit1" value="Submit">
    </form>

    <h3>Search for details</h3>
    <form method="post" action="logic.php">
      <label for="name1">Name:</label>
      <input type="text" name="name1" />
      <input type="submit" name="submit2">
    </form>

   <?php 
        for ($i = 0; $i < mysqli_num_rows($imgres); $i++)
        {
          echo " <form method=\"post\" action=\"product.php\">
                    <button type=\"submit\" name=\"val\" value=\"" .$imgfetch[$i]["ID"]. "\">
                      <img style=\"cursor: pointer;\" src=\"img/product/product_" .$imgfetch[$i]["ID"]. ".png\" />
                    </button>
                  </form>";
        }
   ?>
  </body>
</html>