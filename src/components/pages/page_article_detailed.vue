<template>
    <div class="box">
        <headnav width="990px"></headnav>
        <div class="content">
            <div class="article-header"><h1 class="article-title" v-html="title"></h1></div>
            <div class="line"></div>
            <div class="article-content" v-html="msg">
                
            </div>
        </div>
    </div>
</template>


<script>
export default {
    data(){
        return {
            msg:'',
            title:''
        }
    },
    mounted(){
        var that = this;
        this.$ajax({
            url:"./static/1.json",
            success(res){
                res = JSON.parse(res);
                that.msg = that.$dehtml(res.msg);
                that.title = that.$dehtml(res.title);
                console.log(res);
            }
        });
    }
}
//渲染代码
SyntaxHighlighter.all();
</script>


<style scoped>
.box{
    color: #646464;
    font-family: sans-serif;
    font-size: 16px;
    line-height: 24px;
    max-width: 990px;
    margin: auto;
}
.content{
    position: relative;
    padding: 16px;
    margin: 20px;
    background: #fff;
    border-radius: 5px;
    box-shadow: 0px 2px 10px #ddd;
}
.article-title{
    text-align: center;
    line-height: 1.1em;
}
.line{
    height: 1px;
    background: #eee;
}
</style>
