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
		<div class="us-title">{{ $news->meta->first()->title }}</div>
		<div class="date">{{ myDateTime::months($news->published_at) }}</div>
		{{ $news->meta->first()->content }}
	</div>
</div>
@stop
@section('scripts')

@stop