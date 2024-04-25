@extends('templates.master')
@section('title', 'Detail Data User')
@section('page-name', 'Detail Data User')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/scss/pages/simple-datatables.scss') }}">
@endpush
@section('content')

<section class="section">
    <div class="card">
        <div class="container ">
            <div class="card-header">
                <select class="form-select w-25" id="sortingSelect" onchange="redirectToSelected()">
                    <option value="">-- Sorting Metode Pembayaran --</option>
                    <option value="{{ route('customer.sorting', " alldata") }}">All Data</option>
                    @foreach($dataPayment as $payment)
                    <option value="{{ route('customer.sorting', $payment->name_payment_method) }}">{{
                        $payment->name_payment_method }}</option>
                    @endforeach
                </select>
                <div class="mt-3">
                    <a class="btn btn-sm btn-success" href="{{ route('export.index') }}">
                        Export - <i class="fas fa-file-export"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>ID Customer</th>
                        <th>Nama Customer</th>
                        <th>Spesifikasi Loundry</th>
                        <th>Quantity</th>
                        <th>Result Price</th>
                        <th>Payment Method</th>
                        <th>Nota</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataset as $item)
                    <tr>
                        <td>{{ $item->id_customer }}</td>
                        <td>{{ $item->name_customer_loundry }}</td>
                        <td>{{ $item->spesificationLoundry->name_spesification_loundry }}</td>
                        <td>{{ $item->quantity_loundry }} kg</td>
                        <td> {{ "Rp " . number_format($item->result_price_loundry, 0, ',', '.') }}</td>
                        <td>{{ $item->paymentMethod->name_payment_method }}</td>
                        <td><a href="{{ route('customer.nota', $item->id) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-file-alt"></i>
                            </a></td>
                        <td>
                            <form action="{{ route('customer.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm mr-2" type="submit"><i
                                        class="fa fa-trash"></i></button>
                            </form>
                            <button class="btn btn-success btn-sm" data-toggle="modal"
                                data-target="#customerDetailModal{{ $item->id }}"><i class="fa fa-eye"></i></button>
                        </td>



                        {{-- modal --}}
                        <div class="modal fade" id="customerDetailModal{{ $item->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="customerDetailModal{{ $item->id }}Label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="customerDetailModal{{ $item->id }}Label">Detail
                                            Customer</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>ID Customer: {{ $item->id_customer }}</p>
                                        <p>Nama Customer: {{ $item->name_customer_loundry }}</p>
                                        <p>Spesifikasi Loundry: {{
                                            $item->spesificationLoundry->name_spesification_loundry }}</p>
                                        <p>Quantity: {{ $item->quantity_loundry }} kg</p>
                                        <p>Result Price: Rp {{ number_format($item->result_price_loundry, 0, ',',
                                            '.') }}
                                            {{ $item->address_customer_loundry != "tidak diantar" ? "(including
                                            pengantaran
                                            +Rp. 5000)" : "" }}</p>
                                        <p>Payment Method: {{ $item->paymentMethod->name_payment_method }}</p>
                                        <p>Tanggal Masuk : {{ $item->start_loundry_customer }}</p>
                                        <p>Tanggal Selesai : {{ $item->end_loundry_customer }}</p>
                                        <p>No Telp: {{ $item->phone_number_customer_loundry }}</p>
                                        <p>Alamat: {{ $item->address_customer_loundry }}</p>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        @endforeach

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
</div>

{{-- <script>
    document.getElementById('sortingSelect').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var route = selectedOption.value;

        if (route) {
            window.location.href = route;
        }
    });
</script> --}}

<script src=" {{ asset ('assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
<script>
    let dataTable = new simpleDatatables.DataTable(
                    document.getElementById("table1")
                )               
</script>

<script src="assets/js/main.js"></script>

@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session()->has('success'))
<script>
    Swal.fire({
    icon: 'success',
    title: 'Success',
    text : "{{ session('success') }}",
    showConfirmButton: true,
    timer: 2000
    });
</script>
@endif

<script>
    function redirectToSelected() {
        var selectElement = document.getElementById('sortingSelect');
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var selectedValue = selectedOption.value;
        
        // Redirect to the selected URL if a valid option is selected
        if(selectedValue) {
            window.location.href = selectedValue;
        }
    }
</script>
@endpush