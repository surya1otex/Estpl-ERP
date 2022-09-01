@extends('layouts.app')

@section('content')
<div class="content">
  <div class="animated fadeIn">
    <div class='col-lg-12'>
       <img src="{{ asset('backend/images/alert.png') }}" class="alert">
        <h4><center>401<br>
        You are not authorized to access this page</center></h4>
    </div>
  </div>
</div>
<style>
.alert {
  display:block;
  margin:auto;
  height:100px;
}
</style>
@endsection
