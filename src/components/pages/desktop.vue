<template>
  <div class="bg" onmousedown="return false" oncontextmenu="return false" @contextmenu="upmouse" @mousemove="upmouse" @click="upmouse">
    <desktopicon :data="taskbar" :array="Icon" :element="item" :boxid="index" v-for="(item, index) in Icon" :key="index" @InitializationWindow="InitializationWindow" @windowlayer="windowlayer"></desktopicon>
    <taskbar :data="taskbar" :array="Icon" @windowlayer="windowlayer"></taskbar>
    <window :data="taskbar" :array="Icon" :mouse="mouse" ref="window" @windowlayer="windowlayer"></window>
  </div>
</template>

<script>
/*==============================================
/* ● 加载组件
/*=============================================*/
//桌面图标
import desktopicon from '../parts/desktop-icon'
import taskbar from '../parts/taskbar'
import window from '../parts/window'
//Vue.component('desktopicon',desktopicon); //全局添加

export default {
  //任务栏
  components:{
    taskbar,
    desktopicon,
    window
  },
  name: 'desktop',
  data () {
    return {
      msg: '',
      mouse:{x:0,y:0},
      //任务栏数据
      taskbar:{
        list:[], //任务栏列表
        activation:0, //激活的任务
        move:-1 //激活移动的任务
      },
      //Icon里面定义窗口数据windowData有宽度不可调的，无宽度可调。
      Icon:[
        {icon:"icon-1",name:"视频教程",select:"flase",windowData:{
          url:"", //连接地址
          target:"window", //page新窗口打开页面，window打开窗口
          zindex:99, //层级
          hide:false, //隐藏 (true 最小化),(false 显示)
          type:0, //0创建后居中，1按照位置初始化  2全屏幕(位置无效，宽高无效)
          top:0, //位置 top left 宽高 width height
          left:0
        }},
        {icon:"icon-2",name:"前端日记",select:"flase",windowData:{
          url:"",
          target:"window", //page新窗口打开页面，window打开窗口
          zindex:99,
          hide:false, //隐藏 (true 最小化),(false 显示)
          type:2, //0创建后居中，1按照位置初始化  2全屏幕
          top:100,
          left:500
        }},
        {icon:"icon-3",name:"我的简历",select:"flase",windowData:{
          url:{name:"page_article_detailed",params:{newsId:"44"}},
          target:"page", //page新窗口打开页面，window打开窗口
          zindex:99,
          hide:false, //隐藏 (true 最小化),(false 显示)
          type:1, //0创建后居中，1按照位置初始化  2全屏幕
          top:200,
          left:500
        }},
        {icon:"icon-4",name:"留言板",select:"flase",windowData:{
          url:"",
          target:"window", //page新窗口打开页面，window打开窗口
          zindex:99,
          hide:false, //隐藏 (true 最小化),(false 显示)
          type:0, //0创建后居中，1按照位置初始化  2全屏幕
          top:50,
          left:800
        }},
        {icon:"icon-4",name:"留言板",select:"flase",windowData:{
          url:"",
          target:"window", //page新窗口打开页面，window打开窗口
          zindex:99,
          type:0, //0创建后居中，1按照位置初始化 2全屏幕
          hide:false, //隐藏 (true 最小化),(false 显示)
          top:50,
          left:800,
          width:160
        }},
      ]
    }
  },
  mounted(){
    document.addEventListener('mouseup',function(){
      this.$refs.window.mouseEvent({type:"mouseup"});
    }.bind(this),true)
  },
  methods:{
    /*==============================================
    /* ● 初始化窗口
    /*=============================================*/
    InitializationWindow(res){
      this.taskbar.list.push(res);
      var windowData =  this.Icon;
      var window = {
        innerWidth: document.documentElement.clientWidth,
        innerHeight: document.documentElement.clientHeight
      }
      var i = res;
      switch(windowData[i].windowData.type){
        case 0:
            windowData[i].windowData.width = (windowData[i].windowData.width?windowData[i].windowData.width:800);
            windowData[i].windowData.height = (windowData[i].windowData.height?windowData[i].windowData.height:600);
            windowData[i].windowData.left = ((window.innerWidth - windowData[i].windowData.width) / 2);
            windowData[i].windowData.top = ((window.innerHeight - windowData[i].windowData.height) / 2);
          break;
        case 1:
            windowData[i].windowData.width = (windowData[i].windowData.width?windowData[i].windowData.width:800);
            windowData[i].windowData.height = (windowData[i].windowData.height?windowData[i].windowData.height:600);
          break;
        case 2:
            windowData[i].windowData.width = null;
            windowData[i].windowData.height = null;
            windowData[i].windowData.left = 0;
            windowData[i].windowData.top = 0;
          break;
      }
    },
    /*==============================================
    /* ● 窗口层次
    /*=============================================*/
    windowlayer(res){
        this.taskbar.activation = res;
        var element = this.Icon;
        var max = 100;
        for(var i=0;i<element.length;i++){
            if(element[i].windowData.zindex > max){
                max = element[i].windowData.zindex;
            }
        }
        if(max != element[res].windowData.zindex){
          element[res].windowData.zindex = max + 1;
        }
    },
    /*==============================================
    /* ● 重置桌面图标不选中转态,绑定鼠标事件(左单击、右单击事件、鼠标移动事件)
    /*=============================================*/
    upmouse(res){
      
      //鼠标移动不执行
      if(res.type != "mousemove"){
        for(var i=0;i<this.Icon.length;i++){
          this.Icon[i].select = "false";
        }
      }

      switch(res.type){
        case "click": //左单击
        break;
        case "contextmenu": //右单击事件
        break;
        case "mousemove": //鼠标移动事件
          this.mouse.x = res.x;
          this.mouse.y = res.y;
          this.$refs.window.mouseEvent({type:"mousemove"});
        break;
      }
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.bg{
  position: absolute;
  top: 0;
  right: 0;
  left: 0;
  bottom: 0;
  overflow: hidden;
  background: url('../../assets/1.jpg') center;
  background-size: cover;
}
</style>
