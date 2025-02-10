@extends('themes.publik.layouts.app')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Product List</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">


            <!-- Shop Product Start -->
            <div class="col-lg-12 ">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                                <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    {!! html()->select('sorting', $sortingOptions, $sortingQuery)->class(['form-select'])->attribute('onchange', 'this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);')!!}
  
                                </div>
                            </div>
                        </div>
                    </div>

                    @forelse ( $products as $product )
                    
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <a href="{{shop_product_link($product)}}"></a>
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="https://placehold.co/600x800" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href="{{shop_product_link($product)}}"><i
                                            class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="far fa-heart"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="{{shop_product_link($product)}}">{{$product->name}}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>IDR {{$product->price_label}}</h5>
                                    <h6 class="text-muted ml-2"><del>{{$product->discountPercent}}</del></h6>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small>(99)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                        
                    @endforelse
                    







                    <div class="col-12">
                        <nav>
                            <ul class="pagination justify-content-center">

                                {{-- pagination --}}
                                {!! $products->links() !!}
                            </ul>
                        </nav>

                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->

    </html>
@endsection
