<template>
    <div>
        <div class="header"></div>
        <div class="header header_top">
            <div class="menu_center" :style="'max-width:'+$attrs.width+';'">
                <div class="navber-nav el">
                    首页
                </div>
                <div class="navber-nav el">
                    简历
                </div>
                <div class="navber-nav el">
                    留言板
                </div>
                <span class="search el">
                    <input class="search-input" type="text" placeholder="Search">
                    <div class="search-box">
                        <span class="search-icon">搜</span>
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
        console.log(this);
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
    }
    .menu_center{
        position: absolute;
        left: 0;
        right: 0;
        margin: auto;
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
