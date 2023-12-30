@extends('layouts.web')
@section('content')
    <!-- Include jQuery 3.6.0 from a CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- ##### Breadcrumb Area Start ##### -->
    <div class="breadcrumb-area">
        <!-- Top Breadcrumb Area -->
        <div class="top-breadcrumb-area bg-img bg-overlay d-flex align-items-center justify-content-center" style="background-image: url('web/img/bg-img/24.jpg');">
            <h2>Cart</h2>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cart</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcrumb Area End ##### -->

    <!-- ##### Cart Area Start ##### -->
    <div class="cart-area section-padding-0-100 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cart-table clearfix">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>Products</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>TOTAL</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($carts as $cart)
                            @if ($cart->plants || $cart->tools)
                                <tr>
                                    <td class="cart_product_img">
                                        @if ($cart->plants)
                                            <a href="{{route('plantDetails',$cart->plants->id)}}"><img src="{{asset($cart->plants->image)}}" alt="Product"></a>
                                        @elseif($cart->tools)
                                            <a class="text-center" href="{{route('toolDetails',$cart->tools->id)}}"><img style="height: 118.52px !important;" src="{{asset($cart->tools->image)}}" alt="Product"></a>
                                        @endif
                                            
                                        @if ($cart->plants)
                                                <h5>{{ $cart->plants->name }}</h5>
                                        @elseif($cart->tools)
                                                <h5>{{ $cart->tools->name }}</h5>
                                        @endif
                                    </td>
                                    <td class="qty">
                                        <div class="quantity"><span class="qty-minus" onclick="
                                            var qtyInput = $('#qty_{{$cart->id}}');
                                            var priceValue = parseInt($('#price_{{$cart->id}}').text());
                                            var totalPrice = parseInt($('#total_price_{{$cart->id}}').text());
                                            var qty = parseInt(qtyInput.val());
                                            
                                            if (!isNaN(qty) && qty > 1) {
                                                var total = totalPrice - priceValue;
                                                $('#total_price_{{$cart->id}}').html(total);
                                                qtyInput.val(qty - 1);
                                            }
                                            return false;"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                    <input type="text" class="qty-text" id="qty_{{$cart->id}}" step="1" min="1" max="99" name="quantity" value="{{$cart->quantity}}">
                                        <span class="qty-plus" onclick="
                                            var qtyInput = $('#qty_{{$cart->id}}');
                                            var priceValue = parseInt($('#price_{{$cart->id}}').text());
                                            var qty = parseInt(qtyInput.val()) + 1 ;
                                            
                                            if (!isNaN(qty)) {
                                                var total = priceValue * qty;
                                                $('#total_price_{{$cart->id}}').html(total);
                                                qtyInput.val(qty);
                                            }
                                            return false;" ><i class="fa fa-plus" aria-hidden="true"></i></span>
                                        </div>
                                    </td>
                                    
                                    <td class="price">$<span id="price_{{$cart->id}}" >{{ $cart->plants ? $cart->plants->price : ($cart->tools ? $cart->tools->price : '') }}</span></td>
                                    <td class="total_price">$<span id="total_price_{{$cart->id}}" >{{$cart->total_amount}}</span></td>
                                    <td class="action"><a href="{{ route('deleteCart', $cart->id) }}" ><i class="icon_close"></i></a></td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">

                <!-- Coupon Discount -->
                <div class="col-12 col-lg-6">
                    <div class="coupon-discount mt-70">
                        <h5>COUPON DISCOUNT</h5>
                        <p>Coupons can be applied in the cart prior to checkout. Add an eligible item from the booth of the seller that created the coupon code to your cart. Click the green "Apply code" button to add the coupon to your order. The order total will update to indicate the savings specific to the coupon code entered.</p>
                        <form action="#" method="post">
                            <input type="text" name="coupon-code" placeholder="Enter your coupon code">
                            <button type="submit">APPLY COUPON</button>
                        </form>
                    </div>
                </div>

                <!-- Cart Totals -->
                <div class="col-12 col-lg-6">
                    <div class="cart-totals-area mt-70">
                        <h5 class="title--">Cart Total</h5>
                        <div class="subtotal d-flex justify-content-between">
                            <h5>Subtotal</h5>
                            <h5>$9.99</h5>
                        </div>
                        <div class="shipping d-flex justify-content-between">
                            <h5>Shipping</h5>
                            <div class="shipping-address">
                                <form action="#" method="post">
                                    <select class="custom-select">
                                      <option selected>Country</option>
                                      <option value="1">USA</option>
                                      <option value="2">Latvia</option>
                                      <option value="3">Japan</option>
                                      <option value="4">Bangladesh</option>
                                    </select>
                                    <input type="text" name="shipping-text" id="shipping-text" placeholder="State">
                                    <input type="text" name="shipping-zip" id="shipping-zip" placeholder="ZIP">
                                    <button type="submit">Update Total</button>
                                </form>
                            </div>
                        </div>
                        <div class="total d-flex justify-content-between">
                            <h5>Total</h5>
                            <h5>$9.99</h5>
                        </div>
                        <div class="checkout-btn">
                            <a href="#" class="btn alazea-btn w-100">PROCEED TO CHECKOUT</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- ##### Cart Area End ##### -->
    <script>
                                        $(document).ready(function(){

                                            $('.qty-plus').click(function(){
                                                
                                            })

                                            $('.qty-minus').click(function(){
                                                
                                            })


                                        })
                                    </script>
@endsection