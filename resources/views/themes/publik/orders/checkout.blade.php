@extends('themes.publik.layouts.cart')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Checkout</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Checkout Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <h5 class="section-title position-relative text-uppercase mb-3">
                    <span class="bg-secondary pr-3">Delivery Address</span>
                </h5>
                <div class="bg-light p-30 mb-5">
                    <div class="row">
                        @forelse ($addresses as $address)
                            <div class="col-md-12 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <label class="d-block">
                                            <div class="form-check mb-4">
                                                <input class="form-check-input delivery-address" value="{{ $address->id }}" type="radio" name="address_id" id="homeRadio" {{ ($address->is_primary) ? 'checked' : '' }}>
                                                <label class="form-check-label text-dark" for="homeRadio">{{ $address->label }}</label>
                                            </div>
                                            <p class="card-text">
                                                <strong>{{ $address->first_name }} {{ $address->last_name }}</strong><br>
                                                {{ $address->address1 }}<br>
                                                {{ $address->address2 }}<br>
                                                {{ $address->phone }}
                                            </p>
                                            @if ($address->is_primary)
                                                <span class="badge bg-success">Default Address</span>
                                            @endif
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse

                    </div>
                </div>

                <h5 class="section-title position-relative text-uppercase mb-3">
                    <span class="bg-secondary pr-3">Delivery Service</span>
                </h5>
                <div class="bg-light p-30 mb-5">
                    <div class="row">
                        <div class="col-md-12">
                            <p>Available services:</p>
                            <form>
                                <!-- Pemilihan Kurir -->
                                <div class="mb-4">
                                    <h6>Select Courier:</h6>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input courier-code" type="radio" name="courier_code" id="inlineRadio1" value="jne">
                                        <label class="form-check-label" for="inlineRadio1">JNE</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input courier-code" type="radio" name="courier_code" id="inlineRadio2" value="pos">
                                        <label class="form-check-label" for="inlineRadio2">POS</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input courier-code" type="radio" name="courier_code" id="inlineRadio2" value="tiki">
                                        <label class="form-check-label" for="inlineRadio2">TIKI</label>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <p>Available services:</p>
                                    <ul class="list-group list-group-flush available-services" style="display: none;"></ul>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order
                        Details</span></h5>
                <div class="bg-light p-30 mb-5">
                    @foreach ($cart->items as $item)
                        <div class="border-bottom py-3"> <!-- Tambahkan padding untuk jarak -->
                            <div class="d-flex align-items-center"> <!-- Flexbox untuk alignment -->
                                <!-- Kolom Gambar -->
                                <div class="me-3" style="width: 70px;"> <!-- Atur lebar gambar -->
                                    <img src="{{ asset('img/p1.jpg') }}" alt="{{ $item->product->name }}" class="img-fluid"
                                        style="height: 70px;">
                                </div>

                                <!-- Kolom Nama Produk -->
                                <div class="flex-grow-1 me-4"> <!-- Nama produk mengambil sisa space -->
                                    <a href="{{ shop_product_link($item->product) }}" class="text-decoration-none">
                                        <p class="mb-0">{{ $item->product->name }}</p> <!-- Nama produk -->
                                    </a>
                                </div>

                                <!-- Kolom Harga -->
                                <div class="text-end" style="min-width: 80px;"> <!-- Atur lebar minimal untuk harga -->
                                    @if ($item->product->has_sale_price)
                                        <small class="text-danger">IDR {{ $item->product->sale_price_label }}</small>
                                        <!-- Harga diskon -->
                                        <small class="text-muted text-decoration-line-through d-block">IDR
                                            {{ $item->product->price_label }}</small> <!-- Harga asli -->
                                    @else
                                        <small>IDR {{ $item->product->price_label }}</small> <!-- Harga normal -->
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="border-bottom pt-3 pb-2">
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Item Subtotal</h6>
                            <h6 class="font-weight-medium">IDR {{ $cart->base_total_price_label }}</h6>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div>Discount</div>
                            <div class="fw-bold">IDR {{ $cart->discount_amount_label }}</div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Tax (11%)</h6>
                            <h6 class="font-weight-medium">IDR {{ $cart->tax_amount_label }}</h6>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div>Shipping Fee</div>
                            <div class="fw-bold" id="shipping-fee">IDR 0</div>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2" id="grand-total">
                            <h5>Grand Total</h5>
                            <h5>IDR {{ $cart->grand_total_label }}</h5>
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span
                            class="bg-secondary pr-3">Payment</span></h5>
                    <div class="bg-light p-30">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="paypal">
                                <label class="custom-control-label" for="paypal">Paypal</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="directcheck">
                                <label class="custom-control-label" for="directcheck">Direct Check</label>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="banktransfer">
                                <label class="custom-control-label" for="banktransfer">Bank Transfer</label>
                            </div>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold py-3">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Checkout End -->

    </html>
@endsection