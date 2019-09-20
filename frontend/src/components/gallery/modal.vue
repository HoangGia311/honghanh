<template>
	<div class="vue-modal-dialog" v-if="visible">
		<div class="vue-modal-dialog-backdrop" @click="clickBackdrop"></div>
		<div class="vue-modal-dialog-container">
			<div class="icon-close" @click="hide">
				<i class="fal fa-times"></i>
			</div>
			<div class="vue-modal-dialog-header">
				<ul class="tabs">
					<li :class="{ 'active' : is_active == 'gallery'}">
						<a href="#"  @click.stop.prevent="is_active = 'gallery'">Gallery</a>
					</li>
					<li :class="{ 'active' : is_active == 'upload'}"> 
						<a href="#" @click.stop.prevent="is_active = 'upload'">Upload</a>
					</li>
				</ul>
			</div>
			<div class="vue-modal-dialog-body ">
				<transition name="fade" mode="out-in">
					<div v-if="is_active == 'gallery'" key="gallery">
						<transition name="fade" mode="out-in">
							<div class="card-section" v-if="is_loading" key="is-loading">
								<div class="text-center p-t-80 p-b-80">
									<div class="spinner-border icon-loading text-primary"></div>
								</div>
							</div>
							<div class="card-section" v-else key="loading-success">
								<template v-if="pagination.data.length">
									<div class="list-images">
										<div class="item-image" v-for="(item,index) in pagination.data" :class="{ 'is-selected' : isSelected(item.id)}" @click="select(item)" :key="`key_image${index}`">
											<img :src="item.path" alt="">
										</div>
									</div>
								</template>
								<pagination :change="getList" :router-link="false" v-model="pagination.current_page" :total="pagination.last_page"></pagination>
							</div>
						</transition>
					</div>
					<div v-else-if="is_active == 'upload'" key="upload">
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
									<a href="#" class="item-image-remove"><i class="fas fa-times-circle"></i></a>
								</div>
							</div>
						</div>
					</div>
				</transition>
			</div>
			<div class="vue-modal-dialog-footer ">
				<button class="secondary" @click="hide">Close</button>
				<template v-if="is_active == 'gallery'">
					<button class="primary" @click.stop.prevent="save" :disabled="selected == null ">Select</button>
				</template>
				<template v-else>
					<button class="primary" @click.stop.prevent="handleUpload()" :class="{ 'is-loading' : upload.is_loading }" >
						Upload
					</button>
				</template>
				
			</div>
		</div>
	</div>
</template>
<script>
import Modal from './index.js'
import { mapActions, mapGetters  } from 'vuex'
export default {
	name : 'VueModalDialog',
	data(){
		return {
			visible : false,
			options : {

			},
			selected : null,
			onSelect : null,
			is_active : 'gallery',
			pagination :{
                last_page : 0,
                current_page : 1,
                total : 0,
                limit : 21,
                data : [],
				keyword : '',
				group : ''
			},
			upload:{
				show :false,
				backdrop : true,
				data : [],
				group_id : '',
				is_loading : false,
				formstate: false
			},
            timeout: null,
            is_error : null,
			is_loading : false,
			backdrop : true
		}
	},
	computed:{
		...mapGetters({
			'groups' : 'gallery/get'
		})
	},
	methods:{
		...mapActions({
			getGallery : 'gallery/get',
			createGallery : 'gallery/create',
			fetchData : 'image/list',
			uploadImage : 'image/upload'
		}),
		show(onSelect){
			this.onSelect = onSelect
			this.visible = true 
			this.getList(1)
			this.$nextTick(()=>{
				setTimeout( ()=>{
					this.$el.classList.add("vue-modal-dialog-show");
				}, 10);
				document.body.classList.add("vue-modal-dialog-opened");
			})
		},
		hide(){
			if( !this.backdrop ) return; 
			this.$el.classList.remove("vue-modal-dialog-show");
			setTimeout( ()=>{
				this.visible = false
				document.body.classList.remove("vue-modal-dialog-opened");
				this.$emit('on-hide')
				this.onHide()
			}, 300);
		},
		save(){
			if( typeof this.onSelect == 'function'){
				this.onSelect(this.selected)
			}
			this.hide()
		},
		onHide(){
			this.selected =  null;
			this.onSelect =  null;
			this.is_active =  'gallery';
			this.pagination = {
                last_page : 0,
                current_page : 1,
                total : 0,
                limit : 21,
                data : [],
				keyword : '',
				group : ''
			}
			this.upload = {
				show :false,
				backdrop : true,
				data : [],
				group_id : '',
				is_loading : false,
				formstate: false
			}
		},
		clickBackdrop(){
			this.hide()
		},
		getList(page){
            this.is_loading = true
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
		handleUpload(){
			if( this.upload.is_loading == false){
				this.upload.is_loading = true
				this.backdrop = false
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
						this.getList(1)
						this.is_active = 'gallery'
						this.upload.data = []
                        this.$toasted.success('Upload successfully !')
                    }else{
                        this.$toasted.error(message)
                    }
				})
				.finally(()=>{
					this.upload.is_loading = false
					this.backdrop = true
				})
				
			}
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
		select(item){
			if( this.selected ){
				if( this.selected.id == item.id ){
					this.selected =null
				}else{
					this.selected = item 
				}
			}else{
				this.selected = item 
			}
		},
		isSelected(id){
			if( this.selected ){
				return this.selected.id == id 
			}
			return false
		}
	},
	beforeMount() {
		Modal.EventBus.$on('show', (params) => {
			this.show(params)
		})
  	}
}
</script>
<style lang="scss" >
	.vue-modal-dialog{
		position: fixed;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		z-index: 1050;
		display: flex;
		justify-content: center;
		align-items: center;
		opacity: 0;
		visibility: hidden;
		transition: all 0.3s ease;
		.icon-close{
			position: absolute;
			right: 10px;
			top: 10px;
			height: 30px;
			width: 30px;
			cursor: pointer;
			display: flex;
			justify-content: center;
			align-items: center;
			z-index: 1;
			opacity: 0.5;
			&:hover{
				opacity: 1;
			}
		}
		&-show{
			opacity: 1;
			visibility: visible;
		}
		&-opened{
			width: 100%;
			height: 100%;
			overflow: hidden;
		}
		&-container{
			width: 790px;
			border-radius: 5px;
			border: 1px solid #eee;
			box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
			background: #fff;
			position: relative;
			z-index: 11;
		}
		&-backdrop{
			background: rgba(0,0,0,0.5);
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			z-index: 10;
		}
		&-header{
			padding: 0 ;
			// border-bottom: 1px solid #eee;
			position: relative;
			height: 60px;
			background: #fff;
			h5{
				font-size: 20px;
				font-weight: bold;
				margin: 0;
			}
			
		}
		&-body{
			height: 400px;
			overflow: hidden auto;
			position: relative;
			.gallery-pagination{
				position: absolute;
				bottom: 0;
				left: 0;
				right: 0;
				z-index: 10;
				background: #fff;
			}
		}
		&-footer{
			border-top: 1px solid #eee;
			display: flex;
			justify-content: flex-end;
			flex-direction: row;
			height: 60px;
			padding: 11px 15px;
			background: #fff;
			button{
				margin-left: 15px;
			}
		}
	}
	.list-images{
		width: 100%;
		display: block;
		display: flex;
		flex-direction: row;
		flex-wrap: wrap;
		height: 330px;
		overflow: hidden auto;
		.item-image{
			width: 100px;
			height: 100px;
			margin: 5px;
			border: 2px solid #ddd;
			border-radius: 5px;
			overflow: hidden;
			display: flex;
			justify-content: center;
			align-items: center;
			position: relative;
			&.is-selected{
				border-color: $primary;
			}
			img{
				max-width: 100%;
				max-height: 100%;
			}
		}
	}
	.modal-upload-body{
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
				position: relative;
				a{
					position: absolute;
					top: 0;
					right: 0;
					color:$red;
				}
				img{
					max-width: 100%;
					max-height: 100%;
				}
				
			}
		}
	}
</style>