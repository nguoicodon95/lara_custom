@extends('front._master')

@section('css')

@endsection

@section('slideshow')
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
@endsection

@section('content')
    <!--div class="std">
        <div class="maintext">
            <h1>&nbsp;</h1>
        </div>
    </div-->
    <div class="products_grid p_block_home_top">
        <h2 class="group_title"><span>Sản Phẩm mới nhất</span></h2>
        <!--<div class="banner-group"><img src=""></div>-->
        <div class="prbx">
        @if(isset($new_product) && !empty($new_product))
            @forelse($new_product as $p)
                <?php $row = $p->productContent[0]; ?>
                <div class="col-md-3 grid">
                    <div class="item">
                        <div class="thumb">
                            <a class="product-image" href="{{ _getProductLink($row->slug) }}" title="{{ $row->title }}">
                                <img class="product-img" src="{{ $row->thumbnail }}" alt="{{ $row->title }}" />
                            </a>
                        </div>
                        <h3>
                            <a href="{{ _getProductLink($row->slug) }}" title="{{ $row->title }}">{{ $row->title }}</a>
                        </h3>
                        <div class="price-box">
                            <span class="regular-price">
                                @if($row->old_price != 0)
                                <span class="old-price"><s>{{ _formatPrice($row->old_price) }}</s></span>
                                @endif
                                <span class="price">{{ _formatPrice($row->price) }}</span>
                            </span>
                        </div>
                        <div align="left" class="bgr">
                            <a class="addcart btn btn-danger btn-sm" href="{{ _getAddToCartLink($row->id) }}">Đặt hàng</a>
                            <a class="detail btn btn-info btn-sm" href="{{ _getProductLink($row->slug) }}">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            @empty
                <p>Hiện tại chưa có sản phẩm nào</p>
            @endforelse
        @endif
            <div class="clearfix"></div>
        </div>
    </div>


    <!--div class="banner-group">
        <p>
            <a href="" target="_blank">
                <img src="/images/libraries/banner.png" alt="" />
            </a>
        </p>
    </div-->

    @if(isset($groups) && !empty($groups))
        @foreach($groups as $key => $group)
        <div class="products_grid p_block_home">
            <h2 class="group_title">
                <a href="{{ _getProductCategoryLink($group['slug']) }}"><span>{{ $key }}</span></a>
            </h2>
            @if(!empty($group))
                @foreach($group as $p)
                    @if(is_array($p))
                    <div class="col-md-3 grid">
                        <div class="item">
                            <div class="thumb">
                                <a class="product-image" href="{{ _getProductLink($p['slug']) }}" title="{{ $p['title'] }}">
                                    <img class="product-img" src="{{ $p['thumbnail'] }}" alt="{{ $p['title'] }}" title="{{ $p['title'] }}"/>
                                </a>
                            </div>
                            <h3>
                                <a href="{{ _getProductLink($p['slug']) }}" title="{{ $p['title'] }}">{{ $p['title'] }}</a>
                            </h3>
                            <!-- <p class="sku">Mã SP: {{-- $p['sku'] --}}</p> -->

                            <div class="price-box">
                                <span class="regular-price">
                                    @if($p['old_price'] != 0)
                                    <span class="old-price"><s>{{ _formatPrice($p['old_price']) }}</s></span>
                                    @endif
                                    <span class="price">{{ _formatPrice($p['price']) }}</span>
                                </span>
                            </div>
                            <div align="left" class="bgr">
                                <a class="addcart btn btn-danger btn-sm" href="{{ _getAddToCartLink($p['product_content_id']) }}">Đặt hàng</a>
                                <a class="detail btn btn-info btn-sm" href="">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            @endif
        </div>
        <div class="clearfix"></div>
        @endforeach
    @endif
@endsection

@section('js')
    <script src="/js/slippry.js"></script>
@stop

@section('js-init')
    <script>
        $(function() {
            var slider = $("#gallery").slippry({});
        });
    </script>
@stop
