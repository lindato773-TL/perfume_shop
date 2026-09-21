@extends('layouts.guest')
@section('title', 'Pay order · Flowers')
@section('content')
    <section class="page-intro page-intro-small text-center py-5">
        <div class="container">
            {{-- <span class="badge bg-light text-danger border px-3 py-2 rounded-pill text-uppercase tracking-wider">Order
                #{{ $order->order_number }}</span> --}}
            <h1 class="display-5 fw-bold mt-3 mb-2">Complete your payment</h1>
            <p class="lead text-muted mx-auto" style="max-width: 500px;">Scan the QR code with your banking app, then confirm
                below.</p>
        </div>
    </section>

    <section class="pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">

                    <div class="card border shadow-sm rounded-4 p-4 text-center bg-white">

                        <div class="mb-4">
                            <span class="text-muted small text-uppercase fw-semibold d-block mb-1">Total Amount</span>
                            <h2 class="display-6 fw-bold text-danger m-0">
                                ${{ number_format($order->total, 2) }} <span class="fs-6 text-muted fw-normal">USD</span>
                            </h2>
                        </div>

                        <div class="bg-light border rounded-4 p-4 mx-auto mb-4 d-flex flex-column align-items-center"
                            style="max-width: 280px;">
                            <img src="{{ asset('images/aba-qr.png') }}"
                                alt="ABA QR code for payment {{ $order->payment_reference }}"
                                class="img-fluid rounded-3 mb-3 shadow-sm" style="max-width: 200px; height: auto;">

                            <small class="text-muted fw-medium lh-sm px-2 d-block">
                                Scan with ABA Mobile or any banking app to pay.
                            </small>
                        </div>

                        <div class="border-top pt-3 mb-4 w-100">
                            <span class="text-muted small d-block mb-1">Payment Reference:</span>
                            <span
                                class="d-inline-block bg-light border rounded px-3 py-1 fw-bold text-dark font-monospace fs-5 tracking-wide">
                                {{ $order->payment_reference }}
                            </span>
                            <p class="text-muted small mt-2 mb-0" style="font-size: 0.75rem;">Please input this reference in
                                the payment description/note.</p>
                        </div>

                        <div class="payment-actions w-100">
                            <form method="POST" action="{{ route('order.payment.confirm', $order) }}">
                                @csrf
                                <button class="btn btn-danger w-100 py-2.5 rounded-3 fw-bold text-white shadow-sm"
                                    type="submit">
                                    I completed payment <i class="bi bi-check2-circle ms-1"></i>
                                </button>
                            </form>
                        </div>

                    </div> 

                </div>
            </div>
        </div>
    </section>
@endsection
