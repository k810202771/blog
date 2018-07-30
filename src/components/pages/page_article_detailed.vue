<template>
    <div class="box">
        <headnav width="990px"></headnav>
        <div class="content">
            <div class="article-header"><h1 class="article-title" v-html="data.title"></h1></div>
            <div class="article-meta">
                <span class="icon-11 icon"></span><span class="paragraph">{{data.reg_date}}</span>
                <span class="icon-16 icon"></span><span class="paragraph">阅读({{data.volume}})</span>
                <span class="icon-18 icon"></span><span class="paragraph">评论</span>
            </div>
            <div class="line"></div>
            <div class="article-content" v-html="data.text">
                
            </div>
        </div>
    </div>
</template>


<script>
export default {
    data(){
        return {
            data:''
        }
    },
    mounted(){
        console.log(this);
        var that = this;
        this.$ajax({
            url:"/api/blog/admin/search.php?pageindex=0&pagemax=1&id=" + this.$route.params.newsId,
            dataType:"json",
            success(res){
                console.log(res);
                that.data = res[0];
                that.data.title = that.$dehtml(that.data.title);
                that.data.text = that.$dehtml(that.data.text);
                //console.log(res);
            }
        });
    },
    watch:{
        msg(res){
            //console.log(res);
            setTimeout(function(){
                SyntaxHighlighter.highlight();
            },1)
        }
    }
}
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
.article-meta{
    margin-bottom: 10px;
    font-size: 12px;
    text-align: center;
}
.icon{
    margin-right: 3px;
}
.paragraph{
    margin-right: 10px;
}
.line{
    height: 1px;
    background: #eee;
    margin: 5px 0;
}
</style>
