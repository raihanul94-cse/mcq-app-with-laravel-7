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
                                    <th style="width: 120px">Sub-Category</th>
                                    <th style="text-align: center; width: 10px">CategoryId</th>
                                    <th style="text-align: center; width: 100px">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sub_categories as $sub_category)
                                    <tr>
                                        <td style="text-align: center;">{{ $sub_category->id }}</td>
                                        <td>{{ $sub_category->title }}</td>
                                        <td style="text-align: center;">{{ $sub_category->category_id }}</td>
                                        <td style="text-align: center;"><button class="btn btn-sm btn-danger delete-subcategory" data-id="{{ $sub_category->id }}">Delete</button></td>
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
                        <form class="form" id="subcategory-form">
                            <div class="form-group">
                                <label for="subcategory_title">Sub-Category</label>
                                <input type="text" class="form-control" name="subcategory" placeholder="ex. Programming">
                            </div>
                            <div class="form-group">
                                <label for="category_id">CategoryId</label>
                                <select name="category-id" class="form-control">
                                    <option>--Choose One--</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="d-flex justify-content-center"><button class="btn btn-primary centered add-subcategory">Add to List</button></div>
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
    $(document).on("click", ".add-subcategory", function(e) {
        e.preventDefault();
        let subcategory_info = $("#subcategory-form").serializeArray();
        let subcategory = {
            'title': subcategory_info[0]['value'],
            'category_id': subcategory_info[1]['value']
        };
        $.ajax({
            type: "POST",
            url: "{{ route('create_subcategory') }}",
            data: {"_token": "{{ csrf_token() }}", data: subcategory},
            success: function () {
                location.reload();
            }
        })
    });
});
</script>
@endsection