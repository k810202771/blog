<template>
  <div class="desktopIconBox" :style="'background:'+($attrs.element.select === 'true'?'rgba(0, 0, 0, .25)':'')" ref="box" @click.stop="select" @dblclick="dblclick">
    <div class="icon_box">
        <span :class="$attrs.element.icon" class="iconfont icon"></span>
    </div>
    <div class="text">{{$attrs.element.name}}</div>
    
  </div>
</template>

<script>
export default {
  name: 'desktop',
  data () {
    return {
      msg: ''
    }
  },
  mounted (){
    let box = this.$refs.box;
    let maxid = parseInt(window.innerHeight / box.offsetHeight);
    let array = {y:0,x:0};
    array.x = parseInt(this.$attrs.boxid/maxid);
    array.y = this.$attrs.boxid - (array.x * maxid);
    box.style.top = array.y * (box.offsetHeight + 5) + "px";
    box.style.left = array.x * (box.offsetWidth + 5) + 15 + "px";
  },
  methods:{
      //单击事件
      select:function(res){
          let element = this.$attrs.array;
          for(var i=0;i<element.length;i++){
            if(i == this.$attrs.boxid){
                element[i].select = "true";
            }else{
                element[i].select = "false";
            };
          }
      },
      //双击事件
      dblclick:function(res){
        let element = this.$attrs.array; //全部图标数据
        let openData = this.$attrs.data; //打开的窗口数组
        let boolean = true;
        for(var i=0;i<element.length;i++){
            element[i].select = "false";
        }
        for(var i=0;i<openData.list.length;i++){
            if(openData.list[i] == this.$attrs.boxid){
                boolean = false;
                break;
            };
        }
        if(boolean){
            this.$emit('InitializationWindow',this.$attrs.boxid);
        }
        //显示最小化窗口
        this.$attrs.array[this.$attrs.boxid].windowData.hide = false;
        //触发窗口层次 选中的id
        this.$emit('windowlayer',this.$attrs.boxid);
      }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.desktopIconBox{
    position: absolute;
    display: inline-block;
    padding: 14px;
    border-radius: 8px;
    margin:10px 0;
}
.icon_box{
    background:#fff;
    height:50px;
    line-height:50px;
    width:50px;
    border-radius:90px;
    padding:10px;
    text-align:center;
}
.icon{
    font-size:50px;
    color:#0e9996;
}
.text{
    color: #fff;
    margin-top: 5px;
    text-align: center;
}
</style>
