@extends('themes.publik.layouts.cart')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                {{ html()->form('PUT', route('carts.update'))->id('cart-form')->open() }}
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($cart->items as $item)
                            <tr>
                                <td class="align-middle">
                                    <img src="img/product-1.jpg" alt="" style="width: 50px;">
                                    {{ $item->product->name }}
                                </td>
                                <td class="align-middle">{{ $item->product->price_label }}</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-sm btn-primary btn-minus"
                                                    data-item-id="{{ $item->id }}">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="text" id="qty-{{ $item->id }}" name="qty[{{ $item->id }}]"
                                                class="form-control form-control-sm bg-secondary border-0 text-center"
                                                value="{{ $item->qty }}">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-sm btn-primary btn-plus"
                                                    data-item-id="{{ $item->id }}">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle" id="subtotal-{{ $item->id }}">{{ $item->sub_total }}</td>
                                <td class="align-middle">
                                    <a href="{{ route('carts.destroy', [$item->id]) }}"
                                        onclick="return confirm('anda yakin menghapusnya?')" class="btn btn-sm btn-danger">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Tombol "Update Quantity" di pojok kanan -->
                <div class="text-end mt-3" style="margin-left: 45.2rem">
                    <button type="submit" class="btn btn-primary">Update Quantity</button>
                </div>
                {{ html()->form()->close() }}
            </div>
            <div class="col-lg-4">
                {{-- <form class="mb-30" action="">
                    <div class="input-group">
                        <input type="text" class="form-control border-0 p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form> --}}
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6>{{ $cart->sub_total_price_label }}</h6>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Discount</h6>
                            <h6>{{ $cart->discount_amount_label }}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Tax</h6>
                            <h6 class="font-weight-medium">{{ $cart->tax_amount_label }}</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5>{{ $cart->grand_total_label }}</h5>
                        </div>
                        <a href="{{route('orders.checkout')}}" class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
<script src="{{ asset('assets/js/main.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fungsi untuk mengurangi nilai qty
        document.querySelectorAll('.btn-minus').forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const itemId = this.getAttribute('data-item-id');
                const input = document.getElementById(`qty-${itemId}`);
                let currentValue = parseInt(input.value) ||
                1; // Default ke 1 jika nilai tidak valid
                if (currentValue > 1) { // Pastikan nilai tidak kurang dari 1
                    input.value = currentValue - 1;
                }
            });
        });

        // Fungsi untuk menambah nilai qty
        document.querySelectorAll('.btn-plus').forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const itemId = this.getAttribute('data-item-id');
                const input = document.getElementById(`qty-${itemId}`);
                let currentValue = parseInt(input.value) ||
                0; // Default ke 0 jika nilai tidak valid
                input.value = currentValue + 1;
            });
        });
    });
</script>
