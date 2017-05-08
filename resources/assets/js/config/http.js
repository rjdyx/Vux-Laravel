/**
 * http请求过滤
 */

require('./require');

axios.defaults.headers.common = {
    'X-CSRF-TOKEN': Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
};

// axios
axios.interceptors.request.use(function (config) {
	// let method = config.method
	// if(method !== 'get' && method !== 'post') {
	// 	config.method = 'post'
	// 	config.headers = Object.assign(config.headers,{'X-HTTP-Method-Override': method.toUpperCase()});
	// }
	return config;
}, function (error) {
	return Promise.reject(error)
});

axios.interceptors.response.use(function (response) {
    return response;
}, function (error) {
    return Promise.reject(error)
});