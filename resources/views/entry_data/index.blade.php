@extends('templates.master')
@section('title', 'Entry Data')
@section('page-name', 'Entry Data Customer')
@push('styles')

@endpush
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if(\Route::currentRouteName() == 'customer.edit')
                        <form action="{{ route('customer.update') }}" method="post">
                            @csrf
                            @method('patch')
                            @endif

                            @if(\Route::currentRouteName() == 'customer.index')
                            <form action="{{ route('customer.entry') }}" method="post">
                                @csrf
                                @endif

                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="nama">Nama Customer</label>
                                        <input class="form-control" type="text" name="name_customer_loundry"
                                            value="{{ old('name', $customer->name_customer_loundry ?? '') }}" id="">
                                        @error('name_customer_loundry')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                        <input type="hidden" name="id_customer" id="">
                                        <input type="hidden" name="result_price_loundry" id="">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="phone_number_customer_loundry">No Telp</label>
                                        <input class="form-control"
                                            value="{{ old('phone_number_customer_loundry', $customer->phone_number_customer_loundry ?? '') }}"
                                            type="text" name="phone_number_customer_loundry" id="">
                                        @error('phone_number_customer_loundry')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Spesifikasi Cuci</label>
                                        <select class="form-control" name="spesification_loundry_id" id="">
                                            <option value="">-- Pilih Spesifikasi Cuci --</option>
                                            @foreach($spesifications as $spesification)
                                            <option value="{{ $spesification->id }}" {{ old('spesification_loundry_id',
                                                $customer->
                                                spesification_loundry_id ?? '') == $spesification->id ? 'selected' : ''
                                                }}>
                                                {{ $spesification->name_spesification_loundry }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="">Quantity Laundry</label>
                                        <input value="{{ old('quantity_loundry', $customer->quantity_loundry ?? '') }}"
                                            class="form-control" type="number" name="quantity_loundry">
                                        @error('quantity_loundry')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Tanggal selesai</label>
                                        <input
                                            value="{{ old('end_loundry_customer', $customer->end_loundry_customer ?? '') }}"
                                            class="form-control" type="date" name="end_loundry_customer">
                                        @error('end_loundry_customer')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <div id="alamatInput" style="display:none;">
                                            <label for="">Alamat</label>
                                            <input
                                                value="{{ old('address_customer_loundry', $customer->address_customer_loundry ?? '') }}"
                                                class="form-control" type="text" name="address_customer_loundry">
                                            @error('address_customer_loundry')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <label for="diantar">Pesanan Diantar?</label>
                                        <div>
                                            <input class="form-checkbox" type="checkbox" id="diantarCheckbox"> iya
                                        </div>
                                    </div>

                                </div>
                                <button id="checkButton" class="btn btn-sm btn-primary mt-2" type="submit">
                                    <i class="fas fa-check"></i> Submit
                                </button>

                            </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @endsection
    @push('scripts')
    <script>
        document.getElementById('diantarCheckbox').addEventListener('change', function() {
            var alamatInput = document.getElementById('alamatInput');
    
            if (this.checked) {
                alamatInput.style.display = 'block';
            } else {
                alamatInput.style.display = 'none';
            }
        });
    </script>

    @endpush