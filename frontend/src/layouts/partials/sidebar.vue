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
			<li class="navbar-item"  :class="{ 'is-actived' : moduleActived('Product') }">
                <router-link :to="{ name : 'Product'}" :class="{ 'is-actived' : activeRouterLink('Product')}" class="navbar-item-link">
                    <span class="navbar-item-icon">
                        <svg viewBox="0 0 20 20" class="p_v3ASA" focusable="false" aria-hidden="true"><path fill="currentColor" d="M4 7l-3 3 9 9 3-3z"></path><path d="M19 0h-9c-.265 0-.52.106-.707.293l-9 9a.999.999 0 0 0 0 1.414l9 9a.997.997 0 0 0 1.414 0l9-9A.997.997 0 0 0 20 10V1a1 1 0 0 0-1-1zm-9 17.586L2.414 10 4 8.414 11.586 16 10 17.586zm8-8l-5 5L5.414 7l5-5H18v7.586zM15 6a1 1 0 1 0 0-2 1 1 0 0 0 0 2"></path></svg>

                    </span>
                    <span class="navbar-item-text">Products</span>
                </router-link>
                <ul class="navbar-submenu">
                    <li class="sub-item">
                        <router-link :to="{ name : 'Product'}" :class="{ 'is-actived' : activeRouterLink('Product')}" class="sub-item-link">
                            <span class="sub-item-icon">
                                 <svg viewBox="0 0 20 20" class="p_v3ASA" focusable="false" aria-hidden="true"><path fill="currentColor" d="M4 7l-3 3 9 9 3-3z"></path><path d="M19 0h-9c-.265 0-.52.106-.707.293l-9 9a.999.999 0 0 0 0 1.414l9 9a.997.997 0 0 0 1.414 0l9-9A.997.997 0 0 0 20 10V1a1 1 0 0 0-1-1zm-9 17.586L2.414 10 4 8.414 11.586 16 10 17.586zm8-8l-5 5L5.414 7l5-5H18v7.586zM15 6a1 1 0 1 0 0-2 1 1 0 0 0 0 2"></path></svg>

                            </span>
                            <span class="sub-item-text">Products</span>
                        </router-link>
                    </li>
                </ul>
            </li>
			<li class="navbar-item"  :class="{ 'is-actived' : moduleActived('Cooking') }">
                <router-link :to="{ name : 'Cooking'}" :class="{ 'is-actived' : activeRouterLink('Cooking')}" class="navbar-item-link">
                    <span class="navbar-item-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill="#637381" d="M18.878 1.122c-1.445-1.446-3.967-1.446-5.414 0L13 1.586 11.707.293A1.003 1.003 0 0 0 11 0H1a1 1 0 0 0-1 1v18a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V9.414l2.878-2.878A3.805 3.805 0 0 0 20 3.829a3.803 3.803 0 0 0-1.122-2.707zm-1.414 4L17 5.586 14.414 3l.464-.464c.691-.691 1.895-.691 2.586 0 .346.346.536.805.536 1.293 0 .488-.19.947-.536 1.293zM14 18H2V2h8.586l1 1-5.293 5.293a.976.976 0 0 0-.227.367c-.003.009-.012.015-.015.024l-2 6a.999.999 0 0 0 1.265 1.265l6-2c.01-.003.015-.012.024-.015a.976.976 0 0 0 .367-.227L14 11.414V18zm-6.563-7.15l1.712 1.713-2.568.856.856-2.568zm6.856-2.557L11 11.587 8.414 9 13 4.414 15.586 7l-1.293 1.293z"/></svg>
                    </span>
                    <span class="navbar-item-text">Cookings</span>
                </router-link>
                <ul class="navbar-submenu">
                    <li class="sub-item">
                        <router-link :to="{ name : 'Cooking'}" :class="{ 'is-actived' : activeRouterLink('Cooking')}" class="sub-item-link">
                            <span class="sub-item-icon">
                               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill="#637381" d="M18.878 1.122c-1.445-1.446-3.967-1.446-5.414 0L13 1.586 11.707.293A1.003 1.003 0 0 0 11 0H1a1 1 0 0 0-1 1v18a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V9.414l2.878-2.878A3.805 3.805 0 0 0 20 3.829a3.803 3.803 0 0 0-1.122-2.707zm-1.414 4L17 5.586 14.414 3l.464-.464c.691-.691 1.895-.691 2.586 0 .346.346.536.805.536 1.293 0 .488-.19.947-.536 1.293zM14 18H2V2h8.586l1 1-5.293 5.293a.976.976 0 0 0-.227.367c-.003.009-.012.015-.015.024l-2 6a.999.999 0 0 0 1.265 1.265l6-2c.01-.003.015-.012.024-.015a.976.976 0 0 0 .367-.227L14 11.414V18zm-6.563-7.15l1.712 1.713-2.568.856.856-2.568zm6.856-2.557L11 11.587 8.414 9 13 4.414 15.586 7l-1.293 1.293z"/></svg>

                            </span>
                            <span class="sub-item-text">Cookings</span>
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
                       <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'><path fill='#fff' d='M14 9l-5 5-3-2-5 3v4h18v-6z'/><path fill='rgb(145,158,171)' d='M19 0H1C.448 0 0 .448 0 1v18c0 .552.448 1 1 1h18c.552 0 1-.448 1-1V1c0-.552-.448-1-1-1zM8 6c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm0 4c1.654 0 3-1.346 3-3S9.654 4 8 4 5 5.346 5 7s1.346 3 3 3zm-6 8v-2.434l3.972-2.383 2.473 1.65c.398.264.925.21 1.262-.126l4.367-4.367L18 13.48V18H2zM18 2v8.92l-3.375-2.7c-.398-.32-.973-.287-1.332.073l-4.42 4.42-2.318-1.545c-.322-.214-.74-.225-1.07-.025L2 13.233V2h16z'/></svg>

                    </span>
                    <span class="navbar-item-text">Gallery</span>
                </router-link>
                <ul class="navbar-submenu">
                    <li class="sub-item">
                        <router-link :to="{ name : 'Gallery'}" :class="{ 'is-actived' : activeRouterLink('Gallery')}" class="sub-item-link">
                            <span class="sub-item-icon">
                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'><path fill='#fff' d='M14 9l-5 5-3-2-5 3v4h18v-6z'/><path fill='rgb(145,158,171)' d='M19 0H1C.448 0 0 .448 0 1v18c0 .552.448 1 1 1h18c.552 0 1-.448 1-1V1c0-.552-.448-1-1-1zM8 6c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm0 4c1.654 0 3-1.346 3-3S9.654 4 8 4 5 5.346 5 7s1.346 3 3 3zm-6 8v-2.434l3.972-2.383 2.473 1.65c.398.264.925.21 1.262-.126l4.367-4.367L18 13.48V18H2zM18 2v8.92l-3.375-2.7c-.398-.32-.973-.287-1.332.073l-4.42 4.42-2.318-1.545c-.322-.214-.74-.225-1.07-.025L2 13.233V2h16z'/></svg>

                            </span>
                            <span class="sub-item-text">Gallery</span>
                        </router-link>
                    </li>
                </ul>
            </li>
			<li class="navbar-item"  :class="{ 'is-actived' : moduleActived('Theme') }">
                <router-link :to="{ name : 'Theme'}" :class="{ 'is-actived' : activeRouterLink('Theme')}" class="navbar-item-link">
                    <span class="navbar-item-icon">
                        
						<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'><path fill='#fff' d='M11 1l8 8v8c0 1.104-.896 2-2 2s-2-.896-2-2v-6c0 1.104-.896 2-2 2s-2-.896-2-2V1z'/><path fill='rgb(145,158,171)' d='M17.98 17c0 .55-.45 1-1 1s-1-.45-1-1v-6c0-.552-.448-1-1-1s-1 .448-1 1c0 .55-.45 1-1 1s-1-.45-1-1V3.414l6 6V17zm-9.587-2.07c-1.243 0-2.413.483-3.293 1.363l-1.414 1.414c-.208.21-.505.317-.788.29-.298-.024-.56-.175-.74-.424-.274-.38-.19-.976.19-1.356l1.338-1.34c.94-.94 1.384-2.187 1.35-3.423l3.483 3.483c-.043 0-.084-.008-.127-.008zm3.094.148L4.902 8.492 9.98 3.414V11c0 1.525 1.147 2.774 2.623 2.962l-1.116 1.116zm8.2-6.785l-8-8c-.19-.19-.447-.283-.707-.283V0c-.014 0-.027.007-.04.008-.106.004-.21.023-.31.06-.01.004-.02.003-.03.007h-.003c-.112.048-.208.118-.294.197-.01.01-.02.012-.03.02l-8 8c-.39.392-.39 1.024 0 1.415 1.035 1.036 1.035 2.722 0 3.757l-1.34 1.34c-1.07 1.07-1.242 2.764-.397 3.938.52.722 1.323 1.177 2.202 1.248.08.007.162.01.243.01.794 0 1.556-.313 2.12-.88l1.415-1.413c1.004-1.005 2.755-1.004 3.758 0 .187.188.44.293.707.293s.52-.105.707-.293l2.293-2.293V17c0 1.654 1.346 3 3 3s3-1.346 3-3V9c0-.265-.105-.52-.293-.707z'/></svg>

                    </span>
                    <span class="navbar-item-text">Themes</span>
                </router-link>
                <ul class="navbar-submenu">
                    <li class="sub-item">
                        <router-link :to="{ name : 'Theme'}" :class="{ 'is-actived' : activeRouterLink('Theme')}" class="sub-item-link">
                            <span class="navbar-item-icon">
								
								<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'><path fill='#fff' d='M11 1l8 8v8c0 1.104-.896 2-2 2s-2-.896-2-2v-6c0 1.104-.896 2-2 2s-2-.896-2-2V1z'/><path fill='rgb(145,158,171)' d='M17.98 17c0 .55-.45 1-1 1s-1-.45-1-1v-6c0-.552-.448-1-1-1s-1 .448-1 1c0 .55-.45 1-1 1s-1-.45-1-1V3.414l6 6V17zm-9.587-2.07c-1.243 0-2.413.483-3.293 1.363l-1.414 1.414c-.208.21-.505.317-.788.29-.298-.024-.56-.175-.74-.424-.274-.38-.19-.976.19-1.356l1.338-1.34c.94-.94 1.384-2.187 1.35-3.423l3.483 3.483c-.043 0-.084-.008-.127-.008zm3.094.148L4.902 8.492 9.98 3.414V11c0 1.525 1.147 2.774 2.623 2.962l-1.116 1.116zm8.2-6.785l-8-8c-.19-.19-.447-.283-.707-.283V0c-.014 0-.027.007-.04.008-.106.004-.21.023-.31.06-.01.004-.02.003-.03.007h-.003c-.112.048-.208.118-.294.197-.01.01-.02.012-.03.02l-8 8c-.39.392-.39 1.024 0 1.415 1.035 1.036 1.035 2.722 0 3.757l-1.34 1.34c-1.07 1.07-1.242 2.764-.397 3.938.52.722 1.323 1.177 2.202 1.248.08.007.162.01.243.01.794 0 1.556-.313 2.12-.88l1.415-1.413c1.004-1.005 2.755-1.004 3.758 0 .187.188.44.293.707.293s.52-.105.707-.293l2.293-2.293V17c0 1.654 1.346 3 3 3s3-1.346 3-3V9c0-.265-.105-.52-.293-.707z'/></svg>

							</span>
                            <span class="sub-item-text">Themes</span>
                        </router-link>
                    </li>
                </ul>
            </li>
            <li class="navbar-item"  :class="{ 'is-actived' : moduleActived('User') }">
                <router-link :to="{ name : 'User'}" :class="{ 'is-actived' : activeRouterLink('User')}" class="navbar-item-link">
                    <span class="navbar-item-icon">
                        
						<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'><path fill='#fff' d='M10 13c-4 0-7 3-7 3l1 3h12l1-3s-3-3-7-3z'/><path fill='rgb(145,158,171)' d='M17.707 15.293c.268.268.36.664.24 1.023l-1 3c-.135.41-.517.684-.947.684H4c-.43 0-.813-.275-.95-.684l-1-3c-.12-.36-.025-.755.243-1.023C2.427 15.158 5.635 12 10 12s7.572 3.158 7.707 3.293zM15.28 18l.56-1.687C14.92 15.56 12.687 14 10 14c-2.703 0-4.927 1.558-5.843 2.31L4.72 18h10.56zM10 2c1.654 0 3 1.346 3 3s-1.346 3-3 3-3-1.346-3-3 1.346-3 3-3zm0 8c2.757 0 5-2.243 5-5s-2.243-5-5-5-5 2.243-5 5 2.243 5 5 5z'/></svg>
                    </span>
                    <span class="navbar-item-text">Users</span>
                </router-link>
                <ul class="navbar-submenu">
                    <li class="sub-item">
                        <router-link :to="{ name : 'User'}" :class="{ 'is-actived' : activeRouterLink('User')}" class="sub-item-link">
                            <span class="sub-item-icon">
                                
								<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'><path fill='#fff' d='M10 13c-4 0-7 3-7 3l1 3h12l1-3s-3-3-7-3z'/><path fill='rgb(145,158,171)' d='M17.707 15.293c.268.268.36.664.24 1.023l-1 3c-.135.41-.517.684-.947.684H4c-.43 0-.813-.275-.95-.684l-1-3c-.12-.36-.025-.755.243-1.023C2.427 15.158 5.635 12 10 12s7.572 3.158 7.707 3.293zM15.28 18l.56-1.687C14.92 15.56 12.687 14 10 14c-2.703 0-4.927 1.558-5.843 2.31L4.72 18h10.56zM10 2c1.654 0 3 1.346 3 3s-1.346 3-3 3-3-1.346-3-3 1.346-3 3-3zm0 8c2.757 0 5-2.243 5-5s-2.243-5-5-5-5 2.243-5 5 2.243 5 5 5z'/></svg>
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
					'Product' : ['Product' ,'CreateProduct' , 'EditProduct'],
					'Cooking' : ['Cooking' ,'CreateCooking' , 'EditCooking'],
					'Post' : ['Post' ,'CreatePost' , 'EditPost'],
					'Gallery' : ['Gallery']
                },
                modules : {
                    'Dashboard' : ['Dashboard'],
                    'User' : ['User' ,'CreateUser' , 'EditUser'],
					'Category' : ['Category' ,'CreateCategory' , 'EditCategory'],
					'Product' : ['Product' ,'CreateProduct' , 'EditProduct'],
					'Cooking' : ['Cooking' ,'CreateCooking' , 'EditCooking'],
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
