@extends('primary.layouts.app')
@section('content')
<div class="section section-contact" id="mouse-scroll-to">
	<div class="container section-container">
		<div class="row">
			<div class="col col-12">
				<div class="page-title m-b-20">
					LIÊN HỆ VỚI CHÚNG TÔI
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col col-12">
				<div id="map_canvas" class="google-map"></div>
			</div>
		</div>
		<div class="row m-t-40">
			<div class="col col-6">
				<div class="list-locations">
					<div class="item-location" data-location='{ 
						"name" : "Văn Phòng Đại Diện",
						"address" : "57B Tú Xương, Phường 7, Quận 3, Tp. HCM",
						"phone" : "(028) 3932 6777",
						"fax" : "028) 3932 1677",
						"lat" : 10.777574,
						"lng" : 106.683653
					}'>
						<div class="item-location-type">
							Văn phòng
						</div>
						<div class="item-location-name row">
							<div class="item-location-name-text col col-8">
								ĐẠI DIỆN
							</div>
							<div class="item-location-name-icon col col-4">
								<img src="{{asset('admin/resources/images/icons/icon-home.png')}}" alt="">
							</div>
						</div>
						<div class="row">
							<div class="col col-12">
								<div class="item-location-info">
									<span>
										<img src="{{asset('admin/resources/images/icons/icon-add.png')}}" alt="">
									</span>
									<span>
										57B Tú Xương, Phường 7, Quận 3, Tp. HCM
									</span>
								</div>
							</div>
							<div class="col col-6">
								<div class="item-location-info">
									<span>
										<img src="{{asset('admin/resources/images/icons/icon-phone.png')}}" alt="">
									</span>
									<span>
										(028) 3932 6777
									</span>
								</div>
							</div>
							<div class="col col-6">
								<div class="item-location-info">
									<span>
										<img src="{{asset('admin/resources/images/icons/icon-fax.png')}}" alt="">
									</span>
									<span>
										(028) 3932 1677
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="item-location" data-location='{ 
						"name" : "Xưởng sản xuất tại TP. HỒ CHÍ MINH",
						"address" : "37 Đường 142, Ấp 8, Xã Bình Mỹ, Huyện Củ Chi, Tp. HCM",
						"phone" : "(028) 3797 8429",
						"fax" : "(028) 3797 8428",
						"lat" : 10.9165646,
						"lng" : 106.6122673
					}'>
						<div class="item-location-type">
							Xưởng sản xuất tại
						</div>
						<div class="item-location-name row">
							<div class="item-location-name-text col col-8">
								TP. HỒ CHÍ MINH
							</div>
							<div class="item-location-name-icon col col-4">
								<img src="{{asset('admin/resources/images/icons/icon-factory.png')}}" alt="">
							</div>
						</div>
						<div class="row">
							<div class="col col-12">
								<div class="item-location-info">
									<span>
										<img src="{{asset('admin/resources/images/icons/icon-add.png')}}" alt="">
									</span>
									<span>
										37 Đường 142, Ấp 8, Xã Bình Mỹ,
										Huyện Củ Chi, Tp. HCM
									</span>
								</div>
							</div>
							<div class="col col-6">
								<div class="item-location-info">
									<span>
										<img src="{{asset('admin/resources/images/icons/icon-phone.png')}}" alt="">
									</span>
									<span>
										(028) 3797 8429
									</span>
								</div>
							</div>
							<div class="col col-6">
								<div class="item-location-info">
									<span>
										<img src="{{asset('admin/resources/images/icons/icon-fax.png')}}" alt="">
									</span>
									<span>
										(028) 3797 8428
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="item-location" data-location='{ 
						"name" : "Xưởng sản xuất tại TP. PHÚ QUỐC",
						"address" : "132 Nguyễn Trung Trực, KP.8,TT.Dương Đông, Phú Quốc",
						"phone" : "(029) 7384 7708",
						"fax" : "(029) 7384 7187",
						"lat" : 10.2228069,
						"lng" : 103.9628394
					}'>
						<div class="item-location-type">
							Xưởng sản xuất tại
						</div>
						<div class="item-location-name row">
							<div class="item-location-name-text col col-8">
								PHÚ QUỐC
							</div>
							<div class="item-location-name-icon col col-4">
								<img src="{{asset('admin/resources/images/icons/icon-factory.png')}}" alt="">
							</div>
						</div>
						<div class="row">
							<div class="col col-12">
								<div class="item-location-info">
									<span>
										<img src="{{asset('admin/resources/images/icons/icon-add.png')}}" alt="">
									</span>
									<span>
										132 Nguyễn Trung Trực, KP.8,TT.Dương Đông, Phú Quốc
									</span>
								</div>
							</div>
							<div class="col col-6">
								<div class="item-location-info">
									<span>
										<img src="{{asset('admin/resources/images/icons/icon-phone.png')}}" alt="">
									</span>
									<span>
										(029) 7384 7708
									</span>
								</div>
							</div>
							<div class="col col-6">
								<div class="item-location-info">
									<span>
										<img src="{{asset('admin/resources/images/icons/icon-fax.png')}}" alt="">
									</span>
									<span>
										(029) 7384 7187
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col col-6">
				<form class="contact-form">
					<div class="row">
						<div class="col col-6">
							<div class="form-group">
								<label>
									Tên
								</label>
								<input type="text" class="form-control">
							</div>
						</div>
						<div class="col col-6">
							<div class="form-group">
								<label>
									Email
								</label>
								<input type="text" class="form-control">
							</div>
						</div>
						<div class="col col-6">
							<div class="form-group">
								<label>
									Công ty
								</label>
								<input type="text" class="form-control">
							</div>
						</div>
						<div class="col col-6">
							<div class="form-group">
								<label>
									Điện thoại
								</label>
								<input type="text" class="form-control">
							</div>
						</div>
					</div>


					<div class="form-group">
						<label>
							Nội dung
						</label>
						<textarea class="form-control" rows="5"></textarea>
					</div>
					<div class="form-group">
						<div class="text-right">
							<button class="btn btn-submit">
								Gửi
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>


</div>
</main>
@endsection
