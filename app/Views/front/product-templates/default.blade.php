@extends('front._master')

@section('css')
    <link href="/css/ubislider.min.css" rel="stylesheet" type="text/css">
@endsection

@section('js')
<script type="text/javascript" src="/third_party/jqueryElevateZoom.js"></script>
<script src="/third_party/ubislider.min.js"></script>
@endsection

@section('js-init')
    <script>
        $('#slider').ubislider({
            arrowsToggle: true,
            type: 'ecommerce',
            hideArrows: true,
            autoSlideOnLastClick: true,
            modalOnClick: true,
            position: 'vertical'
        }); 

        (function(){

        $('#itemslider').carousel({ interval: 3000 });
        
        $('.carousel-showmanymoveone .item').each(function(){
            var itemToClone = $(this);

            for (var i=1;i<6;i++) {
            itemToClone = itemToClone.next();


            if (!itemToClone.length) {
                itemToClone = $(this).siblings(':first');
            }


            itemToClone.children(':first-child').clone()
                .addClass("cloneditem-"+(i))
                .appendTo($(this));
            }
        });
        }());

    </script>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="ubislider-image-container left" data-ubislider="#slider" style="cursor: pointer"></div>
            <div id="slider" class="ubislider left">
                <a class="arrow prev"></a>
                <a class="arrow next"></a>
                <ul id="gal1" class="ubislider-inner">
                    <li>
                        <a>
                            <img src="{{ '/uploads/normal/'.$object->thumbnail }}" alt="">
                        </a>
                    </li>
                    @if(!empty($thumbs) && isset($thumbs))
                        @foreach($thumbs as $thumb)
                        <li> 
                            <a> 
                                <img class="product-v-img" src="{{ $thumb['src'] }}"> 
                            </a> 
                        </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>

        <div class="col-md-6 col-md-offset-0">
            <div class="product_info">
                <h1 class="name">{{ $object->title }}</h1>
                <div>Mã sản phẩm: {{ $object->sku }}</div>
                <hr>
                <div class="price-box">
                    <span class="regular-price">
                        @if($object->old_price != 0)
                        <span class="old-price">{{ _formatPrice($object->old_price) }}</span>
                        @endif
                        <span class="price">{{ _formatPrice($object->price) }}</span>
                    </span>
                </div>
                <div>
                    <table class="description">
                    @if(isset($attributes) && !empty($attributes))
                        @foreach($attributes as $key => $value)
                            <tr>
                                <th>{{ $key }}</th>
                                <td>{{ $value }}</td>
                            </tr>
                        @endforeach
                    @endif
                    </table>
                </div>
                <div class="addtocart">
                    <div class="select-qty">
                        <label for="qty">Số lượng</label>
                        <select name="qty" id="qty">
                            @for($i = 1; $i < 7; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <a href="" class="btn btn-cart">Đặt hàng</a>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <h2 class="group_title">
                <span>Thông tin chi chiết</span>
            </h2>
            <div class="dt-content">
                {!! $object->content !!}
            </div>
        </div>
    </div>
    
    <h2 class="group_title">
        <span>Sản phẩm cùng loại</span>
    </h2>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="carousel carousel-showmanymoveone slide" id="itemslider">
                <div class="carousel-inner">
                @if(isset($same_product) && !empty($same_product))
                    @foreach($same_product as $k => $p)
                    <?php
                        $active = '';
                        if($k == 0) {
                            $active = 'active';
                        }
                    ?>
                    <div class="item {{ $active }}">
                        <div class="col-xs-12 col-sm-6 col-md-2">
                        <a href="{{ _getProductLink($p->slug) }}">
                            <img src="/uploads/small/{{ $p->thumbnail }}" class="img-responsive center-block">
                        </a>
                        <h4 class="text-center">{{ $p->title }}</h4>

                        <div class="price-box">
                            <span class="regular-price">
                                @if($p['old_price'] != 0)
                                <span class="old-price">{{ _formatPrice($p->old_price) }}</span>
                                @endif
                                <span class="price">{{ _formatPrice($p->price) }}</span>
                            </span>
                        </div>
                        </div>
                    </div>
                    @endforeach
                @endif
                </div>

                <div id="slider-control">
                <a class="left carousel-control" href="#itemslider" data-slide="prev">
                    <img src="https://s12.postimg.org/uj3ffq90d/arrow_left.png" alt="Left" class="img-responsive">
                </a>
                <a class="right carousel-control" href="#itemslider" data-slide="next">
                    <img src="https://s12.postimg.org/djuh0gxst/arrow_right.png" alt="Right" class="img-responsive">
                </a>
            </div>
        </div>
    </div>
    
@endsection