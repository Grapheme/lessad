@extends(Helper::layout())

@section('style')
{{ HTML::style('css/fotorama.css') }}
@stop

@section('content')
{{ $content }}
@include('channels/views/banners')
@include('reviews/views/default')
@stop
@section('scripts')
{{ HTML::script('js/vendor/fotorama.js'); }}
@stop