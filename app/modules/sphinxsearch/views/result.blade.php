<?php
if (Input::has('query')):

    $channels = SphinxSearch::search(Input::get('query'), 'channelsIndex')->setFieldWeights(array('title'=>10,'short'=>8,'desc'=>6,'category_title'=>1))
        ->setMatchMode(\Sphinx\SphinxClient::SPH_MATCH_EXTENDED)
        ->SetSortMode(\Sphinx\SphinxClient::SPH_SORT_RELEVANCE, "@weight DESC")
        ->limit(6)->get();
    var_dump($channels);

    $products = SphinxSearch::search(Input::get('query'), 'productsIndex')->setFieldWeights(array('title'=>10,'short'=>8,'desc'=>6,'category_title'=>1))
        ->setMatchMode(\Sphinx\SphinxClient::SPH_MATCH_EXTENDED)
        ->SetSortMode(\Sphinx\SphinxClient::SPH_SORT_RELEVANCE, "@weight DESC")
        ->limit(6)->get();
    var_dump($products);

    $reviews = SphinxSearch::search(Input::get('query'), 'reviewsIndex')->setFieldWeights(array('name'=>10,'name'=>8,'details'=>1))
        ->setMatchMode(\Sphinx\SphinxClient::SPH_MATCH_EXTENDED)
        ->SetSortMode(\Sphinx\SphinxClient::SPH_SORT_RELEVANCE, "@weight DESC")
        ->limit(6)->get();
    var_dump($reviews);

    $pages = SphinxSearch::search(Input::get('query'), 'pagesIndex')->setFieldWeights(array('seo_title'=>10,'seo_description'=>10,'seo_h1'=>10,'content'=>8))
        ->setMatchMode(\Sphinx\SphinxClient::SPH_MATCH_EXTENDED)
        ->SetSortMode(\Sphinx\SphinxClient::SPH_SORT_RELEVANCE, "@weight DESC")
        ->limit(6)->get();
    var_dump($pages);

endif;
?>



<!--<div class="wrapper">-->
<!--    <div class="us-block">-->
<!--        <div class="us-title">Результаты поиска <span class="search-am">(3)</span></div>-->
<!--        <ol class="num-list search-list">-->
<!--            <li>-->
<!--                <div class="search-text">-->
<!--                    После зачистки полости дупла от трухи и мусора она опрыскивается аэрозольным антисептиком. Если дупло имеет большой размер в поперечнике или длиной около полуметра, то необходимо  провести  фумигацию или  обработку  савой также-->
<!--                    в аэрозольном варианте для предотвращения развития  в древесине муравьев, точильщиков и образования гнезд ос и шершней....-->
<!--                </div>-->
<!--                <a href="#" class="post-link">Подробнее</a>-->
<!---->
<!--            <li>-->
<!--                <div class="search-text">-->
<!--                    После зачистки полости дупла от трухи и мусора она опрыскивается аэрозольным антисептиком. Если дупло имеет большой размер в поперечнике или длиной около полуметра, то необходимо  провести  фумигацию или  обработку  савой также-->
<!--                    в аэрозольном варианте для предотвращения развития  в древесине муравьев, точильщиков и образования гнезд ос и шершней....-->
<!--                </div>-->
<!--                <a href="#" class="post-link">Подробнее</a>-->
<!---->
<!--            <li>-->
<!--                <div class="search-text">-->
<!--                    После зачистки полости дупла от трухи и мусора она опрыскивается аэрозольным антисептиком. Если дупло имеет большой размер в поперечнике или длиной около полуметра, то необходимо  провести  фумигацию или  обработку  савой также-->
<!--                    в аэрозольном варианте для предотвращения развития  в древесине муравьев, точильщиков и образования гнезд ос и шершней....-->
<!--                </div>-->
<!--                <a href="#" class="post-link">Подробнее</a>-->
<!--        </ol>-->
<!--    </div>-->
<!--</div>-->