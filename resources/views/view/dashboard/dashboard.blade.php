@extends('layout.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <br />
            <h1>Tableau de bord</h1>
            <hr />
            <br />
        </div>
        <div class="col-md-12">
            <h4>Bonjour {{explode(' ', $user->name)[0]}},</h4>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <canvas id="monthlyTransaction" style="width:100%;max-width:700px; max-height:300px;"></canvas>
                    </div>
                    <div class="col-md-6">
                        <canvas id="mostSoldCategories" style="width:100%;max-width:700px; max-height:300px;"></canvas>
                    </div>
                    <div class="col-md-12">
                        <br /><br /><br />
                    </div>
                    <div class="col-md-6">
                        <h3>Catégories les plus vendus</h3>
                        <ol>
                            @if($top_5_categories)
                                @foreach($top_5_categories as $key => $value)
                                    @php
                                        $formatter = new NumberFormatter('fr_CA',  NumberFormatter::CURRENCY); 
                                    @endphp
                                    <li>{{ str_replace(array("\\"), '', $value['name']) }} <small>({{$formatter->formatCurrency($value['sum'], 'CAD')}})</small></li>
                                @endforeach
                            @else
                                <p>Aucune données pour l'instant</p>
                            @endif
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <h3>Articles les plus vendus</h3>
                        <ol>
                            @if($top_10_items)
                                @foreach($top_10_items as $key => $value)
                                    @php
                                        $formatter = new NumberFormatter('fr_CA',  NumberFormatter::CURRENCY); 
                                    @endphp
                                    <li>{{ str_replace(array("\\"), '', $value['name']) }} <small>({{$formatter->formatCurrency($value['sum'], 'CAD')}})</small></li>
                                @endforeach
                            @else
                                <p>Aucune données pour l'instant</p>
                            @endif
                        </ol>
                    </div>
                </div>
                <br /><br />
            </div>
        </div>
    </div>
</div>
<script>
    const monthlyTransactionCanvas = document.getElementById('monthlyTransaction').getContext('2d');
    const monthlyTransaction = new Chart(monthlyTransactionCanvas, {
        type: 'line', // e.g., 'line', 'pie', 'doughnut', 'scatter'
        data: {
        labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet','Août', 'Septembre', 'Octobre', 'Novembre' , 'Décembre'],
        datasets: [{
                label: [new Date().getFullYear()],
                data: [{{implode(',', $transactions_sum_by_month)}}],
                pointRadius: 5,
                pointHoverRadius: 10,
                backgroundColor: [
                    @foreach($transactions_color_by_month as $key => $value)
                     '{{$value}}',
                    @endforeach
                ],
                borderColor: [
                    'rgb(0,0,0)',
                ],
                borderWidth: 1,
                tension: 0.4
            },{
                label: [new Date().getFullYear() -1],
                data: [{{implode(',', $transactions_sum_by_month_last_year)}}],
                pointRadius: 5,
                pointHoverRadius: 10,
                backgroundColor: [
                    'rgb(250, 100, 100,0.2)',
                ],
                borderColor: [
                    'rgb(250, 100, 100, 0.5)',
                ],
                borderWidth: 1,
                tension: 0.4
            },{
                label: [new Date().getFullYear() -2],
                data: [{{implode(',', $transactions_sum_by_month_2_years_ago)}}],
                pointRadius: 5,
                pointHoverRadius: 10,
                backgroundColor: [
                    'rgb(175, 175, 175,0.1)',
                ],
                borderColor: [
                    'rgb(175, 175, 175, 0.3)',
                ],
                borderWidth: 1,
                tension: 0.4
            }
        ]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Ventes totales',
                }
            },
            scales: {
                yAxes: [{
                ticks: {
                    beginAtZero: true
                }
                }]
            }
        }
    });
    
    const mostSoldCategoriesCanvas = document.getElementById('mostSoldCategories').getContext('2d');
    const mostSoldCategories = new Chart(mostSoldCategoriesCanvas, {
        type: 'pie', // e.g., 'line', 'pie', 'doughnut', 'scatter'
        data: {
        labels: ('{!!implode(',', $categories_name)!!}').split(','),
        datasets: [{
            label: 'Catégories les plus vendus',
            data: ('{{implode(',', $categories_sum)}}').split(','),
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(64, 255, 64, 0.2)'
                ],
                borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgb(109, 255, 64)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Ventes annuelles par catégories',
                }
            }
        }
    });
</script>  
@endsection