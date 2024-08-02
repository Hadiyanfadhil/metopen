@extends('frontEnd.layouts.app')
@section('content')
<!-- -------------------------------product details------------------------------------  -->
    <section class="pt-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb d-flex align-items-center ">
                            <li class="breadcrumb-item"><a href="{{ URL::previous() }}" class="btn btn-dark btn-sm"><i class="fa fa-chevron-left"></i> Back</a></li>
                          <li class="breadcrumb-item"><a href="{{ route('frontend#index') }}">Home</a></li>
                          <li class="breadcrumb-item"><a href="#">Products</a></li>
                          <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="bg-white row">
                        <div class="col-5 col-md-4 col-lg-4">
                            <div class="border-0 rounded card">
                                <div class="px-4 card-body">
                                    <div class="mb-4 overflow-hidden big-img">
                                        {{-- preview image --}}
                                        <img src="{{ asset('uploads/products/'.$product->preview_image) }}" class="img-fluid" alt="" srcset="">
                                    </div>
                                    @if (!count($multiImages) == 0)
                                    <div class="m-auto row small-img-slider position-relative owl-carousel owl-theme">
                                        @foreach ($multiImages as $item)
                                            <div class="item">
                                                <div class="mx-1 overflow-hideen small-img">
                                                    <img src="{{ asset('uploads/products/'.$item->image)}}" class="" alt="" srcset="">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-7 col-md-8 col-lg-8">
                            <div class="border-0 rounded card">
                                <div class="card-body">
                                    <h5>{{ $product->name }}</h5>
                                    <hr>
                                    <p>Avaliable : <span class="text-danger">In Stock</span></p>
                                    <p class="text-black-50">{{ $product->short_description }}</p>
                                    <hr>
                                    @if (!empty($product->discount_price))
                                        @php
                                            $amount = $product->discount_price / $product->selling_price;
                                            $percentage = round($amount*100);
                                        @endphp
                                        <p class="">Discount : <span class=""> {{$percentage}} %</span></p>
                                        <hr>
                                    @endif
                                    @if (!$colors->count() == 0)
                                        <div class="form-group">
                                            <select name="" id="" class="colorOption form-control" style="width: 200px" required>
                                                <option value="">---select color---</option>
                                                @foreach ($colors as $item)
                                                    <option value="{{ $item->color_id }}">{{ $item->colorName }}</option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger colorErrorMessage d-none">Color is required!</small>
                                        </div>
                                        <hr>
                                    @endif
                                    @if (!$sizes->count() == 0)
                                    <div class="form-group">
                                        <select name="" id="" class="sizeOption form-control" style="width: 200px">
                                            <option value="">---select size---</option>
                                            @foreach ($sizes as $item)
                                                <option value="{{ $item->size_id }}">{{ $item->sizeName }}</option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger sizeErrorMessage d-none">Size is required!</small>
                                    </div>
                                        <hr>
                                    @endif
                                    <div class="d-flex align-items-center">
                                        <p class="mb-0 me-3">Quantity : </p>
                                        <div class="p-1 rounded d-flex" style="width: 150px ;">
                                            <input type="number" class="quantity form-control" placeholder="qty" value="1" max="10" min="1">
                                        </div>
                                    </div>
                                    <small class="text-danger qtyErrorMessage d-none">quantity must be min: 1 or max: 10</small>
                                    <hr>
                                    <div class="d-flex align-items-baseline">
                                        @php
                                            $price = !empty($product->discount_price) ? $product->selling_price - $product->discount_price : $product->selling_price;
                                        @endphp
                                            <h5 class="mb-0 text-danger">SubTotal :Rp  {{ $price }} </h5>
                                        @if (!empty($product->discount_price))
                                            <p class="mb-0 h6 ms-2 text-black-50 text-decoration-line-through"> Rp {{ $product->selling_price }} </p>
                                        @endif
                                    </div>
                                    <hr>
                                    <div class="mt-4">
                                        <button class="text-white addToCart btn btn-primary" onclick="addToWishList({{ $product->product_id }})">Add to WishList</button>
                                        <button class="text-white addToCart btn btn-danger" onclick="addToCart({{$product->product_id}},{{ $price }})">Add to Cart</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="my-4 border-0 card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-4">
                                  <div class="list-group" id="list-tab" role="tablist">
                                    <a class="list-group-item list-group-item-action active" id="list-home-list" data-bs-toggle="list" href="#list-home" role="tab" aria-controls="list-home">Product Detail</a>
                                    <a class="list-group-item list-group-item-action" id="list-profile-list" data-bs-toggle="list" href="#list-profile" role="tab" aria-controls="list-profile">Product Review</a>
                                  </div>
                                </div>
                                <div class="col-8">
                                  <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                                        <h5>Product Details</h5>
                                        <hr>
                                        <p class="text-black-50">{{ $product->long_description }}</p>
                                    </div>
                                    <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                                        @foreach ($product->productReview as $review)
                                        @if ($review->status == 1)
                                            <div class="mb-3 border-0 rounded bg-light card">
                                                <div class="card-body">
                                                    <div class="">
                                                        <div class="mb-3 d-flex">
                                                            @if (!empty($review->user->profile_photo_path))
                                                                <img src="{{ asset('uploads/user/'.$review->user->profile_photo_path) }}" class="p-1 bg-white rounded-circle" alt="" srcset="" style="width: 50px !important; height: 50px !important">
                                                            @else
                                                                <img src="{{ asset('frontEnd/resources/image/user-default.png') }}" class="p-1 bg-white rounded-circle" alt="" srcset="" style="width: 50px !important; height: 50px !important">
                                                            @endif
                                                                <div class="ms-2">
                                                                    <p class="mb-0">{{ $review->user->name }}</p>
                                                                    <p class="mb-0 text-secondary">{{ $review->created_at->diffForHumans() }}</p>
                                                                </div>
                                                        </div>
                                                        <p class="mb-1">{{ $review->title }}</p>
                                                        <p class="text-secondary">"{{ $review->comment }}"</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @endforeach
                                        <div class="bg-white border-0 card">
                                            <div class="card-body">
                                                <h5 class="">Write your own review</h5>
                                                <hr>
                                                <form action="{{ route('user#storeReview',$product->product_id) }}" method="POST">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Title</label>
                                                        <input name="title" type="text" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Your Review</label>
                                                        <textarea name="comment" id="" class="form-control" cols="" rows="3"></textarea>
                                                    </div>
                                                    <button class="text-white float-end btn btn-primary">Submit Review</button>
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
@endsection
@section('script')
<script>
    $('document').ready(function(){
        //get size
        $('.colorOption').on('click',function(){
            let productId = "{{ $product->product_id }}";
            let colorId = $(this).val();
            $.ajax({
                url: "{{ route('frontend#getProductSize') }}",
                method: "post",
                dataType: "json",
                data: {
                    _token: '{{ csrf_token() }}',
                    colorId: colorId,
                    productId: productId,
                },
                beforeSend:function(){
                    let sizeOptionHtml = '<option value="">----loading----</option>';
                    $('.sizeOption').html(sizeOptionHtml);
                },
                success:function(response){
                    if(response.sizes.length != 0){
                        let sizeOptionHtml = '';
                        for(let i =0 ; i < response.sizes.length ; i++){
                            sizeOptionHtml += `
                                <option value="${response.sizes[i].size_id}">${response.sizes[i].sizeName}</option>
                            `;
                        }
                        $('.sizeOption').html(sizeOptionHtml);
                    }
                }

            })
        })
    })
</script>
@endsection
