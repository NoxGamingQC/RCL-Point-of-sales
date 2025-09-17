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
                    <div class="col-md-6">
                        <canvas id="mostSoldItems" style="width:100%;max-width:700px; max-height:300px;"></canvas>
                    </div>
                </div>
            </div>
            <h4>L'impression de rapport pour le bar est désormais disponible dans l'onglet <span class="text-primary">Gestion</span> puis selectionner <a class="text-danger" href="/transactions">Transactions</a> ci haut.</h4>
                
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
                label: [new Date().getFullYear() -1],
                data: [{{implode(',', $transactions_sum_by_month_last_year)}}],
                backgroundColor: [
                    'rgb(121, 121, 121,0.2)',
                ],
                borderColor: [
                    'rgb(121, 121, 121, 0.5)',
                ],
                borderWidth: 2
            }, {
                label: [new Date().getFullYear()],
                data: [{{implode(',', $transactions_sum_by_month)}}],
                backgroundColor: [
                    'rgb(36, 228, 29,0.2)',
                ],
                borderColor: [
                    'rgb(13, 121, 9)',
                ],
                borderWidth: 2
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


    const mostSoldItemsCanvas = document.getElementById('mostSoldItems').getContext('2d');
    const mostSoldItems = new Chart(mostSoldItemsCanvas, {
        type: 'doughnut', // e.g., 'line', 'pie', 'doughnut', 'scatter'
        data: {
        labels: ('{!!implode(',', $items_name)!!}').split(','),
        datasets: [{
                label: 'Catégories les plus vendus',
                data: ('{{implode(',', $items_sum)}}').split(','),
            
                borderWidth: 2
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Ventes annuelles par articles',
                }
            }
        }
    });
</script>  
@endsection