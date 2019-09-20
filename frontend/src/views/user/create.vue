<template>
    <form class="page page-center"  @submit.stop.prevent="onSubmit" novalidate>
        <div class="page-header">
            <div class="page-title">
                <h1>Create User</h1>
            </div>
            <div class="page-actions">
                <button type="submit">
                    Submit
                </button>
            </div>
        </div>
        <div class="page-body">
            <div class="row">
                <div class="col col-12">
                    <div class="card">
                        <div class="card-section">
                            <h5>Infomation</h5>
                            <div class="row">
                                <div class="col col-12 m-b-20" :class="{ 'error' : $v.form.name.$invalid && formstate}">
                                    <label for="">Name</label>
                                    <input type="text" v-model.trim="form.name" class="form-control">
                                    <transition name="fade" mode="out-in">
                                        <div class="text-danger" v-if="$v.form.name.$invalid && formstate">
                                            <small v-if="!$v.form.name.required">Name is required </small>
                                        </div>
                                    </transition>
                                </div>
                                <div class="col col-12 m-b-20" :class="{ 'error' : $v.form.email.$invalid && formstate}">
                                    <label for="">Email</label>
                                    <input type="email" v-model.trim="form.email" class="form-control">
                                    <transition name="fade" mode="out-in">
                                        <div class="text-danger" v-if="$v.form.email.$invalid && formstate">
                                            <small v-if="!$v.form.email.required">Email is required </small>
                                            <small v-if="$v.form.email.required && !$v.form.email.email">Email is notvalid </small>
                                        </div>
                                    </transition>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="m-b-30">
            <div class="row">
                <div class="col col-12">
                    <div class="card">
                        <div class="card-section">
                            <h5>Password </h5>
                            <div class="row">
                                <div class="col col-12 m-b-20" :class="{ 'error' : $v.form.password.$invalid && formstate}">
                                    <label for="">Password</label>
                                    <input type="password" v-model.trim="form.password" class="form-control">
                                    <transition name="fade" mode="out-in">
                                        <div class="text-danger" v-if="$v.form.password.$invalid && formstate">
                                            <small v-if="!$v.form.password.required">Password is required </small>
                                            <small v-if="!$v.form.password.minLength">Password must have at least 6 letters</small>
                                        </div>
                                    </transition>
                                </div>
                                <div class="col col-12" :class="{ 'error' : $v.form.repassword.$invalid && formstate}">
                                    <label for="">Confirm password</label>
                                    <input type="password" v-model.trim="form.repassword" class="form-control">
                                    <transition name="fade" mode="out-in">
                                        <div class="text-danger" v-if="$v.form.repassword.$invalid && formstate">
                                            <small v-if="!$v.form.repassword.required">Confirm password is required</small>
                                            <small v-if="!$v.form.repassword.sameAs">Passwords must be identical</small>
                                        </div>
                                    </transition>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>
<script>
import { required , email ,  sameAs  , minLength  } from 'vuelidate/lib/validators'
import { mapActions, mapGetters } from 'vuex';

export default {
    name : 'CreateUser',
    data(){
        return {
            is_error: null,
            is_loading : false,
            formstate: false,
            form :{
                name : '',
                email : '',
                password :'',
                repassword : ''
            }
        }
    },
    methods:{
        ...mapActions({
            create : 'user/create'
        }),
        back(){
            this.redirect({
                name : 'User'
            })
        },
        onSubmit(){
            this.formstate = true
            if( this.$v.form.$invalid  || this.is_sending  ) return ;
            this.$confirm.show({
                title : 'Confirm',
                content : 'Do do want to create this user ?',
                btnSave : 'Create',
                btnClose: 'Cancel',
                onSave : () => {
                    return new Promise((resolve , reject) =>{
                        this.postCreate().finally((res)=>{
                            resolve()
                        })
                    })
                }
            })
        },
        postCreate(){
            return new Promise((resolve, reject)=>{
                var formdata = {}
                let { email , password, name } = this.form
                this.create({ email , password, name }).then((res)=>{
                    let { code , message = 'Oops.. Something Went Wrong.. !'} = res.data 
                    if( code ){
                        this.back()
                        this.$toasted.success('Create user successfully !')
                    }else{
                        this.$toasted.error(message)
                    }
                })
                .finally(()=>{
                    resolve()
                })
            });
        },
    },
    validations(){
        var vm = this
        return {
            form : {
                name : {
                    required
                },
                email: {
                    required, email ,
                },
                password: {
                    required, minLength : minLength(6)
                },
                repassword : {
                    required,sameAs: sameAs('password')
                }
            }
        }
    },
}
</script>
<style lang="scss" scoped>
    .modal-dialog {
        width: 500px;
        max-width: 500px;
    }
</style>