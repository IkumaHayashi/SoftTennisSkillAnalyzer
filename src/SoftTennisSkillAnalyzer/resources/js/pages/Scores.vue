<template>
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">スコア一覧</div>
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">試合日</th>
                <th scope="col" colspan="3">組み合わせ</th>
                <th scope="col">結果</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="score in user_scores">
                <td>{{score.match_day}}</td>
                <td>
                  {{score.organization1.name}}
                  <p>
                    {{score.player1_a.name}}
                  </p>
                  <p>
                    {{score.player1_b.name}}
                  </p>
                </td>
                <td>
                  vs
                </td>
                <td>
                  {{score.organization2.name}}
                  <p>
                    {{score.player2_a.name}}
                  </p>
                  <p>
                    {{score.player2_b.name}}
                  </p>
                </td>
                <td>{{score.match_day}}</p></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import { mapState, mapGetters } from 'vuex'
  export default {
    computed: {
      ...mapState({
        user_scores: state => state.score.user_scores,
      }),
      ...mapGetters({
        isLogin: 'auth/check'
      })
    },
    data() {
      return {
        scores: null,
      }
    },
    methods: {
      // フォームに必要な情報を取得
      async setUserScores () {
        await this.$store.dispatch('score/getUserScores')
      },
    },
    async mouted() {
      await this.setUserScores()
    },
    async created() {
      if (!this.isLogin) {
        this.$router.push('/login')
      }
    },
  }
</script>
