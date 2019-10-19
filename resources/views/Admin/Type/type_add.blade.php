@extends('layouts.admin')

@section('title', 'type_add ADMIN')

@section('content')
    <div class="" align="center">
        <h1>Type   Create</h1>
    </div>
    <form class="form-horizontal" action="{{url('admin/type/add_do')}}" method="post">
        @csrf
        <div class="form-group" style="margin-top:30px;">
            <label for="inputEmail3" class="col-sm-2 control-label">type-name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="type_name" id="inputEmail3" placeholder="">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">CREATE</button>
            </div>
        </div>
    </form>
@endsection