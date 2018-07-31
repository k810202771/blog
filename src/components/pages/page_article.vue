<template>
    <div ref="scroll" class="scroll">
        <div class="bg"></div>
        <div class="headTitle">
            <div class="right">
                <div class="title">每天三篇前端日记</div>
                <div class="text">每天三篇前端日记每天三篇前端日记每天三篇前端日记每天三篇前端日记</div>
            </div>
            <div class="content">

                <div class="group" v-for="(item,index) in data" :key="item.id">
                    <!--:src="'./static/cover/'+index+'.jpg'"-->
                    <img v-if="item.cover" class="img" :src="item.cover" width="245" height="150" :cover="index">
                    <div :class="item.cover?'textNo':'text'">
                        <div class="title" v-html="item.title"></div>
                        <div v-text="item.text"></div>
                        <div class="meta">
                            <span class="icon-11 icon"></span><span class="paragraph">{{item.reg_date}}</span>
                            <!--<span class="icon-15 icon"></span><span class="paragraph">喜欢</span>-->
                            <span class="icon-16 icon"></span><span class="paragraph">阅读({{item.volume}})</span>
                            <span class="icon-18 icon"></span><span class="paragraph">评论</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="loading" v-show="ajax_state==1">
                <img class="loading" :src="'./static/loading.gif'" style="height:30%;">
            </div>
        </div>

    </div>
</template>

<script>
export default {
    data(){
        return {
            data:[],
            ajax_state:0,
            page_index:0,
            page_max:10,
            page_id:null
        }
    },
    created(){
        this.pageLoding();
    },
    mounted(){
        var that = this;
        var tid = 0;
        this.$refs.scroll.onscroll = function(res){
            var _this = this;
            clearTimeout(tid);
            tid = setTimeout(function(){
                console.log(123123);
                var scrollMax = _this.scrollHeight - _this.offsetHeight;
                var scroll = _this.scrollTop;
                if(scroll > scrollMax - 200){
                    that.pageLoding();
                }
            },100)
        };
    },
    methods:{
        onscroll(a){
            console.log(a);
        },
        pageLoding(){
            var that = this;
            if(this.ajax_state == 0){
                //锁定ajax
                this.ajax_state = 1;
                //开始ajax
                this.$ajax({
                    //url:"/api/blog/admin/search.php?textmin=false&s="+ encodeURI("我") +"&pageindex="+(that.page_index)+"&pagemax="+(that.page_max),
                    url:"/api/blog/admin/search.php?pageindex=" + (that.page_index) + "&pagemax="+ (that.page_max) +"&textmin=false" + (that.page_id?"&id=" + that.page_id:""),
                    asynchronous:true,
                    dataType:"json",
                    success(res){
                        console.log(res);
                        if(res.length > 0){
                            that.page_id = (that.page_id?that.page_id:parseInt(res[0].id));
                            that.page_index ++;
                            for(var i=0;i<res.length;i++){
                                res[i].title = that.$dehtml(res[i].title);
                                res[i].text = that.$dehtml(res[i].text);
                            }
                            that.data = that.data.concat(res);

                            //解锁ajax
                            that.ajax_state = 0;
                        }else{
                            //终止ajax
                            that.ajax_state = 2;
                        }

                    }
                });

            }
        }
    }
}
</script>


<style scoped>
    .loading{
        margin-top: -48px;
        height: 48px;
        line-height: 48px;
        text-align: center;
    }
    .scroll{
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        overflow-y: scroll;
        overflow-x: hidden;
    }
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
        max-width: 990px;
        width: 90%;
        margin: 120px auto 48px auto;
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
    .content .textNo{
        display: inline-block;
        font-size: 1rem;
        margin: 20px 20px 20px 285px;
        min-height: 150px;
        color: #999;
    }
    .content .text{
        display: inline-block;
        font-size: 1rem;
        margin: 20px;
        color: #999;
    }
    .content .group{
        position: relative;
    }
    .content .group ~ .group{
        border-top: 1px solid #eee;
    }
</style>
