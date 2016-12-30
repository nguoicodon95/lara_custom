
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

    <link rel="shortcut icon" href="/images/logo/favicon.png"/>

    {!! $CMSSettings['google_analytics'] or '' !!}
    <script>
        var delUrl = "{{ asset('/').'/cart/delete/'}}";
        var upUrl = "{{ asset('/').'/cart/update-cart-quantity/' }}";
    </script>
    @stack('style')
</head>

<body class="cms-index-index cms-home">

@if($showHeaderAdminBar)
    @include('admin/_shared/_admin-bar')
@endif

<div class="container">
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
        <div id="maincontain" class="container col1-layout">
            <div class="main">
                <div class="col-main">
                    @hasSection ('slideshow')
                        @yield('slideshow')
                    @else
                        {!! _breadcrumb() !!}
                    @endif
                    <div class="row">
                        <div class="col-md-3">
                            <div class="catalog">
                                <h2 class="group_title"><span>Danh mục sản phẩm</span></h2>
                                <a class="toggle">-</a>
                                <div class="product-category">
                                    {!! $danh_muc_san_pham or '' !!}
                                </div>
                            </div>
                            @hasSection ('sort-a-filter')
                                @yield('sort-a-filter')
                            @else
                                
                            @endif
                        </div>
                        <div class="col-md-9">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer">
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

<!-- BEGIN CORE PLUGINS -->
<script src="/dist/core.min.js"></script>
<!-- END CORE PLUGINS -->

<!-- OTHER PLUGINS -->
@yield('js')
<!-- END OTHER PLUGINS -->

<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="/dist/app.min.js"></script>
<!-- END THEME LAYOUT SCRIPTS -->
<script src="//codeorigin.jquery.com/ui/1.10.2/jquery-ui.min.js"></script>
    
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

    (function($) {
       /* $("#search").autocomplete({
            source: '{{ route('search') }}',
            minLength: 1,
            select: function( event, ui ) {
                $('#search').val(ui.item.id);
            }
        });*/
    })(jQuery);
</script>

@include('front/_shared/_flash-messages')

</body>

</html>