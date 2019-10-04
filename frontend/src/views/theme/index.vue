<template>
    <div class="page">
        <div class="page-header">
            <div class="page-title">
                <h1>Theme</h1>
            </div>
        </div>
        <div class="page-body">
            <div>
				<div class="text-right">
					<button class="button" @click.stop.prevent="submit" :class="{ 'is-loading' : is_saving }">Save</button>
				</div>
                <div>
					<ul class="tabs">
						<li v-for="(item , index ) in pages" :key="`index_page_${index}`" :class="{ 'active' : is_active == item.id}"> 
							<a @click.stop.prevent="is_active = item.id ">{{ item.name }}</a>
						</li>
					</ul>
                </div>
				<div class="m-t-30">
					<transition name="fade" mode="out-in">
						<div v-if="is_loading" key="is-loading">
							<div class="text-center p-t-80 p-b-80">
								<div class="spinner-border icon-loading text-primary"></div>
							</div>
						</div>
						<div v-else key="loading-success">
							<template v-if="is_active == 1">
								<div class="row">
									<div class="col col-2">
										<h2>Image</h2>
									</div>
									<div class="col col-10">
										<div class="card">
											<div class="card-section" >
												<div class="d-inline-block">
													<label>{{data.logo.title}}</label>
													<div class="box-item-image" @click.stop.prevent="$gallery.show(img=>{ $set(data.logo.data ,'image' , img)})">
														<template v-if="data.logo.data.image && data.logo.data.image.id">
															<img :src="data.logo.data.image.path" alt="">
														</template>
														<template v-else>
															<i class="icon-add-section"></i>
														</template>
													</div>
												</div>
												<div class="d-inline-block m-l-30">
													<label>{{data.favicon.title}}</label>
													<div class="box-item-image" @click.stop.prevent="$gallery.show(img=>{ $set(data.favicon.data ,'image' , img)})">
														<template v-if="data.favicon.data.image && data.favicon.data.image.id">
															<img :src="data.favicon.data.image.path" alt="">
														</template>
														<template v-else>
															<i class="icon-add-section"></i>
														</template>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col col-2">
										<h2>Header</h2>
									</div>
									<div class="col col-10">
										<div class="card">
											<div class="card-section" >
												<div v-if="data.show_search_form">
													<h5>{{ data.show_search_form.title}}</h5>
													<div class="row">
														<div class="ol col-12">
															<label>
																<input type="checkbox" v-model="data.show_search_form.content"> <span>Show search form </span>
															</label>
														</div>
													</div>
												</div>
												<div v-if="data.social" class="m-t-20">
													<div class="row m-b-0">
														<div class="col col-6">
															<h5>{{ data.social.title}}</h5>
														</div>
														<div class="col col-6">
															<div class="text-right">
																<a class="button secondary" href="https://fontawesome.com/icons?d=gallery&m=free" target="_blank"> 
																	Get icon from here
																</a>
															</div>
														</div>
													</div>
													<div class="row" v-for="(item,index) in data.social.data" :key="`index_${index}`">
														<div class="col col-5">
															<label>icon</label>
															<input type="text" class="form-control" v-model="item.icon">
														</div>
														<div class="col col-7">
															<label>link</label>
															<input type="text" class="form-control" v-model="item.link">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col col-2">
										<h2>Slider</h2>
									</div>
									<div class="col col-10">
										<div class="card">
											<div class="card-section" >
												<div v-if="data.slider">
													<div class="row">
														<div class="col col-6">
															<h5>{{ data.slider.title}}</h5>
														</div>
														<div class="col col-6">
															<div class="text-right">
																<button class="button secondary" @click="$gallery.show(img=>{ data.slider.data.push({ image : img , link : ''})})">
																	+ Add Image
																</button>
															</div>
														</div>
													</div>
													<div v-if="data.slider.data.length" class="row" >
														<template  v-for="(item,index) in data.slider.data" >
															<div :key="`index_${index}`" class="box-item-image m-l-15 m-b-15"
															@click.stop.prevent="$gallery.show(img=>{ $set(item ,'image' , img)})">
																<template v-if="item.image && item.image.id">
																	<img :src="item.image.path" alt="">
																</template>
																<template v-else>
																	<i class="icon-add-section"></i>
																</template>
																<a @click.stop.prevent="data.slider.data.splice(index , 1)" class="btn-remove"><i class="fas fa-times"></i></a>
															</div>
														</template>
													</div>
													<div class="row" v-else>
														<div class="col col-12">
															No image selected
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col col-2">
										<h2>Footer</h2>
									</div>
									<div class="col col-10">
										<div class="card">
											<div class="card-section" >
												<div v-if="data.footer_info">
													<h5>{{ data.footer_info.title}}</h5>
													<div v-if="data.footer_info.data" class="row" >
														<div class="col col-12 m-b-10">
															<label>Title</label>
															<input type="text" v-model="data.footer_info.data.title" class="form-control">
														</div>
														<div class="col col-12 m-b-10">
															<label>Phone</label>
															<input type="text" v-model="data.footer_info.data.phone" class="form-control">
														</div>
														<div class="col col-12 m-b-10">
															<label>Fax</label>
															<input type="text" v-model="data.footer_info.data.phone" class="form-control">
														</div>
														<div class="col col-12 m-b-10">
															<label>Email</label>
															<input type="text" v-model="data.footer_info.data.phone" class="form-control">
														</div>
													</div>
												</div>
												<div v-if="data.copyright">
													<h5>{{ data.copyright.title}}</h5>
													<div v-if="data.copyright.content" class="row" >
														<div class="col col-12 m-b-10">
															<input type="text" v-model="data.copyright.content" class="form-control">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</template>
							<template v-if="is_active == 2">
								<div class="row">
									<div class="col col-2">
										<h2>Video</h2>
									</div>
									<div class="col col-10">
										<div class="card">
											<div class="card-section" >
												<div class="row">
													<div class="col col-3" v-if="data.video_poster">
														<label for="">
															{{ data.video_poster.title }}
														</label>
														<div  class="box-item-image" @click.stop.prevent="$gallery.show((img)=>{ $set(data.video_poster.data ,'image' , img)})">
															<template v-if="data.video_poster.data.image.id">
																<img :src="data.video_poster.data.image.path" alt="">
															</template>
															<template v-else>
																<i class="icon-add-section"></i>
															</template>
														</div>
													</div>
													<div class="col col-3" v-if="data.video_left">
														<label for="">
															{{ data.video_left.title }}
														</label>
														<div  class="box-item-image" @click.stop.prevent="$gallery.show((img)=>{ $set(data.video_left.data ,'image' , img)})">
															<template v-if="data.video_left.data.image.id">
																<img :src="data.video_left.data.image.path" alt="">
															</template>
															<template v-else>
																<i class="icon-add-section"></i>
															</template>
														</div>
													</div>
													<div class="col col-3" v-if="data.video_right">
														<label for="">
															{{ data.video_right.title }}
														</label>
														<div  class="box-item-image" @click.stop.prevent="$gallery.show((img)=>{ $set(data.video_right.data ,'image' , img)})">
															<template v-if="data.video_right.data.image.id">
																<img :src="data.video_right.data.image.path" alt="">
															</template>
															<template v-else>
																<i class="icon-add-section"></i>
															</template>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col col-2">
										<h2>Banner</h2>
									</div>
									<div class="col col-10">
										<div class="card">
											<div class="card-section" >
												<div v-if="data.home_banner">
													<h5>{{ data.home_banner.title}}</h5>
													<div class="row">
														<div class="col col-12">
															<label for="">
																Image banner
															</label>
															<div  class="box-item-image" @click.stop.prevent="$gallery.show((img)=>{ $set(data.home_banner.data ,'image' , img)})">
																<template v-if="data.home_banner.data.image.id">
																	<img :src="data.home_banner.data.image.path" alt="">
																</template>
																<template v-else>
																	<i class="icon-add-section"></i>
																</template>
															</div>
														</div>
														<div class="col col-12 m-t-10">
															<label for="">
																Link URL
															</label>
															<input type="text" v-model="data.home_banner.data.link">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col col-2">
										<h2>Slider Cooking</h2>
									</div>
									<div class="col col-10">
										<div class="card">
											<div class="card-section" >
												<div v-if="data.slider_cooking">
													<div class="row">
														<div class="col col-6">
															<h5>{{ data.slider_cooking.title}}</h5>
														</div>
														<div class="col col-6">
															<div class="text-right">
																<button class="button secondary" @click="$cooking.show((cooking)=>{cooking.forEach((cook)=>{data.slider_cooking.data.push(cook)})})">
																	+ Add Cooking
																</button>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col col-12">
															<label for="">Title</label>
															<input type="text" v-model="data.slider_cooking.content">
														</div>
													</div>
													<div class="row" v-if="data.slider_cooking.data.length">
														<div class="col col-12">
															<table class="table-cooking">
																<thead>
																	<tr>
																		<th class="td-index">#</th>
																		<th class="td-image">Image</th>
																		<th class="td-name">Title</th>
																		<th class="td-email">Alias</th>
																		<th class="td-actions">Actions</th>
																	</tr>
																</thead>
																<tbody>
																	<tr v-for="(item , index) in data.slider_cooking.data" :key="`index_${index}`">
																		<td class="td-index">
																			{{ index + 1 }}
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
																			{{ item.vi ? item.vi.title : '' }}
																		</td>
																		<td class="td-email">
																			{{ item.alias }}
																		</td>
																		<td class="td-actions">
																			<button class="button secondary icon-trash" @click.stop.prevent="data.slider_cooking.data.splice(index,1)"></button>
																		</td>
																	</tr>
																</tbody>
															</table>
														</div>
													</div>
													<div class="row" v-else>
														<div class="col col-12">
															No Cooking selected
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col col-2">
										<h2>SEO</h2>
									</div>
									<div class="col col-10">
										<div class="card">
											<div class="card-section" >
												<div class="row">
													<div class="col col-12" v-if="data.seo_home_page">
														<label for="">Meta title</label>
														<input type="text" class="form-control m-b-10" v-model="data.seo_home_page.data.meta_title" >
														<label for="">Meta description</label>
														<input type="text" class="form-control m-b-10" v-model="data.seo_home_page.data.meta_description" >
														<label for="">Meta keyword</label>
														<input type="text" class="form-control m-b-10" v-model="data.seo_home_page.data.meta_keyword" >
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</template>
							<template v-if="is_active == 3">
								<div class="row">
									<div class="col col-2">
										<h2>About us</h2>
									</div>
									<div class="col col-10">
										<div class="card">
											<div class="card-section" >
												<div v-if="data.about_us_tabs">
													<div class="row">
														<div class="col col-6">
															<h5>{{ data.about_us_tabs.title}}</h5>
														</div>
														<div class="col col-6">
															<div class="text-right">
																<button class="button secondary" @click=" data.about_us_tabs.data.push({ image : '' , link : ''})">
																	+ Add Tab
																</button>
															</div>
														</div>
													</div>
													<div v-if="data.about_us_tabs.data.length" >
														<template  v-for="(item,index) in data.about_us_tabs.data" >
															<div class="row" :key="`index_${index}`">
																<div :key="`index_${index}`" class="box-item-image m-l-15 m-b-15" @click.stop.prevent="$gallery.show((img)=>{ $set(item ,'image' , img)})">
																	<template v-if="item.image && item.image.id">
																		<img :src="item.image.path" alt="">
																	</template>
																	<template v-else>
																		<i class="icon-add-section"></i>
																	</template>
																</div>
																<div class="col col-6">
																	<label for="">Tab title</label>
																	<input type="text" v-model="item.link">
																</div>
															</div>
														</template>
													</div>
													<div class="row" v-else>
														<div class="col col-12">
															No  tabs found
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col col-2">
										<h2>SEO</h2>
									</div>
									<div class="col col-10">
										<div class="card">
											<div class="card-section" >
												<div class="row">
													<div class="col col-12" v-if="data.seo_about_us">
														<label for="">Meta title</label>
														<input type="text" class="form-control m-b-10" v-model="data.seo_about_us.data.meta_title" >
														<label for="">Meta description</label>
														<input type="text" class="form-control m-b-10" v-model="data.seo_about_us.data.meta_description" >
														<label for="">Meta keyword</label>
														<input type="text" class="form-control m-b-10" v-model="data.seo_about_us.data.meta_keyword" >
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</template>
							<template v-if="is_active == 4">
								<div class="row">
									<div class="col col-2">
										<h2>Tabs</h2>
									</div>
									<div class="col col-10">
										<div class="card">
											<div class="card-section" >
												<div v-if="data.product_tabs">
													<div class="row">
														<div class="col col-6">
															<h5>{{ data.product_tabs.title}}</h5>
														</div>
														<div class="col col-6">
															<div class="text-right">
																<button class="button secondary" @click="$product.show(pro=>{
																	pro.forEach((el)=>{
																		data.product_tabs.data.push({ product: el , normal : '' ,active : ''})
																	})	
																})">
																	+ Add Tab
																</button>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col col-12">
															<label for="">Title</label>
															<input type="text" v-model="data.product_tabs.content">
														</div>
													</div>
													<div class="row" v-if="data.product_tabs.data.length">
														<div class="col col-12">
															<table class="table-tabs">
																<thead>
																	<tr>
																		<th class="td-index">#</th>
																		<th class="td-image">Product</th>
																		<th class="td-name"></th>
																		<th class="td-image-tab">Normal</th>
																		<th class="td-image-tab">Active</th>
																		<th class="td-actions">Actions</th>
																	</tr>
																</thead>
																<tbody>
																	<tr v-for="(item , index) in data.product_tabs.data" :key="`index_${index}`">
																		<td class="td-index">
																			{{ index + 1 }}
																		</td>
																		<td class="td-image">
																			<div class="item-image">
																				<template v-if="item.product.image">
																					<img :src="item.product.image.path" alt="">
																				</template>
																				<template v-else>
																					<i class="icon-add-section"></i>
																				</template>
																			</div>
																		</td>
																		<td class="td-name">
																			{{ item.product.vi ? item.product.vi.name : '' }}
																		</td>
																		<td class="td-image-tab">
																			<div class="item-image" @click.stop.prevent="$gallery.show((img)=>{ $set(item ,'normal' , img)})">
																				<template v-if="item.normal && item.normal.id">
																					<img :src="item.normal.path" alt="">
																				</template>
																				<template v-else>
																					<i class="icon-add-section"></i>
																				</template>
																			</div>
																		</td>
																		<td class="td-image-tab">
																			<div class="item-image" @click.stop.prevent="$gallery.show((img)=>{ $set(item ,'active' , img)})">
																				<template v-if="item.active && item.active.id">
																					<img :src="item.active.path" alt="">
																				</template>
																				<template v-else>
																					<i class="icon-add-section"></i>
																				</template>
																			</div>
																		</td>
																		<td class="td-actions">
																			<button class="button secondary icon-trash" @click.stop.prevent="data.product_tabs.data.splice(index,1)"></button>
																		</td>
																	</tr>
																</tbody>
															</table>
														</div>
													</div>
													<div class="row" v-else>
														<div class="col col-12">
															No Cooking selected
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col col-2">
										<h2>SEO</h2>
									</div>
									<div class="col col-10">
										<div class="card">
											<div class="card-section" >
												<div class="row">
													<div class="col col-12" v-if="data.seo_product">
														<label for="">Meta title</label>
														<input type="text" class="form-control m-b-10" v-model="data.seo_product.data.meta_title" >
														<label for="">Meta description</label>
														<input type="text" class="form-control m-b-10" v-model="data.seo_product.data.meta_description" >
														<label for="">Meta keyword</label>
														<input type="text" class="form-control m-b-10" v-model="data.seo_product.data.meta_keyword" >
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</template>
							<template v-if="is_active == 5">
								<div class="row">
									<div class="col col-2">
										<h2>Traditional</h2>
									</div>
									<div class="col col-10">
										<div class="card">
											<div class="card-section" >
												<div v-if="data.distribution_traditional">
													
													<div class="row">
														<div class="col col-12">
															<label>Title</label>
															<input type="text" v-model="data.distribution_traditional.title">
														</div>
														<div class="col col-12 m-t-10">
															<label>Sub title</label>
															<input type="text" v-model="data.distribution_traditional.content">
														</div>
													</div>
													<div class="row m-t-10">
														<div class="col col-2">
															<label for="">
																Image
															</label>
															<div  class="box-item-image" @click.stop.prevent="$gallery.show((img)=>{ $set(data.distribution_traditional.data ,'image' , img)})">
																<template v-if="data.distribution_traditional.data.image.id">
																	<img :src="data.distribution_traditional.data.image.path" alt="">
																</template>
																<template v-else>
																	<i class="icon-add-section"></i>
																</template>
															</div>
														</div>
														<div class="col col-12 m-t-10">
															<label for="">
																Content
															</label>
															<ckeditor  v-model="data.distribution_traditional.data.link" ></ckeditor>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col col-2">
										<h2>Modern</h2>
									</div>
									<div class="col col-10">
										<div class="card">
											<div class="card-section" >
												<div v-if="data.distribution_modern">
													<div class="row">
														<div class="col col-12">
															<label>Title</label>
															<input type="text" v-model="data.distribution_modern.title">
														</div>
														<div class="col col-12  m-t-10">
															<label>Sub title</label>
															<input type="text" v-model="data.distribution_modern.content">
														</div>
														<div class="col col-12  m-t-10">
															<div class="text-right">
																<button class="button secondary" @click="$gallery.show((img)=>{ data.distribution_modern.data.push({image : img , link : ''}) })">
																	+ Add Image
																</button>
															</div>
														</div>
													</div>
													<div class="row  m-t-10">
														<template v-for="(item,index) in data.distribution_modern.data">
															<div :key="`iinex_${index}`" class="box-item-image m-l-15 m-b-15" @click.stop.prevent="$gallery.show((img)=>{ $set(item ,'image' , img)})">
																<template v-if="item.image && item.image.id">
																	<img :src="item.image.path" alt="">
																</template>
																<template v-else>
																	<i class="icon-add-section"></i>
																</template>
																<a @click.stop.prevent="data.distribution_modern.data.splice(index , 1)" class="btn-remove"><i class="fas fa-times"></i></a>
															</div>
														</template>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col col-2">
										<h2>Heroca</h2>
									</div>
									<div class="col col-10">
										<div class="card">
											<div class="card-section" >
												<div v-if="data.distribution_heroca">
													<div class="row">
														<div class="col col-12">
															<label>Title</label>
															<input type="text" v-model="data.distribution_heroca.title">
														</div>
														<div class="col col-12  m-t-10">
															<label>Sub title</label>
															<input type="text" v-model="data.distribution_heroca.content">
														</div>
														<div class="col col-12  m-t-10">
															<div class="text-right">
																<button class=" button secondary" @click="$gallery.show((img)=>{ data.distribution_heroca.data.push({image : img , link : ''}) })">
																	+ Add Image
																</button>
															</div>
														</div>
													</div>
													<div class="row  m-t-10">
														<template v-for="(item,index) in data.distribution_heroca.data">
															<div :key="`iinex_${index}`" class="box-item-image m-l-15 m-b-15" @click.stop.prevent="$gallery.show((img)=>{ $set(item ,'image' , img)})">
																<template v-if="item.image && item.image.id">
																	<img :src="item.image.path" alt="">
																</template>
																<template v-else>
																	<i class="icon-add-section"></i>
																</template>
																<a @click.stop.prevent="data.distribution_heroca.data.splice(index , 1)" class="btn-remove"><i class="fas fa-times"></i></a>
															</div>
														</template>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col col-2">
										<h2>Export</h2>
									</div>
									<div class="col col-10">
										<div class="card">
											<div class="card-section" >
												<div v-if="data.distribution_export">
													<div class="row">
														<div class="col col-12">
															<label>Title</label>
															<input type="text" v-model="data.distribution_export.title">
														</div>
														<div class="col col-12  m-t-10">
															<label>Sub title</label>
															<input type="text" v-model="data.distribution_export.content">
														</div>
														<div class="col col-12  m-t-10">
															<div class="text-right">
																<button class="button secondary" @click="$gallery.show((img)=>{ data.distribution_export.data.push({image : img , link : ''}) })">
																	+ Add Image
																</button>
															</div>
														</div>
													</div>
													<div class="row  m-t-10">
														<template v-for="(item,index) in data.distribution_export.data">
															<div :key="`iinex_${index}`" class="box-item-image m-l-15 m-b-15" @click.stop.prevent="$gallery.show((img)=>{ $set(item ,'image' , img)})">
																<template v-if="item.image && item.image.id">
																	<img :src="item.image.path" alt="">
																</template>
																<template v-else>
																	<i class="icon-add-section"></i>
																</template>
																<a @click.stop.prevent="data.distribution_export.data.splice(index , 1)" class="btn-remove"><i class="fas fa-times"></i></a>
															</div>
														</template>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col col-2">
										<h2>SEO</h2>
									</div>
									<div class="col col-10">
										<div class="card">
											<div class="card-section" >
												<div class="row">
													<div class="col col-12" v-if="data.seo_distribution">
														<label for="">Meta title</label>
														<input type="text" class="form-control m-b-10" v-model="data.seo_distribution.data.meta_title" >
														<label for="">Meta description</label>
														<input type="text" class="form-control m-b-10" v-model="data.seo_distribution.data.meta_description" >
														<label for="">Meta keyword</label>
														<input type="text" class="form-control m-b-10" v-model="data.seo_distribution.data.meta_keyword" >
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</template>
							<template v-if="is_active == 6">
								<div class="row">
									<div class="col col-2">
										<h2>SEO</h2>
									</div>
									<div class="col col-10">
										<div class="card">
											<div class="card-section" >
												<div class="row">
													<div class="col col-12" v-if="data.seo_cooking">
														<label for="">Meta title</label>
														<input type="text" class="form-control m-b-10" v-model="data.seo_cooking.data.meta_title" >
														<label for="">Meta description</label>
														<input type="text" class="form-control m-b-10" v-model="data.seo_cooking.data.meta_description" >
														<label for="">Meta keyword</label>
														<input type="text" class="form-control m-b-10" v-model="data.seo_cooking.data.meta_keyword" >
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</template>
							<template v-if="is_active == 7">
								<div class="row">
									<div class="col col-2">
										<h2>List Tabs</h2>
									</div>
									<div class="col col-10">
										<div class="card">
											<div class="card-section" >
												<div v-if="data.post_tabs">
													<div class="row">
														<div class="col col-6">
															<h5>{{ data.post_tabs.title}}</h5>
														</div>
														<div class="col col-6">
															<div class="text-right">
																<button class="button secondary" @click="$category.show((category)=>{category.forEach((cook)=>{data.post_tabs.data.push(cook)})})">
																	+ Add Category
																</button>
															</div>
														</div>
													</div>
													<div class="row" v-if="data.post_tabs.data.length">
														<div class="col col-12">
															<table class="table-cooking">
																<thead>
																	<tr>
																		<th class="td-index">#</th>
																		<th class="td-name">Name</th>
																		<th class="td-email">Alias</th>
																		<th class="td-actions">Actions</th>
																	</tr>
																</thead>
																<tbody>
																	<tr v-for="(item , index) in data.post_tabs.data" :key="`index_${index}`">
																		<td class="td-index">
																			{{ index + 1 }}
																		</td>
																		<td class="td-name">
																			{{ item.vi ? item.vi.name : '' }}
																		</td>
																		<td class="td-email">
																			{{ item.alias }}
																		</td>
																		<td class="td-actions">
																			<button class="button secondary icon-trash" @click.stop.prevent="data.post_tabs.data.splice(index,1)"></button>
																		</td>
																	</tr>
																</tbody>
															</table>
														</div>
													</div>
													<div class="row" v-else>
														<div class="col col-12">
															No Cooking selected
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col col-2">
										<h2>SEO</h2>
									</div>
									<div class="col col-10">
										<div class="card">
											<div class="card-section" >
												<div class="row">
													<div class="col col-12" v-if="data.seo_post">
														<label for="">Meta title</label>
														<input type="text" class="form-control m-b-10" v-model="data.seo_post.data.meta_title" >
														<label for="">Meta description</label>
														<input type="text" class="form-control m-b-10" v-model="data.seo_post.data.meta_description" >
														<label for="">Meta keyword</label>
														<input type="text" class="form-control m-b-10" v-model="data.seo_post.data.meta_keyword" >
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</template>
							<template v-if="is_active == 8">
								<div class="row">
									<div class="col col-2">
										<h2>Contact</h2>
									</div>
									<div class="col col-10">
										<div class="card">
											<div class="card-section" >
												<div v-if="data.contact_info">
													<div class="row">
														<div class="col col-12">
															<label>Title</label>
															<input type="text" v-model="data.contact_info.content">
														</div>
													</div>
													<div class="row m-t-10">
														<div class="col col-4" v-for="(item, index) in data.contact_info.data" :key="`index_${index}`">
															<div class="box-contact">
																<label>Name</label>
																<input type="text" v-model="item.name" class="form-control m-b-10">
																<label>Location</label>
																<input type="text" v-model="item.location" class="form-control m-b-10">
																<label>Address</label>
																<input type="text" v-model="item.address" class="form-control m-b-10">
																<label>Phone</label>
																<input type="text" v-model="item.phone" class="form-control m-b-10">
																<label>Fax</label>
																<input type="text" v-model="item.fax" class="form-control m-b-10">
																<label>lat</label>
																<input type="text" v-model="item.lat" class="form-control m-b-10">
																<label>lng</label>
																<input type="text" v-model="item.lat" class="form-control m-b-10">
																<label>Icon</label>
																<div  class="box-item-image" @click.stop.prevent="$gallery.show((img)=>{ $set(item ,'image' , img)})">
																	<template v-if="item.image.id">
																		<img :src="item.image.path" alt="">
																	</template>
																	<template v-else>
																		<i class="icon-add-section"></i>
																	</template>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col col-2">
										<h2>SEO</h2>
									</div>
									<div class="col col-10">
										<div class="card">
											<div class="card-section" >
												<div class="row">
													<div class="col col-12" v-if="data.seo_contact">
														<label for="">Meta title</label>
														<input type="text" class="form-control m-b-10" v-model="data.seo_contact.data.meta_title" >
														<label for="">Meta description</label>
														<input type="text" class="form-control m-b-10" v-model="data.seo_contact.data.meta_description" >
														<label for="">Meta keyword</label>
														<input type="text" class="form-control m-b-10" v-model="data.seo_contact.data.meta_keyword" >
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</template>
						</div>
					</transition>
				</div>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions  } from 'vuex'
export default {
    name : 'Theme',
    data(){
        return {
			
			data : {
				// show_search_form : {
				// 	"code": "show_search_form",
				// 	"type": "boonlean",
				// 	"page_id": "1",
				// 	"title": "Show search form",
				// 	"content": "1",
				// 	"data": []
				// },
				// social : {
				// 	"code": "social",
				// 	"type": "social",
				// 	"page_id": "1",
				// 	"title": "List social",
				// 	"content": null,
				// 	"data": [{
				// 		"icon": "<i class=\"fab fa-facebook-square\"></i>",
				// 		"link": "https://www.facebook.com/nuocmamhonghanh/"
				// 	}, {
				// 		"icon": "<i class=\"fab fa-google-plus-square\"></i>",
				// 		"link": "https://googleplus.com/nuocmamhonghanh/"
				// 	}, {
				// 		"icon": "<i class=\"fab fa-youtube-square\"></i>",
				// 		"link": "https://youtube.com/nuocmamhonghanh/"
				// 	}]
				// },
				// slider : {
				// 	"code": "slider",
				// 	"type": "list_image",
				// 	"created_at": "2019-09-29 15:21:18",
				// 	"updated_at": "2019-09-29 15:21:18",
				// 	"page_id": "1",
				// 	"title": "Slider",
				// 	"content": null,
				// 	"data": []
				// },
				// copyright : {
				// 	"code": "copyright",
				// 	"type": "text",
				// 	"created_at": "2019-09-29 15:21:18",
				// 	"updated_at": "2019-09-29 15:21:18",
				// 	"page_id": "1",
				// 	"title": "Copyright",
				// 	"content": "© Copyright 2019 | Hồng Hạnh. All rights reserved",
				// 	"data": []
				// },
				// footer_info : {
				// 	"code": "footer_info",
				// 	"type": "list_info",
				// 	"created_at": "2019-09-29 15:21:18",
				// 	"updated_at": "2019-09-29 15:21:18",
				// 	"page_id": "1",
				// 	"title": "Footer contact info",
				// 	"content": null,
				// 	"data": {
				// 		"fax": "(028) 3932 1677",
				// 		"email": "honghanh@honghanh.com.vn",
				// 		"phone": "(028) 3932 6777",
				// 		"title": "Liên hệ với chúng tôi"
				// 	}
				// },
				// video_left : {
				// 	"code": "video_left",
				// 	"type": "single_image",
				// 	"created_at": "2019-09-30 16:01:58",
				// 	"updated_at": "2019-09-30 16:01:58",
				// 	"page_id": "2",
				// 	"title": "Image background left",
				// 	"content": null,
				// 	"data": {
				// 		"image": '',
				// 		"link": ''
				// 	}
				// },
				// video_right : {
				// 	"code": "video_right",
				// 	"type": "single_image",
				// 	"created_at": "2019-09-30 16:01:58",
				// 	"updated_at": "2019-09-30 16:01:58",
				// 	"page_id": "2",
				// 	"title": "Image background right",
				// 	"content": null,
				// 	"data": {
				// 		"image": '',
				// 		"link": ''
				// 	}
				// },
				// video_poster : {
				// 	"code": "video_poster",
				// 	"type": "single_image",
				// 	"created_at": "2019-09-30 16:01:58",
				// 	"updated_at": "2019-09-30 16:01:58",
				// 	"page_id": "2",
				// 	"title": "Video Poster",
				// 	"content": null,
				// 	"data": {
				// 		"image": '',
				// 		"link": ''
				// 	}
				// },
				// "about_us_tabs" : {
				// 	code : "about_us_tabs",
				// 	type : "list_image",
				// 	title : "Tabs about us",
				// 	page_id : 3,
				// 	content : '',
				// 	data : [
				// 		{
				// 			"image" : '',
				// 			"link" : ''
				// 		}
				// 	]
				// },
				// home_banner : {
				// 	"code": "home_banner",
				// 	"type": "single_image",
				// 	"created_at": "2019-09-30 16:01:58",
				// 	"updated_at": "2019-09-30 16:01:58",
				// 	"page_id": "2",
				// 	"title": "Home banner",
				// 	"content": null,
				// 	"data": {
				// 		"image": '',
				// 		"link": ''
				// 	}
				// },
				// slider_cooking : {
				// 	"code": "slider_cooking",
				// 	"type": "list_cooking",
				// 	"created_at": "2019-09-30 16:01:58",
				// 	"updated_at": "2019-09-30 16:01:58",
				// 	"page_id": "2",
				// 	"title": "Slider cooking",
				// 	"content": "MÓN NGON",
				// 	"data": []
				// },
				// "product_tabs" :{
				// 	code : "product_tabs",
				// 	type : "tabs",
				// 	title : "Tabs product",
				// 	page_id : 4,
				// 	content : 'Sản phẩm',
				// 	data : []
				// },
				// "distribution_traditional" :{
				// 	code : "distribution_traditional",
				// 	type : "single_image",
				// 	title : "Truyền thống",
				// 	page_id : 5,
				// 	content : '',
				// 	data : {
				// 		image : '',
				// 		link : ''
				// 	}
				// },
				// "distribution_modern" :{
				// 	code : "distribution_modern",
				// 	type : "list_image",
				// 	title : "Hiện đại",
				// 	page_id : 5,
				// 	content : '',
				// 	data : []
				// },
				// "distribution_heroca" :{
				// 	code : "distribution_heroca",
				// 	type : "list_image",
				// 	title : "Heroca",
				// 	page_id : 5,
				// 	content : 'HỒNG HẠNH ĐỒNG HÀNH CÙNG NHỮNG BỮA ĂN NGON',
				// 	data : []
				// },
				// "distribution_export" :{
				// 	code : "distribution_export",
				// 	type : "list_image",
				// 	title : "Export",
				// 	page_id : 5,
				// 	content : 'HỒNG HẠNH VƯƠN RA BIỂN LỚN',
				// 	data : []
				// }
				// "contact_info" :{
				// 	code : "contact_info",
				// 	type : "contact",
				// 	title : "Contact info",
				// 	page_id : 8,
				// 	content : 'Liên hệ',
				// 	data : [
				// 		{
				// 			name : 'Văn phòng',
				// 			location : 'ĐẠI DIỆN',
				// 			address : '57B Tú Xương, Phường 7, Quận 3, Tp. HCM',
				// 			phone : '(028) 3932 6777',
				// 			fax :'(028) 3932 1677',
				// 			image : '',
				// 			lat : 10.777574,
				// 			lng : 106.683653
				// 		},
				// 		{
				// 			name : 'Xưởng sản xuất',
				// 			location : 'TP. HỒ CHÍ MINH',
				// 			address : '37 Đường 142, Ấp 8, Xã Bình Mỹ, Huyện Củ Chi, Tp. HCM',
				// 			phone : '(028) 3797 8429',
				// 			fax :'(028) 3797 8428',
				// 			image : '',
				// 			lat : 10.9165646,
				// 			lng : 106.6122673
				// 		},
				// 		{
				// 			name : 'Xưởng sản xuất',
				// 			location : 'TP. PHÚ QUỐC',
				// 			address : '132 Nguyễn Trung Trực, KP.8,TT.Dương Đông, Phú Quốc',
				// 			phone : '(029) 7384 7708',
				// 			fax :'(029) 7384 7187',
				// 			image : '',
				// 			lat : 10.2228069,
				// 			lng : 103.9628394
				// 		}
				// 	]
				// },
				// "seo_home_page" : {
				// 	code : "seo_home_page",
				// 	type : "seo",
				// 	title : "",
				// 	page_id : 2,
				// 	content : '',
				// 	data : {
				// 		meta_title : '',
				// 		meta_description : '',
				// 		meta_keyword : '',
				// 	}
				// },
				// "seo_about_us" : {
				// 	code : "seo_about_us",
				// 	type : "seo",
				// 	title : "",
				// 	page_id : 3,
				// 	content : '',
				// 	data : {
				// 		meta_title : '',
				// 		meta_description : '',
				// 		meta_keyword : '',
				// 	}
				// },
				// "seo_product" : {
				// 	code : "seo_product",
				// 	type : "seo",
				// 	title : "",
				// 	page_id : 4,
				// 	content : '',
				// 	data : {
				// 		meta_title : '',
				// 		meta_description : '',
				// 		meta_keyword : '',
				// 	}
				// },
				// "seo_distribution" : {
				// 	code : "seo_distribution",
				// 	type : "seo",
				// 	title : "O",
				// 	page_id : 5,
				// 	content : '',
				// 	data : {
				// 		meta_title : '',
				// 		meta_description : '',
				// 		meta_keyword : '',
				// 	}
				// },
				// "seo_contact" : {
				// 	code : "seo_contact",
				// 	type : "seo",
				// 	title : "",
				// 	page_id : 5,
				// 	content : '',
				// 	data : {
				// 		meta_title : '',
				// 		meta_description : '',
				// 		meta_keyword : '',
				// 	}
				// },
				// "seo_cooking" : {
				// 	code : "seo_cooking",
				// 	type : "seo",
				// 	title : "",
				// 	page_id : 6,
				// 	content : '',
				// 	data : {
				// 		meta_title : '',
				// 		meta_description : '',
				// 		meta_keyword : '',
				// 	}
				// },
				// "seo_post" : {
				// 	code : "seo_post",
				// 	type : "seo",
				// 	title : "",
				// 	page_id : 7,
				// 	content : '',
				// 	data : {
				// 		meta_title : '',
				// 		meta_description : '',
				// 		meta_keyword : '',
				// 	}
				// },
				// "logo" :{
				// 	code : "logo",
				// 	type : "single_image",
				// 	title : "Logo",
				// 	page_id : 1,
				// 	content : '',
				// 	data : {
				// 		image : '',
				// 		link : ''
				// 	}
				// },
				// "favicon" :{
				// 	code : "favicon",
				// 	type : "single_image",
				// 	title : "Favicon",
				// 	page_id : 1,
				// 	content : '',
				// 	data : {
				// 		image : '',
				// 		link : ''
				// 	}
				// },
				// "post_tabs" :{
				// 	code : "post_tabs",
				// 	type : "list_category",
				// 	title : "List category",
				// 	page_id : 7,
				// 	content : '',
				// 	data : []
				// },
			},
			is_active:  1,
			pages: [
				{
					"id": 1,
					"code": "",
					"name" : "All page"
				},
				{
					"id": 2,
					"code": "home_page",
					"name" : "Home"
				},
				{
					"id": 3,
					"code": "about_us",
					"name" : "About Us"
				},
				{
					"id": 4,
					"code": "product",
					"name" : "Product"
				},
				{
					"id": 5,
					"code": "distribution",
					"name" : "Distribution"
				},
				{
					"id": 6,
					"code": "cooking",
					"name" : "Cooking"
				},
				{
					"id": 7,
					"code": "post",
					"name" : "Post"
				},
				{
					"id": 9,
					"code": "post_detail",
					"name" : "Post Detail"
				},
				{
					"id": 8,
					"code": "contact",
					"name" : "Contact"
				},
				
			],
            timeout: null,
            is_error : null,
			is_loading : false,
			is_saving : false,
			
        }
    },
    methods : {
        ...mapActions({
            fetchData : 'theme/get',
			update : 'theme/update',
			create : 'theme/create',
			getPage : 'theme/pages'
		}),
        getList(route){
			this.is_loading = true
            this.fetchData()
            .then((res)=>{
                let { code = 0 , data  } = res.data
                if( code ){
                    this.is_error = null
					// this.data = Object.assign(this.data , data )
					this.data = Object.assign(data , this.data )
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
		submit(){
			if( this.is_saving ) return 
			this.is_saving = true 
			var data = JSON.parse(JSON.stringify(this.data))
			var formdata = []
			for (const key in data) {
				if (data.hasOwnProperty(key)) {
					let element = data[key];
					if( element.type == 'list_image'){
						element['data'] = data[key].data.map((item)=>{
							return {
								image :item.image.id,
								link :item.link,
							}
						})
					}
					if( element.type == 'list_cooking'){
						element['data'] = data[key].data.map((item)=>{
							return item.id
						})
					}
					if( element.type == 'single_image'){
						element['data'] = {
							image : element.data.image.id,
							link : element.data.link,
						}
					}
					if( element.type == 'tabs'){
						element['data'] = data[key].data.map((item)=>{
							return {
								product : item.product.id,
								normal: item.normal.id,
								active : item.active.id
							}
						})
					}
					if( element.type == 'list_category'){
						element['data'] = data[key].data.map((item)=>{
							return item.id
						})
					}
					if( element.type == 'contact'){
						element['data'] = data[key].data.map((item)=>{
							item['image'] = item.image.id
							return item
						})
					}
					formdata.push(element)
				}
			}
			this.create(formdata).then((res)=>{
				let { code , message = 'Oops.. Something Went Wrong.. !'} = res.data 
				if( code ){
					this.$toasted.success('Create category successfully !')
				}else{
					this.$toasted.error(message)
				}
			})
			.finally(()=>{
				this.is_saving = false
			})
		},
		addImage(item){
			this.$gallery.show((image)=>{
				item.push(image)
			})
		},
		addCooking(item){
			this.$cooking.show((cooking)=>{
				cooking.forEach((cook)=>{
					item.push(cook)
				})
			})
		},
		removeImage(item,index){
			item.splice(index,1)
		},
		selectImage(item,index){
			this.$gallery.show((image)=>{
				this.$set(item,index,image)
			})
		},
		selectItemImage(item){
			this.$gallery.show((image)=>{
				this.$set(item , 'id' , image.id)
				this.$set(item , 'path' , image.path)

			})
		},
	},
	watch :{
		is_active : function(){
			// this.getList()
		}
	},
    created(){
        this.getList(this.$route)
    }
}
</script>
<style lang="scss" scoped>
    .list-items{
		list-style: none;
		padding: 0;
		margin: 0;
		.item{
			margin-bottom: 10px;
			display: flex;
			&-title{
				padding: 0 15px;
				@include flex(30%);
			}
			&-value{
				padding: 0 15px;
				@include flex(70%);
			}
		}
	}
	.table-cooking{
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
	}
	.table-tabs{
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
				.box-item-image{
					width: 60px;
					height: 60px;
				}
				
			}
			&-image-tab{
				max-width: 200px;
				width: 200px;
				min-width: 200px;
				.item-image{
					width: 100px;
					height: 50px;
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
				.box-item-image{
					width: 60px;
					height: 60px;
				}
				
			}
			&-actions{
				width: 150px;
				text-align: center;
			}
		}
	}
	.box-contact{
		padding: 15px;
		border: 1px solid #eee;
		background: #f2f2f2;
	}
	.product-tabs{
		a{
			height: 70px;
			display: flex;
			justify-content: center;
			align-items: center;
			font-size: 27px;
			font-family: 'Lemonada';
			font-weight: bold;
			text-decoration: none;
			color:$text;
			text-transform: uppercase;
		}
		.item-style-1{
			a{
				background: linear-gradient(to bottom left, #acacac,#ececec,#acacac);
			}
		}
		.item-style-2{
			a:hover,a.active{
				color:#ff0000;
				background: linear-gradient(to bottom left,#ffca49,#ffe090,#ffca49);
			} 
		}
		.item-style-3{
			a:hover,a.active{
				color:#044d98;
				background: linear-gradient(to bottom left,#767676,#ececec,#767676);
			} 
		}
		.item-style-4{
			a:hover,a.active{
				color:#063b02;
				background: linear-gradient(to bottom left,#c7662c,#f68e4e,#c7662c);
			} 
		}
		.item-style-5{
			a:hover,a.active{
				color:#ffffff;
				background: linear-gradient(to bottom left,#559777,#5eca96,#559777);
			} 
		}
		.item-style-6{
			a:hover,a.active{
				color:#ffffff;
				background: linear-gradient(to bottom left,#b50b0b,#ff7164,#b50b0b);
			} 
		}
	}
</style>