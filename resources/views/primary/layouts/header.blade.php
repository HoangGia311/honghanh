<div class="wrapper">
    <header class="header">
		<div class="header-mobile">
			<div class="header-mobile-left">
				<button class="header-toggle" type="button" >
					<span></span>
				</button>
			</div>
			<div class="header-mobile-right">
				<a class="header-mobile-brand" href="/">
					<img src="{{asset('admin/resources/images/logo/logo.png')}}" alt="">
				</a>
			</div>
		</div>
		<div class="header-container">
			<div class="header-top">
				<div class="header-top-wrap container">
					<div class="header-search">
						<form action="" class="header-search-form">
							<button>
								<i class="fas fa-search"></i>
							</button>
							<input type="text">
						</form>
					</div>
					<div class="header-icons">
						<a href="#"><i class="fab fa-facebook-f"></i></a>
						<a href="#"><i class="fab fa-google-plus-g"></i></a>
						<a href="#"><i class="fab fa-youtube"></i></a>
					</div>
					<div class="header-langs">
						<a href="#">Eng</a>
						<a href="#">Vie</a>
					</div>
				</div>
			</div>
			<div class="header-center">
				<div class="header-navbar container">
					<a class="navbar-brand" href="/">
						<img src="{{asset('admin/resources/images/logo/logo.png')}}" alt="">
					</a>
					<nav class="navbar">
						<ul class="navbar-menu">
							<li class="nav-item @if($page == 'home') active @endif">
								<a class="nav-link" href="/">Trang chủ</a>
							</li>
							<li class="nav-item @if($page == 'about_us') active @endif" >
								<a class="nav-link" href="/ve-chung-toi">Về chúng tôi</a>
							</li>
							<li class="nav-item @if($page == 'product') active @endif">
								<a class="nav-link" href="/san-pham">Sản phẩm</a>
							</li>
							<li class="nav-item @if($page == 'distribution') active @endif">
								<a class="nav-link" href="/phan-phoi">Phân phối</a>
							</li>
							<li class="nav-item @if($page == 'cooking') active @endif">
								<a class="nav-link" href="/mon-ngon">Món ngon</a>
							</li>
							<li class="nav-item @if($page == 'post') active @endif">
								<a class="nav-link" href="/tin-tuc">Tin tức</a>
							</li>
							<li class="nav-item @if($page == 'contact') active @endif">
								<a class="nav-link" href="/lien-he">Liên hệ</a>
							</li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
    </header>
    <main class="main">
        <div class="section section-home-slider" >
			<div class="home-slider" id="slider">
				<div class="item-slide">
					<img src="{{asset('admin/resources/images/banner/22.png')}}" alt="">
				</div>
				<div class="item-slide">
					<img src="{{asset('admin/resources/images/banner/22.png')}}" alt="">
				</div>
			</div>
			<div class="icon-mouse-down" id="icon-mouse"></div>
        </div>