@extends(Helper::layout())
@section('style')

@stop

@section('content')
<div class="wrapper">
	<div class="about-img-stick"></div>
	<div class="parallax">
		<div class="par-item"></div>
		<div class="par-item"></div>
	</div>
	<div class="us-block us-page">
		<div class="us-title">{{ $element->channel->first()->title }}</div>
		{{ $element->channel->first()->desc }}
	</div>
</div>
@stop
@section('scripts')

@stop