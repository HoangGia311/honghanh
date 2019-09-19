<template>
    <div class="page">
        <div class="page-header">
            <div class="page-title">
                <h1>Gallery</h1>
            </div>
            <div class="page-actions">
                <button class="button" @click.stop.prevent="form_create.show = true">
                    Add Gallery
                </button>
				 <button class="button" @click.stop.prevent="upload.show = true">
                    Upload Image
                </button>
            </div>
        </div>
        <div class="page-body">
            <div class="card">
				<ul class="tabs">
					<li >
						<router-link :to="setRouterlink('')">All</router-link>
					</li>
					<li v-for="(item,index) in groups" :key="`key_${index}`">
						<router-link :to="setRouterlink(item.id)">{{ item.name }}</router-link>
					</li>
				</ul>
				<transition name="fade" mode="out-in">
					<div class="card-section" v-if="is_loading" key="is-loading">
						<div class="text-center p-t-80 p-b-80">
							<div class="spinner-border icon-loading text-primary"></div>
						</div>
					</div>
					<div class="card-section" v-else key="loading-success">
						<template v-if="pagination.data.length">
							<div class="list-images">
								<div class="item-image" v-for="(item,index) in pagination.data" :key="`key_image${index}`">
									<img :src="item.path" alt="">
								</div>
							</div>
						</template>
						<pagination v-model="pagination.current_page" :total=pagination.last_page></pagination>
					</div>
				</transition>
            </div>
        </div>
		<vue-modal v-model="form_create.show" :backdrop="form_create.backdrop" class="modal-image" >
			<template slot="modal-body">
				<form @submit.stop.prevent="handleCreateGallery">
					<div class="modal-image-header">
						Group Gallery
					</div>
					<div class="modal-image-body">
						<label>Group name</label>
						<input type="text" v-model="form_create.name">
					</div>
					<div class="modal-image-footer">
						<button class="secondary" type="button" @click="form_create.show = false">
							Cancel
						</button>
						<button class="primary" type="submit" :class="{ 'is-loading' : form_create.is_loading }" >
							Create
						</button>
					</div>
				</form>
			</template>
		</vue-modal>
		<vue-modal v-model="upload.show" :backdrop="upload.backdrop"  width="810px" class="modal-upload" >
			<template slot="modal-body">
				<div>
					<div class="modal-upload-header">
						Upload image
					</div>
					<div class="modal-upload-body">
						<div class="row">
							<div class="col col-8">
								<label class="button secondary" for="modal_input_file" >
									Choose files
								</label>
							</div>
							<div class="col col-4">
								<select v-model="upload.group_id">
									<option value="">-- Choose group ---</option>
									<option v-for="(item,index) in groups" :key="`keyall_${index}`" :value="item.id">{{ item.name }}</option>
								</select>
							</div>
						</div>
						<input type="file" @change="onChangeFile($event)" multiple="multiple" hidden id="modal_input_file"  accept="image/*">
						<label for="modal_input_file" class="choose-file" v-if="!upload.data.length">
							Choose Files
						</label>
						<div class="list-item-image" v-else>
							<div class="item-image" v-for="(item,index) in upload.data" :key="`_item_index_${index}`">
								<img :src="item.src" alt="">
							</div>
						</div>
					</div>
					<div class="modal-upload-footer">
						
						<button class="secondary" type="button" @click="hideModalUpload()">
							Cancel
						</button>
						<button class="primary" @click.stop.prevent="handleUpload()" :class="{ 'is-loading' : upload.is_loading }" >
							Upload
						</button>
					</div>
				</div>
			</template>
		</vue-modal>
    </div>
</template>
<script>
import VueModal from '@/components/vue-modal'
import { required } from 'vuelidate/lib/validators'
import { mapActions, mapGetters  } from 'vuex'
export default {
	name : 'Gallery',
	components:{
		VueModal
	},
    data(){
        return {
            pagination :{
                last_page : 0,
                current_page : 1,
                total : 0,
                limit : 30,
                data : [],
				keyword : '',
				group : ''
            },
            timeout: null,
            is_error : null,
			is_loading : false,
			form_create:{
				show :false,
				backdrop : false,
				name : '',
				is_loading : false,
				formstate: false
			},
			upload:{
				show :false,
				backdrop : true,
				data : [],
				group_id : '',
				is_loading : false,
				formstate: false
			}
        }
	},
	computed:{
		...mapGetters({
			'groups' : 'gallery/get'
		})
	},
    methods : {
        ...mapActions({
			getGallery : 'gallery/get',
			createGallery : 'gallery/create',
			fetchData : 'image/list',
			uploadImage : 'image/upload'
		}),
		setRouterlink(group){
			return this.setRouterLinkDefault({
				query : {
					group : group
				}
			})
		},
		isActive(){
			
		},
        getList(route){
            this.is_loading = true
            var page = route.query.page ? route.query.page : 1 
            var limit = this.pagination.limit 
            this.fetchData({ 
                page , 
                limit,
            })
            .then((res)=>{
                let { code = 0 , data  } = res.data
                if( code ){
                    this.is_error = null
                    this.pagination = Object.assign(this.pagination , data )
                }else{
                    this.is_error = true
                }
            }).catch(err=>{
                this.is_error = true
            })
            .finally(()=>{
                this.is_loading = false
            })
        },
        reload(){
            this.getList(this.$route)
        },
		hideModal(){
			this.show_modal_create = false
		},
		handleCreateGallery(){
			this.form_create.formstate = false
			if( this.form_create.is_loading == false && this.$v.form_create.$invalid == false){
				this.form_create.is_loading = true
				this.createGallery({ name : this.form_create.name }).then((res)=>{
					let { code , message = 'Oops.. Something Went Wrong.. !'} = res.data 
                    if( code ){
						this.form_create.show = false
						this.getGallery()
                        this.$toasted.success('Create group image successfully !')
                    }else{
                        this.$toasted.error(message)
                    }
				})
				.finally(()=>{
					this.form_create.is_loading = false
				})
			}
		},
		handleUpload(){
			if( this.upload.is_loading == false){
				this.upload.is_loading = true
				this.upload.backdrop = false
				var formdata = new FormData;
				for (let index = 0; index < this.upload.data.length; index++) {
					formdata.append('images[]' ,this.upload.data[index].file);
				}
				if( this.upload.group_id ){
					formdata.append('group_id' , this.upload.group_id )
				}
				this.uploadImage(formdata).then((res)=>{
					let { code , message = 'Oops.. Something Went Wrong.. !'} = res.data 
                    if( code ){
						this.upload.show = false
						this.reload()
                        this.$toasted.success('Upload successfully !')
                    }else{
                        this.$toasted.error(message)
                    }
				})
				.finally(()=>{
					this.upload.is_loading = false
				})
				
			}
		},
		hideModalUpload(){
			if( this.upload.is_loading  ) return 
			this.upload.show  = false
		},
		onHideModal(){

		},
		onChangeFile($event){
            if(this.isLoading) return
            var files = $event.target.files || $event.dataTransfer.files;
            this.getBase64({ files : files , config : this.config}).then((res)=>{
                if( res  && res.length){
                    this.upload.data = this.upload.data.concat(res);
                }
            })
        },
        dragDrop ($event) {
            event.stopPropagation();
            event.preventDefault();
            if(this.isLoading) return
            var files = $event.dataTransfer.files;
            this.getBase64({ files : files , config : this.config}).then((res)=>{
                if( res  && res.length){
                    this.upload.data = this.upload.data.concat(res);
                }
            })
		},
		getBase64 : async function({  files , config  } ){
			var arr = [] 
			function readFileData (file) {
				return new Promise((resolve , reject )=>{
					var reader = new FileReader();
					reader.onload = function (e) {
						var img = new Image(); 
						img.src = e.target.result;
						img.onload = function() {
							arr.push({
								src : e.target.result,
								name: name,
								size: file.size,
								type: file.name.replace(/^.*\./, '') ,
								file : file
							})
							resolve()
						}
					};
					reader.onerror = reject;
					reader.readAsDataURL(file);
				})
			}
			if (files.length) {
				const promisesToAwait = [];
				for (let i = 0; i < files.length; i++) {
					promisesToAwait.push(readFileData(files[i]));
				}
				const responses = await Promise.all(promisesToAwait);
			};
			
			
			return new Promise((resolve)=>{
				resolve(arr)
			})
		},
    },
    beforeRouteUpdate (to, from, next) {
		this.getList(to)
        next()
	},
	validations(){
		return {
			form_create:{
				name : {
					required 
				}
			}
		}
	},
    async created(){
		await this.getGallery()
		await this.getList(this.$route)
    }
}
</script>
<style lang="scss" scoped>
    .td{
        &-index{
            width: 50px;
            text-align: center;
        }
        &-name{

        }
        &-actions{
            width: 150px;
            text-align: center;
        }
    }
	.list-item-gallery{
		display: flex;
		flex-direction: row;
		flex-wrap: wrap;
		.item-gallery{
			border: 1px solid #ddd;
			padding: 15px;
			width: 25%;
		}
	}
	.modal{
		&-image{
			form{
				display: block;
			}
			&-header{
				padding: 15px;
				border-bottom: 1px solid #ddd;
			}
			&-footer{
				padding: 15px;
				display: block;
				width: 100%;
				text-align: right;
				border-top: 1px solid #ddd;
			}
			&-body{
				padding: 15px;
			}
		}
		&-upload{
			&-header{
				padding: 15px;
				border-bottom: 1px solid #ddd;
			}
			&-footer{
				padding: 15px;
				display: block;
				width: 100%;
				text-align: right;
				border-top: 1px solid #ddd;
			}
			&-body{
				padding: 15px;
				.choose-file{
					height: 200px;
					width: 100%;
					display: block;
					border: 2px dashed $primary;
					display: flex;
					justify-content: center;
					align-items: center;
					cursor: pointer;
					background: transparent;
					&:hover{
						background: rgba(0,0,0,0.1)
					}
				}
				.list-item-image{
					min-height: 200px;
					width: 100%;
					display: block;
					border: 2px dashed $primary;
					display: flex;
					flex-direction: row;
					flex-wrap: wrap;
					.item-image{
						width: 100px;
						height: 100px;
						margin: 5px;
						border: 1px solid #ddd;
						border-radius: 5px;
						overflow: hidden;
						display: flex;
						justify-content: center;
						align-items: center;
						img{
							max-width: 100%;
							max-height: 100%;
						}
					}
				}
			}
		}
	}
	.list-images{
		width: 100%;
		display: block;
		display: flex;
		flex-direction: row;
		flex-wrap: wrap;
		.item-image{
			width: 100px;
			height: 100px;
			margin: 5px;
			border: 1px solid #ddd;
			border-radius: 5px;
			overflow: hidden;
			display: flex;
			justify-content: center;
			align-items: center;
			img{
				max-width: 100%;
				max-height: 100%;
			}
		}
	}
	
</style>