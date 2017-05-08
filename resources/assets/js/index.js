import 'es6-promise/auto'
import Vue from 'vue'
import App from './App.vue'
import store from './vuex/index.js'
import router from './route/routers.js'
import env from 'projectRoot/env.js'

require('./config/init')

router.beforeEach((to, from, next) => {
	if (to.matched.some(record => record.meta.requiresAuth)) {

        if (Laravel.user.id) {

            if(!store.getters.ws) {
              console.log('in ws');
              store.commit('setWS', new WebSocket('ws://'+ env.app_url +':3000/ws/chat'))
              store.getters.ws.onmessage = function(event) {
                let s = JSON.parse(event.data)
                console.log('onmessage')
                if(s.type == 'progress') {
                  store.commit('pushProgress', s.msg)
                }
              };

              store.getters.ws.onclose = function (evt) {
                console.log('[closed] ' + evt.code)
              }

              store.getters.ws.onerror = function (code, msg) {
                console.log('[ERROR] ' + code + ': ' + msg)
              }
            }

            next();
        } else {
            next({
                path: '/login'
            });
        }
    } else {
        next();
    }
});

router.afterEach(route => {
	
})

const app = new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app');

