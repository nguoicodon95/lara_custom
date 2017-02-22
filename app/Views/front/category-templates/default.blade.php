@extends('front._master')

@section('css')

@endsection

@section('js')

@endsection

@section('js-init')

@endsection

@push('style')
<style>
    .post.excerpt, .pr.excerpt {
      clear: both;
      margin-bottom: 30px;
      background-color: #fff;
      padding: 20px;
      border: 1px solid #cdcdcd;
    }
    .corner:before {
      content: "";
      position: absolute;
      left: -10px;
      width: 0;
      height: 0;
      border-style: solid;
      border-width: 0 0 10px 10px;
      border-color: rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) rgba(0, 0, 0, 0.15) rgba(0, 0, 0, 0);
  }
  .post-date-ribbon {
      text-align: center;
      line-height: 25px;
      color: #fff;
      font-size: 12px;
      margin-top: -30px;
      position: relative;
      padding: 0 7px;
      float: left;
      background-color: #EA141F;
  }
  article header {
      margin-bottom: 15px;
      float: left;
  }
  .title {
      margin-bottom: 5px;
      margin-top: 10px;
      font-size: 19px;
      line-height: 18px;
      clear: both;
  }
  #featured-thumbnail {
      float: left;
      max-width: 150px;
      width: 22.2%;
      margin-right: 20px;
  }
  .readMore {
      margin-top: 15px;
  }
  .readMore a {
      color: #fff;
      padding: 5px 12px;
      transition: all 0.25s linear;
      font-family: 'Monda', sans-serif;
      background-color: #EA141F;
  }

  .popular_pr {
      display: block;
      background: #fff;
      padding: 10px;
  }
  .popular_pr .thumb {
      width: 30%;
      float: left;
      padding-right: 5px;
  }
  .popular_pr h2 {
      font-size: 15px;
      line-height: 18px;
  }

  .pr .post-date-ribbon {
      background-color: #0182c6;
  }
  .pr .title {
      font-size: 15px;
  }
  .pr header {
      margin-bottom: 0;
  }
</style>
@endpush

@section('content')
        <div class="col-md-8">
        @foreach($relatedPosts as $key => $row)
            <article class="post excerpt">
                <div class="post-date-ribbon">
                    <div class="corner"></div>{{ $row->created_at or '' }}
                </div>
                <header>
                <h2 class="title">
                    <a href="{{ _getPostLink($row->slug) }}" title="{{ $row->title or '' }}" rel="bookmark">{{ $row->title or '' }}</a>
                </h2>
                </header><!--.header-->
                <a href="{{ _getPostLink($row->slug) }}" title="{{ $row->title or '' }}" id="featured-thumbnail">
                    <div class="featured-thumbnail">
                        <img width="150" height="120" src="{{ $row->thumbnail or '' }}" class="attachment-ribbon-lite-featured size-ribbon-lite-featured wp-post-image" alt="{{ $row->title or '' }}" title="{{ $row->title or '' }}" srcset="" sizes="(max-width: 150px) 100vw, 150px">
                    </div>
                </a>
                <div class="post-content">
                    {!! $row->description or '' !!}
                </div>
                <div class="readMore">
                    <a href="{{ _getPostLink($row->slug) }}" title="{{ $row->title or '' }}">
                        Xem chi tiết</a>
                </div>
                <div class="clearfix"></div>
            </article>
        @endforeach
            <div align="center">
                {!! $relatedPosts->setPath(asset(Request::path()))->appends(Request::query())->render() !!}
            </div>
        </div>
        <div class="col-md-4 filterbx">
            <p class="group_title"><span>Sản phẩm nổi bật</span></p>
            @if(isset($pr_popular) && !empty($pr_popular))
              @foreach($pr_popular as $v)
                <article class="pr excerpt">
                    <div class="post-date-ribbon">
                        <div class="corner"></div><u>Giá:</u> {{ _formatPrice($v['price']) }}
                    </div>
                    <header>
                    <a href="{{ _getProductLink($v['slug']) }}" title="{{ $v['title'] or '' }}">
                        <div class="featured-thumbnail">
                            <img src="{{ $v['thumbnail'] or '' }}" class="attachment-ribbon-lite-featured size-ribbon-lite-featured wp-post-image" alt="{{ $v['title'] or '' }}" title="{{ $v['title'] or '' }}" srcset="" sizes="(max-width: 150px) 100vw, 150px">
                        </div>
                    </a>
                    <h2 class="title text-center">
                        <a href="{{ _getProductLink($v['slug']) }}" title="{{ $v['title'] or '' }}" rel="bookmark">{{ $v['title'] or '' }}</a>
                    </h2>
                    </header><!--.header-->
                    <div class="clearfix"></div>
                </article>
              @endforeach
            @endif
        </div>
@endsection
