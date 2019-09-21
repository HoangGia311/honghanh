@extends('primary.layouts.app')
@section('content')
<div class="section section-product" id="mouse-scroll-to">
    <div class="container section-container">
		<div class="row">
			<div class="col col-12">
				<h1 class="page-title">
					SẢN PHẨM
				</h1>
			</div>
		</div>
		<div class="row product-body">
			<div class="col col-3 col-nav">
				<ul class="product-navbar">
					<li>
						<a href="san-pham.html" class="is-active">
							Cốt nhỉ
						</a>
					</li>
					<li>
						<a href="san-pham-sieu-hang.html">
							Siêu hạng
						</a>
					</li>
					<li>
						<a href="san-pham-cao-dam.html">
							Cao đạm
						</a>
					</li>
					<li>
						<a href="san-pham-ca-com.html">
							Cá cơm
						</a>
					</li>
					<li>
						<a href="san-pham-ngu-vi.html">
							Ngư vị
						</a>
					</li>
				</ul>
			</div>
			<div class="col col-9 col-content">
				<div class="product-content">
					<div class="product-title">
						Thông tin sản phẩm
					</div>
					<div class="product-name">
						NƯỚC MẮM CỐT NHỈ
					</div>
					<div class="product-list">
						<div class="product-row">
							<div class="product-row-title">
								Độ đạm : 
							</div>
							<div class="product-row-content">
								40 độ đạm
							</div>
						</div>
						<div class="product-row">
							<div class="product-row-title">
									Thể tích:	
							</div>
							<div class="product-row-content">
								<span>150 ml</span>
								<span>600 ml</span>
								<span>900 ml</span>
							</div>
						</div>
					</div>
					<div class="product-body-html">
						<p>
								Hướng dẫn sử dụng:
						</p>
						<p>
								Chuyên dùng để ướp đồ ăn và chấm sống.
						</p>
						<p>
								Nguồn dinh dưỡng quý giá từ tinh chất cá cơm, kích thích vị giác và làm tăng thêm hương vị của các món ăn. 
						</p>
						<img src="{{asset('admin/resources/images/product/sp-cot-nhi.png')}}" alt="">
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>
</main>
@endsection
