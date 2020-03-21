import Vue from 'vue'
import VueRouter from 'vue-router'

// ページコンポーネントをインポートする
import Scores from './pages/Scores.vue'
import ScoresCreate from './pages/ScoresCreate.vue'
import ScoresEdit from './pages/ScoresEdit.vue'
import Login from './pages/Login.vue'
import SystemError from './pages/errors/System.vue'

// Vuesのストアをインポート
import store from './store'

// VueRouterプラグインを使用する
// これによって<RouterView />コンポーネントなどを使うことができる
Vue.use(VueRouter)

// パスとコンポーネントのマッピング
const routes = [
  {
    path: '/',
    component: Scores
  },
  {
    path: '/scores',
    component: Scores
  },
  {
    path: '/scores/create',
    component: ScoresCreate
  },
  {
    path: '/scores/:id/edit',
    name: 'scores.edit',
    component: ScoresEdit,
    props: true
  },
  {
    path: '/500',
    component: SystemError
  },
  {
    path: '/404',
    component: SystemError
  },
  {
    path: '/login',
    component: Login,
    beforeEnter (to, from, next) {
      if (store.getters['auth/check']) {
        next('/')
      } else {
        next()
      }
    }
  }
]

// VueRouterインスタンスを作成する
const router = new VueRouter({
  mode: 'history',
  routes
})

// VueRouterインスタンスをエクスポートする
// app.jsでインポートするため
export default router