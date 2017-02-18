<div class="mobile">
    <div id="bottom_hotline" class="pull-left">
    </div>
    <div id="bottom_nav" class="pull-left">
    </div>
</div>
<div id="footer_contain">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ $CMSSettings['icon_sua_chua_bao_hanh'] }}" alt="{{ $CMSSettings['title_col_one'] or '' }}" width="85" />
                        <h4>{{ $CMSSettings['title_col_one'] or '' }}</h4>
                        <div class="sumary">
                            {!! $CMSSettings['content_col_one'] or '' !!}
                        </div>
                        <div class="link-detail">
                            <a href="{{ $CMSSettings['url_page_col_one'] or '#' }}" class="btn btn-primary btn-sm text-uppercase">Xem chi tiết</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <img src="{{ $CMSSettings['icon_ho_tro_truc_tuyen'] }}" alt="{{ $CMSSettings['title_col_two'] or '' }}" width="85" style="padding: 13px;"/>
                        <h4>{{ $CMSSettings['title_col_two'] or '' }}</h4>
                        <div class="sumary">
                            {!! $CMSSettings['content_col_two'] or '' !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <img src="{{ $CMSSettings['icon_lien_he'] }}" alt="{{ $CMSSettings['title_col_three'] or '' }}" width="85" />
                        <h4>{{ $CMSSettings['title_col_three'] or '' }}</h4>
                        <div class="sumary">
                            {!! $CMSSettings['content_col_three'] or '' !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div id="copyright" class="text-center">&copy 2017 <span class="text-uppercase">Công ty TNHH Daikin</span>.All rights reserved | Designed and Maintained by <a href="">DanangTech.com</a></div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
