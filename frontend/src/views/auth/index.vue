<template>
    <div class="card">
        <div class="card-section">
            <div class="card-title">
                <h3>LOGIN</h3>
            </div>
            <form class="card-form" @submit.stop.prevent="onSubmit()" novalidate>
                <div :class="{ 'error' : $v.form.email.$invalid && formstate}">
                    <label>Email</label>
                    <input type="text" v-model.trim="form.email">
                    <transition name="fade" mode="out-in">
                        <div class="text-danger" v-if="$v.form.email.$invalid && formstate">
                            <p v-if="!$v.form.email.required" class="form-text text-danger">
                                Email is required
                            </p>
                            <p v-if="!$v.form.email.email" class="form-text text-danger">
                                Email is invalid format
                            </p>
                        </div>
                    </transition>
                </div>
                <div class="m-t-15" :class="{ 'error' : $v.form.password.$invalid && formstate}">
                    <label>Password</label>
                    <input type="password"  v-model.trim="form.password">
                    <transition name="fade" mode="out-in">
                        <div class="text-danger" v-if="$v.form.password.$invalid && formstate">
                            <p v-if="!$v.form.password.required" class="form-text text-danger">
                                Password is required
                            </p>
                        </div>
                    </transition>
                </div>
                <div class="text-right m-t-15">
                    <button type="submit" :class="{ 'is-loading' : is_loading}">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import { mapActions, mapGetters } from 'vuex'
import { required , email  } from 'vuelidate/lib/validators'
export default {
    name : 'Login',
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
            'login' : 'auth/login'
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
        }
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
    .card{
        width: 400px;
        background: #fff;
        text-align: left;
        &-title{
            text-align: center;
            padding-bottom: 15px;
            h3{
                font-size: 20px;
                font-weight: 600;
            }
        }
        &-form{
            display: block;
        }
    }
</style>