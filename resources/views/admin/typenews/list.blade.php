
@extends('admin.layout.index')

@section('content')

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Loại tin
                            <small> Danh sách </small>
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
                                <th>Tên loại tin</th>
                                <th>Tên không dấu</th>
                                <th>Thể loại</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($typenews as $type)
                            <tr class="odd gradeX" align="center">
                                <td>{{$type->id}}</td>
                                <td>{{$type->name}}</td>
                                <td>{{$type->name_without_accent}}</td>
                                <td>{{$type->category->name}}</td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/typenews/delete/{{$type->id}}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/typenews/edit/{{$type->id}}">Edit</a></td>
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

