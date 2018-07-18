import Vue from 'vue'
import Router from 'vue-router'
/*==============================================
/* ● 加载页面
/*=============================================*/
import desktop from '@/components/pages/desktop'
import page_article_detailed from '@/components/pages/page_article_detailed'
/*==================================================
/* ● 载入公共头组件
===================================================*/
import headnav from '@/components/parts/headnav'

Vue.component('headnav',headnav);
Vue.use(Router);


export default new Router({
  routes: [
    {
      path: '/',
      name: 'home',
      component:desktop
    },{
      path: '/page/article/detailed/:newsId/',
      name: 'page_article_detailed',
      component:page_article_detailed
    },{
      path: '*',
      name: 'error',
      component:desktop
    }
  ]
})
