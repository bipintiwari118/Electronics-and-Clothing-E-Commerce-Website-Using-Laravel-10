@if ($products->count() > 0)
        @foreach ($products as $product)
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="rounded position-relative fruite-item">
                    <div class="fruite-img">
                        <a href="{{ route('shop.details',$product->id) }}">
                        <img src="{{ $product->image }}" class="img-fluid w-100 rounded-top" alt=""
                            style="height: 300px;">
                        </a>
                    </div>
                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                        style="top: 10px; left: 10px;"><a href="{{ route('shop.details',$product->id) }}">
                        {{ $product->category->name }} </a></div>
                    <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                        <h4><a href="{{ route('shop.details',$product->id) }}">{{ $product->title }} </a></h4>
                        <p><a href="{{ route('shop.details',$product->id) }}">{{ $product->description }} </a></p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                            <p class="text-dark fs-5 fw-bold mb-0">${{ $product->price }}</p>
                            <a href="{{ Auth::user() ? 'javascript:void(0);' : route('login') }}"
                                class="btn border border-secondary rounded-pill px-3 text-primary add_to_cart"
                                    data-prod_id={{ $product->id }}><i
                                    class="fa fa-shopping-bag me-2 text-primary" ></i> Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

@else
    <div class="col-md-6 col-lg-6 col-xl-4">
        <img src="{{ asset('no product found.jpeg') }}" alt="">
    </div>
@endif

<div class="col-12">
    <div class="pagination d-flex justify-content-center mt-5">
        @if ($products->onFirstPage())
            <a href="#" class="rounded">&laquo;</a>
        @else
            <a href="{{ $products->previousPageUrl() }}" class="rounded">&laquo;</a>
        @endif

        <!-- Page Links -->
        @for ($page = 1; $page <= $products->lastPage(); $page++)
            <a href="{{ $products->url($page) }}"
                class="{{ $page == $products->currentPage() ? 'active' : '' }} rounded">{{ $page }}</a>
        @endfor

        <!-- Next Page Link -->
        @if ($products->hasMorePages())
            <a href="{{ $products->nextPageUrl() }}" class="rounded">&raquo;</a>
        @else
            <a href="#" class="rounded">&laquo;</a>
        @endif
    </div>
</div>
