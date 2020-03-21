<template>
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">スコア記録</div>
        <div class="card-body">
          <ScoresForm :id="id"/>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import { OK } from '../util'
  import ScoresForm from '../components/ScoresForm'
  import { mapState, mapGetters } from 'vuex'

  export default {
    props: {
      id: {
        type: String,
        required: true
      }
    },
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
      console.log('mounted');
      console.log(this.id);
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
