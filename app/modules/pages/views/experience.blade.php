@extends(Helper::layout())

@section('style')
@stop

@section('content')
    {{ $content }}
    @include('channels/views/experience')
@stop
@section('scripts')
@stop