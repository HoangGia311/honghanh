@extends('primary.layouts.app')
@section('content')

<div class="section section-home-video" id="mouse-scroll-to">
    <div class="section-home-video-container">
        <div class="row">
            <div class="col col-3 item-image">
                <div class="item-image-wrap wow fadeInLeft">
                    <img src="{{asset('admin/resources/images/home/1.png')}}" alt="">
                </div>
            </div>
            <div class="col col-6 item-video">
                <div class="item-video-wrap">
                    <video controls>
                        <source src="{{asset('admin/resources/video/mov_bbb.mp4')}}" type="video/mp4">
                        <source src="{{asset('admin/resources/video/mov_bbb.ogg')}}" type="video/ogg">
                        Your browser does not support HTML5 video.
                    </video>
                </div>
            </div>
            <div class="col col-3 item-image">
                <div class="item-image-wrap wow fadeInRight">
                    <img src="{{asset('admin/resources/images/home/2.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section section-home-banner">
    <a href="#">
        <img src="{{asset('admin/resources/images/home/3.png')}}" alt="">
    </a>
</div>
<div class="section section-home-articles">
    <div class="container">
        <div class="row">
            <div class="col col-12">
                <div class="page-title text-center">
                    Món ngon
                </div>
            </div>
            <div class="col col-12">
                <div class="home-articles-slider" id="article-slider">
                    <div class="item-slide">
                        <div class="item-article">
                            <a class="item-image">
                                <img src="{{asset('admin/resources/images/home/article-1.jpg')}}" alt="">
                            </a>
                            <div class="item-info">
                                <a class="item-title">
                                    Laboriosam quibusdam excepturi numquam cum perspiciatis accusamus
                                    dolorum
                                    molestias id
                                </a>
                                <div class="item-description">
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Velit,
                                    officia.
                                    Pariatur, vitae veritatis. Officia impedit, laboriosam quibusdam
                                    excepturi
                                    numquam cum perspiciatis accusamus dolorum molestias id, esse eveniet
                                    quasi
                                    quia molestiae.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item-slide">
                        <div class="item-article">
                            <a class="item-image">
                                <img src="{{asset('admin/resources/images/home/article-1.jpg')}}" alt="">
                            </a>
                            <div class="item-info">
                                <a class="item-title">
                                    Laboriosam quibusdam excepturi numquam cum perspiciatis accusamus
                                    dolorum
                                    molestias id
                                </a>
                                <div class="item-description">
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Velit,
                                    officia.
                                    Pariatur, vitae veritatis. Officia impedit, laboriosam quibusdam
                                    excepturi
                                    numquam cum perspiciatis accusamus dolorum molestias id, esse eveniet
                                    quasi
                                    quia molestiae.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item-slide">
                        <div class="item-article">
                            <a class="item-image">
                                <img src="{{asset('admin/resources/images/home/article-1.jpg')}}" alt="">
                            </a>
                            <div class="item-info">
                                <a class="item-title">
                                    Laboriosam quibusdam excepturi numquam cum perspiciatis accusamus
                                    dolorum
                                    molestias id
                                </a>
                                <div class="item-description">
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Velit,
                                    officia.
                                    Pariatur, vitae veritatis. Officia impedit, laboriosam quibusdam
                                    excepturi
                                    numquam cum perspiciatis accusamus dolorum molestias id, esse eveniet
                                    quasi
                                    quia molestiae.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item-slide">
                        <div class="item-article">
                            <a class="item-image">
                                <img src="{{asset('admin/resources/images/home/article-1.jpg')}}" alt="">
                            </a>
                            <div class="item-info">
                                <a class="item-title">
                                    Laboriosam quibusdam excepturi numquam cum perspiciatis accusamus
                                    dolorum
                                    molestias id
                                </a>
                                <div class="item-description">
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Velit,
                                    officia.
                                    Pariatur, vitae veritatis. Officia impedit, laboriosam quibusdam
                                    excepturi
                                    numquam cum perspiciatis accusamus dolorum molestias id, esse eveniet
                                    quasi
                                    quia molestiae.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item-slide">
                        <div class="item-article">
                            <a class="item-image">
                                <img src="{{asset('admin/resources/images/home/article-1.jpg')}}" alt="">
                            </a>
                            <div class="item-info">
                                <a class="item-title">
                                    Laboriosam quibusdam excepturi numquam cum perspiciatis accusamus
                                    dolorum
                                    molestias id
                                </a>
                                <div class="item-description">
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Velit,
                                    officia.
                                    Pariatur, vitae veritatis. Officia impedit, laboriosam quibusdam
                                    excepturi
                                    numquam cum perspiciatis accusamus dolorum molestias id, esse eveniet
                                    quasi
                                    quia molestiae.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item-slide">
                        <div class="item-article">
                            <a class="item-image">
                                <img src="{{asset('admin/resources/images/home/article-1.jpg')}}" alt="">
                            </a>
                            <div class="item-info">
                                <a class="item-title">
                                    Laboriosam quibusdam excepturi numquam cum perspiciatis accusamus
                                    dolorum
                                    molestias id
                                </a>
                                <div class="item-description">
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Velit,
                                    officia.
                                    Pariatur, vitae veritatis. Officia impedit, laboriosam quibusdam
                                    excepturi
                                    numquam cum perspiciatis accusamus dolorum molestias id, esse eveniet
                                    quasi
                                    quia molestiae.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section section-home-logo">
    <div class="container">
        <div class="row">
            <div class="col col-12">
                <div class="page-title text-center">
                    Giải thưởng
                </div>
            </div>
            <div class="col col-12">
                <div class="home-logo" id="logo-sliders">
                    <div class="item-slide">
                        <img src="{{asset('admin/resources/images/home/icon-1.png')}}" alt="">
                    </div>
                    <div class="item-slide">
                        <img src="{{asset('admin/resources/images/home/icon-2.png')}}" alt="">
                    </div>
                    <div class="item-slide">
                        <img src="{{asset('admin/resources/images/home/icon-3.png')}}" alt="">
                    </div>
                    <div class="item-slide">
                        <img src="{{asset('admin/resources/images/home/icon-4.png')}}" alt="">
                    </div>
                    <div class="item-slide">
                        <img src="{{asset('admin/resources/images/home/icon-5.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</main>

@endsection
