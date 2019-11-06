
@extends('layouts.style')
@section('title', '列表')
@section('content')
	
	<table border="1" class="table table-bordered table-hover table-striped">
		<tr>
			<td>id</td>
			<td>title</td>
			<td>content</td>
			<td>pdate</td>
			<td>img</td>
			<td>src</td>
			<td>pdate_src</td>
		</tr>
			@foreach($NewData as $k => $v)
				<tr>
					<td>{{$v->id}}</td>
					<td>{{$v->title}}</td>
					<td>{{$v->content}}</td>
					<td>{{$v->pdata}}</td>
					<td style="width: 100px;height: 100px;"><img src="{{$v->img}}"></td>
					<td>{{$v->src}}</td>
					<td>{{$v->pdate_src}}</td>
				</tr>
			@endforeach
	</table>
{{ $NewData->links() }}
<script src="/js/public.js"></script>
		<script type="text/javascript">
			var token=getCookie('token');

			console.log(token);
			if(!token){
				location.href="new/login";
			}
		</script>
@endsection