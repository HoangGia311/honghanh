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
							<button  class="button" @click.stop.prevent="submit" :class="{ 'is-loading' : is_loading }">
								Save Update
							</button>
						</div>
					</div>
				</div>
				<div class="page-body">
					<div class="row">
						<div class="col col-8">
							<div class="card">
								<div class="card-header">
									<h5>Title</h5>
								</div>
								<div class="card-section">
									<div class="m-b-15" :class="{ 'error' : formstate && $v.form.vi.name.$invalid}">
										<label class="m-b-5">Vi Title</label>
										<input type="text"  v-model="form.vi.name">
									</div>
									<div class="m-b-15" :class="{ 'error' : formstate && $v.form.en.name.$invalid}">
										<label class="m-b-5">En title</label>
										<input type="text"  v-model="form.en.name">
									</div>
								</div>
							</div>
						</div>
						<div class="col col-4">
							<div class="card">
								<div class="card-header">
									<h5>Meta</h5>
								</div>
								<div class="card-section">
									<div class="row">
										<div class="col col-12 m-b-15" :class="{ 'error' : formstate && $v.form.primary_image.$invalid}">
											<label class="m-b-15">
												Primary image
											</label>
											<div class="box-item-image" @click="gallery">
												<template v-if="form.primary_image">
													<img :src="form.primary_image.path" alt="">
												</template>
												<template v-else>
													<i class="icon-add-section"></i>
												</template>
											</div>
										</div>
										<div class="col col-12">
											<div class="m-b-15" :class="{ 'error' : formstate && $v.form.meta.meta_title.$invalid}">
												<label class="m-b-5">Meta title </label>
												<textarea v-model="form.meta.meta_title" rows="2"></textarea>
											</div>
											<div class="m-b-15" :class="{ 'error' : formstate && $v.form.meta.meta_description.$invalid}">
												<label class="m-b-5">Meta description</label>
												<textarea v-model="form.meta.meta_description" rows="2"></textarea>
											</div>
											<div class="m-b-15" :class="{ 'error' : formstate && $v.form.meta.meta_keyword.$invalid}">
												<label class="m-b-5">Meta keyword </label>
												<textarea v-model="form.meta.meta_keyword" rows="2"></textarea>
											</div>
										</div>
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
				vi:{
					name : ''
				},
				en:{
					name : ''
				},
				primary_image : null,
				meta :{
					meta_title : '',
					meta_description: '',
					meta_keyword : '',
				}
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
				var formdata = JSON.parse(JSON.stringify(this.form))
				formdata.primary_image = formdata.primary_image.id 
				this.update({
					id : this.form.id,
					formdata : formdata
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
					id :  category.id,
					vi:{
						name : category.vi.name
					},
					en:{
						name :  category.en.name
					},
					primary_image : category.image,
					meta :category.meta
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
				vi :{
					name : {
						required
					}
				},
				en :{
					name : {
						required
					}
				},
				primary_image : {
					required
				},
				meta :{ 
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