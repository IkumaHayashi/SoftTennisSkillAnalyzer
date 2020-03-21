<template>
  <form @submit.prevent="storeScore" >
    <!-- シングルス or ダブルス -->
    <div class="form-group">
      <div v-for="score_type of score_types" :key="score_type.id"
        class="custom-control custom-radio custom-control-inline">
        <input type="radio" :id="'score_type_' + score_type.id" name="score_type" class="custom-control-input"
          v-model="new_or_edit_score.score_type_id" :value="score_type.id">
        <label class="custom-control-label" :for="'score_type_' + score_type.id">{{ score_type.name }}</label>
      </div>
    </div>

    <!-- ゲーム数 -->
    <div class="form-group">
      <div v-for="game_number of game_numbers" :key="game_number"
          class="custom-control custom-radio custom-control-inline">
        
        <input type="radio" :id="'game_numbers_' + game_number" name="game_numbers" class="custom-control-input"
          v-model="new_or_edit_score.game_number" :value="game_number">
        <label class="custom-control-label" :for="'game_numbers_' + game_number" >
          {{game_number}}ゲーム
        </label>
      </div>
    </div>

    <div class="form-group">
      <div class="input-group">
      
        <!-- チーム1 の組織名 -->
        <vue-simple-suggest
          v-model="new_or_edit_score.organization1_name"
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
          v-model="new_or_edit_score.player1_a_name"
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
          v-model="new_or_edit_score.player1_b_name"
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
          v-model="new_or_edit_score.organization2_name"
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
          v-model="new_or_edit_score.player2_a_name"
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
          v-model="new_or_edit_score.player2_b_name"
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
      <datepicker :language="ja" :format="DatePickerFormat" v-model="new_or_edit_score.match_day"
        id="match_day_picker" input-class="form-control"></datepicker>
    </div>

    <!-- メモ -->
    <div class="form-group">
      <label for="note">メモ</label>
      <input type="text" class="form-control" id="note" placeholder="メモを記入ください"
        v-model="new_or_edit_score.note">
    </div>

    <button class="btn btn-primary" type="submit">記録を開始</button>
  </form>
</template>

<script>
  import VueSimpleSuggest from 'vue-simple-suggest'
  import 'vue-simple-suggest/dist/styles.css' // Using a css-loader
  import Datepicker from 'vuejs-datepicker'
  import {ja} from 'vuejs-datepicker/dist/locale'
  import { OK, CREATED} from '../util'
  import { mapState, mapGetters } from 'vuex'

  export default {
    props: {
      id: {
        type: String,
      }
    },
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
        new_or_edit_score: state => state.score.new_or_edit_score
      }),
      ...mapGetters({
      })
    },
    data() {
      return {
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
      await this.setScoresForm()
    },
    async created() {
      console.log('created!');
      console.log(this.id);
    },
    methods: {
      // フォームに必要な情報を取得
      async setScoresForm () {
        await this.$store.dispatch('score/getScoresForm', this.id)
      },
      async storeScore () {
        const response = await axios.post(`/api/scores`, {
          new_or_edit_score: this.new_or_edit_score
        })
        if (response.status == CREATED) {
          // トップページに移動する
          console.log(response.data);
          console.log('/scores/' + response.data.id + '/edit/');
          this.$router.push('/scores/' + response.data.id + '/edit/')
        }
      }
    },
  }
</script>
