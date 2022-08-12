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

    input[type="date"]::-webkit-inner-spin-button,
    input[type="date"]::-webkit-calendar-picker-indicator {
        opacity: 0.3;
    }
</style>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <h2 class="page-title">Grafik data</h2>
            <p class="text-muted">Grafik data yang ditampilkan dapat dilihat dibawah ini..</p>

            <div class="row align-items-center my-2">
                <div class="col-auto ml-auto">
                    <form class="form-inline" id="dateRange">
                        <div class="form-group">
                            <label for="date-input1">Date Range:</label>
                            <div class="input-group ml-3">
                                <input type="date" class="form-control" id="start-date" value="2022-08-01">
                                <input type="date" class="form-control" id="end-date" value="2022-08-31">
                                <div class="input-group-append">
                                    <div class="input-group-text" id="button-addon-date"><span onclick="filterDate()"
                                            class="fe fe-filter fe-16" style="opacity: 0.5; cursor: pointer;"
                                            title="Filter"></span>
                                    </div>
                                    <div class="input-group-text" id="button-addon-date"><span onclick="resetDate()"
                                            class="fe fe-refresh-cw fe-16" style="opacity: 0.5; cursor: pointer;"
                                            title="Refresh"></span>
                                    </div>
                                </div>
                            </div>
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
                                <th>Tanggal</th>
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
                        <canvas id="myChart"></canvas>
                    </div>
                </div> <!-- .col -->
            </div> <!-- end section -->

            <!-- error page/data tidak ditemukan-->
            <div class="alert alert-danger notification" role="alert">
                <span class="fe fe-frown fe-16 mr-2"></span> Data grafik pada <strong>Date Range</strong> ini tidak
                ditemukan, Silahkan ulangi inputan
                <strong>Date Range</strong> yang kamu masukan.!
                <button type="button" onclick="window.location.reload()" class="close" data-dismiss="alert"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


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

    // initial filter dates
    const dates = data.label;
    const convertedDates = dates;
    const datapoints = data.data;
    console.log(convertedDates)

    // setup 
    const datas = {
        labels: data.label,
      datasets: [{
        label: 'Jumlah Data',
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
        onHover:(event, elements) => {
            event.native.target.style.cursor = elements[0] ? 'pointer' : 'default';
        },
      },
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
        $('.notification').hide();
        $('#myChart').show();
        location.reload();

    };

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
                    trHTML += '<tr><td>' + no++ + '</td><td>' + item.from_user + '</td><td>' + item.from_user_id + '</td><td>' + item.text + '</td><td>' + item.id_text +'</td><td>' + item.created_at + '</td></tr>';
                });
                $('#table-records').append(trHTML);
                $('#myChart').hide();
                $('.notification').hide();
                $('#dateRange').hide();
                $('#barModal').show();

                }
            });
        };
    };

    ctx.onclick = modalOpen;

    //function convert timestamp to date
    function timeConverter(UNIX_timestamp){
        let date = new Date(UNIX_timestamp);
        let year = date.getFullYear();
        let month = ("0" + (date.getMonth() + 1)).substr(-2);
        let day = ("0" + date.getDate()).substr(-2);
        let hour = ("0" + date.getHours()).substr(-2);
        let minutes = ("0" + date.getMinutes()).substr(-2);
        let seconds = ("0" + date.getSeconds()).substr(-2);
        // let time =  year + "-" + month + "-" + day + " " + hour + ":" + minutes + ":" + seconds;
        let time =  year + "-" + month + "-" + day;
        return time;
    };

    //function filter dates
    function filterDate(){
        const startDates = new Date(document.getElementById('start-date').value);
        const startDateTimestamp = startDates.setHours(0,0,0,0);
        const startDate = timeConverter(startDateTimestamp);
        console.log(startDate)

        const endDates = new Date(document.getElementById('end-date').value);
        const endDateTimestamp = endDates.setHours(0,0,0,0);
        const endDate = timeConverter(endDateTimestamp);
        console.log(endDate)

        const filterDates = convertedDates.filter(date => date >= startDate && date <= endDate);

        if(filterDates.length >0){
            $('.notification').hide();
            myChart.config.data.labels = filterDates;

            //working on the data
            const startArray = convertedDates.indexOf(filterDates[0]);
            const endArray = convertedDates.indexOf(filterDates[filterDates.length - 1]);
            console.log(endArray);
            const copyDataPoints = [...datapoints];
            copyDataPoints.splice(endArray + 1, filterDates.length);
            copyDataPoints.splice(0, startArray);
            console.log(copyDataPoints);
            myChart.config.data.datasets[0].data = copyDataPoints;
            myChart.update();

        }else{
            $('#myChart').hide();
            $('.notification').show();
            // alert('Data tidak ditemukan');
        }
    }

    //function reset data grafik
    function resetDate(){
        myChart.config.data.labels = convertedDates;
        myChart.config.data.datasets[0].data = datapoints;
        myChart.update();
    }


    //hide notification data tidak ditemukan
    $('.notification').hide();

</script>

@endsection