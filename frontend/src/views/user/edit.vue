<template>
    <transition name="fade" mode="out-in">
        <div class="page" v-if="is_loading" key="is-loading">
            <div class="page-body p-t-150 p-b-150 text-center">
                <span class="spinner-border text-primary icon-loading"></span>
            </div>
        </div>
        <form v-else class="page" key="loading-ready"  @submit.stop.prevent="onSubmit" novalidate>
            <template v-if="is_loading_error">
                <div class="page-body text-center">
                    <template v-if="is_loading_error == 404">
                        <div class="p-t-150 p-b-150">
                            <h1>Data not found !</h1>
                        </div>
                    </template>
                    <template v-else>
                        <div class="p-t-150 p-b-150">
                            <h1>Oops! Something went wrong.</h1>
                        </div>
                    </template>
                </div>
            </template>
            <template v-else>
                <div class="page-header">
                    <div class="page-title">
                        <h1>Update User</h1>
                    </div>
                    <div class="page-actions">
                        <button type="submit">
                            Save Update
                        </button>
                    </div>
                </div>
                <div class="page-body">
                    <div class="row">
                        <div class="col col-4">
                            <div class="card-aside">
                                <h2>User's Infomation</h2>
                            </div>
                        </div>
                        <div class="col col-8">
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
                </div>
            </template>
        </form>
    </transition>
</template>
<script>
import { required , email ,  sameAs  , minLength  } from 'vuelidate/lib/validators'
import { mapActions, mapGetters } from 'vuex';

export default {
    name : 'ModalUpdate',
    data(){
        return {
            is_error: null,
            is_loading : false,
            is_loading_error: false,
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
            update : 'user/update',
            get : 'user/get'
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
                content : 'Do do want to update this user ?',
                btnSave : 'Update',
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
                this.update(this.form).then((res)=>{
                    let { code , message = 'Oops.. Something Went Wrong.. !'} = res.data 
                    if( code ){
                        this.back()
                        this.$toasted.success('Update successfully !')
                    }else{
                        this.$toasted.error(message)
                    }
                })
                .finally(()=>{
                    resolve()
                })
            });
        },
        initData(id){
            this.is_loading = true
            this.get(id).then((res)=>{
                let { code , data } = res.data 
                if( code ){
                    this.form = Object.assign(this.form , data.user)
                }else{
                    this.is_loading_error = 404
                }
            })
            .catch(()=>{
                this.is_loading_error = 500
            })
            .finally(()=>{
                this.is_loading = false
            })
        }
    },
    created(){
        var id = this.$route.params.id
        this.initData(id)
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