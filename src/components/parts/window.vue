<template>
  <div>
    <transition-group name="closeAnimation">
    <div ref="box" v-if="$attrs.array[item].windowData.hide===true?false:true" @click.stop="mouseEvent({type:'click',id:item})"  v-for="item in $attrs.data.list" :key="item" :class="$attrs.array[item].windowData.type == 2?'windowBox2':'windowBox'" :style="'background:'+($attrs.data.activation == item?'':'#555')+';'+($attrs.array[item].windowData.width?'width:' + $attrs.array[item].windowData.width + 'px;':'')+($attrs.array[item].windowData.height?'height:' + $attrs.array[item].windowData.height + 'px;':'')+'top: '+ $attrs.array[item].windowData.top +'px;left: ' + $attrs.array[item].windowData.left +'px;z-index:'+$attrs.array[item].windowData.zindex +';'">
      <div :value="item" class="moving" onmousedown="return false;" @mousemove="mouseEvent" @mousedown.stop="mouseEvent">
        <!--标题按钮-->
        <span class="icon-8 tbutton" onmousedown="return false;" @mousedown.stop="mouseEvent({type:'click',id:item})" @click.stop="mouseEvent({type:'close',id:item})"></span>
        <span class="icon-13 tbutton" onmousedown="return false;" @mousedown.stop="mouseEvent({type:'click',id:item})" @click.stop="mouseEvent({type:'minimize',id:item})"></span>
      </div>
      <div class="icon_box">
          <span :class="$attrs.array[item].icon" class="iconfont icon" :style="'color:'+($attrs.data.activation == item?'':'#555')+';'"></span>
      </div>
      <span class="text">{{$attrs.array[item].name}}</span>
      <div class="pages" @mousedown.stop="mouseEventStop" >
        <pagearticle></pagearticle>
      </div>
    </div>-0
    </transition-group>
  </div>
</template>

<script>
import pagearticle from "../pages/page_article"; //载入列表文章页面

var state = {
  x:0,
  y:0
}
export default {
  components:{
    pagearticle
  },
  name: 'taskbar',
  data () {
    return {

    }
  },
  methods:{
    mouseEvent(res){

      switch(res.type){
        case "mousedown":
          var domId = parseInt(res.target.getAttribute("value"));
          state.x = res.layerX;
          state.y = res.layerY;
          console.log(state.x,state.y);
          this.$attrs.data.move = domId;
          //触发窗口层次 选中的id
          this.$emit('windowlayer',domId);
          break;
        case "mousemove":
          //res.layerX
          if(this.$attrs.data.move >= 0 && this.$attrs.array[this.$attrs.data.move].windowData.type != 2){
            this.$attrs.array[this.$attrs.data.move].windowData.left = this.$attrs.mouse.x - state.x;
            this.$attrs.array[this.$attrs.data.move].windowData.top = this.$attrs.mouse.y - state.y;
          }
          break;
        case "mouseup":
          this.$attrs.data.move = -1;
          break;
        case "click":
          //触发窗口层次  选中的id
          this.$emit('windowlayer',res.id);
          break;
        case "minimize":
          //触发窗口层次  选中的id
          this.$emit('windowlayer',res.id);

          this.$attrs.array[res.id].windowData.hide = true;
          break;
        case "close":
          //触发窗口层次  选中的id
          this.$emit('windowlayer',res.id);
          for(var i=0;i<this.$attrs.data.list.length;i++){
            if(this.$attrs.data.list[i] == res.id){
              this.$attrs.data.list.splice(i,1);
            }
          }
          break;
      }
    },
    mouseEventStop(){

    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.tbutton{
  float: right;
  font-size: 18px;
  color: #fff;
  width: 32px;
  text-align: center;
}
.tbutton:hover{
  background: #2abab7;
}
.tbutton:active{
  background: #087674;
}
.windowBox{
  position: absolute;
  background: #0e9996;
  border-radius: 5px;
}
.windowBox2{
  position: absolute;
  background: #0e9996;
  border-radius: 0;
  left: 0;
  right: 0;
  bottom: 0;
  right: 0;
}
.windowBox .pages{
  position: absolute;
  top: 32px;
  right: 2px;
  bottom: 2px;
  left: 2px;
  background: #f6f6f6;
  border-radius: 5px;
  overflow: auto;
}
.windowBox2 .pages{
  position: absolute;
  top: 32px;
  right: 0;
  bottom: 0;
  left: 0;
  background: #f6f6f6;
  border-radius: 0;
  overflow: auto;
}
.icon_box{
    display: inline-block;
    background:#fff;
    height:18px;
    line-height:18px;
    width:18px;
    border-radius:90px;
    padding:5px;
    text-align:center;
    margin: 2px 2px 2px 10px;
}
.icon{
    font-size:18px;
    color:#0e9996;
}
.text{
  color: #fff;
}
.moving{
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 32px;
  line-height: 32px;
  z-index: 99;
  padding-right: 6px;
}
.closeAnimation-enter-active {
  animation: closeAnimation-in .2s;
}
.closeAnimation-leave-active {
  animation: closeAnimation-in .2s reverse;
}
@keyframes closeAnimation-in {
  0%{transform: scale3d(0,0,1)}
  100%{transform: scale3d(1,1,1)}
}
</style>
