@extends('layouts.web')

@section('content')
@if($errors->get('toolReview'))
        <input id="toolReviewError" type="hidden" value="{{$errors}}" >
        <!-- Modal -->
                        <div class="modal fade" id="toolReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Validation Error</h5>
                                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button> -->
                                </div>
                                <div class="modal-body">
                                @foreach($errors->get('toolReview') as $error)
                                    <div class="text-danger" >{{ $error }}</div>
                                @endforeach
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn alazea-btn ml-15" data-dismiss="modal">Close</button>
                                </div>
                                </div>
                            </div>
                        </div>
                <script>
                    $(document).ready(function(){
                        $('#toolReviewError').val(function(){
                            $('#toolReviewModal').modal('show');
                        })
                    })
                </script>
@endif
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- ##### Breadcrumb Area Start ##### -->
    <div class="breadcrumb-area">
        <!-- Top Breadcrumb Area -->
        <div class="top-breadcrumb-area bg-img bg-overlay d-flex align-items-center justify-content-center" style="background-image: url({{asset('web/img/bg-img/24.jpg')}})">
            <h2>TOOL DETAILS</h2>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('shop.tools') }}">Tool & Accessories</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tool Details</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcrumb Area End ##### -->

    <!-- ##### Single Product Details Area Start ##### -->
    
    <section class="single_product_details_area mb-50">
    <form method="post" action="{{ route('toolToCart') }}">
        @csrf
        <div class="produts-details--content mb-50">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-12 col-md-6 col-lg-5">
                        <div class="single_product_thumb">
                            <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div style="height:350px;" class="carousel-item active">
                                        <!-- <a class="product-img" href="img/bg-img/49.jpg" title="Product Image"> -->
                                            <input name="tool_id" type="hidden" value="{{$tool->id}}" >
                                            <input name="amount" type="hidden" value="{{$tool->price}}" >
                                        <img style="object-fit:contain;width:100%;height:100%" class="d-block product_img" src="{{asset($tool->image)}}" alt="1">
                                    </a>
                                    </div>
                                    <!-- <div class="carousel-item">
                                        <a class="product-img" href="img/bg-img/49.jpg" title="Product Image">
                                        <img class="d-block w-100" src="{{asset('web/img/bg-img/49.jpg')}}" alt="1">
                                    </a>
                                    </div>
                                    <div class="carousel-item">
                                        <a class="product-img" href="img/bg-img/49.jpg" title="Product Image">
                                        <img class="d-block w-100" src="{{asset('web/img/bg-img/49.jpg')}}" alt="1">
                                    </a>
                                    </div> -->
                                </div>
                                <!-- <ol class="carousel-indicators">
                                    <li class="active" data-target="#product_details_slider" data-slide-to="0" style="background-image: url('web/img/bg-img/49.jpg');">
                                    </li>
                                    <li data-target="#product_details_slider" data-slide-to="1" style="background-image: url('web/img/bg-img/49.jpg');">
                                    </li>
                                    <li data-target="#product_details_slider" data-slide-to="2" style="background-image: url('web/img/bg-img/49.jpg');">
                                    </li>
                                </ol> -->
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="single_product_desc">
                            <h4  class="title">{{$tool->name}}</h4>
                            <h4 class="price"><span >$ </span>{{$tool->price}}</h4>
                            <div class="short_overview">
                                <p>{{$tool->description}}</p>
                            </div>

                            <div class="cart--area d-flex flex-wrap align-items-center">
                                <!-- Add to Cart Form -->
                                <section class="cart clearfix d-flex align-items-center"  >
                                    <div class="quantity">
                                    <span class="qty-minus"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                        <input readonly type="text" class="qty-text" id="qty" step="1" min="1" max="12" name="quantity" value="1">
                                        <span class="qty-plus" ><i class="fa fa-plus" aria-hidden="true"></i></span>
                                    </div>
                                    <button type="submit" name="addtocart" value="5" class="btn addtocart alazea-btn ml-15">Add to cart</button>
                                </section>
                                <!-- Wishlist & Compare -->
                                <div class="wishlist-compare d-flex flex-wrap align-items-center">
                                    <a href="#" class="wishlist-btn ml-15"><i class="icon_heart_alt"></i></a>
                                    <a href="#" class="compare-btn ml-15"><i class="arrow_left-right_alt"></i></a>
                                </div>
                            </div>

                            <div class="products--meta">
                                <!-- <p><span>SKU:</span> <span>CT201807</span></p> -->
                                <p><span>Category:</span><span>{{$tool->categories->categories}}</span></p>
                                <p><span>Tags:</span> <span>Tools </span></p>
                                <p>
                                    <span>Share on:</span>
                                    <span>
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                </span>
                                </p>
                            </div>
                            <script>
                                $(document).ready(function(){

$('.qty-plus').click(function(){
    var effect = document.getElementById('qty');
    var qty = parseInt(effect.value) + 1;
      if( !isNaN( qty )){ 
        // localStorage.setItem('quantity',qty);
        effect.value++;
    }
    return false;
})

$('.qty-minus').click(function(){
    var effect = document.getElementById('qty');
    var qty = parseInt(effect.value);
        if (!isNaN(qty) && qty > 1) {
            // localStorage.setItem('quantity',qty-1);
            effect.value--;
        }
        return false;
})

$('.qty-minus').click(function(){
    var effect = document.getElementById('qty');
    var qty = parseInt(effect.value);
        if (!isNaN(qty) && qty > 1) {
            localStorage.setItem('quantity',qty-1);
            effect.value--;
        }
        return false;
})

// $('.addtocart').click(function(){
//     var image_url = $('.product_img').attr('src');
//     var shopName = $('.title').text();
//     var price = parseInt($('.price').text());
//     alert(price);
// })

})
                            </script>

                        </div>
                    </div>
                 
                </div>
            </div>
        </div>
        </form>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product_details_tab clearfix">
                        <!-- Tabs -->
                        <ul class="nav nav-tabs" role="tablist" id="product-details-tab">
                            <li class="nav-item">
                                <a href="#description" class="nav-link active" data-toggle="tab" role="tab">Description</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a href="#addi-info" class="nav-link" data-toggle="tab" role="tab">Additional Information</a>
                            </li> -->
                            <li class="nav-item">
                                <a href="#reviews" class="nav-link" data-toggle="tab" role="tab">Reviews <span class="text-muted">({{$reviews_count}})</span></a>
                            </li>
                        </ul>
                        <!-- Tab Content -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="description">
                                <div class="description_area">
                                    <p>{{$tool->description}}</p>
                                    <!-- <p>Interdum et malesuada fames ac ante ipsum primis in faucibus. In scelerisque augue at the moment mattis. Proin vitae arcu sit amet justo sollicitudin tincidunt sit amet ut velit.Proin placerat vel augue eget euismod. Phasellus cursus orci eu tellus vestibulum, vestibulum urna accumsan. Vestibulum ut ullamcorper sapien. Pellentesque molestie, est ac vestibulum eleifend, lorem ipsum mollis ipsum.</p> -->
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="addi-info">
                                <div class="additional_info_area">
                                    <p>What should I do if I receive a damaged parcel?
                                        <br> <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit impedit similique qui, itaque delectus labore.</span></p>
                                    <p>I have received my order but the wrong item was delivered to me.
                                        <br> <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis quam voluptatum beatae harum tempore, ab?</span></p>
                                    <p>Product Receipt and Acceptance Confirmation Process
                                        <br> <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum ducimus, temporibus soluta impedit minus rerum?</span></p>
                                    <p>How do I cancel my order?
                                        <br> <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum eius eum, minima!</span></p>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="reviews">
                                <div class="reviews_area">
                                    <ul>
                                        <li>
                                        @forelse($recent_reviews as $review )
                                            
                                            <div class="single_user_review mb-15">
                                                <h6>Latest Reviews</h6>
                                                    <div class="review-rating">
                                                <?php
                                                    for($i=1;$i<=$review->rating;$i++){
                                            
                                                ?>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                <?php
                                                    }      
                                                ?>
                                                    
                                                    
                                                </div>
                                                <div class="review-details">
                                                    <p class="m-0">by <a href="#"> {{$review->name}} </a> on <span> {{$review->posted_date}} </span></p>
                                                </div>
                                                <span>{{$review->comments}}</span>
                                                
                                            </div>
                                            <hr>
                                        @empty
                                                <h6>No Reviews Yet !</h6>
                                                <hr>
                                     @endforelse
                                        </li>
                                    </ul>
                                </div>

                                <div class="submit_a_review_area mt-50">
                                    <h4>Submit A Review</h4>
                                    <form action="{{route('toolReviews')}}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group d-flex align-items-center">
                                                    <span class="mr-15">Your Ratings:</span>
                                                    <div class="stars">
                                                    <input name="tool_id" type="hidden" value="{{$tool->id}}" >
                                                        <input type="radio" name="rating" value="1"  class="star-1" id="star-1">
                                                        <label class="star-1" for="star-1">1</label>
                                                        <input type="radio" name="rating" value="2"  class="star-2" id="star-2">
                                                        <label class="star-2" for="star-2">2</label>
                                                        <input type="radio" name="rating" value="3" class="star-3" id="star-3">
                                                        <label class="star-3" for="star-3">3</label>
                                                        <input type="radio" name="rating" value="4"  class="star-4" id="star-4">
                                                        <label class="star-4" for="star-4">4</label>
                                                        <input type="radio" name="rating" value="5" class="star-5" id="star-5">
                                                        <label  class="star-5" for="star-5">5</label>
                                                        <span></span>
                                                        
                                                    </div>
                                                    @if ($errors->has('rating'))
                                                            <div class="text-danger ">{{ $errors->first('rating') }}</div>
                                                        @endif
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Nickname</label>
                                                    <input type="text" name="name" class="form-control" id="name" placeholder="Name">
                                                        @if ($errors->has('name'))
                                                            <div class="text-danger ">{{ $errors->first('name') }}</div>
                                                        @endif
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                                                    @if ($errors->has('email'))
                                                            <div class="text-danger ">{{ $errors->first('email') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="comments">Comments</label>
                                                    <textarea class="form-control" name="comments" id="comments" rows="5" data-max-length="150"></textarea>
                                                    @if ($errors->has('comments'))
                                                            <div class="text-danger ">{{ $errors->first('comments') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn alazea-btn">Submit Your Review</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- ##### Single Product Details Area End ##### -->

    <!-- ##### Related Product Area Start ##### -->
    <div class="related-products-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Section Heading -->
                    <div class="section-heading text-center">
                        <h2>Related Products</h2>
                    </div>
                </div>
            </div>

            <div class="row">

                
            @foreach($recent as $recent_tools)
                <!-- Single Product Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single-product-area mb-100">
                        <!-- Product Image -->
                        <div class="product-img">
                            <a href="shop-details.html"><img style="height:300px" src="{{asset($recent_tools->image)}}" alt=""></a>
                            <!-- Product Tag -->
                            <div class="product-tag sale-tag">
                                <a href="#">Hot</a>
                            </div>
                            <div class="product-meta d-flex">
                                <a href="#" class="wishlist-btn"><i class="icon_heart_alt"></i></a>
                                <a class="add-to-cart-btn">{{$recent_tools->name}}</a>
                                <a href="#" class="compare-btn"><i class="arrow_left-right_alt"></i></a>
                            </div>
                        </div>
                        <!-- Product Info -->
                        <div class="product-info mt-15 text-center">
                            <a href="{{route('toolDetails',$recent_tools->id)}}">
                                <p>ADD TO CART</p>
                            </a>
                            <h6>{{$recent_tools->price}}</h6>
                        </div>
                    </div>
                </div>
            @endforeach



            </div>
        </div>
    </div>
    <!-- ##### Related Product Area End ##### -->

@endsection