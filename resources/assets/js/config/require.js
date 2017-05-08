/**
 * js库初始化
 */

require('babel-polyfill'); // 解决手机端uc浏览器、qq浏览器和微信浏览器无法使用部分ES6语法
require('animate.css'); // 动画css插件
require('./echarts.js');

// 滚动条
import VuePerfectScrollbar from 'vue-perfect-scrollbar'
Vue.component('vue-perfect-scrollbar', VuePerfectScrollbar)

// 路由插件
import VueRouter from 'vue-router';	
Vue.use(VueRouter);


// 表单验证插件
import VeeValidate from 'vee-validate';	
import messagesZhCN from 'lang/validate/zh_CN.js';
import messagesEn from 'lang/validate/en.js';
Vue.use(VeeValidate, {
    fieldsBagName: 'vfields',
    errorBagName: 'verrors',
    locale: require('projectRoot/env.js').app_lang,
    dictionary: {
        'zh-CN': {
            messages: messagesZhCN
        },
        'en': {
            messages: messagesEn
        }
    }
});

// 注册element-ui全局组件
import enLocale from 'element-ui/lib/locale/lang/en'
import zhLocale from 'element-ui/lib/locale/lang/zh-CN'
import locale from 'element-ui/lib/locale'
import 'element-ui/lib/theme-default/index.css'
// 设置语言
switch (require('projectRoot/env.js').app_lang) {
	case 'zh-CN':
		locale.use(zhLocale);
		break;
	case 'en':
		locale.use(enLocale);
		break;
	default:
		locale.use(zhLocale);
}
import * as elementComponent from './element-ui.js'
/**
 * 饿了么组件按需引用组件有两种方式，其中Vue.use可能会导致属性冲突，故不推荐使用
 */
Object.keys(elementComponent).forEach(function (component) {
  Vue.component(elementComponent[component].name, elementComponent[component])
})


// vue-i18n初始化
import VueI18n from 'vue-i18n'
// 准备替换的语言
import en from 'lang/en/en.js'
import zhCN from 'lang/zh-CN/zh-CN.js'
var locales = {
  en: en,
  'zh-CN': zhCN
}
// 这次插件
Vue.use(VueI18n)
// 设置语言
Vue.config.lang = require('projectRoot/env.js').app_lang
// 设置语言文件
Object.keys(locales).forEach(function (lang) {
  Vue.locale(lang, locales[lang])
})



/**
 * css库
 */
require('sass/index.scss');