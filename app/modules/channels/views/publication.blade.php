<?php
$channelCategory = ChannelCategory::where('slug','publication')->first();
$channel = Channel::where('category_id',@$channelCategory->id)->take(100)->get();
?>
@if($channel->count())
<div class="about-posts">
    <div class="wrapper">
        <div class="about-img-stick"></div>
        <div class="parallax">
            <div class="par-item"></div>
            <div class="par-item"></div>
        </div>
        <div class="us-title mar-title">Публикации</div>
        <div class="posts-window">
            <ul class="post-ul">
                @foreach($channel as $pub)
                <li>
                    @if(!empty($pub->link))
                    <a href="{{ link::to($pub->link) }}" class="title">{{ $pub->title }}</a>
                    @else
                    <div class="title">{{ $pub->title }}</div>
                    @endif
                    <div class="desc">{{ $pub->short }}</div>
                @endforeach
            </ul>
        </div>
        @if(Channel::where('category_id',2)->count() > 100)
        <a href="javascript::void(0);" class="post-link js-posts">Показать все</a>
        @endif
    </div>
</div>
@endif