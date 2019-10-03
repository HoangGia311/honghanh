<template>
    <transition name="fade" mode="out-in">
        <div class="page" v-if="is_loading_page" key="is-loading">
            <div class="page-body p-t-150 p-b-150 text-center">
                <span class="spinner-border text-primary icon-loading"></span>
            </div>
        </div>
		<div v-else key="is-loading-success" class="page page-center">
			<div class="page-header">
				<div class="page-title">
					<h1>Create Post</h1>
				</div>
				<div class="row">
					<div class="col col-6">
						<router-link class="button secondary btn-back" :to="{ name : 'Post'}">
							<i class="icon-prev m-r-15"></i> Back
						</router-link>
					</div>
					<div class="col col-6 text-right">
						<button class="button" @click.stop.prevent="submit" :class="{ 'is-loading' : is_loading }">
							Submit
						</button>
					</div>
				</div>
			</div>
			<div class="page-body">
				<div class="row">
					<div class="col col-12">
						<div class="card">
							<div key="content" class="card-section">
								<div class="row">
									<div class="col col-12">
										<div class="m-b-15" :class="{ 'error' : formstate && $v.form.category_id.$invalid}">
											<label class="m-b-5">Category</label>
											<select v-model="form.category_id">
												<option value="">--- select cateogry ---</option>
												<option v-for="item in categories" :value="item.id " :key="item.id">{{ item.vi  ? item.vi.name : ''}}</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="card">
							<div  key="vi" class="card-section">
								<div class="m-b-15" :class="{ 'error' : formstate && $v.form.vi.name.$invalid}">
									<label class="m-b-5">Vi Title </label>
									<input type="text"  v-model="form.vi.title">
								</div>
								<div class="m-b-15" :class="{ 'error' : formstate && $v.form.vi.description.$invalid}">
									<label class="m-b-5">Vi Description</label>
									<textarea  v-model="form.vi.description" rows="5"></textarea>
								</div>
								<div class="m-b-15" :class="{ 'error' : formstate && $v.form.vi.content.$invalid}">
									<label class="m-b-5">Vi Content</label>
									<!-- <ckeditor :editor="editor"  v-model="form.vi.content" ></ckeditor> -->
									<ckeditor v-model="form.vi.content"></ckeditor>
								</div>
							</div>
						</div>
						<div class="card">
							<div  key="en" class="card-section">
								<div class="m-b-15" :class="{ 'error' : formstate && $v.form.en.name.$invalid}">
									<label class="m-b-5">En Title </label>
									<input type="text"  v-model="form.en.title">
								</div>
								<div class="m-b-15" :class="{ 'error' : formstate && $v.form.en.description.$invalid}">
									<label class="m-b-5">En Description</label>
									<textarea  v-model="form.en.description" rows="5"></textarea>
								</div>
								<div class="m-b-15" :class="{ 'error' : formstate && $v.form.en.content.$invalid}">
									<label class="m-b-5">En Content</label>
									<ckeditor v-model="form.en.content" ></ckeditor>
								</div>
							</div>
						</div>
						<div class="card">
							<div  key="seo" class="card-section">
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

export default {
	name : 'CreateProduct',
	components:{
		VueTagsInput,
	},
	data(){
		return {
			formstate :false,
			is_loading : false,
			is_loading_page: false,
			active : 'vi',
			categories: [],
			form :{
				"primary_image": '',
				"category_id" : '',
				"vi" : {
					"title" : "",
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
					"title" : "",
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
			},
			category : [],
		}
	},
	methods:{
		...mapActions({
			create : 'post/create',
			allCategory : 'post/getCreate'
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
				formdata.primary_image = formdata.primary_image.id 
				this.create(formdata).then((res)=>{
					let { code , message = 'Oops.. Something Went Wrong.. !'} = res.data 
                    if( code ){
                        this.redirect({
							name : 'Post'
						})
                        this.$toasted.success('Create post successfully !')
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
		this.allCategory().then((res)=>{
			let { code ,data ,  message = 'Oops.. Something Went Wrong.. !'} = res.data 
			if( code ){
				let { categories = []} = data 
				this.categories = categories 
			}else{

			}
		})
		.finally(()=>{
			this.is_loading_page = false
		})
	},
	validations(){
		return {
			form : {
				vi : {
					title : {
						required
					},
					description : {
						required
					},
					content : {
						required
					},
				},
				en : {
					title : {
						required
					},
					description : {
						required
					},
					content : {
						required
					},
				},
				category_id : {
					required
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