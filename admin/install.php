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
        $id = isset($_GET['pageid'])?$_GET['pageid']:'0';
        $disabled = true; //按钮不禁止
        $event = '';
        switch($id){
            case 0:
                $func = new Funcp;
                $folders = ["./","./utf8-php/",'./src/'];
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
                $disabled = $blnumber == count($folders);
                $event = 'next('.$id.')';
                break;
                case 1:
                $func = new Funcp;
                echo '数据库服务器: <input type="text" id="input0"><br>'.
                    '数据库名称: <input type="text" id="input1"><br>'.
                    '数据库用户名: <input type="text" id="input2"><br>'.
                    '数据库密码: <input type="password" id="input3"><br>'.
                    '数据库前缀: <input onchange="az09(this)" type="text" id="input4"><br>'.
                    '管理员账号: <input type="text" id="input5"><br>'.
                    '管理员密码: <input type="password" id="input6"><br>'.
                    '在输入一次: <input type="password" id="input7"><br>';
                    $event = 'is_from('.$id.')';
                $disabled = true;
                break;
            case 2:
                $func = new Funcp;

                $disabled = true;
                break;
            default:
                $disabled = false;
                break;
        }
        
        echo '<input type="button" '. ($disabled===true?'':'disabled') .' value="next" onclick="'.$event.'" >';
    ?>
</body>
<script>
function az09(res){
    var p = /[0-9a-zA-Z]/g;
    var str = res.value;
    var array = res.value.match(p);
    res.value = array?array.join(''):'';
    if(str != res.value){
        alert('只允许输入字母和数字\n你的前缀\n['+str+']\n会被替换成\n['+res.value+']');
    }   
}
function is_from(id){
    for(var i=0;i<9;i++){
        var elmm = document.getElementById("input6");
        var el = document.getElementById("input"+i);
        switch(i){
            case 0:
            if(!el.value){
                alert("数据库服务器不能为空");
                return false;
            }
            break;
            case 1:
            if(!el.value){
                alert("数据库名称不能为空");
                return false;
            }
            break;
            case 2:
            if(!el.value){
                alert("数据库用户名不能为空");
                return false;
            }
            break;
            case 3:
            if(!el.value){
                alert("数据库密码不能为空");
                return false;
            }
            break;
            case 4:
            if(!el.value){
                alert("数据库前缀不能为空");
                return false;
            }
            break;
            case 5:
            if(!el.value){
                alert("管理员账号不能为空");
                return false;
            }
            break;
            case 6:
            if(!el.value){
                alert("管理员密码");
                return false;
            }
            break;
            case 7:
            if(el.value != elmm.value){
                alert("重新输入的管理员密码和上面的不一样啊~");
                return false;
            }
            break;
        }
    }
    id++;
    window.location.href = "?pageid="+id
}

function next(id){
    id++;
    window.location.href = "?pageid="+id
}

</script>
</html>