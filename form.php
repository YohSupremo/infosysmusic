<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="test2.php" method="POST">
        <p>
            <input type="text" name="user" />
        </p>
        <p>
            <textarea name="address" rows="5" cols="40">
            </textarea>
        </p>
        <p>
            <!-- <select name="products[]" multiple="multiple">
                <option>Sonic Screwdriver</option>
                <option>Tricorder</option>
                <option>ORAC AI</option>
                <option>HAL 2000</option>
            </select> -->

            <input type="checkbox" name="products[]" value="Sonic Screwdriver" />Sonic Screwdriver<br />
            <input type="checkbox" name="products[]" value="Tricorder" />Tricorder<br />
            <input type="checkbox" name="products[]" value="ORAC AI" />ORAC AI<br />
            <input type="checkbox" name="products[]" value="HAL 2000" />HAL 2000<br />
        </p>
        <p>
            <input type="submit" value="hit it!" />
        </p>
    </form>
</body>

</html>