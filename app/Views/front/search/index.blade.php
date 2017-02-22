@extends('front._master')

@section('css')
@endsection

@push('style')
    <style>
        .article {
            margin-bottom: 15px;
        }
        .article img {
            max-width: 100%;
        }
        .pr {
            padding: 0 3px;
        }
        .article a.title {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: block;
        }
        .thumbnail {
            padding: 0;
            border-radius: 0;
            margin-bottom: 10px;
        }
    </style>
@endpush

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

@section('content')
    <div class="products_grid p_block_home">
        <div class="row">
            <?php $count = $products->count() + $posts->count(); ?>
            <h4 class="group_title"><span>Có <strong>{{ $count }}</strong> kết quả tìm kiếm <strong>"{{ Request::get('q') }}"</strong></span></h4>
            @if(isset($products))
                @forelse($products as $p)
                    <div class="col-md-4">
                        <div class="grid">
                            <div class="item">
                                <div class="thumb">
                                    <a class="product-image" href="{{ _getProductLink($p['slug']) }}" title="{{ $p['title'] }}">
                                        <img class="product-img" src="{{ $p['thumbnail'] }}" alt="{{ $p['title'] }}" title="{{ $p['title'] }}"/>
                                    </a>
                                </div>
                                <h3>
                                    <a href="{{ _getProductLink($p['slug']) }}" title="{{ $p['title'] }}">{{ $p['title'] }}</a>
                                </h3>
                                <p class="sku">Mã SP: {{ $p->product->sku }}</p>

                                <div class="price-box">
                                    <span class="regular-price">
                                        @if($p['old_price'] != 0)
                                        <span class="old-price">{{ _formatPrice($p['old_price']) }}</span>
                                        @endif
                                        <span class="price">{{ _formatPrice($p['price']) }}</span>
                                    </span>
                                </div>

                                <a class="linkdetail" href="{{ _getAddToCartLink($p->id) }}">Đặt hàng</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>Hiện tìm thấy sản phẩm nào</p>
                @endforelse
            @endif
        </div>
    </div>
    @if(isset($posts) && !empty($posts))
    <div class="posts">
        <h2 class="group_title"><span>Bài viết</span></h2>
        <div class="">
            <div class="row">
            @foreach($posts as $post)
                <div class="col-md-4 col-sm-6 article">
                    <div class="col-md-3 thumbnail">
                        <a href="{{ _getPostLink($post->slug) }}" title="{{ $post->title }}">
                            <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}" title="{{ $post->title }}">
                        </a>
                    </div>
                    <div class="col-md-9 pr">
                        <a href="{{ _getPostLink($post->slug) }}" class="title" title="{{ $post->title }}">{{ $post->title }}</a>
                        <div class="desc">
                            {!! str_limit($post->description, 55) !!}
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
    @endif
    <div class="clearfix"></div>
    <!--div align="center">
        {{-- !! $all_product->setPath(asset(Request::path()))->appends(Request::query())->render() !!} --}}
    </div-->
@endsection
