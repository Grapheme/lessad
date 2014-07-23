@extends(Helper::layout())

@section('style')
	<link href='http://fonts.googleapis.com/css?family=PT+Serif:400italic&subset=latin,cyrillic,cyrillic-ext' rel='stylesheet' type='text/css'>
@stop

@section('content')
{{ $content }}
@include('channels/views/documents')
@include('channels/views/publication')
@stop

@section('scripts')
@stop