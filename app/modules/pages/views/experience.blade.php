@extends(Helper::layout())

@section('style')
@stop

@section('content')
    {{ $content }}
    @include('channels/views/experiences')
@stop
@section('scripts')
@stop