<template>
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <!-- ナビバー -->
        <div class="card-header">
          <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item" @click="tab = 1">
              <a class="nav-link"
                :class="{'nav-item nav-link active': tab === 1 }">
                ログイン
              </a>
            </li>
            <li class="nav-item" @click="tab = 2">
              <a class="nav-link"
                :class="{'nav-item nav-link active': tab === 2 }">
                会員登録
              </a>
            </li>
          </ul>
        </div>
        <!-- ログインフォーム -->
        <div class="card-body" v-show="tab === 1">
          <form @submit.prevent="login">
            <div v-if="loginErrors" class="errors">
              <ul v-if="loginErrors.email">
                <li v-for="msg in loginErrors.email" :key="msg">{{ msg }}</li>
              </ul>
              <ul v-if="loginErrors.password">
                <li v-for="msg in loginErrors.password" :key="msg">{{ msg }}</li>
              </ul>
            </div>
            <div class="form-group">
              <label for="login-email">メールアドレス</label>
              <input type="email" class="form-control" id="login-email" v-model="loginForm.email">
            </div>
            <div class="form-group">
              <label for="login-password">パスワード</label>
              <input type="password" class="form-control" id="login-password" v-model="loginForm.password">
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-outline-info">ログイン</button>
            </div>
          </form>
        </div>
        <!-- 会員登録フォーム -->
        <div class="card-body" v-show="tab === 2">
          <form class="form-group" @submit.prevent="register">
            <div v-if="registerErrors" class="errors">
              <ul v-if="registerErrors.name">
                <li v-for="msg in registerErrors.name" :key="msg">{{ msg }}</li>
              </ul>
              <ul v-if="registerErrors.email">
                <li v-for="msg in registerErrors.email" :key="msg">{{ msg }}</li>
              </ul>
              <ul v-if="registerErrors.password">
                <li v-for="msg in registerErrors.password" :key="msg">{{ msg }}</li>
              </ul>
            </div>
            <div class="form-group">
              <label for="username">ニックネーム</label>
              <input type="text" class="form-control" id="username" v-model="registerForm.name">
            </div>
            <div class="form-group">
              <label for="email">メールアドレス</label>
              <input type="email" class="form-control" id="email" v-model="registerForm.email">
            </div>
            <div class="form-group">
              <label for="password">パスワード</label>
              <input type="password" class="form-control" id="password" v-model="registerForm.password">
            </div>
            <div class="form-group">
              <label for="password-confirmation">確認用パスワード</label>
              <input type="password" class="form-control" id="password-confirmation" v-model="registerForm.password_confirmation">
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-outline-info">登録</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex'
export default {

  data () {
    return {
      tab: 1,
      loginForm: {
        email: '',
        password: ''
      },
      registerForm: {
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
      }
    }
  },
  computed: {
    ...mapState({
      apiStatus: state => state.auth.apiStatus,
      loginErrors: state => state.auth.loginErrorMessages,
      registerErrors: state => state.auth.registerErrorMessages
    })
  },
  created () {
    this.clearError()
  },
  methods: {
    async login () {
      // authストアのloginアクションを呼び出す
      await this.$store.dispatch('auth/login', this.loginForm)

      if (this.apiStatus) {
        console.log('Login.vue apiStatus = ' + this.apiStatus)
        // トップページに移動する
        this.$router.push('/')
      }
    },
    async register () {
      // authストアのresigterアクションを呼び出す
      await this.$store.dispatch('auth/register', this.registerForm)

      if (this.apiStatus) {
        // トップページに移動する
        this.$router.push('/')
      }
    },
    // 他のページから遷移したときにメッセージを残したくないためエラーメッセージをクリアする
    clearError () {
      this.$store.commit('auth/setLoginErrorMessages', null)
      this.$store.commit('auth/setRegisterErrorMessages', null)
    },
  }
}
</script>