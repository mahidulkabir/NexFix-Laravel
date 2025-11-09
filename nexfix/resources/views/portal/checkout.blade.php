<x-portal.layout>
    <!DOCTYPE html>
    <html lang="en">




    <!-- Modal Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <div class="input-group w-75 mx-auto d-flex">
                        <input type="search" class="form-control p-3" placeholder="keywords"
                            aria-describedby="search-icon-1">
                        <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Search End -->


    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Checkout</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Checkout</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Checkout Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <h1 class="mb-4 fw-semibold">Billing details</h1>
            <h4 class="mt-2">Please provide your billing information</h4>

            <!-- order taking form  -->
            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <input type="hidden" name="service_id" value="{{ $service->id }}">
                <div class="row g-5">
                    <div class="col-md-12 col-lg-6 col-xl-7">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">Full Name<sup>*</sup></label>
                                    <input type="text" class="form-control" value="{{$user->name}}">
                                </div>
                            </div>

                        </div>

                        <div class="form-item">
                            <label class="form-label my-3">Address <sup>*</sup></label>
                            <input type="text" class="form-control" name="address"
                                placeholder="House Number, Street Name" value="Dhaka Bangladesh">
                        </div>




                        <div class="form-item">
                            <label class="form-label my-3">Mobile<sup>*</sup></label>
                            <input type="tel" class="form-control" value="{{$user->phone}}">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Email Address<sup>*</sup></label>
                            <input type="email" class="form-control" value="{{$user->email}}">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Booking Date <sup>*</sup></label>
                            <input type="date" class="form-control" name="booking_date" value="{{ date('Y-m-d') }}"
                                readonly>
                        </div>

                        <div class="form-item">
                            <label class="form-label my-3">Scheduled At <sup>*</sup></label>
                            <input type="datetime-local" class="form-control" name="scheduled_at">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Notes</label>
                            <textarea class="form-control" name="notes" placeholder="Add any special instructions..."
                                rows="3"></textarea>
                        </div>
                        {{-- <div class="form-item my-3">
                            <label for="vendor" class="form-label">Choose Vendor<sup>*</sup></label>
                            <select name="vendor_id" id="vendor" class="form-select">
                                <option value="">Select a vendor</option>
                                @foreach($vendors as $vendor)
                                <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                @endforeach
                            </select>
                        </div> --}}


                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-5">
                        <div class="table-responsive">
                            <h4>Service Details</h4>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Service</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">
                                            <div class="d-flex align-items-center mt-2">
                                                <img src="{{ asset('storage/' . $service->image) }}"
                                                    class="img-fluid rounded-circle" style="width: 90px; height: 90px;"
                                                    alt="">
                                            </div>
                                        </th>
                                        <td class="py-5">{{ $service->name }}</td>
                                        <td class="py-5">{{ $service->base_price }}</td>

                                        <td class="py-5">{{ $service->base_price }}</td>
                                    </tr>


                                    <tr>
                                        <th scope="row">
                                        </th>
                                        <td class="py-5">
                                            <p class="mb-0 text-dark text-uppercase py-3">TOTAL</p>
                                        </td>

                                        <td class="py-5"></td>
                                        <td class="py-5">
                                            <div class="py-3 border-bottom border-top">
                                                <p class="mb-0 text-dark">${{ $service->base_price }}</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                        <div>
                            <h4>Payment Method</h4>
                          <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-12">
                                <div class="form-check text-start my-3">
                                    <input type="radio" class="form-check-input bg-primary border-0" id="payment-bkash"
                                        name="payment_method" value="bkash">
                                    <label class="form-check-label" for="payment-bkash">Pay with bKash</label>
                                </div>
                            </div>
                        </div>

                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-12">
                                <div class="form-check text-start my-3">
                                    <input type="radio" class="form-check-input bg-primary border-0" id="payment-nagad"
                                        name="payment_method" value="nagad">
                                    <label class="form-check-label" for="payment-nagad">Pay with Nagad</label>
                                </div>
                            </div>
                        </div>

                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-12">
                                <div class="form-check text-start my-3">
                                    <input type="radio" class="form-check-input bg-primary border-0" id="payment-card"
                                        name="payment_method" value="card">
                                    <label class="form-check-label" for="payment-card">Pay with Card</label>
                                </div>
                            </div>
                        </div>  
                        </div>
                        

                        <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                            <button type="submit"
                                class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary ">Place
                                Order</button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Checkout Page End -->
             @if(session('success'))
            <div class="alert alert-success text-center mt-3">
                {{ session('success') }}
            </div>
        @endif
        </div>
    </div>

</x-portal.layout>