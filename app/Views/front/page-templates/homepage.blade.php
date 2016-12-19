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
    <div class="products_grid p_block_home_top">
        <h2 class="group_title"><span>Sản Phẩm mới nhất</span></h2>
        <!--<div class="banner-group"><img src=""></div>-->

        <div class="row">
            @if(isset($new_product) && !empty($new_product))
                @foreach($new_product as $p)
                    <?php $row = $p->productContent[0]; ?>
                    <div class="col-md-3">
                        <div class="grid">
                            <div class="item">
                                <div class="thumb">
                                    <a class="product-image" href="{{ _getProductLink($row->slug) }}" title="{{ $row->title }}">
                                        <img class="product-img" src="/uploads/small/{{ $row->thumbnail }}" alt="{{ $row->title }}" />
                                    </a>
                                </div>
                                <h3>
                                    <a href="{{ _getProductLink($row->slug) }}" title="{{ $row->title }}">{{ $row->title }}</a>
                                </h3>
                                <p class="sku">Mã SP: {{ $row->sku }}</p>
                                <div class="price-box">
                                    <span class="regular-price">
                                        @if($row->old_price != 0)
                                        <span class="old-price">{{ _formatPrice($row->old_price) }}</span>
                                        @endif
                                        <span class="price">{{ _formatPrice($row->price) }}</span>
                                    </span>
                                </div>


                                <a class="linkdetail" href="{{ _getProductLink($row->slug) }}">Xem chi tiết</a>
                                <div class="icon" id="icon_online">
                                    <span>Chỉ Bán Online</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
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

    @if(isset($groups) && !empty($groups))
        @foreach($groups as $key => $group)
        <div class="products_grid p_block_home">
            <h2 class="group_title">
                <a href="{{ _getCategoryLink($group['slug']) }}"><span>{{ $key }}</span></a>
            </h2>
            <div class="row">
                @if(!empty($group))
                    @foreach($group as $p)
                        @if(is_array($p))
                        <div class="col-md-3">
                            <div class="grid">
                                <div class="item">
                                    <div class="thumb">
                                        <a class="product-image" href="{{ _getProductLink($p['slug']) }}" title="{{ $p['title'] }}">
                                            <img class="product-img" src="/uploads/small/{{ $p['thumbnail'] }}" alt="{{ $p['title'] }}" title="{{ $p['title'] }}"/>
                                        </a>
                                    </div>
                                    <h3>
                                        <a href="{{ _getProductLink($p['slug']) }}" title="{{ $p['title'] }}">{{ $p['title'] }}</a>
                                    </h3>
                                    <p class="sku">Mã SP: {{ $p['sku'] }}</p>

                                    <div class="price-box">
                                        <span class="regular-price">
                                            @if($p['old_price'] != 0)
                                            <span class="old-price">{{ _formatPrice($p['old_price']) }}</span>
                                            @endif
                                            <span class="price">{{ _formatPrice($p['price']) }}</span>
                                        </span>
                                    </div>

                                    <a class="linkdetail" href="{{ _getProductLink($p['slug']) }}">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
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