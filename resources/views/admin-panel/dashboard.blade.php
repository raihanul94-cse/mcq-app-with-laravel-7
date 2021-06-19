@extends('layouts.master')

@section('contents')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Attempts</span>
                        <span class="info-box-number">
                            {{ $exmAttm }}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-clipboard"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Exams</span>
                        <span class="info-box-number">{{ $exm }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-question"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Questions</span>
                        <span class="info-box-number">{{ $qsn }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Members</span>
                        <span class="info-box-number">{{ $usr }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <div class="card">
            <div class="card-header border-transparent">
                <h3 class="card-title text-bold">Leaderboard</h3>

                <div class="card-tools">
                   
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th style="text-align: center;">RANK</th>
                                <th>NAME</th>
                                <th>CATEGORY</th>
                                <th style="text-align: center;">SCORE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $rank = 0;
                            @endphp
                            @foreach (App\ExamAttempt::with(['user','exam'])->get()->sortByDesc('score') as $examAttempter)
                                @php
                                    $rank++;
                                @endphp
                                <tr>
                                    <td style="text-align: center;">{{ $rank }}</td>
                                    <td>{{ $examAttempter->user->name }}</td>
                                    <td>{{ App\Category::find($examAttempter->exam->category_id)->title }}</td>
                                    <td style="text-align: center;">{{ $examAttempter->score }}</td>
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
</section>

@endsection