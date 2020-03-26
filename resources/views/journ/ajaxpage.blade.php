@foreach ($journInfo as $v)
			<tr>
				<th style="padding-left:20px;">{{$v->journ_id}}</th>
				<th>{{$v->journ_name}}</th>
				<th>{{$v->journ_man}}</th>
				<th>{{$v->cate_name}}</th>
				<th>{{date('Y-m-d H:i:s',$v->journ_time)}}</th>
				<th>
                <a href="{{url('/journ/edit/'.$v->journ_id)}}" class="btn btn-info">编辑</a>
                <a href="{{url('/journ/destroy/'.$v->journ_id)}}" class="btn btn-danger">删除</a>
                </th>
			</tr>
        @endforeach
		<tr><td colspan="6">{{$journInfo->links()}}</td></tr>