<div class="col-md-3 ">
    <ul class="list-group" id="menu">
        <li href="#" class="list-group-item menu1 active">
        	Menu
        </li>

        @foreach( $category as $value)
            @if(count($value->typenews) > 0)
                <li href="#" class="list-group-item menu1">
                	{{$value->name}}
                </li>
                <ul>
                    @foreach( $value->typenews as $val)
            		<li class="list-group-item">
            			<a href="typenews/{{$val->id}}/{{$val->name_without_accent}}.html">{{$val->name}}</a>
            		</li>
                    @endforeach
                </ul>
            @endif
        @endforeach

    </ul>
</div>