@extends('primary.layouts.app')
@section('content')
<div class="section section-store" id="mouse-scroll-to">
	<div class="container section-container">
		<div class="row">
			<div class="col col-12">
				<ul class="nav nav-pills m-b-30">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="pill" href="#store-traditional" role="tab">
							Truyền thống
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="pill" href="#store-modern" role="tab">
							Hiện đại
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="pill" href="#store-horeca" role="tab">
							Horeca
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="pill" href="#store-export" role="tab">
							Xuất khẩu
						</a>
					</li>
				</ul>
				<div class="tab-content" id="pills-tabContent">
					<div class="tab-pane fade show active" id="store-traditional" role="tabpanel">
						<div class="store-traditional">
							<div class="store-traditional-image">
								<img src="{{asset('admin/resources/images/store/1.jpg')}}" alt="">
							</div>
							<div class="store-traditional-content">
								<div class="store-traditional-content-wrap">
									<p>
										Sản phẩm nước mắm Hồng Hạnh đã có mặt tại các chợ truyền thống và
										quầy tạp hóa trên cả nước, với thị trường chủ lực là TP.HCM, Vũng
										Tàu, Bình Dương, Bình Phước, Đồng Nai, Tây Ninh và các tỉnh miền Tây
										Nam Bộ.
									</p>
									<p>
										Ngoài ra, Hồng Hạnh tiếp tục mở rộng, đẩy mạnh thị trường miền Bắc,
										đưa sản phẩm nước mắm truyền thống Phú Quốc đến gần hơn với người
										tiêu dùng
									</p>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="store-modern" role="tabpanel">
						<div class="store-modern">
							<div class="list-icons">
								<div class="item-icon">
									<div class="item-icon-image">
										<img src="{{asset('admin/resources/images/store/icon/1.jpg')}}" alt="">
									</div>
								</div>
								<div class="item-icon">
									<div class="item-icon-image">
										<img src="{{asset('admin/resources/images/store/icon/2.jpg')}}" alt="">
									</div>
								</div>
								<div class="item-icon">
									<div class="item-icon-image">
										<img src="{{asset('admin/resources/images/store/icon/3.jpg')}}" alt="">
									</div>
								</div>
								<div class="item-icon">
									<div class="item-icon-image">
										<img src="{{asset('admin/resources/images/store/icon/4.jpg')}}" alt="">
									</div>
								</div>
								<div class="item-icon">
									<div class="item-icon-image">
										<img src="{{asset('admin/resources/images/store/icon/5.jpg')}}" alt="">
									</div>
								</div>
								<div class="item-icon">
									<div class="item-icon-image">
										<img src="{{asset('admin/resources/images/store/icon/6.jpg')}}" alt="">
									</div>
								</div>
								<div class="item-icon">
									<div class="item-icon-image">
										<img src="{{asset('admin/resources/images/store/icon/7.jpg')}}" alt="">
									</div>
								</div>
								<div class="item-icon">
									<div class="item-icon-image">
										<img src="{{asset('admin/resources/images/store/icon/8.jpg')}}" alt="">
									</div>
								</div>
								<div class="item-icon">
									<div class="item-icon-image">
										<img src="{{asset('admin/resources/images/store/icon/9.jpg')}}" alt="">
									</div>
								</div>
								<div class="item-icon">
									<div class="item-icon-image">
										<img src="{{asset('admin/resources/images/store/icon/10.jpg')}}" alt="">
									</div>
								</div>
								<div class="item-icon">
									<div class="item-icon-image">
										<img src="{{asset('admin/resources/images/store/icon/11.jpg')}}" alt="">
									</div>
								</div>
								<div class="item-icon">
									<div class="item-icon-image">
										<img src="{{asset('admin/resources/images/store/icon/12.jpg')}}" alt="">
									</div>
								</div>
								<div class="item-icon">
									<div class="item-icon-image">
										<img src="{{asset('admin/resources/images/store/icon/13.jpg')}}" alt="">
									</div>
								</div>
								<div class="item-icon">
									<div class="item-icon-image">
										<img src="{{asset('admin/resources/images/store/icon/14.jpg')}}" alt="">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="store-horeca" role="tabpanel">
						<div class="store-horeca">
							<div class="store-horeca-title">
								Hồng Hạnh đồng hành cùng những bữa ăn ngon
							</div>
							<div class="list-icons">
								<div class="item-icons">
									<div class="item-icon-image">
										<img src="{{asset('admin/resources/images/store/horeca/1.jpg')}}" alt="">
									</div>
								</div>
								<div class="item-icons">
									<div class="item-icon-image">
										<img src="{{asset('admin/resources/images/store/horeca/2.jpg')}}" alt="">
									</div>
								</div>
								<div class="item-icons">
									<div class="item-icon-image">
										<img src="{{asset('admin/resources/images/store/horeca/3.jpg')}}" alt="">
									</div>
								</div>
								<div class="item-icons">
									<div class="item-icon-image">
										<img src="{{asset('admin/resources/images/store/horeca/4.jpg')}}" alt="">
									</div>
								</div>
								<div class="item-icons">
									<div class="item-icon-image">
										<img src="{{asset('admin/resources/images/store/horeca/5.jpg')}}" alt="">
									</div>
								</div>
								<div class="item-icons">
									<div class="item-icon-image">
										<img src="{{asset('admin/resources/images/store/horeca/6.jpg')}}" alt="">
									</div>
								</div>
								<div class="item-icons">
									<div class="item-icon-image">
										<img src="{{asset('admin/resources/images/store/horeca/7.jpg')}}" alt="">
									</div>
								</div>
								<div class="item-icons">
									<div class="item-icon-image">
										<img src="{{asset('admin/resources/images/store/horeca/8.jpg')}}" alt="">
									</div>
								</div>
								<div class="item-icons">
									<div class="item-icon-image">
										<img src="{{asset('admin/resources/images/store/horeca/9.jpg')}}" alt="">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="store-export" role="tabpanel">
						<div class="store-export">
							<div class="store-export-title">
									Hồng Hạnh vươn ra biển lớn
							</div>
							<img src="{{asset('admin/resources/images/store/2.jpg')}}" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


</div>
</main>
@endsection
