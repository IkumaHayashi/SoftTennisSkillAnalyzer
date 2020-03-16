<template>
  <footer class="footer">
    <button v-if="isLogin" @click="logout"
            type="button" class="btn btn-link">
      ログアウト
    </button>
    <RouterLink v-else class="btn btn-link" to="/login">
      ログイン / 会員登録
    </RouterLink>
  </footer>
</template>

<script>
import { mapState, mapGetters } from 'vuex'

export default {
  computed: {
    ...mapState({
      apiStatus: state => state.auth.apiStatus
    }),
    ...mapGetters({
      isLogin: 'auth/check'
    })
  },
  methods: {
    async logout () {
      await this.$store.dispatch('auth/logout')

      if (this.apiStatus) {
        this.$router.push('/login')
      }
    }
  }
}
</script>