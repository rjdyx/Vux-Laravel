/**
 * 
 * 登录组件
 * @description 
 * @author 苏锐佳
 * @date 2016/12/14
 * 
 */
<template>
    <div class="content">
        <group>
            <x-input ref="email" title="邮箱" name="email" placeholder="输入邮箱" v-model="user.email" is-type="email"></x-input>
            <x-input ref="password" title="密码" type="password" placeholder="输入密码" v-model="user.password" :min="6"></x-input>
        </group>
        <div style="padding:15px;">
            <x-button @click.native="login" type="primary">登 录</x-button>
        </div>
    </div>
    
</template>

<style lang="sass" scoped>

    @import "../../sass/function";

    .content {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        height: pxToRem(300);
    }

</style>

<script>

    import {XInput, Group, XButton, Toast} from 'vux'

    export default{
        name: 'Login',
        data(){
            return{
                user: {
                    email: '',
                    password: ''
                }
            }
        },
        components: {
            XInput, Group, XButton, Toast
        },
        methods: {

            /**
             * 登录
             */
            login () {
                if(this.user.email == '') {
                    this.$toast('请输入邮箱')
                    return false
                }
                if(this.user.password == '') {
                    this.$toast('请输入密码')
                    return false
                }
                if(this.$refs.email.valid && this.$refs.password.valid) {
                    this.$vux.loading.show({
                        text: '登录中...'
                    })
                    axios.post('login', this.user)
                        .then((responce) => {
                            if(responce.data) {
                                this.$vux.loading.hide()
                                Laravel.user.id = responce.data.id
                                Laravel.user.name = responce.data.name
                                Laravel.user.email = responce.data.email
                                this.$router.push('/')
                            }
                        })
                        .catch((error) => {
                            this.$vux.loading.hide()
                            if(error.response.status !=200) {
                                this.$toast('用户名或密码出错', '10rem')
                                return false
                            }
                        })
                }else {
                    this.$toast('输入出错')
                    return false
                }
            },

            change (val) {
                console.log(val);
            }
        }
    }
</script>
