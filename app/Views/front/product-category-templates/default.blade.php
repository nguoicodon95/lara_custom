@extends('front._master')

@section('css')

@endsection

@section('js')
@endsection

@section('js-init')
    <script>
        $('input[name=sortby]').change(function () {
            $('#form_sort_by').submit();
        })
    </script>
@endsection

@section('sort-a-filter')
    <div class="sort-by">
        <h2 class="group_title"><span>Lựa chọn</span></h2>
        <a class="toggle">-</a>
        <form action="" method="get" id="form_sort_by">
            <div class="asc-sort">
                <input type="radio" name="sortby" id="sortasc" class="radio" value="asc" {{ isset($sort_by) && ($sort_by == 'asc') ? 'checked' : null }}/>
                <label for="sortasc">Giá từ thấp đến cao</label>
            </div>
            <div class="clearfix"></div>
            <div class="desc-sort">
                <input type="radio" name="sortby" id="sortdesc" class="radio" value="desc" {{ isset($sort_by) && ($sort_by == 'desc') ? 'checked' : null }}/>
                <label for="sortdesc">Giá từ cao đến thấp</label>
            </div>
        </form>
    </div>
    
@endsection

@section('content')
    <div class="products_grid p_block_home">
        <div class="row">
            @if(!empty($all_product))
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

                                <a class="linkdetail" href="{{ _getProductLink($p['slug']) }}">Xem chi tiết</a>
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