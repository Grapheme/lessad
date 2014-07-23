<?php
if($channel = Channel::where('category_id',1)->with('images')->get()):
    $channel = $channel->toArray();
endif;
?>
@if(count($channel))
<div class="about-docs">
    <div class="wrapper">
        <div class="us-title mar-title">Документы</div>
        <ul class="documents">
            @foreach($channel as $doc)
            <li>
                <div class="doc-photo">
                    <a href="{{ $doc['file'] }}" target="_blank" class="doc-img" style="background-image: url(uploads/galleries/{{ $doc['images']['name'] }})"></a>
                    <div class="doc-type"><span>{{ File::extension(public_path($doc['file'])) }}</span></div>
                </div>
                <a href="{{ $doc['file'] }}" target="_blank" class="doc-name">{{ $doc['title'] }}</a>
                <a class="doc-size" href="{{ $doc['file'] }}" target="_blank">{{ $doc['short'] }}</a>
            @endforeach
        </ul>
    </div>
</div>
@endif