<template>
    <transition name="fade" mode="out-in">
        <div class="app-frame app-is-loading" v-if="is_loading" key="is-loading">
            <div class="spinner-grow text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div class="app-frame" v-else key="is-loading-fail">
            <template v-if="is_loading_error">
                <section class="zero-state full-width">
                    <article>
                        <h1>Oops! Something went wrong.</h1>
                    </article>
                </section>
            </template>
            <template v-else>
                <div class="app-sidebar" id="app-sidebar">
                    <sidebar></sidebar>
                </div>
                <div class="app-toolbar" id="app-toolbar">
                    <toolbar ></toolbar>
                </div>
                <div class="app-main" id="app-content">
                    <div class="app-main-container">
                        <transition name="fade" mode="out-in">
                            <router-view />
                        </transition>
                    </div>
                </div>
            </template>
        </div>
    </transition>
</template>


<script>
    import toolbar  from '@/layouts/partials/toolbar'
	import sidebar   from '@/layouts/partials/sidebar.vue'
    import { mapActions } from 'vuex';
    export default {
        name: 'defaultLayout',
        components : {
			toolbar, 
			sidebar 
        },
        data(){
            return {
                is_loading : true,
                is_loading_error : false
            }
        },
        computed:{
			
        },
        methods:{
            ...mapActions({
                'getUserInfo' : 'auth/getUserInfo'
            })
        },
        created(){
            this.getUserInfo().then((res)=>{

            })
            .catch(()=>{
                this.is_loading_error = 500
            })
            .finally(()=>{
                this.is_loading = false
            })
        },
        mounted(){
            
        }

    }
</script>

<style lang="scss" scoped >
    .app-frame{
        min-height: 100vh;
        width: 100%;
        position: relative;
        &.app-is-loading{
            display: flex;
            justify-content: center;
            align-items: center;
            .spinner-grow{
                width: 4rem;
                height: 4rem;
            }
        }
        .app-sidebar{
            width: 240px;
            position: fixed;
            top: 56px;
            left: 0;
            bottom: 0;
            border-right: 1px solid #dfe3e8;
            z-index: 512;
            background-color: #fff;
        }
        .app-toolbar{
            width: 100%;
            height: 56px;
            position: fixed;
            left: 0;
            top: 0;
            border-bottom: 1px solid #dfe3e8;
            z-index: 512;
        }
        .app-main{
            position: relative;
            padding: 56px 0 0 240px;
            min-height: 100vh;
            min-width: 1270px;
            .app-main-container{
                width: 1170px;
                margin-left: auto;
                margin-right: auto;
            }
        }
    }
    
    @media(max-width:1600px){
        .app-frame{
            .app-sidebar{
                width: 66px;
            }
            .app-toolbar{
                height: 56px;
            }
            .app-main{
                padding: 56px 0 0 66px;
            }
        }
    }

</style>