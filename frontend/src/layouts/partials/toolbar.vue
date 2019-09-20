<template>
    <div class="app-toolbar-container">
        <div class="app-toolbar-container-left">
            <div class="app-toolbar-logo">
                <img src="@/assets/logo.svg" alt="">
            </div>
        </div>
        <div class="app-toolbar-container-right">
            <div class="dropdown">
                <button class="dropdown-toggle" type="button" data-toggle="dropdown" data-display="static">
                    <template v-if="user">
                        <div class="item-img">
                            {{ user.name | avatar}}
                        </div>
                        <div class="item-text">
                            {{ user.name }}
                        </div>
                    </template>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" >
                        <span class="dropdown-item-icon">
                            <svg viewBox="0 0 20 20" class="p_v3ASA" focusable="false" aria-hidden="true"><path d="M10 2c4.411 0 8 3.589 8 8s-3.589 8-8 8-8-3.589-8-8 3.589-8 8-8zm0 3c-1.104 0-2 .897-2 2s.896 2 2 2 2-.897 2-2-.896-2-2-2zm0 10c1.631 0 3.064-.792 3.978-2-.914-1.208-2.347-2-3.978-2-1.631 0-3.064.792-3.978 2 .914 1.208 2.347 2 3.978 2z"></path></svg>
                        </span>
                        <span class="dropdown-item-text">
                            Your account
                        </span>
                    </a>
                    <a class="dropdown-item"  @click="logout">
                        <span class="dropdown-item-icon">
                            <svg viewBox="0 0 20 20" class="p_v3ASA" focusable="false" aria-hidden="true"><path d="M10 16a1 1 0 1 1 0 2c-4.411 0-8-3.589-8-8s3.589-8 8-8a1 1 0 1 1 0 2c-3.309 0-6 2.691-6 6s2.691 6 6 6zm7.707-6.707a.999.999 0 0 1 0 1.414l-3 3a.997.997 0 0 1-1.414 0 .999.999 0 0 1 0-1.414L14.586 11H10a1 1 0 1 1 0-2h4.586l-1.293-1.293a.999.999 0 1 1 1.414-1.414l3 3z" fill-rule="evenodd"></path></svg>
                        </span>
                        <span class="dropdown-item-text">
                            Logout
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapGetters, mapMutations, mapActions } from 'vuex';
    export default {
        nane : 'toolbar',
        components:{

        },
        data(){
            return {

            }
        },
        computed : {
            ...mapGetters({
                'user' : 'auth/getUser'
            })
        },
        methods : {
            ...mapActions({
                'logout' : 'auth/logout'
            })
        },
        mounted(){

        },
    }
</script>
<style lang="scss" scoped>
    $bg-toolbar : rgb(28, 34, 96);
    .app-toolbar{
        &-container{
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            position: relative;
            width: 100%;
            height: 100%;
            background: $bg-toolbar;
            &-left{
                width: 240px;
                height: 100%;
                z-index: 10;
            }
            &-right{
                z-index: 10;
                display: flex;
                flex: 1 1 auto;
                align-items: center;
                justify-content: flex-end;
                height: 100%;
                padding: 0 15px;
                .dropdown{
                    .dropdown-toggle{
                        background: transparent;
                        border: none;
                        box-shadow: none;
                        display: flex;
                        flex-direction: row;
                        align-items: center;
                        .item{
                            &-img{
                                width: 36px;
                                height: 36px;
                                border-radius: 50%;
                                background: #f2f2f2;
                                margin-right: 10px;
                                font-size: 16px;
                                color:$text-color;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                font-weight: 600;
                            }
                            &-text{
                                color:#fff;
                            }
                        }
                    }
                    .dropdown-menu{
                        min-width: 100%;
                        display: block;
                        opacity: 0;
                        visibility: hidden;
                        transition: all 0.3s ease;
                        transform: translateY(15px);
                        border-radius: 3px;
                        border: none;
                        box-shadow: 0 0 0 1px rgba(6,44,82,.1), 0 2px 16px rgba(33,43,54,.08);
                        padding: 5px 0;
                        right: 0;
                        left: auto;
                        &.show{
                            opacity: 1;
                            visibility: visible;
                            transform: translateY(3px);
                        }
                        a{
                            -webkit-appearance: none;
                            -moz-appearance: none;
                            appearance: none;
                            margin: 0;
                            padding: 0;
                            background: none;
                            border: none;
                            font-size: inherit;
                            line-height: inherit;
                            color: inherit;
                            text-decoration: none;
                            display: flex;
                            justify-content: flex-start;
                            align-items: center;
                            width: 100%;
                            min-height: 4rem;
                            padding: 1rem 1.6rem;
                            text-align: left;
                            cursor: pointer;
                            border-radius: 0;
                            &:hover{
                                background-image: linear-gradient(rgba(223,227,232,.3),rgba(223,227,232,.3));
                            }
                            &:focus{
                                box-shadow: inset 0.2rem 0 0 #5c6ac4;
                                background-image: linear-gradient(rgba(223,227,232,.3),rgba(223,227,232,.3)),linear-gradient(rgba(223,227,232,.3),rgba(223,227,232,.3));
                            }
                            .dropdown-item{
                                &-icon{
                                    display: block;
                                    height: 20px;
                                    width: 20px;
                                }
                                &-text{
                                    font-weight: 600;
                                }
                            }
                        }
                    }
                }
            }
        }
        &-logo{
            width: 100%;
            height: 100%;
            padding: 10px 15px;
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            align-items: center;
            img{
                max-width: 100%;
                max-height: 100%;
            }
        }
    }
</style>
