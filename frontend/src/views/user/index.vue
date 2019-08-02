<template>
    <div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col col-10">
                        <div class="input-group input-group-search">
                            <input type="text" class="form-control" v-model="pagination.keyword" @keyup="onKeyword">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" >
                                    <i class="material-icons">search</i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col col-2">
                        <div class="text-right">
                            <button class="btn btn-primary">
                                + Thêm người dùng
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row m-t-15">
                    <div class="col col-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="td-index">#</th>
                                    <th scope="col" class="td-name">Name</th>
                                    <th scope="col" class="td-role">Role</th>
                                    <th scope="col" class="td-status">Status</th>
                                    <th scope="col" class="td-action"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="td-index">#</td>
                                    <td class="td-name">Name</td>
                                    <td class="td-role">Role</td>
                                    <td class="td-status">Status</td>
                                    <td class="td-action"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions  } from 'vuex'
export default {
    name : 'ListUsers',
    data(){
        return {

        }
    },
    data(){
        return {
            pagination :{
                total_page : 0,
                current_page : 1,
                total : 0,
                limit : 10,
                data : [],
                keyword : '',
                role: ''
            },
            timeout: null,
            is_error : null,
            is_loading : false,
        }
    },
    methods:{
        ...mapActions({
            fetchData : 'User/GET',
        }),
        getList(route){
            this.is_loading = true
            var current_page = route.query.page ? route.query.page : 1 
            var keyword = route.query.keyword ? route.query.keyword :  ''
            var limit = this.pagination.limit 
            this.fetchData({ 
                current_page , 
                keyword,
                limit,
            })
            .then((res)=>{
                let { status , data , pagination } = res.data
                if( status ){
                    this.is_error = null
                    this.pagination.data = data 
                    this.pagination.current_page = pagination.current_page
                    this.pagination.total_page = pagination.total_page
                    this.pagination.total = pagination.total 
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
        onChangeKeyword(){
            var query = {
                
            }
            var keyword = this.pagination.keyword.trim()
            if( keyword ){
                query['keyword'] = keyword
            }
            this.pushRouterLinkDefault({
                query : query
            })
        },
        onChangeRole(){
            var query = {
                
            }
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
