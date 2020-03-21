import { OK, CREATED, UNPROCESSABLE_ENTITY, NOT_FOUND } from '../util'

const state = {
  score_types: null,
  organizations: null,
  game_numbers: null,
  players: null,
  user_scores: null,
  new_or_edit_score: {
    'game_number': 7,
    'score_type_id': 2,
    'match_day': null,
    'note': '',
    'organization_name1': null,
    'organization_name2': null,
    'player1_a_name' : null,
    'player1_b_name' : null,
    'player2_a_name' : null,
    'player2_b_name' : null,
  },
  apiStatus: null,
}

const getters = {}

const mutations = {
  setApiStatus (state, status) {
    state.apiStatus = status
  },
  setUserScores (state, userScores) {
    state.user_scores = userScores
  },
  setCreateFormData (state, createFormData ) {
    state.score_types = createFormData.score_types
    state.organizations = createFormData.organizations
    state.game_numbers = createFormData.game_numbers
    state.players = createFormData.players
  },
  setNewOrUpdateScore (state, score) {
    state.new_or_edit_score = score
  }
}

const actions = {
  async getUserScores(context, data) {
    context.commit('setApiStatus', null)
    const response = await axios.get('/api/scores', data)

    if (response.status === OK) {
      context.commit('setApiStatus', true)
      context.commit('setUserScores', response.data)
      return false
    }
  }, 
  async getScoresForm(context, id) {

    // フォームに必要な基本情報を取得して設定
    let response = await axios.get('/api/scores/create')
    if (response.status !== OK) {
      context.commit('error/setCode', response.status, { root: true })
      return false
    }
    
    context.commit('setCreateFormData', response.data)
    if(id == null){
      return;
    }

    // id指定の場合は編集フォームのため、保存してあるデータを取得
    response = await axios.get('/api/scores/' + id + '/edit')
    if (response.status !== OK) {
      context.commit('error/setCode', response.status, { root: true })
    }
    context.commit('setNewOrUpdateScore', response.data)

  },
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}