<canvas id="bar" style="width: 100%;"></canvas>
<script>
    $(function () {
        var video_num = '{{$video_num}}';
        var fiction_num = '{{$fiction_num}}';
        window.chartColors = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(201, 203, 207)'
        };
        var barChartData = {
            labels: ['Num'],
            datasets: [{
                label: 'Video',
                borderColor: window.chartColors.purple,
                borderWidth: 1,
                data: [
                    video_num,
                ]
            },{
                label: 'Fiction',
                borderColor: window.chartColors.blue,
                borderWidth: 1,
                data: [
                    fiction_num,
                ]
            }]
        };
        var ctx = document.getElementById('bar').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                responsive: true,
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: ''
                }
            }
        });
    });
</script>
