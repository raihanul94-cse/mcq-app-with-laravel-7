@extends('layouts.master')

@section('contents')
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">All Exams</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('create_exam') }}" class="btn btn-primary">Create an exam</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
              <table class="table table-bordered">
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
                  <tbody>
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
                        <td style="text-align: center;"><button class="btn btn-sm btn-danger delete-exam" data-id="{{ $exam->id }}">Delete</button></td>
                        <!-- <td><button class="btn btn-sm btn-secondary attempt-exam" data-id="{{ $exam->id }}">Attempt</button></td> -->
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

@section('scripts')
  <script>
    $(document).ready(function () {
      $(document).on("click", ".delete-exam", function () {
        let id = 0;
        id = $(this).attr("data-id");
        $.ajax({
          type: "DELETE",
          url: `create-exam/${id}`,
          data: {"_token": "{{ csrf_token() }}"},
          success:function (re) {
            alert(`Item Deleted ${re}`);
            location.reload();
          }
        });
      });

      $(document).on("click", ".attempt-exam", function () {
        let id = $(this).attr("data-id");
        console.log(id);
        window.location.href = `/attempt-exam/${id}`;
        
      });
    });
  </script>
@endsection