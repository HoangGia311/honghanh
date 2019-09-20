<template>
    <transition name="fade" mode="out-in">
        <div class="page" v-if="is_loading_page" key="is-loading">
            <div class="page-body p-t-150 p-b-150 text-center">
                <span class="spinner-border text-primary icon-loading"></span>
            </div>
        </div>
		<div v-else key="is-loading-success">
			<div v-if="is_error" class="m-t-30">
				<section class="zero-state full-width">
					<article>
						<h1>404</h1>
						<h3>Data not found !</h3>
						<router-link class="button primary" :to="{ name : 'Category'}">
							Back to list
						</router-link>
					</article>
				</section>
			</div>
			<div v-else class="page page-center" >
				<div class="page-header">
					<div class="page-title">
						<h1>Update Category</h1>
					</div>
					<div class="row">
						<div class="col col-6">
							<router-link class="button secondary btn-back" :to="{ name : 'Category'}">
								<i class="icon-prev m-r-15"></i> Back
							</router-link>
						</div>
						<div class="col col-6 text-right">
							<button @click.stop.prevent="submit" :class="{ 'is-loading' : is_loading }">
								Save Update
							</button>
						</div>
					</div>
				</div>
				<div class="page-body">
					<div class="row">
						<div class="col col-12">
							<div class="card">
								<div class="card-section">
									<div class="m-b-15" :class="{ 'error' : formstate && $v.form.vi_name.$invalid}">
										<label class="m-b-5">Name [Vi]</label>
										<input type="text"  v-model="form.vi_name">
									</div>
									<div class="m-b-15" :class="{ 'error' : formstate && $v.form.en_name.$invalid}">
										<label class="m-b-5">Name [En]</label>
										<input type="text"  v-model="form.en_name">
									</div>
									<div class="m-b-15" :class="{ 'error' : formstate && $v.form.primary_image.$invalid}">
										<div class="box-item-image" @click="gallery">
											<template v-if="form.primary_image">
												<img :src="form.primary_image.path" alt="">
											</template>
											<template v-else>
												<i class="icon-add-section"></i>
											</template>
										</div>
									</div>
									<div class="m-b-15" :class="{ 'error' : formstate && $v.form.meta_title.$invalid}">
										<label class="m-b-5">Meta title</label>
										<input type="text" v-model="form.meta_title">
									</div>
									<div class="m-b-15" :class="{ 'error' : formstate && $v.form.meta_description.$invalid}">
										<label class="m-b-5">Meta description</label>
										<input type="text" v-model="form.meta_description">
									</div>
									<div class="m-b-15" :class="{ 'error' : formstate && $v.form.meta_keyword.$invalid}">
										<label class="m-b-5">Meta keyword</label>
										<input type="text"  v-model="form.meta_keyword">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </transition>
</template>
<script>
import { required } from 'vuelidate/lib/validators'
import { mapActions } from 'vuex'
export default {
	name : 'CreateCategory',
	data(){
		return {
			formstate :false,
			is_loading_page: false,
			is_error : false,
			is_loading : false,
			form :{
				id : '',
				vi_name : '',
				en_name: '',
				primary_image : null,
				meta_title : '',
				meta_description: '',
				meta_keyword : '',
				alias: '',
			}		
		}
	},
	methods:{
		...mapActions({
			update : 'category/update',
			get : 'category/get'
		}),
		gallery(){
			this.$gallery.show((image)=>{
				this.form.primary_image = image
			})
		},
		submit(){
			this.formstate = true 
			if( this.is_loading  == false && this.$v.form.$invalid == false){
				this.is_loading = true
				this.update({
					id : this.form.id,
					formdata : {
						vi :{
							name : this.form.vi_name
						},
						en : {
							name : this.form.en_name
						},
						primary_image :  this.form.primary_image.id,
						meta : {
							meta_title : this.form.meta_title,
							meta_description : this.form.meta_description,
							meta_keyword : this.form.meta_keyword
						} 
					}
				}).then((res)=>{
					let { code , message = 'Oops.. Something Went Wrong.. !'} = res.data 
                    if( code ){
                        this.redirect({
							name : 'Category'
						})
                        this.$toasted.success('Update category successfully !')
                    }else{
                        this.$toasted.error(message)
                    }
				})	
				.finally(()=>{
					this.is_loading = false
				})
			}
		}
	},
	created(){
		this.is_loading_page = true 
		this.get(this.$route.params.id).then((res)=>{
			let { code , data , message = 'Oops.. Something Went Wrong.. !'} = res.data 
			if( code ){
				let { category } = data 
				this.form = {
					id : category.id ,
					vi_name : category.vi.name ,
					en_name : category.en.name ,
					meta_title : category.meta.meta_title ,
					meta_description : category.meta.meta_description ,
					meta_keyword : category.meta.meta_keyword ,
					primary_image : category.image,
				}
			}else{
				this.is_error = true
			}
		})
		.catch(()=>{
			this.is_error = true
		})
		.finally(()=>{
			this.is_loading_page = false
		})
	},
	validations(){
		return {
			form : {
				vi_name : {
					required
				},
				en_name : {
					required
				},
				primary_image : {
					required
				},
				meta_title: {
					required
				},
				meta_description: {
					required
				},
				meta_keyword: {
					required
				}
			}
		}
	}
}
</script>
<style lang="scss" scoped>
	.error{
		.box-item-image{
			border-color: #ed6347;
    		background-color: #fbeae5;
		}
	}
</style>