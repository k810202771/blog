export {ajax};
function isJaon(str){
    try {
        var json = JSON.parse(str);
        if(typeof json == 'object'){
            return true;
        }else{
            return false;
        };
    }catch(err) {
        return false;
    }
}
function ajax(data){
    if(data){
        data.asynchronous = data.asynchronous?data.asynchronous:false; //同步还是异步默认同步
        data.type=data.type?data.type:"GET";
        data.dataType=data.dataType?data.dataType:"String";
        if(!data.url){
            if(data.fail)data.fail({code:404,msg:"未定义URL参数！"});
            return false;
        }
    }else{
        return false;
    }
    var xmlhttp;
    if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else{// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
            if(data.success){
                switch(data.dataType){
                    case "json":
                        if(isJaon(xmlhttp.responseText)){
                            data.success(JSON.parse(xmlhttp.responseText));
                        }else{
                            data.success(xmlhttp.responseText);
                        };
                        break;
                    default:
                        data.success(xmlhttp.responseText);
                        break;
                }
                
            }
        }
    }
    xmlhttp.open(data.type,data.url,data.asynchronous);
    xmlhttp.send();
};