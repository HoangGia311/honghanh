<template>
    <div class="app-sidebar-container">
        <ul class="navbar">
            <li class="navbar-item"  :class="{ 'is-actived' : moduleActived('Dashboard') }">
                <router-link :to="{ name : 'Dashboard'}" :class="{ 'is-actived' : activeRouterLink('Dashboard')}" class="navbar-item-link">
                    <span class="navbar-item-icon">
                        <svg viewBox="0 0 20 20" class="p_v3ASA" focusable="false" aria-hidden="true"><path fill="currentColor" d="M7 13h6v6H7z"></path><path d="M19.664 8.252l-9-8a1 1 0 0 0-1.328 0L8 1.44V1a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v5.773L.336 8.252a1.001 1.001 0 0 0 1.328 1.496L2 9.449V19a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V9.449l.336.299a.997.997 0 0 0 1.411-.083 1.001 1.001 0 0 0-.083-1.413zM16 18h-2v-5a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v5H4V7.671l6-5.333 6 5.333V18zm-8 0v-4h4v4H8zM4 2h2v1.218L4 4.996V2z" fill-rule="evenodd"></path></svg>
                    </span>
                    <span class="navbar-item-text">Dashboard</span>
                </router-link>
                <ul class="navbar-submenu">
                    <li class="sub-item">
                        <router-link :to="{ name : 'Dashboard'}" :class="{ 'is-actived' : activeRouterLink('Dashboard')}" class="sub-item-link">
                            <span class="sub-item-icon">
                                <svg viewBox="0 0 20 20" class="p_v3ASA" focusable="false" aria-hidden="true"><path fill="currentColor" d="M7 13h6v6H7z"></path><path d="M19.664 8.252l-9-8a1 1 0 0 0-1.328 0L8 1.44V1a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v5.773L.336 8.252a1.001 1.001 0 0 0 1.328 1.496L2 9.449V19a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V9.449l.336.299a.997.997 0 0 0 1.411-.083 1.001 1.001 0 0 0-.083-1.413zM16 18h-2v-5a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v5H4V7.671l6-5.333 6 5.333V18zm-8 0v-4h4v4H8zM4 2h2v1.218L4 4.996V2z" fill-rule="evenodd"></path></svg>
                            </span>
                            <span class="sub-item-text">Dashboard</span>
                        </router-link>
                    </li>
                </ul>
            </li>
            <li class="navbar-item"  :class="{ 'is-actived' : moduleActived('Post') }">
                <router-link :to="{ name : 'Post'}" :class="{ 'is-actived' : activeRouterLink('Post')}" class="navbar-item-link">
                    <span class="navbar-item-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill="#637381" d="M18.878 1.122c-1.445-1.446-3.967-1.446-5.414 0L13 1.586 11.707.293A1.003 1.003 0 0 0 11 0H1a1 1 0 0 0-1 1v18a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V9.414l2.878-2.878A3.805 3.805 0 0 0 20 3.829a3.803 3.803 0 0 0-1.122-2.707zm-1.414 4L17 5.586 14.414 3l.464-.464c.691-.691 1.895-.691 2.586 0 .346.346.536.805.536 1.293 0 .488-.19.947-.536 1.293zM14 18H2V2h8.586l1 1-5.293 5.293a.976.976 0 0 0-.227.367c-.003.009-.012.015-.015.024l-2 6a.999.999 0 0 0 1.265 1.265l6-2c.01-.003.015-.012.024-.015a.976.976 0 0 0 .367-.227L14 11.414V18zm-6.563-7.15l1.712 1.713-2.568.856.856-2.568zm6.856-2.557L11 11.587 8.414 9 13 4.414 15.586 7l-1.293 1.293z"/></svg>

                    </span>
                    <span class="navbar-item-text">Posts</span>
                </router-link>
                <ul class="navbar-submenu">
                    <li class="sub-item">
                        <router-link :to="{ name : 'Post'}" :class="{ 'is-actived' : activeRouterLink('Post')}" class="sub-item-link">
                            <span class="sub-item-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill="#637381" d="M18.878 1.122c-1.445-1.446-3.967-1.446-5.414 0L13 1.586 11.707.293A1.003 1.003 0 0 0 11 0H1a1 1 0 0 0-1 1v18a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V9.414l2.878-2.878A3.805 3.805 0 0 0 20 3.829a3.803 3.803 0 0 0-1.122-2.707zm-1.414 4L17 5.586 14.414 3l.464-.464c.691-.691 1.895-.691 2.586 0 .346.346.536.805.536 1.293 0 .488-.19.947-.536 1.293zM14 18H2V2h8.586l1 1-5.293 5.293a.976.976 0 0 0-.227.367c-.003.009-.012.015-.015.024l-2 6a.999.999 0 0 0 1.265 1.265l6-2c.01-.003.015-.012.024-.015a.976.976 0 0 0 .367-.227L14 11.414V18zm-6.563-7.15l1.712 1.713-2.568.856.856-2.568zm6.856-2.557L11 11.587 8.414 9 13 4.414 15.586 7l-1.293 1.293z"/></svg>

                            </span>
                            <span class="sub-item-text">Posts</span>
                        </router-link>
                    </li>
                </ul>
            </li>
            <li class="navbar-item"  :class="{ 'is-actived' : moduleActived('Category') }">
                <router-link :to="{ name : 'Category'}" :class="{ 'is-actived' : activeRouterLink('Category')}" class="navbar-item-link">
                    <span class="navbar-item-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill="#637381" d="M2 18h16v-8H2v8zm17 2H1a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1h18a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1zM17 6H3a1 1 0 0 1 0-2h14a1 1 0 0 1 0 2zm-2-4H5a1 1 0 0 1 0-2h10a1 1 0 0 1 0 2z"/></svg>

                    </span>
                    <span class="navbar-item-text">Categories</span>
                </router-link>
                <ul class="navbar-submenu">
                    <li class="sub-item">
                        <router-link :to="{ name : 'Category'}" :class="{ 'is-actived' : activeRouterLink('Category')}" class="sub-item-link">
                            <span class="sub-item-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill="#637381" d="M2 18h16v-8H2v8zm17 2H1a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1h18a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1zM17 6H3a1 1 0 0 1 0-2h14a1 1 0 0 1 0 2zm-2-4H5a1 1 0 0 1 0-2h10a1 1 0 0 1 0 2z"/></svg>

                            </span>
                            <span class="sub-item-text">Categories</span>
                        </router-link>
                    </li>
                </ul>
            </li>
			<li class="navbar-item"  :class="{ 'is-actived' : moduleActived('Gallery') }">
                <router-link :to="{ name : 'Gallery'}" :class="{ 'is-actived' : activeRouterLink('Gallery')}" class="navbar-item-link">
                    <span class="navbar-item-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill="#637381" d="M2 18h16v-8H2v8zm17 2H1a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1h18a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1zM17 6H3a1 1 0 0 1 0-2h14a1 1 0 0 1 0 2zm-2-4H5a1 1 0 0 1 0-2h10a1 1 0 0 1 0 2z"/></svg>

                    </span>
                    <span class="navbar-item-text">Gallery</span>
                </router-link>
                <ul class="navbar-submenu">
                    <li class="sub-item">
                        <router-link :to="{ name : 'Gallery'}" :class="{ 'is-actived' : activeRouterLink('Gallery')}" class="sub-item-link">
                            <span class="sub-item-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill="#637381" d="M2 18h16v-8H2v8zm17 2H1a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1h18a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1zM17 6H3a1 1 0 0 1 0-2h14a1 1 0 0 1 0 2zm-2-4H5a1 1 0 0 1 0-2h10a1 1 0 0 1 0 2z"/></svg>

                            </span>
                            <span class="sub-item-text">Gallery</span>
                        </router-link>
                    </li>
                </ul>
            </li>
            <li class="navbar-item"  :class="{ 'is-actived' : moduleActived('Discount') }">
                <router-link :to="{ name : 'User'}" :class="{ 'is-actived' : activeRouterLink('User')}" class="navbar-item-link">
                    <span class="navbar-item-icon">
                        <svg viewBox="0 0 20 20" class="p_v3ASA" focusable="false" aria-hidden="true"><path d="M10 2c4.411 0 8 3.589 8 8s-3.589 8-8 8-8-3.589-8-8 3.589-8 8-8zm0 3c-1.104 0-2 .897-2 2s.896 2 2 2 2-.897 2-2-.896-2-2-2zm0 10c1.631 0 3.064-.792 3.978-2-.914-1.208-2.347-2-3.978-2-1.631 0-3.064.792-3.978 2 .914 1.208 2.347 2 3.978 2z"></path></svg>
                    </span>
                    <span class="navbar-item-text">Users</span>
                </router-link>
                <ul class="navbar-submenu">
                    <li class="sub-item">
                        <router-link :to="{ name : 'User'}" :class="{ 'is-actived' : activeRouterLink('User')}" class="sub-item-link">
                            <span class="sub-item-icon">
                                <svg viewBox="0 0 20 20" class="p_v3ASA" focusable="false" aria-hidden="true"><path d="M10 2c4.411 0 8 3.589 8 8s-3.589 8-8 8-8-3.589-8-8 3.589-8 8-8zm0 3c-1.104 0-2 .897-2 2s.896 2 2 2 2-.897 2-2-.896-2-2-2zm0 10c1.631 0 3.064-.792 3.978-2-.914-1.208-2.347-2-3.978-2-1.631 0-3.064.792-3.978 2 .914 1.208 2.347 2 3.978 2z"></path></svg>
                            </span>
                            <span class="sub-item-text">Users</span>
                        </router-link>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</template>
<script>
    export default {
        nane : 'Sidebar',
        data(){
            return {
                routers : {
                    'Dashboard' : ['Dashboard'],
                    'User' : ['User' ,'CreateUser' , 'EditUser'],
                    'Category' : ['Category' ,'CreateCategory' , 'EditCategory'],
					'Post' : ['Post' ,'CreatePost' , 'EditPost'],
					'Gallery' : ['Gallery']
                },
                modules : {
                    'Dashboard' : ['Dashboard'],
                    'User' : ['User' ,'CreateUser' , 'EditUser'],
                    'Category' : ['Category' ,'CreateCategory' , 'EditCategory'],
					'Post' : ['Post' ,'CreatePost' , 'EditPost'],
					'Gallery' : ['Gallery']
                }
            }
        },
        methods:{
            activeRouterLink(route){
                if( this.routers.hasOwnProperty(route)){
                    return this.routers[route].indexOf(this.$route.name) >= 0
                }
                return false
            },
            moduleActived(name){
                if( this.modules.hasOwnProperty(name)){
                    return this.modules[name].indexOf(this.$route.name) >= 0
                }
                return false
            }
        }
    }
</script>

<style lang="scss" scoped>
    ul{
        list-style-type: none;
    }
    .navbar{
        margin : 0;
        padding: 15px 0;
        .navbar-item{
            margin-bottom: 10px;
            position: relative;
            &-link{
                display: flex;
                align-items: center;
                justify-content: flex-start;
                color: #212b36;
                min-height: 40px;
                padding: 0 10px;
                margin: 0 10px;
                border-radius: 5px;
                font-weight: 600;
                transition: all 0.3s ease;
                &.is-actived{
                    font-weight: 600;
                    color: #202e78;
                    background: rgba(223,227,232,.7);
                    .navbar-item{
                        &-icon{
                            svg{
                                path {
                                    fill: #202e78;
                                }
                            }
                        }
                    }
                }
            }
            &-icon{
                display: block;
                height: 20px;
                width: 20px;
                max-height: 100%;
                max-width: 100%;
                margin-right: 15px;
                svg{
                    path {
                        fill: #919eab;
                        transition: all 0.3s ease;
                    }
                }
            }
            &-text{
                flex: 1 1 auto;
                margin-top: 1rem;
                margin-bottom: 1rem;
                line-height: 2rem;
                transition: all 0.3s ease;
            }
            &:hover{
                .navbar-item{
                    &-link{
                        background: rgba(223,227,232,.5);
                        color: #202e78;
                        text-decoration: none;
                    }
                    &-icon{
                        svg{
                            path {
                                fill: #202e78;
                            }
                        }
                    }
                }
            }
        }
        &-submenu{
            display: none;
            position: absolute;
            left: 100%;
            top: 0;
            min-width: 200px;
            padding: 15px 5px;
            border-radius: 5px;
            z-index: 10;
            background: #fff;
            margin: 0;
            min-height: 50px;
            transform: translateX(15px);
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s ease;
            box-shadow: 0 0 0 1px rgba(63,63,68,.05), 0 1px 3px 0 rgba(63,63,68,.15);
            &:after,
            &:before {
                content: '';
                display: block;
                position: absolute;
                right: 100%;
                width: 0;
                height: 0;
                border-style: solid;
            }

            &:after {
                top: 10px;
                border-color: transparent #fff transparent transparent;
                border-width: 10px;
            }

            &:before {
                top: 9px;
                border-color: transparent #ddd transparent transparent;
                border-width: 11px;
            }
            .sub-item{
                margin-bottom: 10px;
                position: relative;
                &:last-child{
                    margin-bottom: 0;
                }
                &-link{
                    display: flex;
                    align-items: center;
                    justify-content: flex-start;
                    color: #212b36;
                    min-height: 40px;
                    padding: 0 10px;
                    border-radius: 5px;
                    font-weight: 600;
                    transition: all 0.3s ease;
                    &.is-actived{
                        font-weight: 600;
                        color: #202e78;
                        background: rgba(223,227,232,.7);
                        .sub-item{
                            &-icon{
                                svg{
                                    path {
                                        fill: #202e78;
                                    }
                                }
                            }
                        }
                    }
                }
                &-icon{
                    display: block;
                    height: 20px;
                    width: 20px;
                    max-height: 100%;
                    max-width: 100%;
                    margin-right: 15px;
                    svg{
                        path {
                            fill: #919eab;
                            transition: all 0.3s ease;
                        }
                    }
                }
                &-text{
                    flex: 1 1 auto;
                    margin-top: 1rem;
                    margin-bottom: 1rem;
                    line-height: 2rem;
                    transition: all 0.3s ease;
                }
                &:hover{
                    .sub-item{
                        &-link{
                            background: rgba(223,227,232,.5);
                            color: #202e78;
                            text-decoration: none;
                        }
                        &-icon{
                            svg{
                                path {
                                    fill: #202e78;
                                }
                            }
                        }
                    }
                }
            }
        }
        @media(max-width:1600px){
            .navbar-submenu{
                display: block;
                
            }
            .navbar-item{
                &-link{

                }
                &-icon{
                    margin: 0;
                }
                &-text{
                    display: none;
                }
                &:hover{
                    .navbar-submenu{
                        display: block;
                        opacity: 1;
                        visibility: visible;
                        transform: translateX(3px);
                    }
                }
            }
        }
    }
</style>
