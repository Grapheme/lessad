@extends(Helper::layout())

@section('style')
@stop

@section('content')
    {{ $content }}
    @include('news/views/index')
@stop
@section('scripts')
@stop