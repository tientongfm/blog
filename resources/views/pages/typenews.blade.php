@extends('layout.index')

@section('content')
<div class="container">
        <div class="row">
        	@include('layout.menu')
            <div class="col-md-9 ">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:#337AB7; color:white;">
                        <h4><b>{{ $typenews->name }}</b></h4>
                    </div>

                    @foreach( $news as $value)
                    <div class="row-item row">
                        <div class="col-md-3">

                            <a href="detail.html">
                                <br>
                                <img width="200px" height="200px" class="img-responsive" src="upload/tintuc/{{$value->image}}" alt="">
                            </a>
                        </div>

                        <div class="col-md-9">
                            <h3>{{ $value->title }}</h3>
                            <p> {{ $value->summary }}</p>
                            <a class="btn btn-primary" href="news/{{$value->id}}/{{$value->name_without_accent}}.html">Xem thêm.. <span class="glyphicon glyphicon-chevron-right"></span></a>
                        </div>
                        <div class="break"></div>
                    </div>
                   @endforeach 

                   <div style="text-align: center;">
                       {{$news->links()}}
                   </div>
                   

                </div>
            </div> 

        </div>

    </div>
@endsection