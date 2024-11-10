@extends('layouts.app')
@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Shop</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Shop</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Fruits Shop Start-->
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <h1 class="mb-4">Fashion Finds</h1>
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4">
                        <div class="col-xl-3">
                            <div class="input-group w-100 mx-auto d-flex">
                                <input type="search" class="form-control p-3" placeholder="keywords"
                                    aria-describedby="search-icon-1">
                                <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                            </div>
                        </div>
                        <div class="col-6"></div>
                        <div class="col-xl-3">
                            <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                                <label for="fruits">Default Sorting:</label>
                                <select id="fruits" name="fruitlist" class="border-0 form-select-sm bg-light me-3"
                                    form="fruitform">
                                    <option value="volvo">Nothing</option>
                                    <option value="saab">Popularity</option>
                                    <option value="opel">Organic</option>
                                    <option value="audi">Fantastic</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-3">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <h4>Categories</h4>
                                        <ul class="list-unstyled fruite-categorie">
                                            @foreach ($categories as $category)
                                                <li data-cat_id={{ $category->id }} class="category_li">
                                                    <div class="d-flex justify-content-between fruite-name">
                                                        <a href="javascript:void(0);"><i
                                                                class="fas fa-apple-alt me-2">{{ $category->name }}</i></a>
                                                        <span>(3)</span>
                                                    </div>
                                                </li>
                                            @endforeach


                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <h4 class="mb-2">Price</h4>
                                        <input type="range" class="form-range w-100" id="rangeInput" name="rangeInput"
                                            min="0" max="100000" value="0"
                                            oninput="amount.value=rangeInput.value">
                                        <output id="amount" name="amount" min-velue="0" max-value="100000"
                                            for="rangeInput">0</output>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <h4>Sub Categories</h4>
                                        @foreach ($subcategories as $subcategory)
                                            <div class="mb-2">
                                                <input type="radio" class="me-2" id="{{ $subcategory->id }}"
                                                    name="sub_category" value="{{ $subcategory->id }}">
                                                <label for="{{ $subcategory->id }}">{{ $subcategory->name }}</label>
                                            </div>
                                        @endforeach


                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <h4 class="mb-3">Featured products</h4>
                                    @foreach ($products->take(3) as $product)
                                    <div class="d-flex align-items-center justify-content-start">
                                        <div class="rounded me-4" style="width: 100px; height: 100px;">
                                            <img src="{{ $product->image }}" class="img-fluid rounded" alt="">
                                        </div>
                                        <div>
                                            <h6 class="mb-2">{{ $product->title }}</h6>
                                            <div class="d-flex mb-2">
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="d-flex mb-2">
                                                <h5 class="fw-bold me-2">${{ $product->discount_price }}</h5>
                                                <h5 class="text-danger text-decoration-line-through">${{ $product->price }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach


                                    <div class="d-flex justify-content-center my-4">
                                        <a href="javascript:void();"
                                            class="btn border border-secondary px-4 py-3 rounded-pill text-primary w-100">Vew
                                            More</a>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="position-relative">
                                        <img src="{{ asset('img/banner.clothes.jpeg') }}" class="img-fluid w-100 rounded" alt="">
                                        <div class="position-absolute"
                                            style="top: 50%; right: 10px; transform: translateY(-50%);">
                                            <h3 class="text-secondary fw-bold">Timeless Styles <br> Modern Fits</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="row g-4 justify-content-center shop-products">
                                @include('shop_product')


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fruits Shop End-->
@endsection

@push('scripts')
    <script>
        $(document).on('click', 'input[name=sub_category]', function() {
            var sub_cat_id = $(this).val();
            var data = {
                sub_cat_id: sub_cat_id
            };
            getProducts(data);
        });
        $(document).on('click', '.category_li', function() {
            var cat_id = $(this).data('cat_id');
            var data = {
                cat_id: cat_id
            };
            getProducts(data);

        });
        $(document).on('change', 'input[name=rangeInput]', function() {
            var range = $(this).val();
            var data = {
                range: range
            };
            getProducts(data);

        });

        function getProducts(data) {
            $.ajax({
                url: "{{ url()->current() }}",
                type: "GET",
                data: data,
                success: function(response) {
                    $('.shop-products').html(response);

                }
            });

        }
    </script>
@endpush
