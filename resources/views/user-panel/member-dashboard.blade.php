@extends('layouts.master')

@section('contents')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Member Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Member Dashboard</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title text-bold">Monthly Score Chart</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="lineChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="panel-filter">
                    <div class="expandable ml-5 mr-4">
                        <div class="input-group">
                            <input class="form-control" type="search" id="query" value="" data-type="search"
                                placeholder="Search phrase or keyword">
                        </div>
                    </div>
                    <div class="mr-4">
                        <div class="select-wrapper">
                            <select name="category" id="category" class="form-control">
                                <option>-- Category --</option>
                                @foreach (Auth::user()->categories()->get() as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mr-2">
                        <div class="select-wrapper">
                            <select name="sub-category" id="sub-category" class="form-control">
                                <option value="">-- Sub-category --</option>
                            </select>
                        </div>
                    </div>
                    <div><button class="btn btn-secondary" id="filter" value="Search">Search</button></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Exam</th>
                                        <th style="width: 120px">Category</th>
                                        <th style="text-align: center; width: 100px">Questions</th>
                                        <th style="text-align: center; width: 100px">Time</th>
                                        <th style="text-align: center; width: 100px">Avg Time</th>
                                        <th style="text-align: center; width: 100px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="table-data">
                                    @foreach ($exams as $exam)
                                    @php
                                    $time = 0;
                                    $count = 0;
                                    $avgTime = 0;
                                    @endphp
                                    @foreach ($exam->questions as $question)
                                    @php
                                    $time+=$question['timeLimit'];
                                    $count++;
                                    @endphp
                                    @endforeach
                                    @php
                                    $avgTime = $time / $count;
                                    @endphp
                                    <tr>
                                        <td>{{ $exam->id }}</td>
                                        <td>{{ $exam->title }}</td>
                                        <td>{{ $exam->category->title }}</td>
                                        <td style="text-align: center;">{{ $count }}</td>
                                        <td style="text-align: center;">{{ $time }}</td>
                                        <td style="text-align: center;">{{ $avgTime }}</td>
                                        <td><button class="btn btn-sm btn-secondary attempt-exam"
                                                data-id="{{ $exam->id }}">Attempt</button></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<script>
$(function() {
    $.ajax({
        type: "GET",
        url: "{{ route('get_score_chart') }}",
        success: function(response) {
            var labels = [];
            var data = [];
            $.each(response, (key, value) => {
                data.push(value.score);
                var date = new Date(value.created_at);
                var date = date.getDate();
                labels.push(date);
            });
            var areaChartData = {
                labels: labels,
                datasets: [{
                    label: 'Exam Attempt Score',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: data
                }]
            }

            var areaChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: false,
                        }
                    }]
                }
            }
            var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
            var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
            var lineChartData = jQuery.extend(true, {}, areaChartData)
            lineChartData.datasets[0].fill = false;
            lineChartOptions.datasetFill = false

            var lineChart = new Chart(lineChartCanvas, {
                type: 'line',
                data: lineChartData,
                options: lineChartOptions
            });
        }
    });

    $(document).on("click", ".attempt-exam", function() {
        let id = $(this).attr("data-id");
        console.log(id);
        window.location.href = `/attempt-exam/${id}`;

    });

    $(".panel-filter").on("change", "#category", function() {
        let category_id = $("#category").find(":selected").val();
        $.ajax({
            type: "GET",
            url: `get-subcategory-based-on-category/${category_id}`,
            success: function(response) {
                if (Object.keys(response).length > 0) {
                    $("#sub-category").empty();
                    $.each(response, (key, value) => {
                        $("#sub-category").append(
                            `<option value="${value.id}">${value.title}</option>`
                            )
                    })
                } else {
                    $("#sub-category").empty().append(
                        '<option value="">-- Choose One --</option>');
                }
            }
        });
    });

    $(".panel-filter").on("click", "#filter", function(e) {
        e.preventDefault();
        let category = $("#category").find(":selected").val();;
        let sub_category = $("#sub-category").find(":selected").val();;
        let query = $("#query").val();

        $.ajax({
            type: "GET",
            url: "{{ route('filter_exam') }}",
            data: {category: category, sub_category: sub_category, query: query},
            success:function (response) {
                console.log(response);
                $("#table-data").empty();
                $.each(response, (key, exam) => {
                    let time = 0;
                    let count = 0;
                    let avgTime = 0;
                    $.each((exam['questions']), (key, question) => {
                        time+=parseInt(question['timeLimit']);
                        count++;
                    });
                    $("#table-data").append(`<tr>
                                        <td>${exam['id']}</td>
                                        <td>${exam['title']}</td>
                                        <td>${exam['category_id']}</td>
                                        <td style="text-align: center;">${count}</td>
                                        <td style="text-align: center;">${time}</td>
                                        <td style="text-align: center;">${1}</td>
                                        <td><button class="btn btn-sm btn-secondary attempt-exam"
                                                data-id="${exam['id']}">Attempt</button></td>
                                    </tr>`);

                });
            }
        });

    });
});
</script>

<style>
.panel-filter {
    display: flex;
    padding: 10px;
    margin-top: 20px;
    background: #f8f8f8;
    border: 1px solid #e5e5e5;
    border-radius: 4px;
}
</style>
@endsection