<template>
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">スコア作成</div>
        <div class="card-body">
            <form action="/scores" method="POST">
          
            <!-- シングルス or ダブルス -->
            <div class="form-group">
              <div v-for="score_type,key of score_types" :key="key"
                class="custom-control custom-radio custom-control-inline">
                <input type="radio" :id="'score_type_' + key" name="score_type" class="custom-control-input"
                  v-model="selected_score_type":value="key">
                <label class="custom-control-label" :for="'score_type_' + key">{{ score_type }}</label>
              </div>
            </div>

            <!-- ゲーム数 -->
            <div class="form-group">
              <div v-for="game_number of game_numbers" :key="game_number"
                  class="custom-control custom-radio custom-control-inline">
                
                <input type="radio" :id="'game_numbers_' + game_number" name="game_numbers" class="custom-control-input"
                  v-model="selected_game_number" :value="game_number">
                <label class="custom-control-label" :for="'game_numbers_' + game_number" >
                  {{game_number}}ゲーム
                </label>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <div class="dropdown">
                  <input type="text" name="list_name" class="form-control dropdown-toggle" data-toggle="dropdown"
                        placeholder="所属"  aria-label="チーム1">
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li v-for="organization in organizations" :key="organization.id"
                        class="autocomplete" :data-autocomplete=organization.name data-target="list_name">
                      <a href="#">{{ organization.name }}</a>
                    </li>
                  </ul>
                </div>
                
                <div class="input-group-prepend">
                  <span class="input-group-text">A</span>
                </div>
                <input type="text" class="form-control" aria-label="プレイヤー1-A">
                
                <div class="input-group-prepend">
                  <span class="input-group-text">B</span>
                </div>
                <input type="text" class="form-control" aria-label="プレイヤー1-B">
              </div>
            </div>
            
            <div class="form-group">
              <!-- 対戦相手のチーム -->
              <div class="input-group">
                <div class="dropdown">
                  <input type="text" name="list_name" class="form-control dropdown-toggle" data-toggle="dropdown"
                        placeholder="所属"  aria-label="チーム2">
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li v-for="organization in organizations" :key="organization.id"
                        class="autocomplete" :data-autocomplete=organization.name data-target="list_name">
                      <a href="#">{{ organization.name }}</a>
                    </li>
                  </ul>
                </div>
                <div class="input-group-prepend">
                  <span class="input-group-text">A</span>
                </div>
                <input type="text" class="form-control" aria-label="プレイヤー2-A">
                <div class="input-group-prepend">
                  <span class="input-group-text">B</span>
                </div>
                <input type="text" class="form-control" aria-label="プレイヤー2-B">
              </div>
            </div>

            <!-- 試合日 -->
            <div class="form-group">
              <label for="match_day_picker">試合日</label>
              <datepicker :language="ja" :format="DatePickerFormat" v-model="selected_match_day"
                id="match_day_picker" input-class="form-control"></datepicker>
            </div>

            <!-- メモ -->
            <div class="form-group">
              <label for="note">メモ</label>
              <input type="text" class="form-control" id="note" placeholder="メモを記入ください">
            </div>

            <button class="btn btn-primary" type="submit">作成</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import Datepicker from 'vuejs-datepicker';
  import {ja} from 'vuejs-datepicker/dist/locale'
  export default {
    components: {
      Datepicker
    },
    data() {
      return {
        game_numbers: null,
        score_types: null,
        organizations: null,
        selected_game_number: null,
        selected_score_type: null,
        selected_match_day: null,
        
        ja:ja,
        DatePickerFormat: 'yyyy年MM月dd日',
      }
    },
    mounted() {
      axios
        .get('/api/scores/create')
        .then((response) => {
          this.organizations = response.data.oraganization;
          this.game_numbers = response.data.game_numbers;
          this.score_types = response.data.score_types;
          console.log(response.data.game_numbers);
          console.log(response.data.score_types);
        });
    },
    methods: {
      post() {
        console.log('post!!');
        const params = new URLSearchParams();
        params.append('game_number', this.selected_game_number);
        params.append('score_type', this.selected_score_type);
        params.append('match_day', this.selected_match_day);

        axios.post('/api/scores', params,)
          .then(respose => {
          })
      }
    }
  }
</script>
