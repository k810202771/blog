<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>install</title>
</head>
<body>
    <?php
        require('func.php');
        $folders = ["./utf8-php/",'./src/'];
        $func = new Funcp;
        $blnumber = 0;
        for($i=0;$i<count($folders);$i++){
            if($func -> is_Power($folders[$i])===true){
                $bl = '可写';
                $blnumber ++;
            }else{
                $bl = '不可写';
            }
            echo $folders[$i].'---------------------------->>'.$bl.'<br>';
        }
        
        echo '<input type="button" '. ($blnumber == count($folders)?'':'disabled') .' value="下一步" >';
    ?>
</body>
</html>