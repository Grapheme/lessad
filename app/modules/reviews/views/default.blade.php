<div class="feedback">
    <div class="wrapper">
        <div class="block-title">Отзывы</div>
        <ul class="feedb-messages">
            @foreach(Reviews::orderBy('published_at','desc')->take(3)->with('photo')->with('meta')->get() as $review)
            <li>
                @if(!empty($review->photo))
                <div class="feedb-photo" style="background-image: url(uploads/galleries/{{ $review->photo->name  }})"></div>
                @endif
                <div class="name">{{ $review->meta->first()->name }}</div>
                <div class="post">{{ $review->meta->first()->position }}</div>
                <div class="message">{{ $review->meta->first()->preview }}</div>
                @if (ReviewsController::$prefix_url !== FALSE):
                <a href="{{ link::to(ReviewsController::$prefix_url.'/'.$review->meta->first()->seo_url) }}" class="review-link"></a>
                @endif
            @endforeach
        </ul>
    </div>
</div>