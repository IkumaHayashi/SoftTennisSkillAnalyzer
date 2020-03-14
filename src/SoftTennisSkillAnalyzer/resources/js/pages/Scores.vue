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
              <tr v-for="score in scores">
                <td>{{score.created_at}}</td> <!--TODO 試合日に変更する-->
                <td>
                  <p>
                    {{score.player1_1.organization.name}}
                    {{score.player1_1.name}}
                  </p>
                  <p>
                    {{score.player1_2.organization.name}}
                    {{score.player1_2.name}}</p>
                </td>
                <td>
                  vs
                </td>
                <td>
                  <p>
                    {{score.player2_1.organization.name}}
                    {{score.player2_1.name}}</p>
                  <p>
                    {{score.player2_2.organization.name}}
                    {{score.player2_2.name}}</p>
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
  export default {
    data() {
      return {
        scores: null,
      }
    },
    mounted() {
      axios
        .get('/api/scores')
        .then((response) => {
          console.log(response)
          this.scores = response.data
        });
    }
  }
</script>
