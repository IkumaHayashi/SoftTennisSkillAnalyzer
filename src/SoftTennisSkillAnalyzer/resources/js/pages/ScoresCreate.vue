<template>
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">スコア作成</div>
        <div class="card-body">
          <ScoresForm />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import ScoresForm from '../components/ScoresForm'
  import { mapState, mapGetters } from 'vuex'

  export default {
    components: {
      ScoresForm,
    },
    computed: {
      ...mapState({
      }),
      ...mapGetters({
        isLogin: 'auth/check'
      })
    },
    data() {
      return {
      }
    },
    async mounted() {
    },
    async created() {
      if (!this.isLogin) {
        this.$router.push('/login')
      }
    },
    methods: {
    },
  }
</script>
