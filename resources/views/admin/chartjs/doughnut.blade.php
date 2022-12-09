<canvas id="doughnut" style="width: 100%;"></canvas>
<script>
    $(function () {
        var fiction_incomplete_num = '{{$fiction_incomplete_num}}';
        var fiction_complete_num = '{{$fiction_complete_num}}';
        window.chartColors = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(201, 203, 207)'
        };
        var config = {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [
                        fiction_incomplete_num,
                        fiction_complete_num
                    ],
                    backgroundColor: [
                        window.chartColors.red,
                        window.chartColors.blue
                    ],
                    label: 'Dataset 1'
                }],
                labels: [
                    'Incomplete',
                    'Complete'
                ]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: ''
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        };
        var ctx = document.getElementById('doughnut').getContext('2d');
        new Chart(ctx, config);
    });
</script>
