@extends('front._master')

@section('css')
@endsection

@section('js')
@endsection

@section('js-init')
@endsection

@section('content')
    <div class="products_grid p_block_home">
        <div class="row">
            @if(!empty($all_product))
                @foreach($all_product as $p)
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
                @endforeach
            @endif
        </div>
    </div> 
    <div align="center">
        {!! $all_product->setPath(asset(Request::path()))->appends(Request::query())->render() !!}
    </div>
@endsection