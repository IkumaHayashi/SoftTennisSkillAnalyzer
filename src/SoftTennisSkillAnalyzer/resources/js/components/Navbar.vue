<template>
 <div>
  <b-navbar toggleable="lg" type="dark" variant="info">
    <RouterLink class="navbar-brand" to="/">
      そふてにあっぷ！
    </RouterLink>

    <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

    <b-collapse id="nav-collapse" is-nav>
      <!-- ログイン済の表示 -->
      <b-navbar-nav class="ml-auto" v-if="isLogin" >
        <RouterLink class="nav-link" to="/scores/create">
          スコア登録
        </RouterLink>
      </b-navbar-nav>

      <!-- 未ログインの表示 -->
      <b-navbar-nav class="ml-auto" v-else>
        <RouterLink class="nav-link" to="/login">
          ログイン / 会員登録
        </RouterLink>
      </b-navbar-nav>
    </b-collapse>
  </b-navbar>
</div>
</template>
<script>
export default {
  computed: {
    isLogin () {
      return this.$store.getters['auth/check']
    },
    username () {
      return this.$store.getters['auth/username']
    }
  }
}
</script>