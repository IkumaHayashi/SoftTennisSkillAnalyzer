const state = {
  score_types: null,
  organizations: null,
  game_numbers: null,
  players: null,
  user_scores: null,
}

const getters = {}

const mutations = {
  setUserScores (state, userScores) {
    state.user_scores = userScores
  },
  setCreateFormData (state, createFormData ) {
    state.score_types = createFormData.score_types
    state.organizations = createFormData.organizations
    state.game_numbers = createFormData.game_numbers
    state.players = createFormData.players
  }
}

const actions = {
  async getUserScores(context, data) {
    const response = await axios.get('/api/scores', data)
    context.commit('setUserScores', response.data)
  }, 
  async getCreateForm(context, data) {
    const response = await axios.get('/api/scores/create', data)
    context.commit('setCreateFormData', response.data)
  }
}

export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}