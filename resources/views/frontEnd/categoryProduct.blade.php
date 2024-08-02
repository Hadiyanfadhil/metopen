@extends('frontEnd.layouts.app')

@section('content')
<section class="min-vh-100 py-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb d-flex align-items-center">
                        <li class="breadcrumb-item"><a href="{{ URL::previous() }}" class="btn btn-dark btn-sm"><i class="fa fa-chevron-left"></i> Back</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('frontend#index') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Products</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
             <div class="col-3">
                <!-- Categories -->
                <div class="card border-0 mb-4 bg-white p-3 position-sticky">
                    <div class="">
                        <div class="mb-2 fw-bolder">Categories</div>
                        <div class="list-group">
                            @foreach ($categories as $item)
                                <a href="{{ route('frontend#catProduct', $item->category_id) }}" class="list-group-item list-group-item-action {{ Request::url() == route('frontend#catProduct', $item->category_id) ? 'active' : '' }}">{{ $item->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Price & Date Filter -->
                <div class="card border-0 mb-4 bg-white p-3 position-sticky">
                    <form action="{{ route('frontend#filterProduct') }}" method="get">
                        @csrf
                        <div class="mb-4">
                            <div class="mb-2">Price</div>
                            <div class="d-flex">
                                <input type="number" name="minPrice" class="form-control me-2" placeholder="min">
                                <input type="number" name="maxPrice" class="form-control" placeholder="max">
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="mb-2">Date</div>
                            <input type="date" name="startDate" class="form-control mb-2">
                            <input type="date" name="endDate" class="form-control">
                        </div>
                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary text-white w-100 me-2">Filter</button>
                            <button type="reset" class="btn btn-outline-primary w-100 ">Cancel</button>
                        </div>
                    </form>
                </div>

                <!-- Brand -->
                <div class="card border-0 mb-4 bg-white p-3 position-sticky">
                    <div class="">
                        <div class="mb-2 fw-bolder">Brands</div>
                        <div class="list-group">
                            @foreach ($brands as $item)
                                <a href="{{ route('frontend#brandProduct', $item->brand_id) }}" class="list-group-item list-group-item-action {{ Request::url() == route('frontend#brandProduct', $item->brand_id) ? 'active' : '' }}">{{ $item->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="card min-vh-100 border-0 bg-transparent">
                    <div class="card-body">
                        <div class="row">
                            @foreach ($products as $item)
                            <div class="col-4">
                                <div class="card bg-white product-card p-3 mb-3">
                                    <div class="product-img-container">
                                        <img src="{{ asset('uploads/products/'.$item->preview_image) }}" alt="" class="d-block w-100">
                                        @if (!empty($item->discount_price))
                                            @php
                                                $amount = $item->discount_price / $item->selling_price;
                                                $percentage = round($amount * 100);
                                            @endphp
                                            <div class="product-discount bg-danger">
                                                <p class="mb-0 text-white">-{{ $percentage }}%</p>
                                            </div>
                                        @else
                                            <div class="product-discount bg-dark">
                                                <p class="mb-0 text-white">New</p>
                                            </div>
                                        @endif
                                        <div class="d-flex product-overlay py-2 justify-content-center align-items-center">
                                            <a href="{{ route('frontend#showProduct', $item->product_id) }}" class="btn btn-light mx-3 px-1 shadow" title="View details" style="width: 40px; height: 40px;"><i class="mx-auto fas fa-eye text-info" style="font-size: 25px;"></i></a>
                                            <button onclick="addToWishList({{ $item->product_id }})" class="btn btn-light mx-3 px-1 shadow" title="Add to wishlist" style="width: 40px; height: 40px;"><i class="mx-auto fas fa-heart text-danger" style="font-size: 25px;"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body px-0 pb-0">
                                        <h5>{{ $item->name }}</h5>
                                        <div class="d-flex align-items-baseline">
                                            @if (!empty($item->discount_price))
                                                <h6 class="mb-0 text-danger">{{ number_format($item->discount_price, 0, ',', '.') }} Rp</h6>
                                                <p class="h6 mb-0 ms-2 text-black-50 text-decoration-line-through">{{ number_format($item->selling_price, 0, ',', '.') }} Rp</p>
                                            @else
                                                <h6 class="mb-0 text-danger">{{ number_format($item->selling_price, 0, ',', '.') }} Rp</h6>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
