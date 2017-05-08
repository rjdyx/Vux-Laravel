<template>
    <div>
        <div class="top">
            <el-button icon="arrow-left" @click="$router.back()">返回</el-button>
            <div class="title">{{title}}</div>
            <div v-if="!edit" class="status-btns">
                <ul>
                    <li>
                        提交后重置
                        <el-switch
                          v-model="reset"
                          on-text=""
                          off-text=""></el-switch>
                    </li>
                    <li>
                        提交后不返回
                        <el-switch
                          v-model="back"
                          on-text=""
                          off-text=""></el-switch>
                    </li>
                    
                </ul>
            </div>
        </div>
        <vue-perfect-scrollbar class="middle">
            <component v-if="edit" :is="popComponent" :form="formMsg" :edit="edit"></component>
            <component v-else :is="popComponent" :edit="edit" @addSuccess="addSuccess" ref="formPop"></component>
        </vue-perfect-scrollbar>
    </div>
</template>

<style lang="sass" scoped>
    @import "../../sass/function";

    .top {
        position: absolute;
        top: pxToRem(48);
        right: 0;
        width: 100%;
        height: pxToRem(48);
        line-height: pxToRem(48);
        z-index: 100;
        border-bottom: 1px solid #d9d9d9;
        background: white;

        button {
            margin-left: pxToRem(190);
        }

        .title {
            display: inline-block;
            margin-left: pxToRem(30);
        }

        .status-btns {
            float: right;
            margin-right: pxToRem(30);

            ul {

                li {
                    float: right;
                    margin-right: pxToRem(30);
                }
            }
        }
    }
</style>

<script>

    import {mapGetters, mapMutations} from 'vuex'
    import PopOrg from 'page/middle/components/message/pop-org.vue'
    import PopExpert from 'page/middle/components/message/pop-expert.vue'
    import PopEmergencyCrew from 'page/middle/components/message/pop-emergencycrew.vue'
    import PopCondition from 'page/middle/components/message/pop-condition.vue'
    import PopPlan from 'page/middle/components/message/pop-plan.vue'
    import PopInformation from 'page/middle/components/message/pop-information.vue'
    import PopEvent from 'page/middle/components/reaction/pop-event.vue'
    import EventHandle from 'page/middle/components/reaction/event-handle.vue'
    import EventProgress from 'page/middle/components/reaction/event-progress.vue'
    import PopUser from 'page/middle/components/rbac/pop-user.vue'

    export default {
        name: 'NewForm',
        props: {
            title: {
                type: String,
                default: '新增'
            }
        },
        data () {
            return {
                popComponent: null,
                // 提交后是否返回
                back: false,
                // 提交后是否重置表单
                reset: false
            }
        },
        computed: {

            ...mapGetters([
                'formMsg'
            ]),

            model () {
                return this.$route.params.model
            },
            edit () {
                return this.$route.params.type === 'edit'?true:false
            }
        },
        mounted () {
            
            switch(this.model) {
                case 'org':
                    this.popComponent = PopOrg
                    break
                case 'expert':
                    this.popComponent = PopExpert
                    break
                case 'emergencycrew':
                    this.popComponent = PopEmergencyCrew
                    break
                case 'waningcondition':
                    this.popComponent = PopCondition
                    break
                case 'plan':
                    this.popComponent = PopPlan
                    break
                case 'information':
                    this.popComponent = PopInformation
                    break
                case 'event-1':
                case 'event-4':
                    this.popComponent = PopEvent
                    break
                case 'handle-1':
                case 'handle-4':
                    this.popComponent = EventHandle
                    break
                case 'progress-2':
                case 'progress-3':
                case 'progress-5':
                case 'progress-6':
                    this.popComponent = EventProgress
                    break
                case 'user':
                    this.popComponent = PopUser
                    break
            }
        },
        methods: {
            ...mapMutations([
                'setFormMsg'
            ]),

            addSuccess () {
                if(!this.back){
                    this.$router.back()
                }
                if(this.reset){
                    $('.form-pop')[0].reset()
                }
            }
        },
        destroyed () {
            this.setFormMsg(null)
        }
    }
</script>
