@extends('layouts.master')

@section('contents')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Cartgories</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="text-align: center; width: 10px">#</th>
                                    <th style="width: 120px">Category</th>
                                    <th style="text-align: center; width: 100px">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td style="text-align: center;">{{ $category->id }}</td>
                                        <td>{{ $category->title }}</td>
                                        <td style="text-align: center;"><button class="btn btn-sm btn-danger delete-category" data-id="{{ $category->id }}">Delete</button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <form class="form" id="category-form">
                            <div class="form-group">
                                <label for="category_title">Category</label>
                                <input type="text" class="form-control" name="category" placeholder="ex. Programming">
                            </div>
                            <div class="d-flex justify-content-center"><button class="btn btn-primary centered add-category">Add to List</button></div>
                        </form>
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
$(document).ready(function() {
    $(document).on("click", ".add-category", function(e) {
        e.preventDefault();
        let category_info = $("#category-form").serializeArray();
        let category = {
            'title': category_info[0]['value']
        };
        $.ajax({
            type: "POST",
            url: "{{ route('create_category') }}",
            data: {"_token": "{{ csrf_token() }}", data: category},
            success: function () {
                location.reload();
            }
        })
    });
});
</script>
@endsection