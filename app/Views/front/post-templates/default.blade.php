@extends('front._master')

@section('css')

@endsection

@section('js')

@endsection

@section('js-init')

@endsection

@push('style')
<style>
    .detail-post h1 {
        font-size: 18px;
    }

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
      background-color: #0182c6;
  }
  article header {
      margin-bottom: 0;
      float: left;
  }
  .title {
      margin-bottom: 5px;
      margin-top: 10px;
      font-size: 15px;
      line-height: 18px;
      display: inline;
  }
  .featured-thumbnail {
      float: left;
      max-width: 150px;
      width: 22.2%;
      margin-right: 10px;
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
</style>
@endpush

@section('content')
        <div class="col-md-8 detail-post">
            <h1>{{ $object->title }}</h1>
            {!! $object->content !!}
        </div>
        <div class="col-md-4 filterbx">
            <p class="group_title"><span>Tin cùng chuyên mục</span></p>
            @if(isset($post_same_category) && !empty($post_same_category))
                @foreach($post_same_category as $row)
                <article class="pr excerpt">
                    <div class="post-date-ribbon">
                        <div class="corner"></div>{{ $row->created_at }}
                    </div>
                    <header>
                    <a href="{{ _getPostLink($row->slug) }}" title="{{ $row->title or '' }}">
                        <div class="featured-thumbnail">
                            <img src="{{ $row->thumbnail or '' }}" class="attachment-ribbon-lite-featured size-ribbon-lite-featured wp-post-image" alt="{{ $row->title or '' }}" title="{{ $row->title or '' }}">
                        </div>
                    </a>
                    <h2 class="title text-center">
                        <a href="{{ _getPostLink($row->slug) }}" title="{{ $row->title or '' }}" rel="bookmark">{{ $row->title or '' }}</a>
                    </h2>
                    </header><!--.header-->
                    <div class="clearfix"></div>
                </article>
                @endforeach
            @endif
        </div>
@endsection
