@extends('layouts.app')

@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Selamat Datang {{ Auth::user()->name }}</h3>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@role('penjual')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Transaksi</h4>
                    <canvas id="transaksi-chart" class="mt-2" style="height:300px; width:100%;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Makam Terjual</h4>
                    <canvas id="transaksi-bar" class="mt-2" style="height: 300px; width:100%;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="container-fluid"></div>
@endrole

@endsection

@push('script')
<!-- Chart JS -->
<script src="{{ asset('assets/libs/chart.js/dist/Chart.min.js') }}"></script>
<script>
    var ticksStyle = {
        fontColor: '#495057',
        fontStyle: 'bold'
    }
    var mode = 'index'
    var intersect = true

    var optionsBarChart = {
        ///maintainAspectRatio: false,
        tooltips: {
            mode: mode,
            intersect: intersect
        },
        hover: {
            mode: mode,
            intersect: intersect
        },
        legend: {
            display: true,
            position: 'bottom',
        },
        scales: {
            yAxes: [{
                gridLines: {
                    display: true,
                    lineWidth: '4px',
                    color: 'rgba(0, 0, 0, .2)',
                    zeroLineColor: 'transparent'
                },
                ticks: {
                    beginAtZero: true,
                    min: 0,
                },
            }],
            xAxes: [{
                display: true,
                gridLines: {
                    display: false
                },
                ticks: ticksStyle
            }]
        }
    }

    var transaksiChart = new Chart($('#transaksi-chart'), {
        type: 'doughnut',
        data: {
            datasets: [{
                data: @json($transaksiChart->data),
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 206, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(153, 102, 255)',
                    'rgb(255, 159, 64)'
                ],
                borderWidth: 1
            }],
            labels: @json($transaksiChart->label)
        },
        options: {
            legend: {
                display: true,
                position: 'bottom',
            }
        }
    })

    var departmentChart = new Chart($('#transaksi-bar'), {
        type: 'bar',
        data: {
            labels: @json($transaksiBar->pluck('x')),
            datasets: [{
                    label: 'Makam',
                    backgroundColor: '#007bff',
                    borderColor: '#007bff',
                    data: @json($transaksiBar->pluck('y')),
                },
            ]
        },
        options: optionsBarChart
    })
</script>
@endpush
