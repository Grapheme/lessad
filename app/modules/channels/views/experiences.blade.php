<?php
$channelCategory = ChannelCategory::where('slug','experience')->first();
$channel = Channel::where('category_id',@$channelCategory->id)->with('images')->take(100)->get();
?>
@if($channel->count())
<div class="about-posts">
	<div class="wrapper">
		<div class="about-img-stick">
		</div>
		<div class="parallax">
			<div class="par-item">
			</div>
			<div class="par-item">
			</div>
		</div>
		<div class="us-title mar-title">Многолетний опыт работы</div>
		<div class="posts-window">
			<ul class="post-ul exp-ul">
				@foreach($channel as $pub)
                <li>
                    <div class="post-photo" style="background-image: url(/uploads/galleries/{{ $pub->images->name }})"> </div>
                    @if(!empty($pub->link))
                    <a href="{{ link::to('experience/'.$pub->link) }}" class="title">{{ $pub->title }}</a>
                    @else
                    <div class="title">{{ $pub->title }}</div>
                    @endif
                    <div class="desc">{{ $pub->short }}</div>
                    <a href="{{ link::to('experience/'.$pub->link) }}" class="post-link">Подробнее</a>
                @endforeach
			</ul>
		</div>
	</div>
</div>
@endif