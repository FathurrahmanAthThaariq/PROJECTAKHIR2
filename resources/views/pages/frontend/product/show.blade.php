@extends('layouts.frontend.master')
@section('content')
    <!-- breadcrumb area start -->
    <section class="breadcrumb__area breadcrumb__style-2 include-bg pt-50 pb-20">
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="breadcrumb__content p-relative z-index-1">
                        <div class="breadcrumb__list has-icon">
                            <span class="breadcrumb-icon">
                                <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M1.42393 16H15.5759C15.6884 16 15.7962 15.9584 15.8758 15.8844C15.9553 15.8104 16 15.71 16 15.6054V6.29143C16 6.22989 15.9846 6.1692 15.9549 6.11422C15.9252 6.05923 15.8821 6.01147 15.829 5.97475L8.75305 1.07803C8.67992 1.02736 8.59118 1 8.5 1C8.40882 1 8.32008 1.02736 8.24695 1.07803L1.17098 5.97587C1.11791 6.01259 1.0748 6.06035 1.04511 6.11534C1.01543 6.17033 0.999976 6.23101 1 6.29255V15.6063C1.00027 15.7108 1.04504 15.8109 1.12451 15.8847C1.20398 15.9585 1.31165 16 1.42393 16ZM10.1464 15.2107H6.85241V10.6202H10.1464V15.2107ZM1.84866 6.48977L8.4999 1.88561L15.1517 6.48977V15.2107H10.9946V10.2256C10.9946 10.1209 10.95 10.0206 10.8704 9.94654C10.7909 9.87254 10.683 9.83096 10.5705 9.83096H6.42848C6.316 9.83096 6.20812 9.87254 6.12858 9.94654C6.04904 10.0206 6.00435 10.1209 6.00435 10.2256V15.2107H1.84806L1.84866 6.48977Z"
                                        fill="#55585B" stroke="#55585B" stroke-width="0.5" />
                                </svg>
                            </span>
                            <span><a href="#">Home</a></span>
                            <span><a href="#">Electronics</a></span>
                            <span><a href="#">{{ $product->category->name }}</a></span>
                            <span>{{ $product->name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb area end -->

    <!-- product details area start -->
    <section class="tp-product-details-area">
        <div class="tp-product-details-top pb-115">
            <div class="container">
                <div class="row">
                    <div class="col-xl-7 col-lg-6">
                        <div class="tp-product-details-thumb-wrapper tp-tab d-sm-flex">
                            <div class="tp-product-details-nav-main-thumb">
                                <img src="{{ asset('images/products/' . $product->image) }}" alt="" width="500"
                                    height="500">
                            </div>

                        </div>
                    </div> <!-- col end -->
                    <div class="col-xl-5 col-lg-6">
                        <div class="tp-product-details-wrapper">
                            <div class="tp-product-details-category">
                                <span>{{ $product->category_name }}</span>
                            </div>
                            <h3 class="tp-product-details-title">{{ $product->name }}</h3>

                            <!-- inventory details -->
                            <div class="tp-product-details-inventory d-flex align-items-center mb-10">
                                <div class="tp-product-details-stock mb-10">
                                    <span>{{ $product->quantity }} in stock</span>
                                </div>
                                <div class="tp-product-details-rating-wrapper d-flex align-items-center mb-10">
                                    <div class="tp-product-details-rating">
                                        <span><i class="fa-solid fa-star"></i></span>
                                        <span><i class="fa-solid fa-star"></i></span>
                                        <span><i class="fa-solid fa-star"></i></span>
                                        <span><i class="fa-solid fa-star"></i></span>
                                        <span><i class="fa-solid fa-star"></i></span>
                                    </div>
                                    <div class="tp-product-details-reviews">
                                        <span>(36 Reviews)</span>
                                    </div>
                                </div>
                            </div>

                            <!-- price -->
                            <div class="tp-product-details-price-wrapper mb-20">
                                <span class="tp-product-details-price new-price">Rp.
                                    {{ number_format($product->price, 0, ',', '.') }}</span>
                            </div>

                            <!-- actions -->
                            <div class="tp-product-details-action-wrapper">
                                <h3 class="tp-product-details-action-title">Quantity</h3>
                                <div class="tp-product-details-action-item-wrapper d-flex align-items-center">
                                    <div class="tp-product-details-quantity">
                                        <div class="tp-product-quantity mb-15 mr-15">
                                            <span class="tp-cart-minus">
                                                <svg width="11" height="2" viewBox="0 0 11 2" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1 1H10" stroke="currentColor" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </span>
                                            <input class="tp-cart-input" type="text" value="1" id="quantity"
                                                name="quantity" />
                                            <span class="tp-cart-plus">
                                                <svg width="11" height="12" viewBox="0 0 11 12" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1 6H10" stroke="currentColor" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M5.5 10.5V1.5" stroke="currentColor" stroke-width="1.5"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="tp-product-details-add-to-cart mb-15 w-100">
                                        <button class="tp-product-details-add-to-cart-btn w-100"
                                            onclick="addToCart({{ $product->id }})"><i class="fa-solid fa-cart-plus"></i>
                                            Add To Cart</button>
                                    </div>
                                </div>
                                <button class="tp-product-details-buy-now-btn w-100">Buy Now</button>
                            </div>
                            <div class="tp-product-details-query">
                                <div class="tp-product-details-query-item d-flex align-items-center">
                                    <span>Category: </span>
                                    <p>{{ $product->category->name }}</p>
                                </div>
                            </div>
                            <div class="tp-product-details-social">
                                <span>Share: </span>
                                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                                <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                                <a href="#"><i class="fa-brands fa-vimeo-v"></i></a>
                            </div>
                            <div class="tp-product-details-msg mb-15">
                                <ul>
                                    <li>30 days easy returns</li>
                                    <li>Order yours before 2.30pm for same day dispatch</li>
                                </ul>
                            </div>
                            <div
                                class="tp-product-details-payment d-flex align-items-center flex-wrap justify-content-between">
                                <p>Guaranteed safe <br> & secure checkout</p>
                                <img src="frontend/img/product/icons/payment-option.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tp-product-details-bottom pb-140">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="tp-product-details-tab-nav tp-tab">
                            <nav>
                                <div class="nav nav-tabs justify-content-center p-relative tp-product-tab"
                                    id="navPresentationTab" role="tablist">
                                    <button class="nav-link" id="nav-description-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-description" type="button" role="tab"
                                        aria-controls="nav-description" aria-selected="true">Description</button>
                                    <button class="nav-link active" id="nav-addInfo-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-addInfo" type="button" role="tab"
                                        aria-controls="nav-addInfo" aria-selected="false">Additional
                                        information</button>
                                    <button class="nav-link" id="nav-review-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-review" type="button" role="tab"
                                        aria-controls="nav-review" aria-selected="false">Reviews (2)</button>

                                    <span id="productTabMarker" class="tp-product-details-tab-line"></span>
                                </div>
                            </nav>
                            <div class="tab-content" id="navPresentationTabContent">
                                <div class="tab-pane fade" id="nav-description" role="tabpanel"
                                    aria-labelledby="nav-description-tab" tabindex="0">
                                    <div class="tp-product-details-desc-wrapper pt-80">
                                        <div class="row justify-content-center">
                                            <div class="col-xl-10">
                                                <div class="tp-product-details-desc-item pb-105">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            {!! $product->description !!}
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="tp-product-details-desc-thumb">
                                                                <img src="frontend/img/product/details/desc/product-details-desc-1.jpg"
                                                                    alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tp-product-details-desc-item  pb-75">
                                                    <div class="row">

                                                        <div class="col-lg-7">
                                                            <div class="tp-product-details-desc-thumb">
                                                                <img src="frontend/img/product/details/desc/product-details-desc-2.jpg"
                                                                    alt="">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-5 order-first order-lg-last">
                                                            <div
                                                                class="tp-product-details-desc-content des-content-2 pl-40">
                                                                <h3 class="tp-product-details-desc-title">Carry with
                                                                    <br> Confidence and style
                                                                </h3>
                                                                <p>Wrap your tablet in a sleek case that's as stylish as
                                                                    it is convenient. Galaxy Tab S6 Lite Book Cover
                                                                    folds around and clings magnetically, so you can
                                                                    easily gear up as you're headed out the door.
                                                                    There's even a compartment for S pen, so you can be
                                                                    sure it doesn't get left behind.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tp-product-details-desc-item">
                                                    <div class="row">
                                                        <div class="col-xl-12">
                                                            <div class="tp-product-details-desc-banner text-center m-img">
                                                                <h3
                                                                    class="tp-product-details-desc-banner-title tp-product-details-desc-title">
                                                                    Speed Memory Power = Epic Races</h3>
                                                                <img src="frontend/img/product/details/desc/product-details-desc-3.jpg"
                                                                    alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade show active" id="nav-addInfo" role="tabpanel"
                                    aria-labelledby="nav-addInfo-tab" tabindex="0">

                                    <div class="tp-product-details-additional-info ">
                                        <div class="row justify-content-center">
                                            <div class="col-xl-10">
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                            <td>Standing screen display size</td>
                                                            <td>Screen display Size 10.4</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Color</td>
                                                            <td>Gray, Dark gray, Mystic black</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Screen Resolution</td>
                                                            <td>1920 x 1200 Pixels</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Max Screen Resolution</td>
                                                            <td>2000 x 1200</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Processor</td>
                                                            <td>2.3 GHz (128 GB)</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Graphics Coprocessor</td>
                                                            <td>Exynos 9611, Octa Core (4x2.3GHz + 4x1.7GHz)</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Wireless Type</td>
                                                            <td>802.11a/b/g/n/ac, Bluetooth</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Average Battery Life (in hours)</td>
                                                            <td>13 Hours</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Series</td>
                                                            <td>Samsung Galaxy tab S6 Lite WiFi</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Item model number</td>
                                                            <td>SM-P6102ZAEXOR</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Hardware Platform</td>
                                                            <td>Android</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Operating System</td>
                                                            <td>Android 12</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Batteries</td>
                                                            <td>1 Lithium Polymer batteries required. (included)</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Product Dimensions</td>
                                                            <td>0.28 x 6.07 x 9.63 inches</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-review" role="tabpanel"
                                    aria-labelledby="nav-review-tab" tabindex="0">
                                    <div class="tp-product-details-review-wrapper pt-60">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="tp-product-details-review-statics">
                                                    <!-- number -->
                                                    <div class="tp-product-details-review-number d-inline-block mb-50">
                                                        <h3 class="tp-product-details-review-number-title">Customer
                                                            reviews</h3>
                                                        <div
                                                            class="tp-product-details-review-summery d-flex align-items-center">
                                                            <div class="tp-product-details-review-summery-value">
                                                                <span>4.5</span>
                                                            </div>
                                                            <div
                                                                class="tp-product-details-review-summery-rating d-flex align-items-center">
                                                                <span><i class="fa-solid fa-star"></i></span>
                                                                <span><i class="fa-solid fa-star"></i></span>
                                                                <span><i class="fa-solid fa-star"></i></span>
                                                                <span><i class="fa-solid fa-star"></i></span>
                                                                <span><i class="fa-solid fa-star"></i></span>
                                                                <p>(36 Reviews)</p>
                                                            </div>
                                                        </div>
                                                        <div class="tp-product-details-review-rating-list">
                                                            <!-- single item -->
                                                            <div
                                                                class="tp-product-details-review-rating-item d-flex align-items-center">
                                                                <span>5 Start</span>
                                                                <div class="tp-product-details-review-rating-bar">
                                                                    <span
                                                                        class="tp-product-details-review-rating-bar-inner"
                                                                        data-width="82%"></span>
                                                                </div>
                                                                <div class="tp-product-details-review-rating-percent">
                                                                    <span>82%</span>
                                                                </div>
                                                            </div> <!-- end single item -->

                                                            <!-- single item -->
                                                            <div
                                                                class="tp-product-details-review-rating-item d-flex align-items-center">
                                                                <span>4 Start</span>
                                                                <div class="tp-product-details-review-rating-bar">
                                                                    <span
                                                                        class="tp-product-details-review-rating-bar-inner"
                                                                        data-width="30%"></span>
                                                                </div>
                                                                <div class="tp-product-details-review-rating-percent">
                                                                    <span>30%</span>
                                                                </div>
                                                            </div> <!-- end single item -->

                                                            <!-- single item -->
                                                            <div
                                                                class="tp-product-details-review-rating-item d-flex align-items-center">
                                                                <span>3 Start</span>
                                                                <div class="tp-product-details-review-rating-bar">
                                                                    <span
                                                                        class="tp-product-details-review-rating-bar-inner"
                                                                        data-width="15%"></span>
                                                                </div>
                                                                <div class="tp-product-details-review-rating-percent">
                                                                    <span>15%</span>
                                                                </div>
                                                            </div> <!-- end single item -->

                                                            <!-- single item -->
                                                            <div
                                                                class="tp-product-details-review-rating-item d-flex align-items-center">
                                                                <span>2 Start</span>
                                                                <div class="tp-product-details-review-rating-bar">
                                                                    <span
                                                                        class="tp-product-details-review-rating-bar-inner"
                                                                        data-width="6%"></span>
                                                                </div>
                                                                <div class="tp-product-details-review-rating-percent">
                                                                    <span>6%</span>
                                                                </div>
                                                            </div> <!-- end single item -->

                                                            <!-- single item -->
                                                            <div
                                                                class="tp-product-details-review-rating-item d-flex align-items-center">
                                                                <span>1 Start</span>
                                                                <div class="tp-product-details-review-rating-bar">
                                                                    <span
                                                                        class="tp-product-details-review-rating-bar-inner"
                                                                        data-width="10%"></span>
                                                                </div>
                                                                <div class="tp-product-details-review-rating-percent">
                                                                    <span>10%</span>
                                                                </div>
                                                            </div> <!-- end single item -->
                                                        </div>
                                                    </div>

                                                    <!-- reviews -->
                                                    <div class="tp-product-details-review-list pr-110">
                                                        <h3 class="tp-product-details-review-title">Rating & Review
                                                        </h3>
                                                        <div
                                                            class="tp-product-details-review-avater d-flex align-items-start">
                                                            <div class="tp-product-details-review-avater-thumb">
                                                                <a href="#">
                                                                    <img src="frontend/img/users/user-3.jpg"
                                                                        alt="">
                                                                </a>
                                                            </div>
                                                            <div class="tp-product-details-review-avater-content">
                                                                <div
                                                                    class="tp-product-details-review-avater-rating d-flex align-items-center">
                                                                    <span><i class="fa-solid fa-star"></i></span>
                                                                    <span><i class="fa-solid fa-star"></i></span>
                                                                    <span><i class="fa-solid fa-star"></i></span>
                                                                    <span><i class="fa-solid fa-star"></i></span>
                                                                    <span><i class="fa-solid fa-star"></i></span>
                                                                </div>
                                                                <h3 class="tp-product-details-review-avater-title">
                                                                    Eleanor Fant</h3>
                                                                <span class="tp-product-details-review-avater-meta">06
                                                                    March, 2023 </span>

                                                                <div class="tp-product-details-review-avater-comment">
                                                                    <p>Designed very similarly to the nearly double
                                                                        priced Galaxy tab S6, with the only removal
                                                                        being.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="tp-product-details-review-avater d-flex align-items-start">
                                                            <div class="tp-product-details-review-avater-thumb">
                                                                <a href="#">
                                                                    <img src="frontend/img/users/user-2.jpg"
                                                                        alt="">
                                                                </a>
                                                            </div>
                                                            <div class="tp-product-details-review-avater-content">
                                                                <div
                                                                    class="tp-product-details-review-avater-rating d-flex align-items-center">
                                                                    <span><i class="fa-solid fa-star"></i></span>
                                                                    <span><i class="fa-solid fa-star"></i></span>
                                                                    <span><i class="fa-solid fa-star"></i></span>
                                                                    <span><i class="fa-solid fa-star"></i></span>
                                                                    <span><i class="fa-solid fa-star"></i></span>
                                                                </div>
                                                                <h3 class="tp-product-details-review-avater-title">
                                                                    Shahnewaz Sakil</h3>
                                                                <span class="tp-product-details-review-avater-meta">06
                                                                    March, 2023 </span>

                                                                <div class="tp-product-details-review-avater-comment">
                                                                    <p>This review is for the Samsung Tab S6 Lite, 64gb
                                                                        wifi in blue. purchased this product performed.
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->
                                            <div class="col-lg-6">
                                                <div class="tp-product-details-review-form">
                                                    <h3 class="tp-product-details-review-form-title">Review this
                                                        product</h3>
                                                    <p>Your email address will not be published. Required fields are
                                                        marked *</p>
                                                    <form action="#">
                                                        <div
                                                            class="tp-product-details-review-form-rating d-flex align-items-center">
                                                            <p>Your Rating :</p>
                                                            <div
                                                                class="tp-product-details-review-form-rating-icon d-flex align-items-center">
                                                                <span><i class="fa-solid fa-star"></i></span>
                                                                <span><i class="fa-solid fa-star"></i></span>
                                                                <span><i class="fa-solid fa-star"></i></span>
                                                                <span><i class="fa-solid fa-star"></i></span>
                                                                <span><i class="fa-solid fa-star"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="tp-product-details-review-input-wrapper">
                                                            <div class="tp-product-details-review-input-box">
                                                                <div class="tp-product-details-review-input">
                                                                    <textarea id="msg" name="msg" placeholder="Write your review here..."></textarea>
                                                                </div>
                                                                <div class="tp-product-details-review-input-title">
                                                                    <label for="msg">Your Name</label>
                                                                </div>
                                                            </div>
                                                            <div class="tp-product-details-review-input-box">
                                                                <div class="tp-product-details-review-input">
                                                                    <input name="name" id="name" type="text"
                                                                        placeholder="Shahnewaz Sakil">
                                                                </div>
                                                                <div class="tp-product-details-review-input-title">
                                                                    <label for="name">Your Name</label>
                                                                </div>
                                                            </div>
                                                            <div class="tp-product-details-review-input-box">
                                                                <div class="tp-product-details-review-input">
                                                                    <input name="email" id="email" type="email"
                                                                        placeholder="shofy@mail.com">
                                                                </div>
                                                                <div class="tp-product-details-review-input-title">
                                                                    <label for="email">Your Email</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tp-product-details-review-suggetions mb-20">
                                                            <div class="tp-product-details-review-remeber">
                                                                <input id="remeber" type="checkbox">
                                                                <label for="remeber">Save my name, email, and website
                                                                    in this browser for the next time I comment.</label>
                                                            </div>
                                                        </div>
                                                        <div class="tp-product-details-review-btn-wrapper">
                                                            <button class="tp-product-details-review-btn">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product details area end -->
@endsection
