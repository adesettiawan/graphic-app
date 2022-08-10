@extends('backend.layouts.app')

@section('content')
<style>
    #barModal {
        z-index: 1;
        opacity: 100;
        transition: opacity 0.2s;
    }

    #barModal.hide {
        z-index: -1;
        opacity: 0;
        transition: opacity 0.2s;
        height: 0;
    }

    .modal-background {
        position: relative;
        margin: 0;
        padding: 0;
        top: auto;
        left: auto;
        width: 100%;
        height: auto;
        /* background-color: rgba(0, 0, 0, 0.1) */
    }
</style>
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

            <div id="barModal" class="hide modal-background">
                <div class="card shadow">
                    <div class="modal-header">
                        <h5 class="modal-title">Data pada tanggal: <span class="label"><strong>934934</strong></span>
                        </h5>
                        <button type="button" onclick="modalClose()" class="close" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table id="table-records" class="table table-responsive table-hover">
                            <thead>
                                <th>No</th>
                                <th>From User</th>
                                <th>From User ID</th>
                                <th>Text</th>
                                <th>ID</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button onclick="modalClose()" type="button" class="btn btn-secondary"
                            data-dismiss="modal">Close</button>
                    </div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

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
    const ctx =  document.getElementById('myChart');
    const myChart = new Chart(
      ctx,
      config
    );

    //modal
    const barModal = document.getElementById('barModal');

    function modalClose(){
        barModal.classList.toggle('hide');
        $('#barModal').hide();
        $('#myChart').show();
        location.reload();

    }

    function modalOpen(click){
        const points = myChart.getElementsAtEventForMode(click, 'nearest',{
            intersect:true
        },true);
        if(points[0]){
            const dataset = points[0].datasetIndex;
            const datapoint = points[0].index;
            console.log(datas.labels[datapoint]);
            barModal.classList.toggle('hide');

            const labels = document.querySelectorAll('.label');
            console.log(labels);
            labels.forEach(label =>{
                label.innerText = datas.labels[datapoint];
            });
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:"GET",
                url: '{{url("/search")}}',
                data: {
                    text: datas.labels[datapoint]
                },
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                success: function(response) {
                    console.log(response);
                    let trHTML = '';
                    let no=1;
                $.each(response, function (i, item) {
                    trHTML += '<tr><td>' + no++ + '</td><td>' + item.from_user + '</td><td>' + item.from_user_id + '</td><td>' + item.text + '</td>'+ '</td><td>' + item.id_text + '</td></tr>';
                });
                $('#table-records').append(trHTML);
                $('#myChart').hide();
                $('#barModal').show();

                }
            });
        }
        
    }

    ctx.onclick = modalOpen;
</script>

@endsection