
@extends('admin.layout.index')

@section('content')

    <!-- Page Content -->
    <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Thể loại
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                     @if(session('thongbao'))
                            <div class="alert alert-success">
                                {{session('thongbao')}}
                            </div>
                    @endif
                    
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Tên không dấu</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($category as $cate)
                            <tr class="odd gradeX" align="center">
                                <td>{{$cate->id}}</td>
                                <td>{{$cate->name}}</td>
                                <td>{{$cate->name_without_accent}}</td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/category/delete/{{$cate->id}}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/category/edit/{{$cate->id}}">Edit</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection

