@extends('layouts.app')

@section('title', '| Add Role')

@section('content')
<div class="content">
  <div class="animated fadeIn card">
<div class='col-lg-4 col-lg-offset-4 content'>

    <h5><i class='fa fa-key'></i> Add Role</h5>
    <hr>

    {{ Form::open(array('url' => 'roles')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>

    <h5><b>Assign Permissions</b></h5>

    <div class='form-group'>
        @foreach ($permissions as $permission)
            {{ Form::checkbox('permissions[]',  $permission->id ) }}
            {{ Form::label($permission->name, ucfirst($permission->name)) }}<br>

        @endforeach
    </div>

    {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

    </div>
   </div>
 </div>
 <style>
.content {
    padding:25px;
}
</style>
@endsection