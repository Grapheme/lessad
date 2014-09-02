<?php
$news = I18nNews::where('publication',1)->orderBy('published_at','DESC')->with('meta')->with('photo')->take(100)->get();
?>
@if($news->count())
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
		<div class="us-title mar-title">БЛОГ</div>
		<div class="posts-window">
			<ul class="post-ul exp-ul">
				@foreach($news as $new)
                <li>
                    @if(!empty($new->photo->name))
                    <div class="post-photo" style="background-image: url(/uploads/galleries/{{ $new->photo->name }})"> </div>
                    @endif
                    <a href="{{ URL::route('news_full',array('url'=>$new->slug)) }}" class="title">{{ $new->meta->first()->title }}</a>
                    <div class="desc">{{ $new->meta->first()->preview }}</div>
                    <a href="{{ URL::route('news_full',array('url'=>$new->slug)) }}" class="post-link">Подробнее</a>
                @endforeach
			</ul>
		</div>
	</div>
</div>
@endif