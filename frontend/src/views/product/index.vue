<template>
    <div class="page">
        <div class="page-header">
            <div class="page-title">
                <h1>Products</h1>
            </div>
            <div class="page-actions">
                <router-link class="button" :to="{ name : 'CreateProduct'}">
                    Add product
                </router-link>
            </div>
        </div>
        <div class="page-body">
            <div class="card">
                <div class="card-section">
                    <div class="row">
                        <div class="col col-12 m-b-30">
                            <div class="input-group">
                                <button class="secondary">Filters</button>
                                <input type="search" v-model="pagination.keyword" @keyup="onKeyword"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
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
                                            <th class="td-name">Name</th>
                                            <th class="td-email">Alias</th>
                                            <th class="td-actions">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template v-if="pagination.data.length">
                                            <tr v-for="(item , index) in pagination.data" :key="`index_${index}`">
                                                <td class="td-index">
                                                    {{ pagination.limit * ( pagination.current_page - 1) + index + 1 }}
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
                                                <td class="td-actions">
                                                    <router-link class="button secondary icon-edit" :to="{ name : 'EditProduct' , params : { id : item.id}}"></router-link>
                                                    <button class="secondary icon-trash" @click.stop.prevent="remove(item.id)"></button>
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
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions  } from 'vuex'
export default {
    name : 'Discount',
    data(){
        return {
            pagination :{
                last_page : 0,
                current_page : 1,
                total : 0,
                limit : 10,
                data : [],
                keyword : '',
            },
            timeout: null,
            is_error : null,
            is_loading : false,
        }
    },
    methods : {
        ...mapActions({
            fetchData : 'product/list',
            delete : 'product/delete'
        }),
        getList(route){
            this.is_loading = true
            var page = route.query.page ? route.query.page : 1 
            var keyword = route.query.keyword ? route.query.keyword :  ''
            var limit = this.pagination.limit 
            this.fetchData({ 
                page , 
                keyword,
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
        onChangeKeyword(){
            var query = {}
            var keyword = this.pagination.keyword.trim()
            if( keyword ){
                query['keyword'] = keyword
            }
            this.pushRouterLinkDefault({
                query : query
            })
        },
        onKeyword(event){
            clearTimeout(this.timeout)
            if( event.keyCode == 13){
                if( typeof this.onChangeKeyword == 'function'){
                    this.onChangeKeyword()
                }
            }else{
                this.timeout = setTimeout(() => {
                    if( typeof this.onChangeKeyword == 'function'){
                        this.onChangeKeyword()
                    }
                }, 1000);
            }
        },
        remove(id){
            this.$confirm.show({
                title : 'Confirm',
                content : 'Do do want to delete this product ?',
                btnSave : 'Delete',
                btnSaveClass : 'warning',
                btnClose: 'Cancel',
                onSave : () => {
                    return new Promise((resolve , reject) =>{
                        this.delete(id).then((res)=>{
                            let { code  , message = ''} = res.data 
                            if( code ){
                                this.reload()
                                this.$toasted.success(message)
                            }else{
                                this.$toasted.error(message)
                            }
                        })
                        .catch((err)=>{
                            console.log(err)
                            this.$toasted.error('Error !')
                        })
                        .finally((res)=>{
                            resolve()
                        })
                    })
                }
            })
        },
    },
    beforeRouteUpdate (to, from, next) {
        this.getList(to)
        next()
    },
    created(){
        this.pagination.keyword = this.$route.query.keyword ? this.$route.query.keyword :  ''
        this.getList(this.$route)
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
</style>