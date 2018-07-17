<template>
  <div class="Box" v-if="$attrs.data.list.length > 0" @mousemove="mouseEvents" @mouseout="mouseEvents">
    <div class="taskbarBox">
        <div v-for="item in $attrs.data.list" :key="item" class="buttonbox" @click.stop="mouseEvent(item)">
            <div class="icon_box">
                <span :class="$attrs.array[item].icon" class="iconfont icon" :style="'color:'+($attrs.data.activation == item?'':'#555')+';'"></span>
            </div>

            <!--<div class="text">{{$attrs.array[item].name}}</div> 任务栏标题-->
        </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'taskbar',
  data () {
    return {

    }
  },
  mounted (){
    
  },
  methods:{
    mouseEvent(res){

        if(!this.$attrs.array[res].windowData.hide){
            if(this.$attrs.data.activation == res){//任务栏同级再次点击，最小化窗口
                this.$attrs.array[res].windowData.hide = true;
                this.$attrs.data.activation = this.$attrs.data.lastactivation;
            };
        }else{
            this.$attrs.array[res].windowData.hide = false;
        }
        
        //触发窗口层次 选中的id
        this.$emit('windowlayer',res);
    },
    mouseEvents(res){
        switch(res.type){
            case "mousemove":
            break;
            case "mouseout":
            break;
        }
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.Box{
    position: absolute;
    bottom: 50px;
    left: 0;
    right: 0;
    text-align: center;
}
.taskbarBox{
    display: inline-block;
    border-radius: 15px;
    background: rgba(255, 255, 255, .3);
    padding: 10px 32px ;
}
.icon_box{
    background:#fff;
    height:32px;
    line-height:32px;
    width:32px;
    border-radius:90px;
    padding:10px;
    text-align:center;
}
.buttonbox{
    display: inline-block;
    margin: 0 10px;
}
.icon{
    font-size:32px;
    color:#0e9996;
}
.text{
    color:#fff;
    margin-top: 5px;
}
</style>
