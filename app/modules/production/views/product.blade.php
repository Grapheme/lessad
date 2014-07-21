<?php
if($product = Product::where('link',Request::path())->with('images')->first()):
    $product = $product->toArray();
endif;
?>

<div class="wrapper">
    <div class="us-block">
        <ul class="products">
            <li>
                <div class="product-photo"
                     style="background-image: url(uploads/galleries/{{ $product['images']['name'] }});"></div>
                <div class="product-info">
                    <div class="block-title">
                        {{ $product['title'] }}
                    </div>
                    <div class="us-text">
                        {{ $product['short'] }}
                    </div>
                    {{ $product['desc'] }}
                </div>
    </div>
</div>