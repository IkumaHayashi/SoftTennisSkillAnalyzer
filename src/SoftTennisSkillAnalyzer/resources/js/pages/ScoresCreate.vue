<template>
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">スコア作成</div>
        <div class="card-body">
            <form @submit.prevent="storeScore" >
          
            <!-- シングルス or ダブルス -->
            <div class="form-group">
              <div v-for="score_type of score_types" :key="score_type.id"
                class="custom-control custom-radio custom-control-inline">
                <input type="radio" :id="'score_type_' + score_type.id" name="score_type" class="custom-control-input"
                  v-model="new_score.score_type_id" :value="score_type.id">
                <label class="custom-control-label" :for="'score_type_' + score_type.id">{{ score_type.name }}</label>
              </div>
            </div>

            <!-- ゲーム数 -->
            <div class="form-group">
              <div v-for="game_number of game_numbers" :key="game_number"
                  class="custom-control custom-radio custom-control-inline">
                
                <input type="radio" :id="'game_numbers_' + game_number" name="game_numbers" class="custom-control-input"
                  v-model="new_score.game_number" :value="game_number">
                <label class="custom-control-label" :for="'game_numbers_' + game_number" >
                  {{game_number}}ゲーム
                </label>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
              
                <!-- チーム1 の組織名 -->
                <vue-simple-suggest
                  v-model="new_score.organization_name1"
                  :list="organizations"
                  :filter-by-query="true"
                  :styles="autoCompleteStyle"
                  display-attribute="name">
                </vue-simple-suggest>
                
                <!-- プレイヤー1-Aの名前 -->
                <div class="input-group-prepend">
                  <span class="input-group-text">A</span>
                </div>
                <vue-simple-suggest
                  v-model="new_score.player_name1_a"
                  :list="this.players"
                  :filter-by-query="true"
                  :styles="autoCompleteStyle"
                  display-attribute="name">
                </vue-simple-suggest>
                
                <!-- プレイヤー1-Bの名前 -->
                <div class="input-group-prepend">
                  <span class="input-group-text">B</span>
                </div>
                <vue-simple-suggest
                  v-model="new_score.player_name1_b"
                  :list="this.players"
                  :filter-by-query="true"
                  :styles="autoCompleteStyle"
                  display-attribute="name">
                </vue-simple-suggest>
              </div>
            </div>
            
            <div class="form-group">
                <!-- チーム2 の組織名 -->
              <div class="input-group">
                <vue-simple-suggest
                  v-model="new_score.organization_name2"
                  :list="this.organizations"
                  :filter-by-query="true"
                  :styles="autoCompleteStyle"
                  display-attribute="name">
                </vue-simple-suggest>
                
                <!-- プレイヤー2-Aの名前 -->
                <div class="input-group-prepend">
                  <span class="input-group-text">A</span>
                </div>
                <vue-simple-suggest
                  v-model="new_score.player_name2_a"
                  :list="this.players"
                  :filter-by-query="true"
                  :styles="autoCompleteStyle"
                  display-attribute="name">
                </vue-simple-suggest>
                
                <!-- プレイヤー2-Bの名前 -->
                <div class="input-group-prepend">
                  <span class="input-group-text">B</span>
                </div>
                <vue-simple-suggest
                  v-model="new_score.player_name2_b"
                  :list="this.players"
                  :filter-by-query="true"
                  :styles="autoCompleteStyle"
                  display-attribute="name">
                </vue-simple-suggest>
              </div>
            </div>

            <!-- 試合日 -->
            <div class="form-group">
              <label for="match_day_picker">試合日</label>
              <datepicker :language="ja" :format="DatePickerFormat" v-model="new_score.match_day"
                id="match_day_picker" input-class="form-control"></datepicker>
            </div>

            <!-- メモ -->
            <div class="form-group">
              <label for="note">メモ</label>
              <input type="text" class="form-control" id="note" placeholder="メモを記入ください"
                v-model="new_score.note">
            </div>

            <button class="btn btn-primary" type="submit">記録を開始</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import VueSimpleSuggest from 'vue-simple-suggest'
  import 'vue-simple-suggest/dist/styles.css' // Using a css-loader
  import Datepicker from 'vuejs-datepicker'
  import {ja} from 'vuejs-datepicker/dist/locale'
  import { OK } from '../util'
  import { mapState, mapGetters } from 'vuex'

  export default {
    components: {
      Datepicker,
      VueSimpleSuggest
    },
    computed: {
      ...mapState({
        score_types: state => state.score.score_types,
        organizations: state => state.score.organizations,
        game_numbers: state => state.score.game_numbers,
        players: state => state.score.players,
      }),
      ...mapGetters({
        isLogin: 'auth/check'
      })
    },
    data() {
      return {
        new_score: {
          'game_number': 7,
          'score_type_id': 2,
          'match_day': null,
          'note': '',
          'organization_name1': null,
          'organization_name2': null,
          'player_name1_a' : null,
          'player_name1_b' : null,
          'player_name2_a' : null,
          'player_name2_b' : null,
        },
        ja:ja,
        DatePickerFormat: 'yyyy年MM月dd日',
        autoCompleteStyle : {
          vueSimpleSuggest: "position-relative",
          inputWrapper: "",
          defaultInput : "form-control",
          suggestions: "position-absolute list-group z-1000",
          suggestItem: "list-group-item"
        }
      }
    },
    async mounted() {
      await this.setCreateForm()
    },
    async created() {
      if (!this.isLogin) {
        this.$router.push('/login')
      }
    },
    methods: {
      // フォームに必要な情報を取得
      async setCreateForm () {
        await this.$store.dispatch('score/getCreateForm')
      },
      async storeScore () {
        const response = await axios.post(`/api/scores`, {
          new_score: this.new_score
        })
      }
    },
  }
</script>
