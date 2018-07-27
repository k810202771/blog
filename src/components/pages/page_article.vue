<template>
    <div>
        <div class="bg"></div>
        <div class="headTitle">
            <div class="right">
                <div class="title">每天三篇前端日记</div>
                <div class="text">每天三篇前端日记每天三篇前端日记每天三篇前端日记每天三篇前端日记</div>
            </div>
        </div>
        <div class="content">

            <div class="group" v-for="(item,index) in data" :key="item.id">
                <img class="img" :src="'./static/cover/'+index+'.jpg'" width="245" height="150">
                <div class="text">
                    <div class="title" v-html="item.title"></div>
                    <div v-text="item.text"></div>
                    <div class="meta">
                        <span class="icon-11 icon"></span><span class="paragraph">2018-07-17</span>
                        <span class="icon-15 icon"></span><span class="paragraph">喜欢</span>
                        <span class="icon-16 icon"></span><span class="paragraph">阅读(105)</span>
                        <span class="icon-18 icon"></span><span class="paragraph">评论</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            data:[]
        }
    },
    created(){
        this.pageLoding();
    },

    methods:{
        onscroll(a){
            console.log(a);
        },
        pageLoding(){
            var that = this;
            this.$ajax({
                url:"/api/blog/admin/search.php?pageindex=1&pagemax=10&textmin=false",
                asynchronous:true,
                dataType:"json",
                success(res){
                    that.data = res;
                    console.log(that.data);
                }
            });
        }
    }
}
</script>


<style scoped>
    .paragraph{
        margin-right: 10px;
    }
    .meta{
        margin-top: 10px;
        height: 16px;
        line-height: 16px;
        font-size: 12px;
    }
    .bg{
        /*background:url("../../assets/article_head_bg.jpg") center;*/
        background: #52b737;
        height: 174px;
        position: absolute;
        left: 0;
        right: 0;
    }
    .headTitle{
        position: absolute;
        left: 0;
        right: 0;
        top: 20px;
        width: 90%;
        max-width: 990px;
        margin: auto;
        padding: 0 24px;
        color: #fff;
    }
    .headTitle .right{
        float: right;
        width: 300px;
    }
    .headTitle .title{
        font-size: 32px;
        font-weight: bold;
        margin-bottom: 8px;
    }
    .headTitle .text{
        font-size: 14px;
    }
    .content{
        font-size: 0;
        position: absolute;
        left: 0;
        right: 0;
        top: 120px;
        max-width: 990px;
        width: 90%;
        margin: auto auto 48px auto;
        background: #fff;
        box-shadow: 0px 2px 10px #ddd;
        border-radius: 3px;
        overflow: hidden;
    }
    .content .img{
        position: absolute;
        left: 20px;
        top: 20px;
    }
    .content .title{
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 5px;
        color: #333;
    }
    .content .icon{
        margin-right: 3px;
    }
    .content .text{
        display: inline-block;
        font-size: 1rem;
        margin: 20px 20px 20px 285px;
        min-height: 150px;
        color: #999;
    }
    .content .group{
        position: relative;
    }
    .content .group ~ .group{
        border: 1px solid #eee;
    }
</style>
