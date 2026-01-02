<!DOCTYPE html>
<html>

<head>
    <title>{{ config('app.name') }} - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/shantachatterjee.css') }}">
    <link rel="stylesheet" href="{{ asset('css/subhaschandrachatterjee.css') }}">
</head>

<body>
    @include('layouts.header')

    <div class="container-fluid py-4">

        <h4 class="mb-4">Dashboard Overview</h4>

        @php
        $total = max($totalLeads, 1);
        $hotPct = round(($hotLeads / $total) * 100, 1);
        $warmPct = round(($warmLeads / $total) * 100, 1);
        $coldPct = round(($coldLeads / $total) * 100, 1);
        @endphp

        
        <div class="row mb-4 g-3">
            <div class="col-md-3">
                <div class="card shadow-sm kpi-card" style="background: linear-gradient(45deg, #2e8b57, #3cb371);">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6>Total Leads</h6>
                            <h3>{{ $totalLeads }}</h3>
                            <small>+{{ $weeklyLeads }} this week</small>
                        </div>
                        <i class="fas fa-users kpi-icon"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm kpi-card" style="background: linear-gradient(45deg, #f1c40f, #f39c12);">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6>Warm Leads</h6>
                            <h3>{{ $warmLeads }}</h3>
                            <small>{{ $warmPct }}% of total</small>
                        </div>
                        <i class="fas fa-handshake kpi-icon"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm kpi-card" style="background: linear-gradient(45deg, #e74c3c, #c0392b);">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6>Hot Leads</h6>
                            <h3>{{ $hotLeads }}</h3>
                            <small>{{ $hotPct }}% of total</small>
                        </div>
                        <i class="fas fa-fire kpi-icon"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm kpi-card" style="background: linear-gradient(45deg, #3498db, #2980b9);">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6>Cold Leads</h6>
                            <h3>{{ $coldLeads }}</h3>
                            <small>{{ $coldPct }}% of total</small>
                        </div>
                        <i class="fas fa-snowflake kpi-icon"></i>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="row g-4">

            
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header card-header-custom text-center">
                        <h5 class="mb-0">Today's Leads</h5>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($todayLeads as $lead)
                                <tr>
                                    <td>{{ $lead->name }}</td>
                                    <td>{{ $lead->phone }}</td>
                                    <td>{{ ucfirst($lead->status) }}</td>
                                    <td>{{ $lead->lead_given_date }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">No leads today</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-header card-header-custom text-center">
                        <h5 class="mb-0">Leads by Type</h5>
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        <canvas id="leadTypeChart" style="max-width:200px; max-height:200px;"></canvas>
                    </div>
                </div>
            </div>

        
<div class="col-md-3">
    <div class="card shadow-sm">
        <div class="card-header card-header-custom text-center">
            <h5 class="mb-0">Leads Follow-Up Status</h5>
        </div>
        <div class="card-body d-flex justify-content-center">
            <canvas id="followUpLeadTypeChart" style="max-width:200px; max-height:200px;"></canvas>
        </div>
    </div>
</div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
    
    const leadTypeCtx = document.getElementById('leadTypeChart').getContext('2d');
    new Chart(leadTypeCtx, {
        type: 'doughnut',
        data: {
            labels: [`Hot ({{ $hotPct }}%)`, `Warm ({{ $warmPct }}%)`, `Cold ({{ $coldPct }}%)`],
            datasets: [{
                data: [{{ $hotLeads }}, {{ $warmLeads }}, {{ $coldLeads }}],
                backgroundColor: [
                    'rgba(231, 76, 60, 0.8)',
                    'rgba(241, 196, 15, 0.8)',
                    'rgba(52, 152, 219, 0.8)'
                ],
                borderColor: ['#c0392b', '#f39c12', '#2980b9'],
                borderWidth: 2
            }]
        },
        options: { cutout: '65%' }
    });

 
    const followUpData = @json($followUpLeadsChartData);

const labels = Object.keys(followUpData); 
const data = Object.values(followUpData);

const ctx = document.getElementById('followUpLeadTypeChart').getContext('2d');
new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: labels,
        datasets: [{
            data: data,
            backgroundColor: [
                'rgba(46, 204, 113, 0.8)',  
                'rgba(52, 152, 219, 0.8)',  
                'rgba(231, 76, 60, 0.8)'    
            ],
            borderColor: '#fff',
            borderWidth: 2
        }]
    },
    options: {
        cutout: '65%',
        plugins: {
            legend: {
                position: 'bottom',
                labels: { boxWidth: 12, padding: 15 }
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.label + ': ' + context.parsed;
                    }
                }
            }
        }
    }
});
    </script>

    @include('layouts.footer')
</body>
</html>
