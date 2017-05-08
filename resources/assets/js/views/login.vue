/**
 * 
 * 登录组件
 * @description 
 * @author 苏锐佳
 * @date 2017/02/22
 * 
 */
<template>
    <div class="login">
        <div class="item">
        	<label for="email">邮 箱</label>
        	<input 
        		v-focus 
        		v-model="user.email" 
        		v-validate.initial="user.email" 
                data-vv-rules="required" 
                data-vv-as="用户名" 
                :placeholder="userNamePlaceholder" 
                :class="{red: isNameError, 'el-input__inner': true}" 
        		id="email" 
        		type="text">
        </div>
        <div class="item">
        	<label for="password">密 码</label>
        	<input 
        		v-model="user.password" 
        		v-validate.initial="user.password" 
                data-vv-rules="required" 
                data-vv-as="密码" 
                :placeholder="passwordPlaceholder" 
                :class="{red: isPasswordError, 'el-input__inner': true}" 
        		id="password" 
        		type="password">
        </div>
        <div class="item">
        	<el-button size="large" @click="login" :disabled="isLogin">{{loginBtn}}</el-button>
        </div>
    </div>
</template>
<style lang="sass" scoped>

    @import "../../sass/function";

    .login {
	    position: absolute;
	    width: 300px;
	    height: 165px;
	    top: 0;
	    bottom: 0;
	    left: 0;
	    right: 0;
	    margin: auto;

	    .item {
    	    margin-bottom: 20px;
	    }

	    label {
    	    display: inline-block;
    		margin-right: 50px;
	    }

	    #email, #password {
    	    display: inline-block;
	    	width: 200px;
	    }

	    button {
	    	width: 100%;
	    }
    }

        /*placeholder*/
    ::-webkit-input-placeholder {
        /* WebKit browsers */
        color: #d6d6d7 !important; 
    }

    :-ms-input-placeholder {
        /* Internet Explorer 10+ */
        color: #d6d6d7 !important; 
    }

    /*placeholder*/
    input[class=red]::-webkit-input-placeholder {
        /* WebKit browsers */
        color: #fd6e64 !important; 
    }

    input[class=red]:-ms-input-placeholder {
        /* Internet Explorer 10+ */
        color: #fd6e64 !important; 
    }

</style>
<script>

    export default{
        name: 'Login',
        data () {
        	return {
        		user: {
        			email: '',
	        		password: ''
        		},
        		// 用户名表单验证出错的标志
                isNameError: false,
                // 密码表单验证出错的标志
                isPasswordError: false,
                // 后端用户名或密码不匹配的标志
                isError: false,
                // 登录按钮的文本
                loginBtn: '登 录',
                // 登录按钮是否可用的标志，false表示可用
                isLogin: false
        	}
        },
        computed: {

            userNamePlaceholder () {
                if(this.verrors.has('email')) {
                    this.isNameError = true;
                    return this.verrors.first('email');
                }
                return '';
            },
            passwordPlaceholder () {
                if(this.verrors.has('password')) {
                    this.isPasswordError = true;
                    return this.verrors.first('password');
                }
                return '';
            }
        },
        mounted () {
        	if(Laravel.user.id) {
        		this.$router.back()
        	}
        },
        methods: {

        	login () {
        		// 验证表单
                this.$validator.validateAll();
                // 如果表单报错则不提交
                if(this.verrors.any()) {
                	console.log('in error');
                	console.log(this.verrors.has('email'));
                    return false;
                }else {
                    this.loginBtn = '登录中...'
                    this.isLogin = true;
	        		axios.post('/login', this.user)
	        			.then((responce) => {
	        				Laravel.user.id = responce.data.id
	        				Laravel.user.name = responce.data.name
	        				Laravel.user.email = responce.data.email
	        				this.$router.push('/')
	        			})
        		}
        	}
        }
    }
</script>
