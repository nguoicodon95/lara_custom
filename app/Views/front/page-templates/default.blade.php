@extends('front._master')

@section('css')

@endsection

@section('js')

@endsection

@section('js-init')

@endsection

@section('content')
    <div class="main-content">
        {!! $object->content !!}
    </div>
@endsection
