<?php
if (Input::has('query')):
    $result = SphinxsearchController::search();
    $totalCount = (int) count($result['channels']) + (int) count($result['products']) + (int) count($result['reviews']) + (int) count($result['pages']);
    if($totalCount == 0):
        $totalCount = 'Ничего не найдено';
    endif;
endif;
?>

<div class="wrapper">
    <div class="us-block">
        <div class="us-title">Результаты поиска <span class="search-am">({{ $totalCount }})</span></div>
        <ol class="num-list search-list">
            @if(!is_null($result['channels']) && $result['channels']->count())
                @foreach($result['channels'] as $channel)
            <li>
                <div class="search-text">
                    После зачистки полости дупла от трухи и мусора она опрыскивается аэрозольным антисептиком. Если дупло имеет большой размер в поперечнике или длиной около полуметра, то необходимо  провести  фумигацию или  обработку  савой также
                    в аэрозольном варианте для предотвращения развития  в древесине муравьев, точильщиков и образования гнезд ос и шершней....
                </div>
                <a href="#" class="post-link">Подробнее</a>
                @endforeach
            @endif
            @if(!is_null($result['products']) && $result['products']->count())
                @foreach($result['products'] as $product)
            <li>
                <div class="search-text">
                    После зачистки полости дупла от трухи и мусора она опрыскивается аэрозольным антисептиком. Если дупло имеет большой размер в поперечнике или длиной около полуметра, то необходимо  провести  фумигацию или  обработку  савой также
                    в аэрозольном варианте для предотвращения развития  в древесине муравьев, точильщиков и образования гнезд ос и шершней....
                </div>
                <a href="#" class="post-link">Подробнее</a>
                @endforeach
            @endif
            @if(!is_null($result['reviews']) && $result['reviews']->count())
                @foreach($result['reviews'] as $review)
            <li>
                <div class="search-text">
                    После зачистки полости дупла от трухи и мусора она опрыскивается аэрозольным антисептиком. Если дупло имеет большой размер в поперечнике или длиной около полуметра, то необходимо  провести  фумигацию или  обработку  савой также
                    в аэрозольном варианте для предотвращения развития  в древесине муравьев, точильщиков и образования гнезд ос и шершней....
                </div>
                <a href="#" class="post-link">Подробнее</a>
                @endforeach
            @endif
            @if(!is_null($result['pages']) && $result['pages']->count())
                @foreach($result['pages'] as $page)
            <li>
                <div class="search-text">
                    После зачистки полости дупла от трухи и мусора она опрыскивается аэрозольным антисептиком. Если дупло имеет большой размер в поперечнике или длиной около полуметра, то необходимо  провести  фумигацию или  обработку  савой также
                    в аэрозольном варианте для предотвращения развития  в древесине муравьев, точильщиков и образования гнезд ос и шершней....
                </div>
                <a href="#" class="post-link">Подробнее</a>
                @endforeach
            @endif
        </ol>
    </div>
</div>