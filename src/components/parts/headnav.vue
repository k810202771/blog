<template>
    <div>
        <div class="header"></div>
        <div class="header header_top">
            <div class="menu_center" :style="'max-width:'+$attrs.width+';'">
                <div class="navber-nav el" @click="href({name:'name'})">
                    首页
                </div>
                <div class="navber-nav el" @click="href({name:'name'})">
                    简历
                </div>
                <div class="navber-nav el" @click="href({name:'name'})">
                    留言板
                </div>
                <span class="search el">
                    <input class="search-input" type="text" placeholder="Search">
                    <div class="search-box">
                        <span class="search-icon icon-20"></span>
                    </div>
                </span>
                
            </div>
        </div>

    </div>
</template>


<script>
export default {
    data(){
        return {
            msg:''
        }
    },
    mounted(){
        //console.log(this);
    },
    methods:{
        href(res){
            let routeData = this.$router.resolve({
                name: res.name
            });
            window.open(routeData.href, '_blank');
        }
    }
}
</script>


<style scoped>
    .header_top{
        position: fixed;
    }
    .header{
        top: 0;
        left: 0;
        right: 0;
        height: 60px;
        line-height: 60px;
        background: #fff;
        z-index: 99;
        text-align: center;
    }
    .menu_center{
        display: inline-block;
        margin: 0 auto;
        width: 100%;
        height: 100%;
    }
    .navber-nav{
        float: left;
        cursor: pointer;
        padding: 0 20px;
    }
    .navber-nav:hover{
        background: #f6f6f6;
    }
    .search{
        float: right;
        position: relative;
    }
    .search-input{
        background: #eee;
        border: none;
        width: 120px;
        transition: width .3s;
        outline: none;
        padding: 10px 20px;
        border-radius: 90px;
    }
    .search-input:focus{
        width: 160px;
    }
    .search-icon{
        display: inline-block;
        width: 24px;
        height: 24px;
        line-height: 24px;
        margin-right: 5px;
        border-radius: 90px;
        text-align: center;
    }
    .search-box{
        position: absolute;
        top: 0;
        right: 0;
        font-size: 14px;
    }
    .search-input:focus + .search-box > .search-icon{
        background: #969696;
        color: #fff;
    }
    .el{
        margin-left: 10px;
    }
</style>
