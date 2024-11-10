@extends('layouts.app')
@section('content')

        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Cart</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-white">Cart</li>
            </ol>
        </div>
        <!-- Single Page Header End -->


        <!-- Cart Page Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Handle</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $cart)
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset($cart->product->image) }}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4">{{ $cart->product->title }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4"> ${{ $cart->product->discount_price }}</p>
                                </td>
                                <td data-cart_id="{{ $cart->id }}" data-price="{{ $cart->product->discount_price }}">
                                    <div class="input-group quantity mt-4" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-minus rounded-circle bg-light border cart-plus-minus" >
                                            <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm text-center border-0" value="{{ $cart->quantity }}" name="quantity">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-plus rounded-circle bg-light border cart-plus-minus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4 total_product_price">{{ $cart->product->discount_price * $cart->quantity }}</p>
                                </td>
                                <td>
                                    <button class="btn btn-md rounded-circle bg-light border mt-4 remove-cart" data-cart_id="{{ $cart->id }}" >
                                        <i class="fa fa-times text-danger"></i>
                                    </button>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-5">
                    <input type="text" class="border-0 border-bottom rounded me-5 py-3 mb-4" placeholder="Coupon Code">
                    <button class="btn border-secondary rounded-pill px-4 py-3 text-primary" type="button">Apply Coupon</button>
                </div>
                <div class="row g-4 justify-content-end">
                    <div class="col-8"></div>
                    <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                        <div class="bg-light rounded">
                            <div class="p-4">
                                <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                                <div class="d-flex justify-content-between mb-4">
                                    <h5 class="mb-0 me-4">Subtotal:</h5>
                                    <p class="mb-0 total_payout"></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h5 class="mb-0 me-4">Shipping</h5>
                                    <div class="">
                                        <p class="mb-0">Flat rate: $0.00</p>
                                    </div>
                                </div>
                                <p class="mb-0 text-end">Shipping to kathmandu.</p>
                            </div>
                            <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                                <h5 class="mb-0 ps-4 me-4">Total</h5>
                                <p class="mb-0 pe-4 total_payout"></p>
                            </div>
                            <a href="{{ route('checkout') }}" class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button">Proceed Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Cart Page End -->


@endsection
@push('scripts')
<script>
    $(document).on('click','.cart-plus-minus',function(){
      var quantity = $(this).parents('td').find('input[name=quantity]').val();
      var cart_id = $(this).parents('td').data('cart_id');
      var price = $(this).parents('td').data('price');

      var product_price=price*quantity;
        $(this).parents('tr').find('.total_product_price').text(product_price+"$");

      $.ajax({
          url: "{{ route('update.cart') }}",
          type: "GET",
          data: { cart_id,quantity },
          success: function(response) {
           if(response.success){
              toastr.success(response.message);
              $(document).find('.cart_counter').text(response.cart_count);
              totalPayout();
           }
          }
      });

  });
  $(document).on('click','.remove-cart',function(){
      var cart_id = $(this).data('cart_id');
      var $this=$(this);

      $.ajax({
          url: "{{ route('remove.cart') }}",
          type: "GET",
          data: { cart_id },
          success: function(response) {
            toastr.success(response.message);
           $this.parents('tr').remove();
           $(document).find('.cart_counter').text(response.cart_count);
           totalPayout();
          }
      });

  });

  totalPayout();
  function totalPayout(){

    $.ajax({
          url: "{{ route('total.payout') }}",
          type: "GET",
          success: function(response) {
           $(document).find('.total_payout').text("$"+response.total_payout);
          }
      });
  }
</script>

@endpush
