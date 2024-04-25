@extends('templates.master')
@section('title', 'Dashboard Panel')
@section('page-name', 'Dashboard Panel')
@push('styles')
<style>
    @media print {
        body * {
            visibility: hidden;
        }

        .print-section,
        .print-section * {
            visibility: visible;
        }

        .print-section {
            position: absolute;
            left: 0;
            top: 0;
        }
    }
</style>
@endpush
@section('content')

<div class="d-flex justify-content-between items-center">
    <a href="{{ route('customer') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back
    </a>
    <button id="cetakNota" class="btn btn-primary">
        <i class="fas fa-print"></i> Cetak Nota
    </button>
</div>

<div class="print-section mt-2">
    <div class="card">
        <div class="card-body border text-center">
            <h1>Laundry Nota</h1>
            <img class="w-25" src="{{ asset('storage/' . $imageLoundry->image_loundry_user) }}" alt="">
            <h3>No Pelanggan : {{ $userLoundry->id_customer }}</h3>
            <h5>Nama Pelanggan : {{ $userLoundry->name_customer_loundry }}</h5>
        </div>
        <div class="card-body border">
            <table class="table">
                <thead>
                    <tr>
                        <th>Spesifikasi Cuci</th>
                        <th>Quantity</th>
                        <th>Harga/kilo</th>
                        <th>Sub Total</th>
                        <th>Metode Pembayaran</th>
                        <th>Pemesanan</th>
                        <th>Alamat</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $userLoundry->spesificationLoundry->name_spesification_loundry }}</td>
                        <td>{{ $userLoundry->quantity_loundry }} kg</td>
                        <td>Rp {{ number_format($userLoundry->spesificationLoundry->price_kg_loundry, 0, ',', '.') }}/kg
                        </td>
                        <td>Rp {{ number_format($userLoundry->result_price_loundry, 0, ',', '.') }}
                            {{ $userLoundry->address_customer_loundry != "tidak diantar" ? "(including pengantaran
                            +Rp. 5000)" : "" }}</td>
                        <td>{{ $userLoundry->paymentMethod->name_payment_method }}</td>
                        <td>{{ $userLoundry->address_customer_loundry ? "diantar" : "tidak
                            diantar" }}</td>
                        <td>{{ $userLoundry->address_customer_loundry ? $userLoundry->address_customer_loundry : "-" }}
                        </td>
                        <td>
                            <p class="text-danger fw-bold">{{ $userLoundry->status_loundry }}</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>
@endsection
@push('scripts')

<script>
    var cetakNotaButton = document.getElementById('cetakNota');
    
        cetakNotaButton.addEventListener('click', function () {
            window.print();
        });
</script>

@endpush