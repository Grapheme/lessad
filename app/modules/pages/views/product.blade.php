@extends(Helper::layout())

@section('style')
@stop

@section('content')
@include('production/views/product')
{{ $content }}
@stop
@section('scripts')
@stop