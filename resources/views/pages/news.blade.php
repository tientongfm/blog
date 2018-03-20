@extends('layout.index')

@section('content')

<!-- Page Content -->
    <div class="container">
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-9">

                <!-- Blog Post -->

                <!-- Title -->
                <h1>{{ $news->title }}</h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">Admin</a>
                </p>

                <!-- Preview Image -->
                <img class="img-responsive" src="upload/tintuc/{{ $news->image}}" alt="">

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> {{ $news->created_at}}</p>
                <hr>

                <!-- Post Content -->
                <p>{!! $news->content !!} </p>

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                {{-- @if(Auth::check())
                <div class="well">
                    @if(session('thongbao'))
                        <div class = "alert alert-success">
                            {{session('thongbao')}}    
                        </div>
                    @endif
                    <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                    <form action="comment/{{$news->id}}" method="POST" role="form">
                        {{csrf_field()}}
                        <div class="form-group">
                            <textarea class="form-control" name="content" rows="3"></textarea>
                        </div>
                        <button type="submit" name="submit-com" class="btn btn-primary">Gửi</button>
                    </form>
                </div> --}}

                <div class="well">
                    <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                    <form>
                        <div class="form-group">
                            <textarea class="form-control content" name="content" rows="3"></textarea>
                        </div>
                        <button type="submit" name="submit-com" class="btn btn-primary submit" data-comment_id = {{ $news->id }}>Gửi</button>
                    </form>
                </div>
                <hr>

                <!-- Posted Comments -->
               {{--  @endif --}}

                <!-- Comment -->
                @foreach( $news->comment as $val)
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        {{--  Do lien ket giua comment va user trong Comment.php --}}
                        <h4 class="media-heading" style="color: blue;">{{ $val->user->name}}
                            <small>{{ $val->created_at}}</small>
                        </h4>
                        {{ $val->content }}
                    </div>
                   {{--  Tra loi comment --}}
                    <div class="media-footer" >
                        {{-- <a href="">Trả lời</a>
                        <form action="" method="POST" role="form" style="margin-left: 75px;">
                            {{csrf_field()}}
                            <div class="form-group">
                                <textarea class="form-control" name="content" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary ">Gửi</button>
                        </form> --}}
                    </div>
                </div>
                @endforeach
               
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-3">

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin liên quan</b></div>
                    <div class="panel-body">
                        @foreach($related_news as $news)
                        <!-- item -->
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="news/{{$news->id}}/{{$news->name_without_accent}}.html">
                                    <img class="img-responsive" src="upload/tintuc/{{ $news->image }}" alt="">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a href="news/{{$news->id}}/{{$news->name_without_accent}}.html""><b>{{$news->title}}</b></a>
                            </div>
                            <p style="padding-left: 5px;">{{$news->summary}}</p>
                            <div class="break"></div>
                        </div>
                        <!-- end item -->
                        @endforeach

                       
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin nổi bật</b></div>
                    <div class="panel-body">

                        @foreach( $hotnews as $news)
                        <!-- item -->
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="news/{{$news->id}}/{{$news->name_without_accent}}.html">
                                    <img class="img-responsive" src="upload/tintuc/{{ $news->image }}" alt="">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a href="news/{{$news->id}}/{{$news->name_without_accent}}.html"><b>{{$news->title}}</b></a>
                            </div>
                            <p style="padding-left: 5px;">{{$news->summary}}</p>
                            <div class="break"></div>
                        </div>
                        <!-- end item -->
                        @endforeach
                    </div>
                </div>
                
            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->
@endsection

@section('script')
<script>
$(document).ready(function(){
    $(".submit").click(function(){
        content = $(".content").val();
        comment_id = $(this).data("comment_id");
        data = {
            content : content,
            comment_id : comment_id,
        },
        $.ajax({
            type: 'POST',
            url: "",
            data: data,
            success: function(data) {
                console.log(data);    
            },
            error: function(){
                //alert("error");
            }
        });
    });
});    
</script>

@endsection