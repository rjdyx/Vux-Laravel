
const state = {
  formMsg: null
}

// getters
const getters = {}

// actions
const actions = {}

// mutations
const mutations = {
  /**
   * 设置表单对象信息
   */
  setFormMsg(state, formMsg) {
    state.formMsg = formMsg;
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
