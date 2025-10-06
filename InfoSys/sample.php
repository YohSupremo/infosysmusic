<?php 

$firstNum = isset($_POST['num1']) ? (int)$_POST['num1'] : 0 ;
$secondNum = isset($_POST['num2']) ? (int)$_POST['num2'] : 0;
$result = $firstNum + $secondNum;


















?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form method = POST>

    <input type = "textbox" name = "num1" value = "0"> <br> <br>
    <input type = "textbox" name = "num2" value = "0"> <br> <br>
    <input type = "textbox" name = "result" value = "<?php echo $result; ?>" readonly> <br> <br>

    <button type="submit"> Submit </button>
  <button type="button" onclick="window.location.href=window.location.href;">Refresh</button>
 

    
    </form>






</body>
</html>