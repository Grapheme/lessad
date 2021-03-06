<?php
//<a href="{{-- link::to('catalog/'.$product['link']) --}}">{{-- $product['title'] --}}</a>
if($products = Product::orderBy('sort')->orderBy('title')->with('images')->with('category')->get()):
    $products = $products->toArray();
endif;
?>

<div class="wrapper">
    <div class="us-block">
        <ul class="products">
            @foreach($products as $product)
            <li>
                <a class="product-photo" target="_blank" href="{{ $product['link'] }}" style="background-image: url(uploads/galleries/{{ $product['images']['name'] }});"></a>
                <div class="product-info">
                    <a class="block-title" target="_blank" href="{{ $product['link'] }}">
                        {{ $product['title'] }}
                    </a>
                    <!--<div>{{ $product['category']['title'] }}</div>-->
                    <div class="us-text">
                        {{ $product['short'] }}
                    </div>
                </div>
            @endforeach
        </ul>
    </div>
</div>