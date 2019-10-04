<template>
    <div class="vue-confirm-dialog">
        <transition name="fade" mode="out-in">
            <div class="modal" v-if="modal_show" ref="modal">
                <div class="modal-dialog" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ options.title }}</h5>
                            <a  class="close" @click="close()">
                                <i class="icon-close"></i>
                            </a>
                        </div>
                        <div class="modal-body">
                            {{ options.content }}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="button" v-if="options.btnCloseShow" :class="options.btnCloseClass" @click="close()">{{ options.btnClose}}</button>
                            <button type="button" class="button" v-if="options.btnSaveShow" :class="[{ 'is-loading' : options.isLoading } , options.btnSaveClass]" @click="onSave">
                                {{options.btnSave}}
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-backdrop" @click="close()"></div>
            </div>
        </transition>
    </div>
</template>
<script>
import Modal from '@/plugins/modal'
export default {
    data(){
        return {
            options : {
                title : '',
                content : '',
                btnClose : 'Close',
                btnCloseShow : true,
                btnCloseClass : 'secondary',
                btnSave : 'Done',
                btnSaveShow : true,
                btnSaveClass : '',
                onSave : null,
                onClose : null,
                isLoading: false,
            },
            modal_show: false
        }
    },
    methods: {
        onSave(){
            this.options.isLoading = true
            if( typeof this.options.onSave == 'function'){
                this.options.onSave().finally(()=>{
                    this.options.isLoading = false
                    this.close()
                })
            }else{
                this.options.isLoading = false
                this.close()
            }
        },
        show( options ){
            this.options = Object.assign(this.options ,options )
            this.modal_show = true
        },
        close(){
            if( this.options.isLoading ) return ;
            if( typeof this.options.onClose == 'function'){
                this.options.onClose().finally(()=>{
                    this.reset()
                })
            }else{
                this.reset()
            }
            this.modal_show = false
        },
        reset(){
            this.options = {
                title : '',
                content : '',
                btnClose : 'Close',
                btnCloseShow : true,
                btnCloseClass : 'secondary',
                btnSave : 'Done',
                btnSaveShow : true,
                btnSaveClass : '',
                onSave : null,
                onClose : null,
                isLoading: false,
            }
        },
    },
    beforeMount() {
        Modal.EventBus.$on('show', (options) => {
            this.show(options)
        })
    }
};
</script>
<style lang="scss" scoped>
    .vue-confirm-dialog{
        user-select: none;
        .modal{
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            padding: 50px 0;
            &-dialog{
                max-width: 450px;
                width: 450px;
                z-index: 1041;
            }
            &-header{
                .close{
                    width: 40px;
                }
            }
            &-body{
                padding: 30px 15px;
            }
            &-footer{
                button{

                }
            }
            &-backdrop{
                opacity: 0.5;
            }
        }
    }
</style>
