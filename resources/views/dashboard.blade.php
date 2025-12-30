@extends('layouts.app')

@section('content')

<h4 class="mb-4">Welcome back, {{ auth()->user()->name }} 👋</h4>

@php
    $total = max($totalLeads, 1);
    $hotPct  = round(($hotLeads / $total) * 100, 1);
    $warmPct = round(($warmLeads / $total) * 100, 1);
    $coldPct = round(($coldLeads / $total) * 100, 1);
@endphp

<div class="row mb-4">

    <div class="col-md-3">
        <div class="card text-white" style="background:#006600">
            <div class="card-body">
                <h6>Total Leads</h6>
                <h3>{{ $totalLeads }}</h3>
                <small>+{{ $weeklyLeads }} this week</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card" style="background:#fbfb6a">
            <div class="card-body">
                <h6>Worm Leads</h6>
                <h3>{{ $warmLeads }}</h3>
                <small>{{ $warmPct }}% of total</small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white" style="background:#ffb3b3">
            <div class="card-body">
                <h6>Hot Leads</h6>
                <h3>{{ $hotLeads }}</h3>
                <small>{{ $hotPct }}% of total</small>
            </div>
        </div>
    </div>

    

    <div class="col-md-3">
        <div class="card text-white" style="background:#3498db">
            <div class="card-body">
                <h6>Cold Leads</h6>
                <h3>{{ $coldLeads }}</h3>
                <small>{{ $coldPct }}% of total</small>
            </div>
        </div>
    </div>

</div>

<div class="row">

    <div class="col-md-7">
        <div class="card">
            <div class="card-header fw-bold">Leads</div>
            <div class="card-body">

                <ul class="nav nav-tabs mb-3">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#today">Today Lead </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tomorrow">Tomorrow Lead </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="today">
                        @include('leads-table',['leads'=>$todayLeads])
                    </div>
                    <div class="tab-pane fade" id="tomorrow">
                        @include('leads-table',['leads'=>$tomorrowLeads])
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card">
            <div class="card-header fw-bold text-center">Leads Distribution</div>
            <div class="card-body d-flex justify-content-center">
                <canvas id="leadChart" style="max-width:260px;max-height:260px;"></canvas>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
new Chart(document.getElementById('leadChart'), {
    type: 'doughnut',
    data: {
        labels: [
            'Hot ({{ $hotPct }}%)',
            'Warm ({{ $warmPct }}%)',
            'Cold ({{ $coldPct }}%)'
        ],
        datasets: [{
            data: [{{ $hotLeads }}, {{ $warmLeads }}, {{ $coldLeads }}],
            backgroundColor: ['#e74c3c','#f1c40f','#3498db'],
            borderWidth: 0
        }]
    },
    options: {
        cutout: '65%',
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    boxWidth: 12,
                    padding: 15
                }
            }
        }
    }
});
</script>

@endsection
