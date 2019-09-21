@extends('primary.layouts.app')
@section('content')
<div class="section section-about-us " id="mouse-scroll-to">
	<div class="container section-container">
		<div class="row">
			<div class="col col-12">
				<ul class="nav nav-pills m-b-30">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="pill" href="#about-us-tab1" role="tab">
							Về chúng tôi
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="pill" href="#about-us-tab2" role="tab">
							Quy trình sản phẩm
						</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="tab-content" >
				<div class="tab-pane fade show active" id="about-us-tab1" role="tabpanel">
					<div class="background-about-us" >
						<img src="{{asset('admin/resources/images/banner/about-2.png')}}" alt="" srcset="">
					</div>
				</div>
				<div class="tab-pane fade" id="about-us-tab2" role="tabpanel">
					<div class="background-flow-us" >
						<img src="{{asset('admin/resources/images/banner/about-3.png')}}" alt="" srcset="">
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>
</main>
@endsection
