@extends('layouts.master')

@section('contents')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Create a Exam</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">All Exams</a></li>
                    <li class="breadcrumb-item active">Create an Exam</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="content">
    <div class="container-fluid exam">
    <form id="exam-info">
    <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="exam-title">Exam Title</label>
                    <input type="text" class="form-control" name="title"
                        placeholder="ex. Web and Internet Programming Lab - Class test">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="exam-category">Exam Category</label>
                    <select name="category" id="category" class="form-control">
                        <option>-- Choose One --</option>
                        @foreach (Auth::user()->categories()->get() as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="exam-category">Exam SubCategory</label>
                    <select name="sub-category" id="sub-category" class="form-control">
                        <option value="">-- Choose One --</option>
                    </select>
                </div>
            </div>
        </div>
        </form>
        <div class="row">
            <div class="questions col-lg-12">
            <form id="question1">
                <div class="card">
                        <div class="card-header">
                            <span class="badge badge-info">Qusetion No: 1</span>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Question</label>
                                <textarea type="text" class="form-control" name="question1" placeholder="ex. Which is valid ORM for Laravel"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Options</label>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-3"><input type="text" class="form-control" name="question1-a" placeholder="A."></div>
                                        <div class="col-3"><input type="text" class="form-control" name="question1-b" placeholder="B."></div>
                                        <div class="col-3"><input type="text" class="form-control" name="question1-c" placeholder="C."></div>
                                        <div class="col-3"><input type="text" class="form-control" name="question1-d" placeholder="D."></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="">Time Limit <small>(minutes)</small></label>
                                        <input type="number" class="form-control" name="question1-time_limit" min="1" value="1">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="">Question Category</label>
                                        <select name="question1-question_category" class="form-control">
                                            <option value="">--Choose One--</option>
                                            <option value="general">General</option>
                                            <option value="programming">Programming</option>
                                            <option value="analytics">Analytics</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="">Question Weight</label>
                                        <input type="number" class="form-control" name="question1-weight" min="1">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="">Correct Option</label>
                                        <select name="question1-correct_option" class="form-control">
                                            <option value="">--Choose One--</option>
                                            <option value="a">A</option>
                                            <option value="b">B</option>
                                            <option value="c">C</option>
                                            <option value="d">D</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <button class="btn btn-primary add_more"><i class="fa fa-plus"></i> Add Another Question</button>
                            </div>
                            <div class="col-lg-4">
                                <span class="d-none limit-warning badge badge-warning">you reached the limit</span>
                            </div>
                            <div class="col-lg-4">
                                <button class="btn btn-warning create_exam float-right text-white"><i class="fa fa-save"></i> Create Exam</button> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
    $(document).ready(function() {
        var max_fields = 4;
        var wrapper = $(".questions");
        var add_button = $(".add_more");

        var x = 1;
        $(add_button).click(function(e) {
            e.preventDefault();
            if (x < max_fields) {
                x++;
                $(wrapper).append(`<form id="question${x}"><div class="card">
                        <div class="card-header">
                            <span class="badge badge-info">Qusetion No: ${x}</span>
                            <button class="btn btn-danger float-right delete"><i class="fa fa-trash"></i></button>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Question</label>
                                <textarea type="text" class="form-control" name="question${x}" placeholder="ex. Which is valid ORM for Laravel"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Options</label>
                                <div class="form-group">
                                    <div class="row">
                                        <form id="options">
                                            <div class="col-3"><input type="text" class="form-control" name="question${x}-a" placeholder="A."></div>
                                            <div class="col-3"><input type="text" class="form-control" name="question${x}-b" placeholder="B."></div>
                                            <div class="col-3"><input type="text" class="form-control" name="question${x}-c" placeholder="C."></div>
                                            <div class="col-3"><input type="text" class="form-control" name="question${x}-d" placeholder="D."></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="">Time Limit <small>(minutes)</small></label>
                                        <input type="number" class="form-control" name="question${x}-time_limit" min="1" value="1">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="">Question Category</label>
                                        <select name="question${x}-question_category" class="form-control">
                                            <option value="">--Choose One--</option>
                                            <option value="general">General</option>
                                            <option value="programming">Programming</option>
                                            <option value="analytics">Analytics</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="">Question Weight</label>
                                        <input type="number" class="form-control" name="question${x}-weight" min="1">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="">Correct Option</label>
                                        <select name="question${x}-correct_option" class="form-control">
                                            <option value="">--Choose One--</option>
                                            <option value="a">A</option>
                                            <option value="b">B</option>
                                            <option value="c">C</option>
                                            <option value="d">D</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div></form>`); //add input box
            } else {
                $('.limit-warning').removeClass('d-none');
            }
            var $target = $('html,body'); 
            $target.animate({scrollTop: $target.height()}, 1000);
        });

        $(wrapper).on("click", ".delete", function(e) {
            $(this).parents('.card').remove();
            x--;
            $('.limit-warning').addClass('d-none');
        })

        $('.exam').on("click", ".create_exam", function (e) {
            e.preventDefault();
            let exam_info = $('#exam-info').serializeArray();
            let exam = {
                        "examTitle": exam_info[0]['value'],
                        "examCategory": exam_info[1]['value'],
                        "examSubCategory": exam_info[2]['value'],
                        "questions": []
                       }
            for(i=1;i<=x;i++){
                $(`form#question${i}`).each(function() {
                    var form = $(this);
                    var data = form.serializeArray();
                        var obj={};
                        exam.questions.push({
                            "question": data[0]['value'],
                            "options": {
                                "a": data[1]['value'],
                                "b": data[2]['value'],
                                "c": data[3]['value'],
                                "d": data[4]['value']
                            },
                            "timeLimit": data[5]['value'],
                            "questionCategory": data[6]['value'],
                            "questionWeight": data[7]['value'],
                            "correctOption": data[8]['value']
                        });  
                    });
                }

                $.ajax({
                    type: "POST",
                    url: "{{ route('store_exam') }}",
                    data: {"_token": "{{ csrf_token() }}", data: exam},
                    success: function (response) {
                        window.location.href = "{{ route('all_exams') }}";
                    }
                })

            });


        $("#exam-info").on("change", "#category",function (){
            let category_id = $("#category").find(":selected").val();
            $.ajax({
                type: "GET",
                url: `get-subcategory-based-on-category/${category_id}`,
                success: function (response){
                    if(Object.keys(response).length > 0){
                        $.each(response ,(key, value) => {
                            $("#sub-category").append(`<option value="${value.id}">${value.title}</option>`)
                        })
                    }else{
                        $("#sub-category").empty().append('<option value="">-- Choose One --</option>');
                    }
                }
            });

        });
    });
    </script>
@endsection