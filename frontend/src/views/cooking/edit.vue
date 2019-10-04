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
						<router-link class="button primary" :to="{ name : 'Cooking'}">
							Back to list
						</router-link>
					</article>
				</section>
			</div>
			<div v-else class="page page-center">
				<div class="page-header">
					<div class="page-title">
						<h1>Update Cooking</h1>
					</div>
					<div class="row">
						<div class="col col-6">
							<router-link class="button secondary btn-back" :to="{ name : 'Cooking'}">
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
						<div class="col col-8">
							<div class="card">
								<div class="card-header">
									<h5>Title</h5>
								</div>
								<div  key="vi" class="card-section">
									<div class="m-b-15" :class="{ 'error' : formstate && $v.form.vi.title.$invalid}">
										<label class="m-b-5">Vi Title </label>
										<input type="text"  v-model="form.vi.title">
									</div>
									<div class="m-b-15" :class="{ 'error' : formstate && $v.form.en.title.$invalid}">
										<label class="m-b-5">En Title </label>
										<input type="text"  v-model="form.en.title">
									</div>
								</div>
							</div>
							<div class="card">
								<div class="card-header">
									<h5>Description</h5>
								</div>
								<div  key="vi" class="card-section">
									<div class="m-b-15" :class="{ 'error' : formstate && $v.form.vi.description.$invalid}">
										<label class="m-b-5">Vi Description</label>
										<textarea v-model="form.vi.description" rows="4"></textarea>
									</div>
									<div class="m-b-15" :class="{ 'error' : formstate && $v.form.en.description.$invalid}">
										<label class="m-b-5">En Description</label>
										<textarea v-model="form.en.description" rows="4"></textarea>
									</div>
								</div>
							</div>
							<div class="card">
								<div class="card-header">
									<h5>Ingredients</h5>
								</div>
								<div  key="vi" class="card-section">
									<label class="m-b-5">Vi Ingredients</label>
									<div>
										<div class="row" v-for="(item, index) in form.vi.properties.ingredients" :key="`index_${index}`">
											<div class="col col-4" :class="{ 'error' : formstate && vi_ingredients[index].name.$invalid }">
												<label>Name</label>
												<input type="text"  v-model="item.name">
											</div>
											<div class="col col-7" :class="{ 'error' : formstate && vi_ingredients[index].value.$invalid}">
												<label>Value</label>
												<input type="text"  v-model="item.value">
											</div>
											<div class="col col-1">
												<label>&nbsp;</label>
												<button class="button secondary icon-trash" @click.stop.prevent="form.vi.properties.ingredients.splice(index, 1)"></button>
											</div>
										</div>
										<div>
											<button class="button secondary icon-addition" @click.stop.prevent="form.vi.properties.ingredients.push({ name : '', value : ''})"></button>
										</div>
									</div>
									<hr class="m-t-15 m-b-15">
									<label class="m-b-5">En Ingredients</label>
									<div >
										<div class="row" v-for="(item, index) in form.en.properties.ingredients" :key="`index_${index}`">
											<div class="col col-4" :class="{ 'error' : formstate && en_ingredients[index].name.$invalid }">
												<label>Name</label>
												<input type="text"  v-model="item.name" >
											</div>
											<div class="col col-7" :class="{ 'error' : formstate && en_ingredients[index].value.$invalid }">
												<label>Value</label>
												<input type="text"  v-model="item.value" >
											</div>
											<div class="col col-1">
												<label>&nbsp;</label>
												<button class="button secondary icon-trash" @click.stop.prevent="form.en.properties.ingredients.splice(index, 1)"></button>
											</div>
										</div>
										<div>
											<button class="button secondary icon-addition" @click.stop.prevent="form.en.properties.ingredients.push({ name : '', value : ''})"></button>
										</div>
									</div>
								</div>
							</div>
							<div class="card">
								<div class="card-header">
									<h5>Process</h5>
								</div>
								<div  key="vi" class="card-section">
									<label class="m-b-5">Vi Process</label>
									<div>
										<div class="row" v-for="(item, index) in form.vi.properties.process" :key="`index_${index}`">
											<div class="col col-11 ck-200" :class="{ 'error' : formstate && en_process[index].value.$invalid }">
												<label>Step</label>
												<ckeditor   v-model="item.value" ></ckeditor>
											</div>
											<div class="col col-1">
												<label>&nbsp;</label>
												<button class="button secondary icon-trash" @click.stop.prevent="form.vi.properties.process.splice(index, 1)"></button>
											</div>
										</div>
										<div>
											<button class="button secondary icon-addition" @click.stop.prevent="form.vi.properties.process.push({ value : ''})"></button>
										</div>
									</div>
									<hr class="m-t-15 m-b-15">
									<label class="m-b-5">En Process</label>
									<div>
										<div class="row" v-for="(item, index) in form.en.properties.process" :key="`index_${index}`">
											<div class="col col-11 ck-200" :class="{ 'error' : formstate && en_process[index].value.$invalid }">
												<label>Step</label>
												<ckeditor   v-model="item.value" ></ckeditor>
											</div>
											<div class="col col-1">
												<label>&nbsp;</label>
												<button class="button secondary icon-trash" @click.stop.prevent="form.en.properties.process.splice(index, 1)"></button>
											</div>
										</div>
										<div>
											<button class="button secondary icon-addition" @click.stop.prevent="form.en.properties.process.push({ value : ''})"></button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col col-4">
							<div class="card">
								<div  key="seo" class="card-section">
									<div class="row">
										<div class="col col-12">
											<div class="m-b-15" :class="{ 'error' : formstate && $v.form.link.$invalid}">
												<label class="m-b-5">Youtube Video ID</label>
												<input type="text"  v-model="form.link">
											</div>
										</div>
									</div>
								</div>
							</div>
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
import VueTagsInput from '@johmun/vue-tags-input';
export default {
	name : 'UpdateCooking',
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
			form :{
				"primary_image": '',
				"link" : "",
				"vi" : {
					"title" : "",
					"description" : "",
					"properties" : {
						"ingredients" : [{
							"name" : "",
							"value" : ""
						}],
						"process" : [{
							"value" : ""
						}]
					}
					
				},
				"en" : {
					"title" : "",
					"description" : "",
					"properties" : {
						"ingredients" : [{
							"name" : "",
							"value" : ""
						}],
						"process" : [{
							"value" : ""
						}]
					}
				},
				"meta" : {
					"meta_title" : "",
					"meta_description" : "",
					"meta_keyword" : ""
				}
			}	
		}
	},
	computed:{
		vi_ingredients(){
			return Object.values(this.$v.form.vi.properties.ingredients.$each.$iter)
		},
		vi_process(){
			return Object.values(this.$v.form.vi.properties.process.$each.$iter)
		},
		en_ingredients(){
			return Object.values(this.$v.form.en.properties.ingredients.$each.$iter)
		},
		en_process(){
			return Object.values(this.$v.form.en.properties.process.$each.$iter)
		}
	},
	methods:{
		...mapActions({
			update : 'cooking/update',
			get : 'cooking/get'
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
				formdata.vi['properties']['process'] = formdata.vi.properties.process.map((item)=>{
					return item.value
				})
				formdata.en['properties']['process'] = formdata.en.properties.process.map((item)=>{
					return item.value
				})
				formdata.primary_image = formdata.primary_image.id 
				this.update({
					id : this.form.id ,
					formdata : formdata
				}).then((res)=>{
					let { code , message = 'Oops.. Something Went Wrong.. !'} = res.data 
                    if( code ){
                        this.redirect({
							name : 'Cooking'
						})
                        this.$toasted.success('Create Cooking successfully !')
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
				let { cooking } = data 
				this.form = {
					"id" : cooking.id,
					"primary_image": cooking.image,
					"link" : cooking.link,
					"vi" : {
						"title" : cooking.vi.title,
						"description" :cooking.vi.description,
						"properties" : {
							"ingredients" : cooking.vi.properties.ingredients,
							"process" : cooking.vi.properties.process.map((item)=>{
								return {
									value : item
								}
							})
						}
					},
					"en" : {
						"title" : cooking.en.title,
						"description" :cooking.en.description,
						"properties" : {
							"ingredients" : cooking.en.properties.ingredients,
							"process" : cooking.en.properties.process.map((item)=>{
								return {
									value : item
								}
							})
						}
					},
					"meta" : cooking.meta,
				}
			}else{
				this.is_error = true
			}
		})
		.catch((err)=>{
			console.log(err)
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
					title : {
						required
					},
					description : {
						required
					},
					properties : {
						ingredients : {
							required,
							$each : {
								name : {
									required
								},
								value : {
									required
								},
							}
						},
						process : {
							required,
							$each : {
								value : {
									required
								},
							}
						}
					}
				},
				en : {
					title : {
						required
					},
					description : {
						required
					},
					properties : {
						ingredients : {
							required,
							$each : {
								name : {
									required
								},
								value : {
									required
								},
							}
						},
						process : {
							required,
							$each : {
								value : {
									required
								},
							}
						}
					}
				},
				primary_image : {
					required
				},
				link : {
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