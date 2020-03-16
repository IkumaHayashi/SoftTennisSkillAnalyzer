<template>
 <div>
  <b-navbar toggleable="lg" type="dark" variant="info">
    <b-navbar-brand href="/">そふてにあっぷ！</b-navbar-brand>

    <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

    <b-collapse id="nav-collapse" is-nav>
      <!-- ログイン済の表示 -->
      <b-navbar-nav class="ml-auto" v-if="isLogin" >
        <b-nav-item href="/scores/create">スコア登録</b-nav-item>
      </b-navbar-nav>

      <!-- 未ログインの表示 -->
      <b-navbar-nav class="ml-auto" v-else>
        <b-nav-item href="/login">ログイン / 会員登録</b-nav-item>
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