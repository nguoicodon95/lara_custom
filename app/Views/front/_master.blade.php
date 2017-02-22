
<!DOCTYPE html>
<!--[if IE 8]>
<html lang="{{ $currentLanguageCode or 'en' }}" class="ie8 no-js {{ ($showHeaderAdminBar) ? 'show-admin-bar' : '' }}"> <![endif]-->
<!--[if IE 9]>
<html lang="{{ $currentLanguageCode or 'en' }}" class="ie9 no-js {{ ($showHeaderAdminBar) ? 'show-admin-bar' : '' }}"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{ $currentLanguageCode or 'en' }}" class="{{ ($showHeaderAdminBar) ? 'show-admin-bar' : '' }}">
<!--<![endif]-->
<head>
    @include('front/_shared/_metas')

    <!-- GLOBAL PLUGINS -->
    {{--<link rel="stylesheet" href="/fonts/Open-Sans/font.css">--}}
    <!-- GLOBAL PLUGINS -->

    <!-- OTHER PLUGINS -->
    @yield('css')
    <!-- END OTHER PLUGINS -->

    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
    <link href="/css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <!-- END THEME LAYOUT STYLES -->

    <link rel="stylesheet"href="//codeorigin.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />

    <link rel="stylesheet" href="/css/responsive.css">
    @if($showHeaderAdminBar)
        <link rel="stylesheet" href="/admin/css/admin-bar.css">
    @endif

    <link rel="shortcut icon" href="{{ $CMSSettings['favicon'] or '' }}"/>

    {!! $CMSSettings['google_analytics'] or '' !!}
    <script>
        var delUrl = "{{ asset('/').'/cart/delete/'}}";
        var upUrl = "{{ asset('/').'/cart/update-cart-quantity/' }}";
    </script>
    @stack('style')

    <!-- BEGIN CORE PLUGINS -->
    <script src="/dist/core.min.js"></script>
    <!-- END CORE PLUGINS -->
</head>

<body class="cms-index-index cms-home">

@if($showHeaderAdminBar)
    @include('admin/_shared/_admin-bar')
@endif

<div class="wrap">
    <noscript>
        <div class="global-site-notice noscript">
            <div class="notice-inner">
                <p>
                    <strong>Dường như JavaScript bị tắt trong trình duyệt của bạn.</strong><br />
                    Bạn phải có bật Javascript trong trình duyệt của bạn để sử dụng các chức năng của trang web này.
                </p>
            </div>
        </div>
    </noscript>
    <div class="page">
        <header class="header">
            @include('front/_shared/_header')
        </header>
        <div class="clearfix"></div>
        <div id="maincontain" class="col1-layout">
            <div class="main">
                <div class="col-main">
                    @hasSection ('slideshow')
                        @yield('slideshow')
                    @else
                    <div class="container">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                {!! _breadcrumb() !!}
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="container">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(isset($blog_popular) && isset($show_blog) && !empty($blog_popular) && $show_blog == true)
        <section class="blog">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        @foreach($blog_popular as $b)
                        <div class="col-md-4 grid-blog">
                            <div class="item">
                                <div class="thumb">
                                    <a class="product-image" href="{{ _getPostLink($b->slug) }}" title="{{ $b->title }}">
                                        <img class="product-img" src="{{ $b->thumbnail }}" alt="{{ $b->title }}" title="{{ $b->title }}" />
                                    </a>
                                </div>
                                <h3>
                                    <a href="{{ _getPostLink($b->slug) }}" title="{{ $b->title }}">{{ $b->title }}</a>
                                </h3>
                                <div class="sumary">
                                    {{ $b->description }}
                                </div>
                                <a class="detail btn btn-info btn-sm pull-right" href="">Xem chi tiết</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        @endif
        <footer class="footer">
            @if(isset($CMSSettings['banner_bottom']))
            <div class="banner-group">
                <a><img src="{{ $CMSSettings['banner_bottom'] or '' }}" /></a>
            </div>
            @endif
            @include('front/_shared/_footer')
        </footer>
    </div>
</div>

<!--Modals-->
@include('front/_shared/_modals')

<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!--Google captcha-->
@include('front/_shared/_google-captcha')
<!--Google captcha-->

<!-- OTHER PLUGINS -->
@yield('js')
<!-- END OTHER PLUGINS -->

<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="/dist/app.min.js"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<!-- JS INIT -->
@yield('js-init')
<!-- JS INIT -->

<script>
    (function($) {

        var $nav = $('nav#mainmenu');
        var $btn = $('nav#mainmenu button');
        var $vlinks = $('nav#mainmenu .nav.navbar-nav');
        var $hlinks = $('nav#mainmenu .hidden-links');

        var numOfItems = 0;
        var totalSpace = 0;
        var breakWidths = [];

        // Get initial state
        $vlinks.children().outerWidth(function(i, w) {
            totalSpace += w;
            numOfItems += 1;
            breakWidths.push(totalSpace);
        });

        var availableSpace, numOfVisibleItems, requiredSpace;

        function check() {

            // Get instant state
            availableSpace = $vlinks.width() - 10;
            numOfVisibleItems = $vlinks.children().length;
            requiredSpace = breakWidths[numOfVisibleItems - 1];

            // There is not enought space
            if (requiredSpace > availableSpace) {
            $vlinks.children().last().prependTo($hlinks);
            numOfVisibleItems -= 1;
            check();
            // There is more than enough space
            } else if (availableSpace > breakWidths[numOfVisibleItems]) {
            $hlinks.children().first().appendTo($vlinks);
            numOfVisibleItems += 1;
            }
            // Update the button accordingly
            $btn.attr("count", numOfItems - numOfVisibleItems);
            if (numOfVisibleItems === numOfItems) {
            $btn.addClass('hidden');
            } else $btn.removeClass('hidden');
        }

        // Window listeners
        $(window).resize(function() {
            check();
        });

        $btn.on('click', function() {
            $hlinks.toggleClass('hidden');
        });

        check();

    })(jQuery);

    $('.quantity').change(function(event) {
  	    var value = $(this).val();
  	    var id = $(this).attr('pid');
  	    $.ajax({
  	      	url: upUrl + id + '/' + value,
  	      	type: 'GET',
  		 	beforeSend: function(){
  		    	$('.loading').css('display', 'block');
  		  	},
  		  	complete: function(){
  	        	location.reload()
  		   	}
  	    });
  	});

	/*Delete item*/
    $('.deteteElem').click(function(event) {
        var id = $(this).attr('id');
        $.ajax({
          	url: delUrl + id ,
          	type: 'GET',
		 	beforeSend: function(){
		    	$('.loading').css('display', 'block');
		  	},
		  	complete: function(){
	        	location.reload()
		   	}
        });
    });

    (function($) {
        var isClosed = true;
        $('.cart').click(function(){
        if(isClosed)
        {
            $(this).addClass("active");
            $(this).removeClass("hover");
            $('.cd-cart-items').slideDown('normal');
            isClosed = false;
        }
        else
        {
            $(this).removeClass("active");
            $('.cd-cart-items').slideUp('normal');
            isClosed = true;
        }
        });
    })(jQuery);

    $('.header').css({
        'background-image': "url({{ $CMSSettings['bg_header'] }})",
        'background-repeat': "no-repeat",
        'background-position': '0px 25%',
        'background-size': '100%'
    })
</script>

@include('front/_shared/_flash-messages')

</body>

</html>
