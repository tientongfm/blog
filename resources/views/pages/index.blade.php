@extends('layout.index')

@section('content')
 <!-- Page Content -->
<div class="container">

	@include('layout.slide')

        <div class="space20"></div>


    <div class="row main-left">
        @include('layout.menu')

        <div class="col-md-9">
            <div class="panel panel-default">            
            	<div class="panel-heading" style="background-color:#337AB7; color:white;" >
            		<h2 style="margin-top:0px; margin-bottom:0px;">Laravel Tin Tức</h2>
            	</div>

            	<div class="panel-body">
            		@foreach( $category as $value)
            		@if(count($value->typenews) > 0)
					    <div class="row-item row">
		                	<h3>
		                		<a href="category.html">{{ $value->name }}</a> | 
		                		@foreach( $value->typenews as $val)	
		                		<small><a href="typenews/{{$val->id}}/{{$val->name_without_accent}}.html"><i>{{ $val->name}}</i></a>/</small>
		                		@endforeach
		                	</h3>
		                	<?php
		                	//lay 5 tin noi bat trong the loai do
		                	//$data la 1 mang
		                	$data = $value->news->where('hotnews', 1)->sortByDesc('created_at')->take(5);
		                	//lay ra 1 tin noi bat de hien len
		                	//bien $data gio chi con co 4 tin
		                	$news1 = $data->shift();


		                	?>
		                	<div class="col-md-8 border-right">
		                		<div class="col-md-5">
			                        <a href="news/{{$news1['id']}}/{{$news1['name_without_accent']}}.html">
			                            <img class="img-responsive" src="upload/tintuc/{{$news1['image']}}" alt="">
			                        </a>
			                    </div>

			                    <div class="col-md-7">
			                        <h3>{{ $news1['title']}}</h3>
			                        <p>{{  $news1['summary']}}</p>
			                        <a class="btn btn-primary" href="news/{{$news1['id']}}/{{$news1['name_without_accent']}}.html">Xem thêm... <span class="glyphicon glyphicon-chevron-right"></span></a>
								</div>

		                	</div>
		                    

							<div class="col-md-4">
								@foreach($data->all() as $value)
								<a href="news/{{$news1['id']}}/{{$news1['name_without_accent']}}.html">
									<h4>
										<span class="glyphicon glyphicon-list-alt"></span>
										{{ $value['title']}}
									</h4>
								</a>					
								@endforeach			
							</div>
							
							<div class="break"></div>
		                </div>
		            @endif
	                @endforeach
				</div>
            </div>
    	</div>
    </div>
    <!-- /.row -->
</div>
<!-- end Page Content -->

@endsection