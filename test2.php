<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    // print_r($_POST);

    print "Welcome <b>" . $_REQUEST['user'] . "</b><br/>\n";
    print "Your address is:<br/><b>" . $_POST['address'] . "</b><br/>\n";

    if (is_array($_POST['products'])) {
        print "<p>Your product choices are:</p>\n";
        print "<ul>\n";
        foreach ($_POST['products'] as $value) {
            print "<li>$value</li>\n";
        }
        print "</ul>\n";
    }
    ?>
</body>

</html>