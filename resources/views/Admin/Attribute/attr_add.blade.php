@extends('layouts.admin')

@section('title', 'attr_add ADMIN')

@section('content')
    <div class="" align="center">
        <h1>Attr   Create</h1>
    </div>
    <form class="form-horizontal" action="{{url('admin/attr/add_do')}}" method="post">
        @csrf
        <div class="form-group" style="margin-top:30px;">
            <label for="inputEmail3" class="col-sm-2 control-label">attr-name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="attr_name" id="inputEmail3" placeholder="">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">所属类型</label>
            <div class="col-sm-10">
                <select name="attr_pid" class="form-control">

                    @foreach($type_info as $k=>$v)
                        <option value="{{$v['type_id']}}">{{$v['type_name']}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">属性是否可选</label>
            <div class="col-sm-10">
                <input type="radio" value='1' name="optional" id="">参数
                <input type="radio" value='2' name="optional" id="">规格
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">CREATE</button>
            </div>
        </div>
    </form>
@endsection