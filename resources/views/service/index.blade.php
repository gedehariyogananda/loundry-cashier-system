@extends('templates.master')
@section('title', 'Service Loundry')
@section('page-name', 'Service Loundry')
@push('styles')

@endpush
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary">
                <div class="row justify-content-end">
                    <div class="col-md-6">
                        <h5 class="mb-0 text-light">service cuci</h5>
                    </div>
                    <div class="col-md-6">
                        <h5 class="mb-0 text-light">
                            <button class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#addSpesificationModal">
                                <i class="fas fa-plus"></i> Tambah Service Cuci
                            </button>
                        </h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Service Spesifikasi Cuci</th>
                            <th>Harga/kilo</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no = 1;
                        @endphp
                        @foreach($spesificationCuci as $spesification)
                        <tr>
                            <td>#{{ $no++}}</td>
                            <td>{{ $spesification->name_spesification_loundry }}</td>
                            <td> Rp {{ number_format ($spesification->price_kg_loundry, 0, ',', '.') }}</td>
                            <td>
                                <button class="btn btn-sm btn-info" data-toggle="modal"
                                    data-target="#editSpesificationModal{{$spesification->id}}">
                                    <i class="fas fa-pen"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Modal for Edit Spesification Cuci -->
                        <div class="modal fade" id="editSpesificationModal{{$spesification->id}}" tabindex="-1"
                            role="dialog" aria-labelledby="editSpesificationModal{{$spesification->id}}Label"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editSpesificationModal{{$spesification->id}}Label">
                                            Edit Spesifikasi
                                            Cuci</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('servicecuci.update', $spesification->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="form-group">
                                                <label for="name_spesification_loundry">Nama Spesifikasi Cuci</label>
                                                <input type="text" class="form-control" id="name_spesification_loundry"
                                                    value="{{ $spesification->name_spesification_loundry }}"
                                                    name="name_spesification_loundry">
                                            </div>
                                            <div class="form-group">
                                                <label for="price_kg_loundry">Harga/kilo</label>
                                                <input type="text" class="form-control" id="price_kg_loundry"
                                                    value="{{ $spesification->price_kg_loundry }}"
                                                    name="price_kg_loundry">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary">
                <div class="row justify-content-end">
                    <div class="col-md-6">
                        <h5 class="mb-0 text-light">service payment</h5>
                    </div>
                    <div class="col-md-6">
                        <h5 class="mb-0 text-light">
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addPaymentModal">
                                <i class="fas fa-plus"></i> Tambah Service Pembayaran
                            </button>
                        </h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Service Pembayaran Loundry</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $no = 1;
                        @endphp
                        @foreach($paymentMethod as $payment)
                        <tr>
                            <td>#{{ $no++}}</td>
                            <td> {{ $payment->name_payment_method }}</td>
                            <td>
                                <button class="btn btn-sm btn-info" data-toggle="modal"
                                    data-target="#editPaymentModal{{$payment->id}}">
                                    <i class="fas fa-pen"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Modal for Edit Payment Method -->
                        <div class="modal fade" id="editPaymentModal{{$payment->id}}" tabindex="-1" role="dialog"
                            aria-labelledby="editPaymentModal{{$payment->id}}Label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editPaymentModal{{$payment->id}}Label">Edit Metode
                                            Pembayaran</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Form for Edit Payment Method -->
                                        <form action="{{ route('servicepayment.update', $payment->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="form-group">
                                                <label for="name_payment_method">Metode Pembayaran</label>
                                                <input type="text" class="form-control" id="name_payment_method"
                                                    value="{{ $payment->name_payment_method }}"
                                                    name="name_payment_method">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Add Spesification Cuci -->
<div class="modal fade" id="addSpesificationModal" tabindex="-1" role="dialog"
    aria-labelledby="addSpesificationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSpesificationModalLabel">Tambah Service Cuci</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for Add Spesification Cuci -->
                <form action="{{ route('addservicecuci.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name_spesification_loundry">Nama Spesifikasi Cuci</label>
                        <input type="text" class="form-control" id="name_spesification_loundry"
                            name="name_spesification_loundry">
                    </div>
                    <div class="form-group">
                        <label for="price_kg_loundry">Harga/kilo</label>
                        <input type="text" class="form-control" id="price_kg_loundry" name="price_kg_loundry">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Add Payment Method -->
<div class="modal fade" id="addPaymentModal" tabindex="-1" role="dialog" aria-labelledby="addPaymentModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPaymentModalLabel">Tambah Service Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for Add Payment Method -->
                <form action="{{ route('addservicepayment.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name_payment_method">Metode Pembayaran</label>
                        <input type="text" class="form-control" id="name_payment_method" name="name_payment_method">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')

@endpush