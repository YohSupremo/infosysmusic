<?php
session_start();
print session_id();
// session_destroy();
$_SESSION['products'] = array();
$_SESSION['id'] = 1;
print_r($_SESSION);





if ( empty( $_SESSION['products'] ) ) {
  $_SESSION['products'] = array();
}


if ( is_array( $_POST['form_products'] ) ) {
  $_SESSION['products'] = array_unique(
    array_merge( $_SESSION['products'],
          $_POST['form_products'] )
  );
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <div>
 <h1>Product Choice Page</h1>
 <form action="<?php print $_SERVER['PHP_SELF'] ?>" method="post">
 <p>
 <select name="form_products[]" multiple="multiple" size="3">
 <option>Sonic Screwdriver</option>
 <option>Hal 2000</option>
 <option>Tardis</option>
 <option>ORAC</option>
 <option>Transporter bracelet</option>
 </select>
 </p>
 <p>
 <input type="submit" value="choose" />
 </p>
 </form>
 <a href="test5.php">A content page</a>
 </div>
</body>
</html>