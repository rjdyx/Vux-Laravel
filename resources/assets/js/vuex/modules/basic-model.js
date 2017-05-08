
const state = {
  navbarName: '',
  subNavBarName: ''
}

// getters
const getters = {}

// actions
const actions = {}

// mutations
const mutations = {

  setNavbarName(state, navbarName) {
    state.navbarName = navbarName
  },

  setSubNavBarName(state, subNavBarName) {
    state.subNavBarName = subNavBarName
  }

}

export default {
  state,
  getters,
  actions,
  mutations
}
