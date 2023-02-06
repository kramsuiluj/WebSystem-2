<base href="/public">
<link rel="stylesheet" href="assets/css/templatemo-klassy-cafe.css">
<!-- Show Graph Data -->
<script src="https://cdnjs.com/libraries/Chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
@if($max_sold != null)
<div class="map_canvas">
        <div class="container">
            <div class="row">
                <div id="top"  class="col-lg-4 offset-lg-4 text-center">
                    <div class="section-heading">
                        <h2>Top Selling Rice</h2>
                    </div>
                </div>
            </div>
        </div>

    <canvas id="myChart"></canvas>
</div>

<script>
var ctx = document.getElementById('myChart').getContext('2d');
var max = <?php echo json_encode($max_sold) ?>;
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($prod_name) ?>,
        datasets: [{
            label: '',
            data: <?php echo json_encode($prod_sold); ?>,
            backgroundColor: [
                'rgba(31, 58, 147, 1)',
                'rgba(37, 116, 169, 1)',
                'rgba(92, 151, 191, 1)',
                'rgb(200, 247, 197)',
                'rgb(77, 175, 124)'
                // 'rgb(30, 130, 76)'
            ],
            borderColor: [
                'rgba(31, 58, 147, 1)',
                'rgba(37, 116, 169, 1)',
                'rgba(92, 151, 191, 1)',
                'rgb(200, 247, 197)',
                'rgb(77, 175, 124)'
                // 'rgb(30, 130, 76)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                max: max,
                min: 0,
                ticks: {
                    stepSize: 50
                }
            }
        },
        plugins: {
            title: {
                display: false,
                text: 'Custom Chart Title'
            },
            legend: {
                display: false,
            }
        }
    }
});
</script>
@else
  
@endif