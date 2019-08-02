<template>
    <div class="auth-form">
        <div class="card" >
            <div class="card-header">
                ĐĂNG NHẬP
            </div>
            <div class="card-body">
                <form class="auth-form-body"  @submit.stop.prevent="onSubmit" novalidate>
                    <div class="form-group">
                        <label for="form-email">Email</label>
                        <input type="email" id="form-email"  class="form-control" v-model.trim="form.email">
                        <transition name="fade" mode="out-in">
                            <div class="text-danger" v-if="$v.form.email.$invalid && formstate">
                                <small v-if="!$v.form.email.required" class="form-text text-danger">
                                    Email bắt buộc phải nhập
                                </small>
                                <small v-if="!$v.form.email.email" class="form-text text-danger">
                                    Email chưa đúng định dạng
                                </small>
                            </div>
                        </transition>
                    </div>
                    <div class="form-group">
                        <label for="form-password">Mật khẩu</label>
                        <input type="password" id="form-password" class="form-control" v-model.trim="form.password">
                        <transition name="fade" mode="out-in">
                            <div class="text-danger" v-if="$v.form.password.$invalid && formstate">
                                <small v-if="!$v.form.password.required" class="form-text text-danger">Mật khẩu bắt buộc nhập</small>
                            </div>
                        </transition>
                    </div>
                    <div class="form-group">
                        <div class="text-danger m-b-10" v-if="message">
                            {{ message }}
                        </div>
                        <button class="btn btn-primary btn-submit btn-block">
                            <template v-if="is_loading"><span class="spinner-border"></span></template>
                            <template v-else>Đăng nhập</template>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions, mapGetters } from 'vuex'
import { required , email  } from 'vuelidate/lib/validators'
export default {
    name : 'Auth',
    data(){
        return {
            is_loading : false,
            formstate : false,
            form : {
                email : '',
                password : '',
            },
            message : null 
        }
    },
    methods:{
        ...mapActions({
            login : 'LOGIN' ,
        }),
        onSubmit(){
            this.formstate  = true
            if( this.is_loading || this.$v.form.$invalid ) return 
            this.is_loading = true 
            this.message = null 
            this.login(this.form).then((res)=>{
                let { code , data  , message } = res.data 
                if( code ){
                    this.redirect({
                        name : 'Dashboard'
                    })
                }else{
                    this.message = message 
                    this.is_loading = false
                }
            }).catch((error)=>{

            })
            .finally(()=>{
                this.is_loading = false
            })
        },
    },
    validations(){
        return {
            form : {
                email: {
                    required,
                    email
                },
                password: {
                    required
                },
            }
        }
    }
}
</script>
<style lang="scss" scoped>
    .auth-form{
        -webkit-box-flex: 0;
        -ms-flex: 0 0 400px;
        flex: 0 0 400px;
        max-width: 400px;
        .card{
            width: 100%;
            border-radius: 6px;
            box-shadow: 0 3px 1px -2px rgba(0,0,0,.1), 0 2px 2px 0 rgba(0,0,0,.1), 0 1px 3px 0 rgba(0,0,0,.1);
            color: #4d4f5c;
            border: 1px solid #eee;
            user-select: none;
            &-header{
                padding: 0;
                border: none;
                text-align: center;
                background: transparent;
                margin-bottom: 15px;
                font-size:20px;
                font-weight:600;
            }
            .card-body{
                padding: 0;
                .nav{
                    li{
                        width: 50%;
                        padding: 0;
                        a{
                            text-align: center;
                            display: block;
                            cursor: pointer;
                            text-transform: uppercase;
                            color:$text;
                            font-weight: bold;
                            padding: 6px 15px;
                            border-bottom: 2px solid #f2f2f2;
                            transition: all 0.3s ease;
                            &.is-active{
                                color:$purple;
                                border-color: $purple;
                            }
                            &:hover{

                            }
                        }
                    }
                }
            }
        }
        &-body{
            display: block;
            width: 100%;
            padding: 15px;
            label{
                font-weight: 500;
            }
            .btn-submit{
                text-transform: uppercase;
                font-weight: 600;
            }
        }
    }

</style>
