@extends(Helper::layout())

@section('style')
{{ HTML::style('theme/css/fotorama.css') }}
@stop

@section('content')
{{ $content }}
@include('reviews/views/default')
@stop
@section('scripts')
{{ HTML::script('theme/js/vendor/fotorama.js'); }}
{{ HTML::script('theme/js/main.js'); }}
@stop