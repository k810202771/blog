<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>install</title>
</head>
<body>
    <input type="text">
    <?php
        $folders = ["D:\phpStudy\WWW\blog\admin\utf8-php"];
        for($i=0;$i<count($folders);$i++){
            echo recurDir($folders[$i],0777);
        }
    ?>
</body>
</html>