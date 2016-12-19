@extends('front._master')

@section('css')

@endsection

@section('content')
    <div class="slideshow">
        <ul id="gallery">
            @if(isset($slideshow) && !empty($slideshow))
                @foreach($slideshow as $s)
            <li>
                <a href="{{ $s['link'] }}">
                    <img src="{{ $s['image'] }}">
                </a>
            </li>
                @endforeach
            @endif
        </ul>
    </div>
    <div class="std">
        <div class="maintext">
            <h1>&nbsp;</h1>
        </div>
    </div>
    <div id="home_exclusive_products" class="products_grid p_block_home_top">
        <h2 class="group_title"><span>Sản Phẩm Độc Quyền</span></h2>
        <!--<div class="banner-group"><img src=""></div>-->

        <div class="row">
            <div class="col-md-3">
                <div class="grid">
                    <div class="item">
                        <div class="thumb">
                            <a class="product-image" href="" title="Dây Cổ Bạc My Feeling">
                                <img class="product-img" src="/images/libraries/product.png" alt="Dây Cổ Bạc My Feeling" />
                            </a>
                        </div>
                        <h3>
                            <a href="" title="Dây Cổ Bạc My Feeling">
                                Dây Cổ Bạc My Feeling</a>
                        </h3>
                        <p class="sku">Mã SP: SCH2KK13059.100</p>
                        <div class="price-box">
                            <span class="regular-price" id="product-price-8800">
                            <span class="price">744.000 ₫</span> </span>
                        </div>


                        <a class="linkdetail" href="">Xem chi tiết</a>
                        <div class="icon" id="icon_online">
                            <span>Chỉ Bán Online</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="grid">
                    <div class="item">
                        <div class="thumb">
                            <a class="product-image" href="bong-tai-bac-my-feeling-8986.html" title="Bông Tai Bạc My Feeling">
                                <img class="product-img" src="/images/libraries/product.png" alt="Bông Tai Bạc My Feeling" />
                            </a>
                        </div>
                        <h3>
                            <a href="bong-tai-bac-my-feeling-8986.html" title="Bông Tai Bạc My Feeling">
                    Bông Tai Bạc My Feeling                                    </a>
                        </h3>
                        <p class="sku">Mã SP: SBD2KN13060.100</p>



                        <div class="price-box">
                            <span class="regular-price" id="product-price-8801">
                                <span class="old-price">860.000 ₫</span>
                                <span class="price">560.000 ₫</span>
                            </span>

                        </div>


                        <a class="linkdetail" href="bong-tai-bac-my-feeling-8986.html">Xem chi tiết</a>
                        <div class="icon" id="icon_online">
                            <span>Chỉ Bán Online</span></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="grid">
                    <div class="item">
                        <div class="thumb">
                            <a class="product-image" href="bo-trang-suc-bac-my-feeling.html" title="Bộ Trang Sức Bạc My Feeling">
                                <img class="product-img" src="/images/libraries/product.png"  />
                            </a>
                        </div>
                        <h3>
                            <a href="bo-trang-suc-bac-my-feeling.html" title="Bộ Trang Sức Bạc My Feeling">
                    Bộ Trang Sức Bạc My Feeling</a>
                        </h3>
                        <p class="sku">Mã SP: SLH2KK12983.100-...</p>



                        <div class="price-box">
                            <span class="regular-price" id="product-price-8862">
                            <span class="price">1.015.000 ₫</span> </span>

                        </div>


                        <a class="linkdetail" href="bo-trang-suc-bac-my-feeling.html">Xem chi tiết</a>
                        <div class="icon" id="icon_online">
                            <span>Chỉ Bán Online</span></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="grid">
                    <div class="item">
                        <div class="thumb">
                            <a class="product-image" href="day-co-bac-her-time-9276.html" title="Dây cổ Bạc Her time ">
                                <img class="product-img" src="/images/libraries/product.png" />
                            </a>
                        </div>
                        <h3>
                            <a href="day-co-bac-her-time-9276.html" title="Dây cổ Bạc Her time ">
                    Dây cổ Bạc Her time </a>
                        </h3>
                        <p class="sku">Mã SP: SCH2DK13272.000</p>



                        <div class="price-box">
                            <span class="regular-price" id="product-price-9250">
                                                        <span class="price">886.000 ₫</span> </span>

                        </div>


                        <a class="linkdetail" href="day-co-bac-her-time-9276.html">Xem chi tiết</a>
                        <div class="icon" id="icon_online">
                            <span>Chỉ Bán Online</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="banner-group">
        <p>
            <a href="" target="_blank">
                <img src="/images/libraries/banner.png" alt="" />
            </a>
        </p>
    </div>

    <div id="home_promotion_products" class="products_grid p_block_home">
        <h2 class="group_title">
            <span>Trang sức vàng</span>
        </h2>

        <div class="row">
            <div class="col-md-3">
                <div class="grid">
                    <div class="item">
                        <div class="thumb">
                            <a class="product-image" href="" title="Bộ sản phẩm Ruby vàng trắng 14K">
                                <img class="product-img" src="/images/libraries/product.png" />
                            </a>
                        </div>
                        <h3>
                            <a href="" title="Bộ sản phẩm Ruby vàng trắng 14K">
                    Bộ sản phẩm Ruby vàng trắng 14K									</a>
                        </h3>
                        <p class="sku">Mã SP: GBDRWB81994.600-...</p>



                        <div class="price-box">
                            <span class="regular-price" id="product-price-7539">
                            <span class="price">30.832.000 ₫</span> </span>
                        </div>


                        <a class="linkdetail" href="">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="grid">
                    <div class="item">
                        <div class="thumb">
                            <a class="product-image" href="" title="Bộ trang sức vàng trắng 10K">
                                <img class="product-img" src="/images/libraries/product.png" alt="Bộ trang sức vàng trắng 10K" />
                            </a>
                        </div>
                        <h3>
                            <a href="" title="Bộ trang sức vàng trắng 10K">
                    Bộ trang sức vàng trắng 10K									</a>
                        </h3>
                        <p class="sku">Mã SP: GMDRWB82390.406-...</p>



                        <div class="price-box">
                            <span class="regular-price" id="product-price-7634">
                                                        <span class="price">8.794.000 ₫</span> </span>

                        </div>


                        <a class="linkdetail" href="">Xem chi tiết</a>
                        <div class="icon" id="icon_new"><span>Mới</span></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="grid">
                    <div class="item">
                        <div class="thumb">
                            <a class="product-image" href="" title="Bộ trang sức vàng trắng 10K">
                                <img class="product-img" src="/images/libraries/product.png" alt="Bộ trang sức vàng trắng 10K" />
                            </a>
                        </div>
                        <h3>
                            <a href="" title="Bộ trang sức vàng trắng 10K">
                    Bộ trang sức vàng trắng 10K	</a>
                        </h3>
                        <p class="sku">Mã SP: GNDRWB82317.406-...</p>



                        <div class="price-box">
                            <span class="regular-price" id="product-price-7635">
                                                        <span class="price">18.500.000 ₫</span> </span>

                        </div>


                        <a class="linkdetail" href="">Xem chi tiết</a>
                        <div class="icon" id="icon_new"><span>Mới</span></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="grid">
                    <div class="item">
                        <div class="thumb">
                            <a class="product-image" href="trang-suc-mystery.html" title="Trang sức Mystery">
                                <img class="product-img" src="/images/libraries/product.png" />
                            </a>
                        </div>
                        <h3>
                            <a href="trang-suc-mystery.html" title="Trang sức Mystery">
                    Trang sức Mystery									</a>
                        </h3>
                        <p class="sku">Mã SP: GLDRCB81394.106-...</p>



                        <div class="price-box">
                            <span class="regular-price" id="product-price-7454">
                                                        <span class="price">11.830.000 ₫</span> </span>

                        </div>


                        <a class="linkdetail" href="trang-suc-mystery.html">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>

    <div id="home_promotion2_products" class="products_grid p_block_home">
        <h2 class="group_title"><span>Trang sức bạc</span></h2>

        <a class="view_all" href="trang-suc-pnjsilver.html"><span>Xem tất cả</span></a>


        <div class="row">
            <div class="col-md-3">
                <div class="grid">
                    <div class="item">
                        <div class="thumb">
                            <a class="product-image" href="bong-tai-bac-her-time-9294.html" title="Bông Tai Bạc Her time ">
                                <img class="product-img" src="/images/libraries/product.png" alt="Bông Tai Bạc Her time " />
                            </a>
                        </div>
                        <h3>
                            <a href="bong-tai-bac-her-time-9294.html" title="Bông Tai Bạc Her time ">
                            Bông Tai Bạc Her time</a>
                        </h3>
                        <p class="sku">Mã SP: SBD2QN13289.200</p>
                        <div class="price-box">
                            <span class="regular-price" id="product-price-9093">
                            <span class="price">551.000 ₫</span> </span>
                        </div>
                        <a class="linkdetail" href="bong-tai-bac-her-time-9294.html">Xem chi tiết</a>
                        <div class="icon" id="icon_new"><span>Mới</span></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="grid">
                    <div class="item">
                        <div class="thumb">
                            <a class="product-image" href="bong-tai-bac-her-time-9294.html" title="Bông Tai Bạc Her time ">
                                <img class="product-img" src="/images/libraries/product.png" alt="Bông Tai Bạc Her time " />
                            </a>
                        </div>
                        <h3>
                            <a href="bong-tai-bac-her-time-9294.html" title="Bông Tai Bạc Her time ">
                            Bông Tai Bạc Her time</a>
                        </h3>
                        <p class="sku">Mã SP: SBD2QN13289.200</p>
                        <div class="price-box">
                            <span class="regular-price" id="product-price-9093">
                            <span class="price">551.000 ₫</span> </span>
                        </div>
                        <a class="linkdetail" href="bong-tai-bac-her-time-9294.html">Xem chi tiết</a>
                        <div class="icon" id="icon_new"><span>Mới</span></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="grid">
                    <div class="item">
                        <div class="thumb">
                            <a class="product-image" href="bong-tai-bac-her-time-9294.html" title="Bông Tai Bạc Her time ">
                                <img class="product-img" src="/images/libraries/product.png" alt="Bông Tai Bạc Her time " />
                            </a>
                        </div>
                        <h3>
                            <a href="bong-tai-bac-her-time-9294.html" title="Bông Tai Bạc Her time ">
                            Bông Tai Bạc Her time</a>
                        </h3>
                        <p class="sku">Mã SP: SBD2QN13289.200</p>
                        <div class="price-box">
                            <span class="regular-price" id="product-price-9093">
                            <span class="price">551.000 ₫</span> </span>
                        </div>
                        <a class="linkdetail" href="bong-tai-bac-her-time-9294.html">Xem chi tiết</a>
                        <div class="icon" id="icon_new"><span>Mới</span></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="grid">
                    <div class="item">
                        <div class="thumb">
                            <a class="product-image" href="mat-day-chuyen-bac-her-time.html" title="Mặt Dây Chuyền Bạc Her time ">
                                <img class="product-img" src="/images/libraries/product.png">
                            </a>
                        </div>
                        <h3>
                            <a href="mat-day-chuyen-bac-her-time.html" title="Mặt Dây Chuyền Bạc Her time ">
                    Mặt Dây Chuyền Bạc Her time 									</a>
                        </h3>
                        <p class="sku">Mã SP: SMD2KN13307.200</p>



                        <div class="price-box">
                            <span class="regular-price" id="product-price-9220">
                                                        <span class="price">415.000 ₫</span> </span>

                        </div>


                        <a class="linkdetail" href="mat-day-chuyen-bac-her-time.html">Xem chi tiết</a>

                        <div class="icon" id="icon_new"><span>Mới</span></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="grid">
                    <div class="item">
                        <div class="thumb">
                            <a class="product-image" href="nhan-bac-her-time-9286.html" title="Nhẫn Bạc Her time">
                                <img class="product-img" src="/images/libraries/product.png">
                            </a>
                        </div>
                        <h3>
                            <a href="nhan-bac-her-time-9286.html" title="Nhẫn Bạc Her time">
                    Nhẫn Bạc Her time									</a>
                        </h3>
                        <p class="sku">Mã SP: SND2ZN13320.100</p>



                        <div class="price-box">
                            <span class="regular-price" id="product-price-9248">
                                                        <span class="price">455.000 ₫</span> </span>

                        </div>


                        <a class="linkdetail" href="nhan-bac-her-time-9286.html">Xem chi tiết</a>

                        <div class="icon" id="icon_new"><span>Mới</span></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="grid">
                    <div class="item">
                        <div class="thumb">
                            <a class="product-image" href="bong-tai-bac-her-time-9305.html" title="Bông Tai Bạc Her time ">
                                <img class="product-img" src="/images/libraries/product.png">
                            </a>
                        </div>
                        <h3>
                            <a href="bong-tai-bac-her-time-9305.html" title="Bông Tai Bạc Her time ">
                    Bông Tai Bạc Her time </a>
                        </h3>
                        <p class="sku">Mã SP: SBD2ZN13313.200</p>



                        <div class="price-box">
                            <span class="regular-price" id="product-price-9241">
                                                        <span class="price">647.000 ₫</span> </span>

                        </div>


                        <a class="linkdetail" href="bong-tai-bac-her-time-9305.html">Xem chi tiết</a>

                        <div class="icon" id="icon_new"><span>Mới</span></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="grid">
                    <div class="item">
                        <div class="thumb">
                            <a class="product-image" href="bong-tai-bac-her-time-9303.html" title="Bông Tai Bạc Her time ">
                                <img class="product-img" src="/images/libraries/product.png">
                                                         </a>
                        </div>
                        <h3>
                            <a href="bong-tai-bac-her-time-9303.html" title="Bông Tai Bạc Her time ">
                    Bông Tai Bạc Her time 									</a>
                        </h3>
                        <p class="sku">Mã SP: SBO2UN13344.000</p>



                        <div class="price-box">
                            <span class="regular-price" id="product-price-9236">
                                                        <span class="price">494.000 ₫</span> </span>

                        </div>


                        <a class="linkdetail" href="bong-tai-bac-her-time-9303.html">Xem chi tiết</a>

                        <div class="icon" id="icon_new"><span>Mới</span></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="grid">
                    <div class="item">
                        <div class="thumb">
                            <a class="product-image" href="nhan-bac-her-time-9283.html" title="Nhẫn Bạc Her time">
                                <img class="product-img" src="/images/libraries/product.png" />
                            </a>
                        </div>
                        <h3>
                            <a href="nhan-bac-her-time-9283.html" title="Nhẫn Bạc Her time">
                    Nhẫn Bạc Her time									</a>
                        </h3>
                        <p class="sku">Mã SP: SNH2QK13361.100</p>



                        <div class="price-box">
                            <span class="regular-price" id="product-price-9231">
                                                        <span class="price">362.000 ₫</span> </span>

                        </div>


                        <a class="linkdetail" href="nhan-bac-her-time-9283.html">Xem chi tiết</a>

                        <div class="icon" id="icon_new"><span>Mới</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>

    <div id="home_featured_products" class="products_grid p_block_home">
        <h2 class="group_title"><span>Sản Phẩm Đồng Hồ</span></h2>

        <div class="row">
            <div class="col-md-3">
                <div class="grid">
                    <div class="item">
                        <div class="thumb">
                            <a class="product-image" href="" title="ĐỒNG HỒ NỮ MICHAEL KORS">
                                <img class="product-img" src="/images/libraries/product.png" />
                            </a>
                        </div>
                        <h3>
                            <a href="" title="ĐỒNG HỒ NỮ MICHAEL KORS">
                    ĐỒNG HỒ NỮ MICHAEL KORS									</a>
                        </h3>
                        <p class="sku">Mã SP: WMF33K02241.100</p>

                        <div class="price-box">
                            <span class="regular-price" id="product-price-7109">
                            <span class="price">8.250.000 ₫</span> </span>
                        </div>

                        <a class="linkdetail" href="">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="grid">
                    <div class="item">
                        <div class="thumb">
                            <a class="product-image" href="" title="ĐỒNG HỒ NỮ GUESS">
                                <img class="product-img" src="/images/libraries/product.png" />
                            </a>
                        </div>
                        <h3>
                            <a href="" title="ĐỒNG HỒ NỮ GUESS">
                    ĐỒNG HỒ NỮ GUESS									</a>
                        </h3>
                        <p class="sku">Mã SP: WGF11T02315.000</p>



                        <div class="price-box">
                            <span class="regular-price" id="product-price-6974">
                                                        <span class="price">5.038.000 ₫</span> </span>

                        </div>


                        <a class="linkdetail" href="">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="grid">
                    <div class="item">
                        <div class="thumb">
                            <a class="product-image" href="dong-ho-nu-skagen-8447.html" title="ĐỒNG HỒ NỮ SKAGEN">
                                <img class="product-img" src="/images/libraries/product.png" />
                            </a>
                        </div>
                        <h3>
                            <a href="dong-ho-nu-skagen-8447.html" title="ĐỒNG HỒ NỮ SKAGEN">
                    ĐỒNG HỒ NỮ SKAGEN									</a>
                        </h3>
                        <p class="sku">Mã SP: WKF18D02371.000</p>



                        <div class="price-box">
                            <span class="regular-price" id="product-price-7187">
                                                        <span class="price">7.950.000 ₫</span> </span>

                        </div>


                        <a class="linkdetail" href="dong-ho-nu-skagen-8447.html">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="grid">
                    <div class="item">
                        <div class="thumb">
                            <a class="product-image" href="dong-ho-citizen-8768.html" title="ĐỒNG HỒ NAM CITIZEN">
                                <img class="product-img" src="/images/libraries/product.png" />
                            </a>
                        </div>
                        <h3>
                            <a href="dong-ho-citizen-8768.html" title="ĐỒNG HỒ NAM CITIZEN">
                    ĐỒNG HỒ NAM CITIZEN									</a>
                        </h3>
                        <p class="sku">Mã SP: WBF11T02216.000</p>



                        <div class="price-box">
                            <span class="regular-price" id="product-price-7189">
                                                        <span class="price">2.960.000 ₫</span> </span>

                        </div>


                        <a class="linkdetail" href="dong-ho-citizen-8768.html">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="/js/slippry.js"></script>
@stop

@section('js-init')
    <script>
        $(function() {
            var slider = $("#gallery").slippry({
                /*transition: 'fade',
                useCSS: true,
                speed: 3000,
                pause: 3000,
                auto: true,
                preload: 'visible',
                autoHover: false*/
            });
        });
    </script>
@stop