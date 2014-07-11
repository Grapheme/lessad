@extends(Helper::layout())

@section('style')
@stop

@section('content')
{{ $content }}
@include('reviews/views/default')
@stop
@section('scripts')
{{ HTML::script('theme/js/vendor/fotorama.js'); }}
{{ HTML::script('theme/js/main.js'); }}
@stop