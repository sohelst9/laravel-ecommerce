@extends('layouts.frontend.app')
@section('content-frontend')
        <!--start slider section-->
        <section class="slider-section mb-4">
			<div class="first-slider p-0">

				<div class="banner-slider owl-carousel owl-theme">
                    @foreach ($banners as $banner)
                        <div class="item">
                            <div class="position-relative">
                                <div class="position-absolute top-50 slider-content translate-middle">
                                    <h3 class="h3 fw-bold d-none d-md-block">{{ $banner->subtitle }}</h3>
                                    <h1 class="h1 fw-bold">{{ $banner->title }}</h1>
                                    <p class="fw-bold text-dark d-none d-md-block"><i>Last call for upto <span>{{ $banner->discount }}</span> %</i></p>
                                    <div class=""><a class="btn btn-dark btn-ecomm px-4" href="shop-grid.html">Shop Now</a>
                                    </div>
                                </div>
                                <a href="javascript:;">
                                    <img src="{{ asset('images/banner/' . $banner->banner) }}" class="img-fluid" alt="...">
                                </a>
                            </div>
                        </div>
                    @endforeach
				</div>

			</div>
		</section>
        
        <!--end slider section-->
        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                <!--start information-->
                <section class="py-4">
                    <div class="container">

                        <div class="row row-cols-1 row-cols-lg-3 g-4">
                            <div class="col">
                                <div class="d-flex align-items-center justify-content-center p-3 border">
                                    <div class="fs-1 text-content"><i class='bx bx-taxi'></i>
                                    </div>
                                    <div class="info-box-content ps-3">
                                        <h6 class="mb-0 fw-bold">FREE SHIPPING &amp; RETURN</h6>
                                        <p class="mb-0">Free shipping on all orders over $49</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="d-flex align-items-center justify-content-center p-3 border">
                                    <div class="fs-1 text-content"><i class='bx bx-dollar-circle'></i>
                                    </div>
                                    <div class="info-box-content ps-3">
                                        <h6 class="mb-0 fw-bold">MONEY BACK GUARANTEE</h6>
                                        <p class="mb-0">100% money back guarantee</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="d-flex align-items-center justify-content-center p-3 border">
                                    <div class="fs-1 text-content"><i class='bx bx-support'></i>
                                    </div>
                                    <div class="info-box-content ps-3">
                                        <h6 class="mb-0 fw-bold">ONLINE SUPPORT 24/7</h6>
                                        <p class="mb-0">Awesome Support for 24/7 Days</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </div>
                </section>
                <!--end information-->
                <!--start categories-->
                <section class="py-4">
                    <div class="container">
                        <div class="separator pb-4">
                            <div class="line"></div>
                            <h5 class="mb-0 fw-bold separator-title">Browse Catergory</h5>
                            <div class="line"></div>
                        </div>

                        @php
                            $cate = categories();
                        @endphp
                       
                        <div class="product-grid">
                            <div class="browse-category owl-carousel owl-theme">
                                @foreach ($cate as $category)
                                    @php
                                        $catProductCount = \App\Models\Product::catProductCount($category->id);
                                    @endphp
                                    <div class="item">
                                        <div class="card rounded-0">
                                            <div class="card-body p-0">
                                                <a href="{{ route('category.shop', $category->id) }}">
                                                    <img src="{{ asset('images/category/' . $category->banner) }}" class="img-fluid"
                                                    alt="...">
                                                </a>
                                            </div>
                                            <div class="card-footer text-center bg-transparent border">
                                                <a href="{{ route('category.shop', $category->id) }}">
                                                    <h6 class="mb-0 text-uppercase fw-bold">{{ substr($category->name, 0, 18) . '..' }}</h6>
                                                </a>
                                                <p class="mb-0 font-12 text-uppercase"><span>{{ $catProductCount }}</span> Products</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </section>
                <!--end categories-->
                <!--start Featured product-->
                <section class="py-4">
                    <div class="container">
                        <div class="separator pb-4">
                            <div class="line"></div>
                            <h5 class="mb-0 fw-bold separator-title">FEATURED PRODUCTS</h5>
                            <div class="line"></div>
                        </div>
                        <div class="product-grid">
                            <div
                                class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-4 row-cols-xxl-5 g-3 g-sm-4">
                                @foreach ($products->take(15) as $product)
                                    <div class="col">
                                        <div class="card">
                                            <div class="position-relative overflow-hidden">
                                                <form action="{{ route('cart.insert') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <input type="hidden" name="quntity" value="1">
                                                    @auth('web')
                                                        <div class="add-cart add-carts position-absolute top-0 end-0 mt-3 me-3">
                                                            <button class="" type="submit"><i class='bx bx-cart-add'></i></button>
                                                        </div>
                                                    @else
                                                        <div class="add-cart position-absolute top-0 end-0 mt-3 me-3">
                                                            <a href="{{ route('login') }}"><i class='bx bx-cart-add'></i></a>
                                                        </div>
                                                    @endauth
                                                </form>
                                                {{-- <div class="quick-view position-absolute start-0 bottom-0 end-0">
                                                    <a href="javascript:;" data-bs-toggle="modal"
                                                        data-bs-target="#QuickViewProduct">Quick View</a>
                                                </div> --}}
                                                <div class="quick-view position-absolute start-0 bottom-0 end-0">
                                                    <a href="{{ route('single.Product', $product->id) }}">Details View</a>
                                                </div>
                                                <a href="{{ route('single.Product', $product->id) }}">
                                                    <img src="{{ asset('images/thumbnailImage/' . $product->thumbnailImage) }}" class="img-fluid"
                                                        alt="...">
                                                </a>
                                            </div>
                                            <div class="card-body px-0">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="">
                                                        <p class="mb-1 product-short-name">{{ $product->subcategory->subcategory }}</p>
                                                        <a href="{{ route('single.Product', $product->id) }}">
                                                            <h6 class="mb-0 fw-bold product-short-title">{{ substr($product->productName, 0, 20) . '...' }}</h6>
                                                        </a>
                                                    </div>
                                                    <div class="icon-wishlist">
                                                        <a href="javascript:;"><i class="bx bx-heart"></i></a>
                                                    </div>
                                                </div>
                                                <div class="cursor-pointer rating mt-2">
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                    <i class="bx bxs-star text-warning"></i>
                                                </div>
                                                <div
                                                    class="product-price d-flex align-items-center justify-content-start gap-2 mt-2">
                                                    <div
                                                        class="h6 fw-light fw-bold text-secondary text-decoration-line-through">
                                                        &#2547;{{ $product->productPrice }}</div>
                                                    <div class="h6 fw-bold">&#2547;{{ $product->after_discount }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <!--end row-->

                        </div>
                    </div>
                </section>
                <!--end Featured product-->
                <!--start New Arrivals-->
                <section class="py-4">
                    <div class="container">
                        <div class="separator pb-4">
                            <div class="line"></div>
                            <h5 class="mb-0 fw-bold separator-title">New Arrivals</h5>
                            <div class="line"></div>
                        </div>
                        <div class="product-grid">
                            <div class="new-arrivals owl-carousel owl-theme position-relative">
                                @foreach ($latest_products->take(20) as $latest_product)
                                <div class="item">
                                    <div class="card">
                                        <div class="position-relative overflow-hidden">
                                            <form action="{{ route('cart.insert') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $latest_product->id }}">
                                                <input type="hidden" name="quntity" value="1">
                                                @auth('web')
                                                    <div class="add-cart add-carts position-absolute top-0 end-0 mt-3 me-3">
                                                        <button class="" type="submit"><i class='bx bx-cart-add'></i></button>
                                                    </div>
                                                @else
                                                    <div class="add-cart position-absolute top-0 end-0 mt-3 me-3">
                                                        <a href="{{ route('login') }}"><i class='bx bx-cart-add'></i></a>
                                                    </div>
                                                @endauth
                                            </form>
                                            <div class="quick-view position-absolute start-0 bottom-0 end-0">
                                                <a href="javascript:;" data-bs-toggle="modal"
                                                    data-bs-target="#QuickViewProduct">Quick View</a>
                                            </div>
                                            <a href="{{ route('single.Product', $latest_product->id) }}">
                                                <img src="{{ asset('images/thumbnailImage/' . $latest_product->thumbnailImage) }}" class="img-fluid"
                                                    alt="...">
                                            </a>
                                        </div>
                                        <div class="card-body px-0">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="">
                                                    <p class="mb-1 product-short-name">{{ $latest_product->category->name }}</p>
                                                    <a href="{{ route('single.Product', $latest_product->id) }}">
                                                        <h6 class="mb-0 fw-bold product-short-title">{{ substr($latest_product->productName, 0, 20) }} </h6>
                                                    </a>
                                                </div>
                                                <div class="icon-wishlist">
                                                    <a href="javascript:;"><i class="bx bx-heart"></i></a>
                                                </div>
                                            </div>
                                            <div class="cursor-pointer rating mt-2">
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                                <i class="bx bxs-star text-warning"></i>
                                            </div>
                                            <div
                                                class="product-price d-flex align-items-center justify-content-start gap-2 mt-2">
                                                <div
                                                    class="h6 fw-light fw-bold text-secondary text-decoration-line-through">
                                                    &#2547;{{ $latest_product->productPrice }}</div>
                                                <div class="h6 fw-bold">&#2547;{{ $latest_product->after_discount }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
                <!--end New Arrivals-->
               
                <!--start support info-->
                <section class="py-5 bg-light">
                    <div class="container">
                        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-4">
                            <div class="col">
                                <div class="text-center border p-3 bg-white">
                                    <div class="font-50 text-dark"><i class='bx bx-cart-add'></i>
                                    </div>
                                    <h5 class="fs-5 text-uppercase mb-0 fw-bold">Free delivery</h5>
                                    <p class="text-capitalize">Free delivery over $199</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum
                                        magna, et dapib.</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-center border p-3 bg-white">
                                    <div class="font-50 text-dark"><i class='bx bx-credit-card'></i>
                                    </div>
                                    <h5 class="fs-5 text-uppercase mb-0 fw-bold">Secure payment</h5>
                                    <p class="text-capitalize">We possess SSL / Secure сertificate</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum
                                        magna, et dapib.</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-center border p-3 bg-white">
                                    <div class="font-50 text-dark"> <i class='bx bx-dollar-circle'></i>
                                    </div>
                                    <h5 class="fs-5 text-uppercase mb-0 fw-bold">Free returns</h5>
                                    <p class="text-capitalize">We return money within 30 days</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum
                                        magna, et dapib.</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-center border p-3 bg-white">
                                    <div class="font-50 text-dark"> <i class='bx bx-support'></i>
                                    </div>
                                    <h5 class="fs-5 text-uppercase mb-0 fw-bold">Customer Support</h5>
                                    <p class="text-capitalize">Friendly 24/7 customer support</p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum
                                        magna, et dapib.</p>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </div>
                </section>
                <!--end support info-->

                <!--start brands-->
                <section class="py-4">
                    <div class="container">
                        <h3 class="d-none">Brands</h3>
                        <div class="brand-grid">
                            <div class="brands-shops owl-carousel owl-theme border">

                                @foreach ($brands as $brand)
                                <div class="item border-end">
                                    <div class="p-4">
                                        <a href="javascript:;">
                                            <img src="{{ asset('images/brand/' . $brand->logo) }}" class="img-fluid"
                                                alt="...">
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
                <!--end brands-->
            </div>
        </div>
        <!--end page wrapper -->


        <!--start quick view product-->
        <!-- Modal -->
        {{-- <div class="modal fade" id="QuickViewProduct">
            <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-xl-down">
                <div class="modal-content rounded-0 border-0">
                    <div class="modal-body">
                        <button type="button" class="btn-close float-end" data-bs-dismiss="modal"></button>
                        <div class="row g-0">
                            <div class="col-12 col-lg-6">
                                <div class="image-zoom-section">
                                    <div class="product-gallery owl-carousel owl-theme border mb-3 p-3"
                                        data-slider-id="1">
                                        <div class="item">
                                            <img src="{{ asset('frontend/new_asset/images/product-gallery/01.png')}}" class="img-fluid"
                                                alt="">
                                        </div>
                                    </div>
                                    <div class="owl-thumbs d-flex justify-content-center" data-slider-id="1">
                                        <button class="owl-thumb-item">
                                            <img src="{{ asset('frontend/new_asset/images/product-gallery/02.png')}}" class=""
                                                alt="">
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="product-info-section p-3">
                                    <h3 class="mt-3 mt-lg-0 mb-0">Allen Solly Men's Polo T-Shirt</h3>
                                    <div class="product-rating d-flex align-items-center mt-2">
                                        <div class="rates cursor-pointer font-13"> <i
                                                class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                            <i class="bx bxs-star text-warning"></i>
                                        </div>
                                        <div class="ms-1">
                                            <p class="mb-0">(24 Ratings)</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mt-3 gap-2">
                                        <h5 class="mb-0 text-decoration-line-through text-light-3">$98.00</h5>
                                        <h4 class="mb-0">$49.00</h4>
                                    </div>
                                    <div class="mt-3">
                                        <h6>Discription :</h6>
                                        <p class="mb-0">Virgil Abloh’s Off-White is a streetwear-inspired collection
                                            that continues to break away from the conventions of mainstream fashion.
                                            Made in Italy, these black and brown Odsy-1000 low-top sneakers.</p>
                                    </div>
                                    <dl class="row mt-3">
                                        <dt class="col-sm-3">Product id</dt>
                                        <dd class="col-sm-9">#BHU5879</dd>
                                        <dt class="col-sm-3">Delivery</dt>
                                        <dd class="col-sm-9">Russia, USA, and Europe</dd>
                                    </dl>
                                    <div class="row row-cols-auto align-items-center mt-3">
                                        <div class="col">
                                            <label class="form-label">Quantity</label>
                                            <select class="form-select form-select-sm">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Size</label>
                                            <select class="form-select form-select-sm">
                                                <option>S</option>
                                                <option>M</option>
                                                <option>L</option>
                                                <option>XS</option>
                                                <option>XL</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label class="form-label">Colors</label>
                                            <div class="color-indigators d-flex align-items-center gap-2">
                                                <div class="color-indigator-item bg-primary"></div>
                                                <div class="color-indigator-item bg-danger"></div>
                                                <div class="color-indigator-item bg-success"></div>
                                                <div class="color-indigator-item bg-warning"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end row-->
                                    <div class="d-flex gap-2 mt-3">
                                        <a href="javascript:;" class="btn btn-dark btn-ecomm"> <i
                                                class="bx bxs-cart-add"></i>Add to Cart</a> <a href="javascript:;"
                                            class="btn btn-light btn-ecomm"><i class="bx bx-heart"></i>Add to
                                            Wishlist</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </div>
                </div>
            </div>
        </div> --}}
        <!--end quick view product-->
@endsection
