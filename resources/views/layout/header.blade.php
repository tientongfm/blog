<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Laravel Tin Tức</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="{{ url('index') }}">Giới thiệu</a>
                    </li>
                    <li>
                        <a href="{{ url('contact') }}">Liên hệ</a>
                    </li>
                </ul>

                <form action="{{ url('search') }}" class="navbar-form navbar-left" role="search" >
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
			        <div class="form-group">
			          <input type="text" name="key" class="form-control" placeholder="Search">
			        </div>
			        <button type="submit" class="btn btn-default">Search</button>
			    </form>

			    <ul class="nav navbar-nav pull-right">
                    {{-- @if(Auth::user())
                        <li>
                            <a href="{{ url('user_register')}}">Đăng ký</a>
                        </li>
                        <li>
                            <a href="{{ url('user_login')}}">Đăng nhập</a>
                        </li>
                    @else
                        <li>
                        	<a>
                        		<span class ="glyphicon glyphicon-user"></span>
                        		 {{ Auth::user()->name }}
                        	</a>
                        </li>

                        <li>
                        	<a href="{{ url('user_logout')}}">Đăng xuất</a>
                        </li>
                    @endif --}}

                    @if(Auth::check())
                        <li>
                            <a href="{{ url('user')}}">
                                <span class ="glyphicon glyphicon-user"></span>
                                 {{ Auth::user()->name }}
                            </a>
                        </li>

                        <li>
                            <a href="{{ url('user_logout')}}">Đăng xuất</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ url('register')}}">Đăng ký</a>
                        </li>
                        <li>
                            <a href="{{ url('user_login')}}">Đăng nhập</a>
                        </li>
                    @endif
                </ul>
            </div>
            
            <!-- /.navbar-collapse -->
    </div>
     <!-- /.container -->
</nav>