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
						<router-link class="button primary" :to="{ name : 'Product'}">
							Back to list
						</router-link>
					</article>
				</section>
			</div>
			<div v-else class="page page-center">
				<div class="page-header">
					<div class="page-title">
						<h1>Update Product</h1>
					</div>
					<div class="row">
						<div class="col col-6">
							<router-link class="button secondary btn-back" :to="{ name : 'Product'}">
								<i class="icon-prev m-r-15"></i> Back
							</router-link>
						</div>
						<div class="col col-6 text-right">
							<button @click.stop.prevent="submit" :class="{ 'is-loading' : is_loading }">
								Submit
							</button>
						</div>
					</div>
				</div>
				<div class="page-body">
					<div class="row">
						<div class="col col-12">
							<div class="card">
								<ul class="tabs">
									<li :class="{ 'active' :  active == 'vi'}">
										<a href="#" @click.stop.prevent="active = 'vi'">Vi</a>
									</li>
									<li :class="{ 'active' :  active == 'en'}">
										<a href="#" @click.stop.prevent="active = 'en'">En</a>
									</li>
									<li :class="{ 'active' :  active == 'seo'}">
										<a href="#" @click.stop.prevent="active = 'seo'">SEO</a>
									</li>
								</ul>
								<transition name="fade" mode="out-in">
									<div v-if="active == 'vi'" key="vi" class="card-section">
										<div class="m-b-15" :class="{ 'error' : formstate && $v.form.vi.name.$invalid}">
											<label class="m-b-5">Vi Title </label>
											<input type="text"  v-model="form.vi.name">
										</div>
										<div class="m-b-15" :class="{ 'error' : formstate && $v.form.vi.description.$invalid}">
											<label class="m-b-5">Vi Description</label>
											<ckeditor :editor="editor" v-model="form.vi.description" :config="editorConfig"></ckeditor>
										</div>
										<div class="m-b-15" :class="{ 'error' : formstate && $v.form.vi.properties.$invalid}">
											<label class="m-b-5">Properties</label>
											<div>
												<div class="row" v-for="(item, index) in form.vi.properties" :key="`index_${index}`">
													<div class="col col-4">
														<label>Name</label>
														<input type="text"  v-model="item.name">
													</div>
													<div class="col col-8">
														<label>Value</label>
														<vue-tags-input v-model="item.value" @tags-changed="newTags => item.children = newTags"  :tags="item.children" placeholder="add property" />
													</div>
												</div>
											</div>
										</div>
									</div>
								
									<div v-else-if="active =='en'" key="en" class="card-section">
										<div class="m-b-15" :class="{ 'error' : formstate && $v.form.en.name.$invalid}">
											<label class="m-b-5">En Title </label>
											<input type="text"  v-model="form.en.name">
										</div>
										<div class="m-b-15" :class="{ 'error' : formstate && $v.form.en.description.$invalid}">
											<label class="m-b-5">En Description</label>
											<ckeditor :editor="editor" v-model="form.en.description" :config="editorConfig"></ckeditor>
										</div>
										<div class="m-b-15" :class="{ 'error' : formstate && $v.form.en.properties.$invalid}">
											<label class="m-b-5">Properties</label>
											<div >
												<div class="row" v-for="(item, index) in form.en.properties" :key="`index_${index}`">
													<div class="col col-4" >
														<label>Name</label>
														<input type="text"  v-model="item.name">
													</div>
													<div class="col col-8">
														<label>Value</label>
														<vue-tags-input v-model="item.value" @tags-changed="newTags => item.children = newTags"  :tags="item.children" placeholder="add property" />
													</div>
												</div>
											</div>
										</div>
									</div>

									<div v-else-if="active == 'seo'" key="seo" class="card-section">
										<div class="row">
											<div class="col col-3">
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
											</div>
											<div class="col col-9">
												<div class="m-b-15" :class="{ 'error' : formstate && $v.form.meta.meta_title.$invalid}">
													<label class="m-b-5">Meta title </label>
													<input type="text"  v-model="form.meta.meta_title">
												</div>
												<div class="m-b-15" :class="{ 'error' : formstate && $v.form.meta.meta_description.$invalid}">
													<label class="m-b-5">Meta description</label>
													<input type="text"  v-model="form.meta.meta_description">
												</div>
												<div class="m-b-15" :class="{ 'error' : formstate && $v.form.meta.meta_keyword.$invalid}">
													<label class="m-b-5">Meta keyword </label>
													<input type="text"  v-model="form.meta.meta_keyword">
												</div>
											</div>
										</div>
									</div>
								</transition>
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
import VueTagsInput from '@johmun/vue-tags-input';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
export default {
	name : 'UpdateProduct',
	components:{
		VueTagsInput
	},
	data(){
		return {
			formstate :false,
			is_loading_page: false,
			is_loading : false,
			is_error : false,
			active : 'vi',
			editor: ClassicEditor,
			editorConfig: {},
			form :{
				"primary_image": '',
				"vi" : {
					"name" : "",
					"description" : "",
					"properties" : [
						{
							"name" : "Độ Đạm",
							"value" : '',
							"children" : []
						},
						{
							"name" : "Thể tích",
							"value" : '',
							"children" : []
						}
					]
				},
				"en" : {
					"name" : "",
					"description" : "",
					"properties" : [
						{
							"name" : "Do dam",
							"value" : '',
							"children" : []
						},
						{
							"name" : "The tich",
							"value" : '',
							"children" : []
						}
					]
				},
				"meta" : {
					"meta_title" : "",
					"meta_description" : "",
					"meta_keyword" : ""
				}
			}
		}
	},
	methods:{
		...mapActions({
			update : 'product/update',
			get : 'product/get'
		}),
		gallery(){
			this.$gallery.show((image)=>{
				this.form.primary_image = image
			})
		},
		submit(){
			this.formstate = true 
			if( this.is_loading ) return;
			if( this.$v.form.$invalid == false){
				this.is_loading = true
				var formdata = JSON.parse(JSON.stringify(this.form))
				formdata.vi.properties = formdata.vi.properties.map((item)=>{
					var object = {
						name : item.name ,
						children : item.children.map((el)=>{
							return {
								name : el.text
							}
						})
					}
					return object
				})
				formdata.en.properties = formdata.en.properties.map((item)=>{
					var object = {
						name : item.name ,
						children : item.children.map((el)=>{
							return {
								name : el.text
							}
						})
					}
					return object
				})
				formdata.primary_image = formdata.primary_image.id 
				this.update({
					id : this.form.id ,
					formdata : formdata
				}).then((res)=>{
					let { code , message = 'Oops.. Something Went Wrong.. !'} = res.data 
                    if( code ){
                        this.redirect({
							name : 'Product'
						})
                        this.$toasted.success('Create Product successfully !')
                    }else{
                        this.$toasted.error(message)
                    }
				})	
				.finally(()=>{
					this.is_loading = false
				})
			}else{
				this.$toasted.error('Please check form !')
			}
		}
	},
	created(){
		this.is_loading_page = true 
		this.get(this.$route.params.id).then((res)=>{
			let { code , data , message = 'Oops.. Something Went Wrong.. !'} = res.data 
			if( code ){
				let { product } = data 
				this.form = {
					"id" : product.id,
					"primary_image": product.image,
					"vi" : {
						"name" : product.vi.name,
						"description" :product.vi.description,
						"properties" : product.vi.properties.map((item)=>{
							return  {
								name : item.name,
								value : '',
								children : item.children.map((el)=>{
									return {
										text : el.name
									}
								})
							}
						})
					},
					"en" : {
						"name" : product.en.name,
						"description" :product.en.description,
						"properties" : product.en.properties.map((item)=>{
							return  {
								name : item.name,
								value : '',
								children : item.children.map((el)=>{
									return {
										text : el.name
									}
								})
							}
						})
					},
					"meta" : product.meta,
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
				vi : {
					name : {
						required
					},
					description : {
						required
					},
					properties : {
						required,
						$each : {
							name : {
								required
							},
							value : {},
							children :{
								required
							}
						}
					}
				},
				en : {
					name : {
						required
					},
					description : {
						required
					},
					properties : {
						required,
						$each : {
							name : {
								required
							},
							value : {},
							children :{
								required
							}
						}
					}
				},
				primary_image : {
					required
				},
				meta : {
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