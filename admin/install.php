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
        require('func.php');
        $folders = ["./utf8-php/",'./ace'];
        $func = new Funcp;
        for($i=0;$i<count($folders);$i++){
            var_dump ($func -> is_Power($folders[$i]));
        }
        
    ?>
</body>
</html>