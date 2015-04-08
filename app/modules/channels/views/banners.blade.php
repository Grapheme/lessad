<?php
$channelCategory = ChannelCategory::where('slug','banners')->first();
$channel = Channel::where('category_id',@$channelCategory->id)->orderBy('sort')->with('image')->take(100)->get();
?>
@if($channel->count())
<div class="info-slider">
    <a href="#" class="slider-prev"></a><a href="#" class="slider-next"></a>
    <div class="slider_fotorama" data-loop="true" data-width="100%" data-height="630px" data-nav="false" data-arrows="false">
        @foreach($channel as $banner)
        <?php
            $hasImage = FALSE;
            if (!empty($banner->image) && File::exists(public_path('/uploads/galleries/'.$banner->image->name))):
                $hasImage = TRUE;
            endif;
        ?>
        <div class="slide" {{ $hasImage ? 'style="background-image: url(/uploads/galleries/'.$banner->image->name.')"' : '' }}>
            <div class="wrapper">
                <div class="slide-text">
                    <div class="title">{{ $banner->title }}</div>
                    <div class="desc">{{ $banner->desc }}</div>
                    @if(!empty($banner->link))
                    <p>
                        <a class="us-btn" href="{{ URL::to($banner->link) }}">Подробнее</a><br>
                    </p>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif