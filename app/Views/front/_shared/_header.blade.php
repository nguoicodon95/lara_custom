<div class="header_container container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <!--logo-->
            <div id="logo" class="pull-left">
                <a href="/" title="" class="logo">
                    <img src="{{ $CMSSettings['site_logo'] or '/images/logo/logo.png' }}" alt="{{ $CMSSettings['site_title'] or '' }}" />
                </a>
            </div>
            <!--end logo-->
            <!--top Search-->
            <div id="top_search" class="pull-left">
                <form id="search_mini_form" action="{{ route('search') }}" method="get">
                    <div class="form-search form-search-autocomplete">
                        <input id="search" type="text" name="q" value="" class="input-text" maxlength="128" />
                        <button class="button" id="basic-search" type="submit" title=" Tìm kiếm">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </div>
                </form>
            </div>
            <!--End top search-->
            <div class="cart">Giỏ hàng: {{ isset($shoppingCart['cartItems']) ? count($shoppingCart['cartItems']) : 0 }} sản phẩm | {{ isset($shoppingCart['cartItems']) ? _formatPrice($shoppingCart['cartSubTotal']) : 0 }}</div>

            <div class="clearfix"></div>
            @if(isset($shoppingCart['cartItems']))
             <ul class="cd-cart-items">
                    @foreach($shoppingCart['cartItems'] as $item)
                    <li>
                        <div class="thumb pull-left" style="line-height: 45px;">
                            <img src="{{ asset($item->thumbnail) }}" alt="{{ $item->title }}" width="55">
                        </div>
                        <div class="general pull-left">{{ $item->title }}
                            <div class="cd-price">
                                <u>Giá:</u><strong> {{ number_format($item->price) }}<sup>₫</sup></strong>
                            </div>
                            <u>Số Lượng:</u> {{$item->quantity}}
                            <a id="{{$item->id}}" class="cd-item-remove cd-img-replace deteteElem" title="Xóa sản phẩm này">x</a>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                    @endforeach
                    <hr>
                    <div align="center">
                        <a href="{{ route('checkout') }}"><u>Đi đến đặt hàng</u></a>
                    </div>
                </ul>
            @endif
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div id="menu_area">
    <nav id="mainmenu">
      <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                {!! $main_menu or '' !!}
                <button>MENU</button>
                <ul class='hidden-links hidden'></ul>
            </div>
        </div>
      </div>
    </nav>
</div>
