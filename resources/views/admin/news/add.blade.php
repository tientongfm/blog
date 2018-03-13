        
@extends('admin.layout.index')

@section('content')

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tin Tức
                        <small>Thêm</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">

                    @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                                {{$err}}<br>
                            @endforeach  
                        </div>
                    @endif
                    @if(session('thongbao'))
                        <div class = "alert alert-success">
                            {{session('thongbao')}}    
                        </div>
                    @endif

                <form action="admin/news/add" method="POST" enctype="multipart/form-data" >
                
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label>Thể loại</label>
                        <select class="form-control" name="Category" id="Category">
                                @foreach($category as $cate)
                                    <option value="{{$cate->id}}">{{$cate->name}}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Loại tin</label>
                        <select class="form-control" name="Typenews" id="Typenews">
                            @foreach($typenews as $type)
                                <option value="{{$type->id}}">{{$type->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tiêu đề</label>
                        <input class="form-control" name="title" placeholder=" Nhập tiêu đề">
                    </div>
                    <div class="form-group">
                        <label>Tóm tắt</label>
                        <textarea id="demo" class="form-control ckeditor" name="summary"
                            placeholder="Nhập tóm tắt" row="3";>
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea id="demo" class="form-control ckeditor" name="content" placeholder="Please Enter Category Order" row="3";>
                        </textarea>
                    </div>    
                    <div class="form-group">
                        <label>Hình ảnh</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nổi bật</label>
                        <label class="radio-inline">
                            <input name="Highlights" value="1" checked="" type="radio">Không
                            </label>
                        <label class="radio-inline">
                            <input name="Highlights" value="0" type="radio">Có
                        </label>
                    </div>
                    <button type="submit" class="btn btn-default">Thêm</button>
                    <button type="reset" class="btn btn-default">Làm mới</button>
                </form>
                </div>
            </div>
                <!-- /.row -->
        </div>
            <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $("#Category").change(function() {
                var id_category = $(this).val();
                $.get("admin/ajax/typenews/"+id_category,function(data){
                    $("#Typenews").html(data);
                });
            });
        });
    </script>
@endsection
