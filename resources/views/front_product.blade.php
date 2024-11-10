@if ($products_four->count()>0)

@foreach ($products_four as $product)
<div class="col-md-6 col-lg-4 col-xl-3">
    <div class="rounded position-relative fruite-item">
        <div class="fruite-img">
            <img src="{{ asset($product->image) }}" class="img-fluid w-100 rounded-top" alt=""
                style="height: 250px;">
        </div>
        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">
            {{ $product->subcategory->name }}</div>
        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
            <h4>{{ $product->title }}</h4>
            <p>{{ $product->description }}</p>
            <div class="d-flex justify-content-between flex-lg-wrap">
                <p class="text-dark fs-5 fw-bold mb-0">${{ $product->price }}</p>
                <a href="{{ Auth::user() ? 'javascript:void(0);': route('login')}}" class="btn border border-secondary rounded-pill px-3 text-primary  add_to_cart" data-prod_id={{ $product->id }}><i
                        class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
            </div>
        </div>
    </div>
</div>
@endforeach

@else
    <h5>Product Not Avaliable.</h5>
@endif

