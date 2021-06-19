@extends('layouts.master')

@section('contents')
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">All Users</h1>
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
                      <th style="text-align: center; width: 10px">#</th>
                      <th style="width: 120px">Name</th>
                      <th style="width: 120px">Email</th>
                      <th style="text-align: center; width: 60px">Role</th>
                      <th style="text-align: center; width: 60px">Status</th>
                      <th style="text-align: center; width: 100px">User Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td style="text-align: center;">{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td style="text-align: center;">{{ $user->role }}</td>
                            <td style="text-align: center;">{{ $user->status }}</td>
                            @if (($user->status == 'pending' || $user->status == 'unapproved') && $user->role != 'admin')
                            <td style="text-align: center;"><button class="btn btn-sm btn-primary approve" data-id="{{ $user->id }}">Approve</button> <button class="btn btn-sm btn-danger delete-user" data-id="{{ $user->id }}">Delete</button></td>
                            @elseif ($user->status == 'approved' && $user->role != 'admin')
                            <td style="text-align: center;"><button class="btn btn-sm btn-primary unapprove" data-id="{{ $user->id }}">Unapprove</button> <button class="btn btn-sm btn-danger delete-user" data-id="{{ $user->id }}">Delete</button></td>
                            @endif
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
      $(document).on("click", ".unapprove", function () {
        let id = 0;
        id = $(this).attr("data-id");
        status = 'unapproved';
        $.ajax({
          type: "GET",
          url: `change-status/${id}/${status}`,
          data: {"_token": "{{ csrf_token() }}"},
          success:function (re) {
            location.reload();
          }
        });
      });

      $(document).on("click", ".approve", function () {
        let id = 0;
        id = $(this).attr("data-id");
        status = 'approved';
        $.ajax({
          type: "GET",
          url: `change-status/${id}/${status}`,
          data: {"_token": "{{ csrf_token() }}"},
          success:function (re) {
            location.reload();
          }
        });
      });

      $(document).on("click", ".delete-user", function () {
        let id = 0;
        id = $(this).attr("data-id");
        $.ajax({
          type: "DELETE",
          url: `delete-user/${id}`,
          data: {"_token": "{{ csrf_token() }}"},
          success:function (re) {
            location.reload();
          }
        });
      });
    });
  </script>
@endsection