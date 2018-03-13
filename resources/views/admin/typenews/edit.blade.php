
@extends('admin.layout.index')

@section('content')

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Loại tin
                        <small>{{ $typenews->name}}</small>
                    </h1>
                </div>
                    <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    @if(count($errors) > 0)
                        <div class = "alert alert-danger">
                            @foreach( $errors -> all() as $err)
                                {{$err}}<br>
                            @endforeach
                        </div>
                    @endif
                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif

                    <form action="admin/typenews/edit/{{$typenews->id}}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label> Tên loại tin</label>
                            <select class="form-control" name="Category">
                                @foreach($category as $cate)
                                <option 
                                    @if($typenews->id_category == $cate->id)
                                        {{"selected"}}
                                    @endif
                                    value="{{$cate->id}}">{{$cate->name}}</option>
                                @endforeach
                            </select>
                            <input class="form-control" name="name" placeholder="Điền tên thể loại" value = "{{ $typenews->name}}"/>
                        </div>
                           
                        <button type="submit" class="btn btn-default">Sửa</button>
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