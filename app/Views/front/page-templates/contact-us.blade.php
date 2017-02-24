@extends('front._master')

@section('css')

@endsection

@section('js')

@endsection

@section('js-init')

@endsection

@section('content')
    <div class="main-content">
        <h1 class="group_title"><span>{{ $object->title }}</span></h1>
    </div>
    <div class="row">
      <div class="col-md-6">
        {!! $object->content !!}
      </div>
      <div class="col-md-6">
        @include('front._modules._contact-us')
      </div>
    </div>
@endsection
