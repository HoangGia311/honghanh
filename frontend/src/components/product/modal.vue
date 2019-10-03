<template>
	<div class="vue-modal-dialog" v-if="visible">
		<div class="vue-modal-dialog-backdrop" @click="clickBackdrop"></div>
		<div class="vue-modal-dialog-container">
			<div class="icon-close" @click="hide">
				<i class="fal fa-times"></i>
			</div>
			<div class="vue-modal-dialog-body ">
				<transition name="fade" mode="out-in">    
					<div class="col col-12" v-if="is_loading" key="is-loading">
						<div class="text-center p-t-80 p-b-80">
							<div class="spinner-border icon-loading text-primary"></div>
						</div>
					</div>
					<div class="col col-12" v-else key="is-loading-success">
						<table>
							<thead>
								<tr>
									<th class="td-index">#</th>
									<th class="td-image">Image</th>
									<th class="td-name">Title</th>
									<th class="td-email">Alias</th>
								</tr>
							</thead>
							<tbody>
								<template v-if="pagination.data.length">
									<tr v-for="(item , index) in pagination.data" :key="`index_${index}`">
										<td class="td-index">
											<div class="div-checkbox" @click.stop.prevent="select(item)" :class="{ checked : isSelected(item.id)}"></div>
										</td>
										<td class="td-image">
											<div class="item-image">
												<template v-if="item.image">
													<img :src="item.image.path" alt="">
												</template>
												<template v-else>
													No image
												</template>
											</div>
										</td>
										<td class="td-name">
											{{ item.vi ? item.vi.name : '' }}
										</td>
										<td class="td-email">
											{{ item.alias }}
										</td>
									</tr>
								</template>
								<template v-else>
									<tr>
										<td colspan="20" class="text-center  p-t-30 p-b-30">
											<h3>
												Could not find any categories
											</h3>
										</td>
									</tr>
								</template>
							</tbody>
						</table>
						<div class="text-center m-t-20">
							<pagination v-model="pagination.current_page" :total="pagination.last_page" ></pagination>
						</div>
					</div>
				</transition>
			</div>
			<div class="vue-modal-dialog-footer ">
				<button class=" button secondary" @click="hide">Close</button>
				<button class=" button primary" @click.stop.prevent="save" :disabled="!selected.length">Select</button>
			</div>
		</div>
	</div>
</template>
<script>
import Modal from './index.js'
import { mapActions, mapGetters  } from 'vuex'
import _ from  'lodash'
export default {
	name : 'VueModalDialog',
	data(){
		return {
			visible : false,
			options : {

			},
			selected : [],
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
            timeout: null,
            is_error : null,
			is_loading : false,
			backdrop : true
		}
	},
	methods:{
		...mapActions({
			fetchData : 'product/list',
		}),
		show(onSelect){
			this.onSelect = onSelect
			this.visible = true 
			this.getList(1)
			this.$nextTick(()=>{
				setTimeout( ()=>{
					this.$el.classList.add("vue-modal-dialog-show");
				}, 10);
				document.body.classList.add("vue-modal-dialog-product-opened");
			})
		},
		hide(){
			if( !this.backdrop ) return; 
			this.$el.classList.remove("vue-modal-dialog-show");
			setTimeout( ()=>{
				this.visible = false
				document.body.classList.remove("vue-modal-dialog-product-opened");
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
			this.selected =  [];
			this.onSelect =  null;
			this.pagination = {
                last_page : 0,
                current_page : 1,
                total : 0,
                limit : 21,
                data : [],
				keyword : '',
				group : ''
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
		select(item){
			var index = _.findIndex(this.selected , { id : item.id })
			if( index >= 0){
				this.selected.splice(index,1)
			}else{
				this.selected.push(item)
			}
		},
		isSelected(id){
			var index = _.findIndex(this.selected , { id : id })
			return index >= 0
		}
	},
	beforeMount() {
		Modal.EventBus.$on('show', (params) => {
			this.show(params)
		})
	},
	  beforeDestroy(){
		document.body.classList.remove("vue-modal-dialog-product-opened");
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
		&-product-opened{
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
		.td{
			&-index{
				width: 50px;
				text-align: center;
			}
			&-name{

			}
			&-image{
				max-width: 100px;
				width: 100px;
				min-width: 100px;
				.item-image{
					width: 40px;
					height: 40px;
					border-radius: 4px;
					border: 1px soldi #ddd;
					overflow: hidden;
					display: flex;
					align-items: center;
					justify-content: center;
					img{
						max-width: 100%;
						max-height: 100%;
					}
				}
			}
			&-actions{
				width: 150px;
				text-align: center;
			}
		}
	}
</style>