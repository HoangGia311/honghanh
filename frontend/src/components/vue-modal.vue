<template>
	<div class="vue-modal-dialog" v-if="visible">
		<div class="vue-modal-dialog-backdrop" @click="clickBackdrop"></div>
		<div class="vue-modal-dialog-container" :style="{ width : width}">
			<div class="icon-close" @click="hide">
				<i class="fal fa-times"></i>
			</div>
			<div class="vue-modal-dialog-header">
				<slot name="modal-header"></slot>
			</div>
			<div class="vue-modal-dialog-body ">
				<slot name="modal-body"></slot>
			</div>
			<div class="vue-modal-dialog-footer ">
				<slot name="modal-footer"></slot>
			</div>
		</div>
	</div>
</template>
<script>
export default {
	name : 'VueModalDialog',
	props:{
		value :{
			type : Boolean,
			required : true,
		},
		backdrop:{
			type : Boolean,
			default : true
		},
		width :{
			type : String,
			default : '400px'
		}
	},
	data(){
		return {
		}
	},
	computed:{
		visible : {
			get(){
				return this.value
			},
			set(value){
				this.$emit('input', value)
			}
		}
	},
	methods:{
		show(){
			this.visible = true 
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
			}, 300);
		},
		save(){
			
		},
		clickBackdrop(){
			this.hide()
		},
	},
	watch :{
		'value' : function(value){
			if( value ){
				this.show()
			}else{
				this.hide()
			}
		}
	},
	beforeDestroy(){
		document.body.classList.remove("vue-modal-dialog-opened");
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
			// min-height: 200px;
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
			// padding: 15px ;
			// border-bottom: 1px solid #eee;
			position: relative;
			h5{
				font-size: 20px;
				font-weight: bold;
				margin: 0;
			}
			
		}
		&-body{
			min-height: 100px;
		}
		&-footer{
			// padding: 15px ;
			// border-top: 1px solid #eee;
			display: flex;
			justify-content: flex-end;
			flex-direction: row;
			button{
				margin-left: 15px;
			}
		}
	}
</style>