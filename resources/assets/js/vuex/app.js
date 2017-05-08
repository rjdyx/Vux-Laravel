// Vuex
import Vuex from 'vuex';
import Vue from 'vue';

const store = new Vuex.Store({
    state: {
        formMsg: null,
        showBack: false,
        menu: null,
        ws: null,
        earlyWaningData: [{name: '', location: '无数据', status: 0}],
        emergencyData: [{name: '', location: '无数据', status: 0}],
        progress: [],
        selectedItem: '预警事件'
    },

    getters: {

        formMsg: (state) => {
            return state.formMsg
        },
        
        ws: (state) => {
            return state.ws
        },

        earlyWaningData: (state) => {
            return state.earlyWaningData
        },

        emergencyData: (state) => {
            return state.emergencyData
        },

        progress: (state) => {
            return state.progress
        },

        selectedItem: (state) => {
            return state.selectedItem
        }
    },

    mutations: {

        /**
          * 设置表单对象信息
          */
        setFormMsg(state, formMsg) {
            state.formMsg = formMsg;
        },

        setShowBack(state, showBack) {
            state.showBack = showBack
        },

        setMenu(state, menu) {
            state.menu = menu
        },

        setWS(state, ws) {
            state.ws = ws
        },

        setEarlyWaningData(state, data) {
            state.earlyWaningData = data
        },

        pushEarlyWaningData(state, data) {
            state.earlyWaningData.unshift(data)
        },

        setEmergencyData(state, data) {
            state.emergencyData = data
        },

        pushEmergencyData(state, data) {
            state.emergencyData.unshift(data)
        },

        setProgress(state, progress) {
            state.progress = progress
        },

        pushProgress(state, progress) {
            state.progress.unshift(progress)
        },

        changeEventStatus(state, event) {
            if(event.status == 3) {
                for(let item of state.earlyWaningData) {
                    if(item.id == event.id) {
                        item.status = event.status
                    }
                }
            }

            if(event.status == 6) {
                for(let item of state.emergencyData) {
                    if(item.id == event.id) {
                        item.status = event.status
                    }
                }
            }
            
        },

        setSelectedItem(state, selectedItem) {
            state.selectedItem = selectedItem
        }
    }
    
    // actions: {
    //     setUserInfo(context, user) {
    //         context.commit('setUserInfo', user);
    //     }
    // }
    
});

export default store;