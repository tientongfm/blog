
@extends('admin.layout.index')

@section('content')

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tin tức
                        <small> Danh sách</small>
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
                            <th>Tiêu đề</th>
                            <th>Nổi bật</th>
                            <th>Tóm tắt</th>
                            <th>Thể loại</th>
                            <th>Loại tin</th>
                            <th>Xem</th>
                            
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($news as $tt)
                        <tr class="odd gradeX" align="center">
                            <td>{{$tt->id}}</td>
                            <td><p>{{$tt->title}}</p>
                                <img width="100px" src="upload/tintuc/{{$tt->image}}">   
                            </td>
                            <td>
                                @if($tt->hotnews == 0)
                                    {{'Không'}}
                                @else
                                    {{'Có'}}
                                @endif
                            </td>
                            <td>{{$tt->summary}}</td>
                            <td>{{$tt->typenews->category->name}}</td>
                            <td>{{$tt->typenews->name}}</td>
                            <td>{{$tt->view_counts}}</td>
                            
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/news/edit/{{$tt->id}}">Edit</a></td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/news/delete/{{$tt->id}}" onclick='return show_confirm()'> Delete</a></td>
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
        if(confirm("Bạn có muốn xóa tin tức này?")){
           return true;
        }
        else {
           return false;
      }
    }    
</script>

@endsection