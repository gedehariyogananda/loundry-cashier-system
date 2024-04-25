@extends('templates.master')
@section('title', 'Checkout')
@section('page-name', 'Checkout Page')
@push('styles')

@endpush
@section('content')
<a href="{{ route('customer.edit') }}" class="btn btn-primary mt-2">
    <i class="fas fa-edit"></i> Edit Pemesanan
</a>
<div class="card mt-2">
    <div class="card-body border">
        <div class="text-center">
            <img class="w-25" src="{{ asset('storage/' . $imageLoundry->image_loundry_user) }}" alt="">
            <h3>No Pelanggan : {{ $userLoundry->id_customer }}</h3>
            <h5>Nama Pelanggan : {{ $userLoundry->name_customer_loundry }}</h5>
        </div>
    </div>
    <div class="card">
        <div class="card-body border">
            <table class="table">
                <thead>
                    <tr>
                        <th>Spesifikasi Cuci</th>
                        <th>Quantity</th>
                        <th>Harga</th>
                        <th>Sub Total</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $userLoundry->spesificationLoundry->name_spesification_loundry }}</td>
                        <td>{{ $userLoundry->quantity_loundry }} kg</td>
                        <td>Rp {{ number_format($userLoundry->spesificationLoundry->price_kg_loundry, 0, ',', '.')
                            }}/kg</td>
                        <td>Rp {{ number_format($userLoundry->result_price_loundry, 0, ',', '.') }}
                            {{ $userLoundry->address_customer_loundry != "tidak diantar" ? "(including pengantaran
                            +Rp. 5000)" : "" }}
                        </td>
                        <td>{{ $userLoundry->address_customer_loundry }}</td>

                    </tr>
                </tbody>
            </table>
            <h6>Setup Pembayaran : </h6>
            <form id="checkoutForm" action="{{ route('payment.update', $userLoundry->id) }}" method="post">
                @csrf
                @method('patch')
                <div class="d-flex items-center">
                    <select class="form-control w-25" name="payment_method_id" id="">
                        <option value="">-- Pilih Pembayaran --</option>
                        @foreach($payments as $payment)
                        <option value="{{ $payment->id }}">{{ $payment->name_payment_method }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-sm btn-success mx-2" id="checkoutButton" type="button">
                        <i class="fa fa-cart-plus"></i>
                    </button>
                </div>
                @error('payment_method_id')
                <p class="text-danger">{{ $message }}</p>
                @enderror

            </form>

        </div>
    </div>
</div>
@endsection
@push('scripts')

<script>
    document.getElementById('checkoutButton').addEventListener('click', function () {
        Swal.fire({
            title: 'Confirmation',
            text: 'Apakah yakin untuk checkout?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, Checkout',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('checkoutForm').submit();
            }
        });
    });
</script>

@endpush