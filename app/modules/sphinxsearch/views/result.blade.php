<?php
if (Input::has('query')):
   $results = SphinxSearch::search(Input::has('query'))->query();

   var_dump($results);exit;

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