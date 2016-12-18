<div class="header_container">
    <!--logo-->
    <div id="logo" class="pull-left">
        <a href="/" title="" class="logo">
            <img src="/images/logo/logo.png" alt="{{ $CMSSettings['site_title'] or '' }}" />
        </a>
    </div>
    <!--end logo-->
    <!--top Search-->
    <div id="top_search" class="pull-left">
        <form id="search_mini_form" action="" method="get">
            <div class="form-search form-search-autocomplete">
                <input id="search" type="text" name="q" value="" class="input-text" maxlength="128" />
                <button class="button" id="basic-search" type="submit" title=" Tìm kiếm">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </div>
        </form>
    </div>
    <!--End top search-->

    <div class="link-pnj"></div>
    <div class="clearfix"></div>
</div>
<div id="menu_area">
    <div class="container">
        <div id="mainmenu">
            {!! $CMSMenuHtml or '' !!}
        </div>
    </div>
</div>