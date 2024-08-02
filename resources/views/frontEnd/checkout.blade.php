@extends('frontEnd.layouts.app')

@section('content')
<section class="py-4 min-vh-100">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb d-flex align-items-center">
                        <li class="breadcrumb-item">
                            <a href="{{ URL::previous() }}" class="btn btn-dark btn-sm">
                                <i class="fa fa-chevron-left"></i> Back
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('frontend#index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('frontend#viewCarts') }}">My Carts</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card border-0 mb-4">
                    <div class="card-header bg-transparent border-bottom-0">
                        <h5 class="my-2">Delivery Information</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user#createOrder') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Enter your name" required>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Enter your phone number" required>
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="note" class="form-label">Note</label>
                                    <textarea class="form-control" id="note" name="note" rows="3" placeholder="Say something...">{{ old('note') }}</textarea>
                                    @error('note')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="stateDivisionId" class="form-label">Region</label>
                                    <select class="form-control stateDivisionsOption" id="stateDivisionId" name="stateDivisionId" required>
                                        <option value="">----Select Region----</option>
                                        @foreach ($stateDivisions as $item)
                                            <option value="{{ $item->state_division_id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('stateDivisionId')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="cityId" class="form-label">City</label>
                                    <select class="form-control cityOption" id="cityId" name="cityId" disabled required>
                                        <option value="">----Select City----</option>
                                    </select>
                                    @error('cityId')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="townshipId" class="form-label">Township</label>
                                    <select class="form-control townshipOption" id="townshipId" name="townshipId" disabled required>
                                        <option value="">----Select Township----</option>
                                    </select>
                                    @error('townshipId')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="address" class="form-label">Full Address</label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" placeholder="Enter your full address" required>
                                    @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4 card border-0">
                                <div class="card-header bg-transparent border-bottom-0">
                                    <h5>Select Payment Method</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="paymentMethod" id="kpay" value="kpay" checked>
                                        <label class="form-check-label" for="kpay">
                                            <img src="{{ asset('frontEnd/resources/image/kpay.png') }}" alt="KPay" class="rounded" style="width: 60px">
                                            KPay
                                        </label>
                                    </div>
                                    <hr>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="paymentMethod" id="wave" value="wave">
                                        <label class="form-check-label" for="wave">
                                            <img src="{{ asset('frontEnd/resources/image/warvemoney.png') }}" alt="Wave Money" class="rounded" style="width: 60px">
                                            Wave Money
                                        </label>
                                    </div>
                                    <hr>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="paymentMethod" id="cod" value="cod">
                                        <label class="form-check-label" for="cod">
                                            <img src="https://e7.pngegg.com/pngimages/510/354/png-clipart-food-indian-cuisine-bangladeshi-cuisine-devops-dubai-cash-on-delivery-text-logo.png" alt="Cash on Delivery" class="rounded" style="width: 60px">
                                            Cash on Delivery
                                        </label>
                                    </div>
                                    @error('paymentMethod')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4 card border-0 bg-light">
                                <div class="card-body">
                                    <div class="mb-3 d-flex justify-content-between">
                                        <h6 class="mb-0">Sub Total :</h6>
                                        <h5 class="mb-0"> Rp {{ Session::get('subTotal', 0) }} </h5>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-0">Coupon Discount :</h6>
                                        <h5 class="mb-0 couponDiscount"> Rp -{{ Session::get('coupon')['couponDiscount'] ?? 0 }} </h5>
                                    </div>
                                    <hr>
                                    <div class="mb-3 d-flex justify-content-between">
                                        <h6 class="mb-0">Grand Total :</h6>
                                        <h5 class="mb-0"> Rp - {{ Session::get('grandTotal', 0) }} </h5>
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-primary btn-lg float-end">Place Order</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 mb-4">
                    <div class="card-header bg-white border-bottom-0">
                        <h5 class="my-2">Your Orders</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product</th>
                                        <th>Name</th>
                                        <th>Unit Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach (Session::get('cart', []) as $key => $item)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td><img src="{{ asset('uploads/products/'.$item['productImage']) }}" alt="{{ $item['productName'] }}" class="img-fluid" style="max-width: 50px;"></td>
                                        <td>{{ $item['productName'] }}</td>
                                        <td> Rp {{ $item['price'] }} </td>
                                        <td>{{ $item['quantity'] }}</td>
                                        <td>Rp {{ $item['price'] * $item['quantity'] }} </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" class="text-end">Sub Total :</td>
                                        <td> Rp {{ Session::get('subTotal', 0) }} </td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="d-grid gap-2 mt-3">
                                <a href="{{ route('frontend#allProduct') }}" class="btn btn-dark">
                                    <i class="fa fa-chevron-left"></i> Continue Shopping
                                </a>
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
    $(document).ready(function(){
        $('.stateDivisionsOption').on('change', function(){
            var stateDivisionId = $(this).val();
            $.ajax({
                url: "{{ route('user#getCity') }}",
                method: "POST",
                dataType: "json",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: stateDivisionId,
                },
                beforeSend: function(){
                    $('.cityOption').prop("disabled", false).html('<option>Loading...</option>');
                },
                success: function(data){
                    var cityHtml = '<option value="">----Select City----</option>';
                    $.each(data.cities, function(key, value){
                        cityHtml += '<option value="' + value.city_id + '">' + value.name + '</option>';
                    });
                    $('.cityOption').html(cityHtml);
                    $('.townshipOption').html('<option>----Select Township----</option>').prop("disabled", true);
                }
            });
        });

        $('.cityOption').on('change', function(){
            var cityId = $(this).val();
            $.ajax({
                url: "{{ route('user#getTownship') }}",
                method: "POST",
                dataType: "json",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: cityId,
                },
                beforeSend: function(){
                    $('.townshipOption').prop("disabled", false).html('<option>Loading...</option>');
                },
                success: function(data){
                    var townshipHtml = '<option value="">----Select Township----</option>';
                    $.each(data.townships, function(key, value){
                        townshipHtml += '<option value="' + value.township_id + '">' + value.name + '</option>';
                    });
                    $('.townshipOption').html(townshipHtml);
                }
            });
        });
    });
</script>
@endsection
