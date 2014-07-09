@extends(Helper::layout())

@section('style')
@stop

@section('content')
    {{ $content }}
    @include('reviews/views/default')
@stop
@section('scripts')
@stop