@extends('backend.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <h2 class="page-title">Grafik data</h2>
            <p class="text-muted">Grafik data yang ditampilkan dapat dilihat dibawah ini..</p>

            <div class="row align-items-center my-2">
                <div class="col-auto ml-auto">
                    <form class="form-inline">
                        <div class="form-group">
                            <label for="reportrange" class="sr-only">Date Ranges</label>
                            <div id="reportrange" class="px-2 py-2 text-muted">
                                <i class="fe fe-calendar fe-16 mx-2"></i>
                                <span class="small"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-sm"><span
                                    class="fe fe-refresh-ccw fe-12 text-muted"></span></button>
                            <button type="button" class="btn btn-sm"><span
                                    class="fe fe-filter fe-12 text-muted"></span></button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- charts-->
            <div class="row my-4">
                <div class="col-md-12">
                    <div class="chart-box">
                        {{-- <div id="columnChart"></div> --}}
                        {{-- <canvas id="barChartjs" width="400" height="300"></canvas> --}}
                        <canvas id="myChart"></canvas>
                    </div>
                </div> <!-- .col -->
            </div> <!-- end section -->
        </div> <!-- .col-12 -->
    </div> <!-- .row -->
</div> <!-- .container-fluid -->
@endsection

@section('script')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js">
</script>

<script type="text/javascript">
    //get the pie chart canvas
    const data = <?php echo $data['chart_data'] ?>;

    // setup 
    const datas = {
        labels: data.label,
      datasets: [{
        // label: 'Jumlah Data',
        data: data.data,
        barThickness: 20,
        pointRadius: !1,
        pointColor: "#3b8bba",
        pointStrokeColor: "rgba(60,141,188,1)",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(60,141,188,1)",
        fill: "",
        lineTension: 0.1,
        backgroundColor: [
          'rgba(27, 104, 255, 1)',
        ],
        borderColor: [
            'rgba(27, 104, 255, 1)',
        ],
        borderWidth: 2,
      }]
    };

    // config 
    const config = {
      type: 'bar',
      data: datas,
      options: {
        responsive: true,
        scales: {
            x:{
                type:'time',
                time:{
                    unit:'day',
                },
                grid: {
                    display: false,
                },
            },
          y: {
            beginAtZero: true,
            grid: {
                drawBorder: false,
            },
          },
          
        },
        plugins:{
            tooltip:{
                callbacks:{
                    title: context => {
                        const d = new Date(context[0].parsed.x);
                        const formatedDate = d.toLocaleString([], {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric',
                        });
                        return formatedDate;
                    },
                },
            },
            legend: {
                display: false
            },
        },
      }
    };

    // render init block
    const myChart = new Chart(
      document.getElementById('myChart'),
      config
    );
</script>

@endsection