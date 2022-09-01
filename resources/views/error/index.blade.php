@extends('layouts.app')

@section('content')

<div class="content">
  <div class="animated fadeIn">
    <div class='col-lg-12'>
       <img src="{{ asset('backend/images/alert.png') }}" class="alert">
        <h3>You Requested a Wrong Information</h3>
    </div>
  </div>
</div>

@endsection