
@extends('admin.layout.index')

@section('content')

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Slide
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
                                <th>Nội dung</th>
                                <th>Hình</th>
                                <th>Link</th>
                                <th>Edit</th>
                                <th>Delete</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($slide as $sd)
                            <tr class="odd gradeX" align="center">
                                <td>{{ $sd->id}}</td>
                                <td>{{ $sd->name}}</td>
                                <td>{{ $sd->content}}</td>
                                <td>
                                    <img width="400px" src="upload/slide/{{ $sd->image }}">
                                </td>
                                <td>{{ $sd->link}}</td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/slide/edit/{{$sd->id}}"> Edit</a></td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/slide/delete/{{$sd->id}}" onclick='return show_confirm()'> Delete</a></td>
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

@section('script')
<script>
    function show_confirm(){
        if(confirm("Bạn có muốn xóa slide này?")){
           return true;
        }
        else {
           return false;
      }
    }    
</script>
@endsection


