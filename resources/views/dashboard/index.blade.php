@extends('templates.master')
@section('title', 'Dashboard Panel')
@section('page-name', 'Dashboard Panel')
@push('styles')

@endpush
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="text-center">Statistic Loundry</h4>
            </div>
            <div class="card-body" id="chartStatistik">
                <p class="text-center">Data /Bulan</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="text-center">Statistic Pembayaran</h4>
            </div>
            <div class="card-body" id="paymentStatistik">
                <div id="pieChart"></div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')

<script>
    var options2 = {
chart: {
type: 'bar'
},
series: [
{
  name: 'sales',
  data: [
    {!! json_encode($dataset[1], JSON_HEX_TAG) !!},
    {!! json_encode($dataset[2], JSON_HEX_TAG) !!},
    {!! json_encode($dataset[3], JSON_HEX_TAG) !!},
    {!! json_encode($dataset[4], JSON_HEX_TAG) !!},
    {!! json_encode($dataset[5], JSON_HEX_TAG) !!},
    {!! json_encode($dataset[6], JSON_HEX_TAG) !!},
    {!! json_encode($dataset[7], JSON_HEX_TAG) !!},
    {!! json_encode($dataset[8], JSON_HEX_TAG) !!},
    {!! json_encode($dataset[9], JSON_HEX_TAG) !!},
    {!! json_encode($dataset[10], JSON_HEX_TAG) !!},
    {!! json_encode($dataset[11], JSON_HEX_TAG) !!},
    {!! json_encode($dataset[12], JSON_HEX_TAG) !!},
    ]
}
],
xaxis: {
categories: ['JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC']
}
}


var chart = new ApexCharts(document.querySelector('#chartStatistik'), options2)
chart.render()


var optionsPie = {
        chart: {
            type: 'pie',
        },
        series: [],
        labels: [],
    };

    var paymentData = @json($dataPembayaran);

    for (var key in paymentData) {
        optionsPie.series.push(paymentData[key]['count']);
        optionsPie.labels.push(key);
    }

    var pieChart = new ApexCharts(document.querySelector("#pieChart"), optionsPie);
    pieChart.render();


</script>
@endpush