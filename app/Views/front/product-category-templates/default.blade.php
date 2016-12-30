@extends('front._master')

@section('css')

@endsection

@section('js')
@endsection

@section('js-init')
    <script>
        $('input[name=sortby], input[name=price]').change(function (e) {
            $('#form_filter').submit();
        })

        function updateQueryStringParameter(uri, key, value) {
            var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
            var separator = uri.indexOf('?') !== -1 ? "&" : "?";
            if (uri.match(re)) {
                return uri.replace(re, '$1' + key + "=" + value + '$2');
            }
            else {
                return uri + separator + key + "=" + value
            }
        }

    </script>
@endsection

@section('sort-a-filter')
    <form action="" method="get" id="form_filter">
        <div class="sort-by">
            <h2 class="group_title"><span>Lựa chọn</span></h2>
            <a class="toggle">-</a>
            <div class="asc-sort">
                <input type="radio" name="sortby" id="sortasc" class="radio" value="asc" {{ isset($sort_by) && ($sort_by == 'asc') ? 'checked' : null }}/>
                <label for="sortasc">Giá từ thấp đến cao</label>
            </div>
            <div class="clearfix"></div>
            <div class="desc-sort">
                <input type="radio" name="sortby" id="sortdesc" class="radio" value="desc" {{ isset($sort_by) && ($sort_by == 'desc') ? 'checked' : null }}/>
                <label for="sortdesc">Giá từ cao đến thấp</label>
            </div>
            <div class="clearfix"></div>
        </div>
        @if(isset($rangePrice))
        <div class="find sort-by">
            <h2 class="group_title"><span>Tìm kiếm theo giá</span></h2>
            <a class="toggle">-</a>
            @forelse($rangePrice as $key => $price)
            <?php 
                $value = (string) $price['min'].'-'.$price['max'];
            ?>
            <div class="asc-sort">
                <input type="radio" name="price" id="{{ $key }}" class="radio" value="{{ $value }}" {{ isset($price_filter) && ($price_filter == $value) ? 'checked' : null }}/>
                <label for="{{ $key }}">{{ _formatPrice($price['min']). ' - ' ._formatPrice($price['max']) }}</label>
            </div>
            <div class="clearfix"></div>
            @empty
                <p>Giá cố định</p>
            @endforelse
        </div>
        @endif
    </form>
@endsection

@section('content')
    <div class="products_grid p_block_home">
        <div class="row">
            @if(isset($all_product))
                @forelse($all_product as $p)
                    <div class="col-md-4">
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

                                <a class="linkdetail" href="{{ _getAddToCartLink($p['content_id']) }}">Đặt hàng</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>Hiện tại chưa có sản phẩm nào</p>
                @endforelse
            @endif
        </div>
    </div> 
    <div align="center">
        {!! $all_product->setPath(asset(Request::path()))->appends(Request::query())->render() !!}
    </div>
@endsection