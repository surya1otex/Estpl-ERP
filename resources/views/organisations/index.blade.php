@extends('layouts.app')

@section('title', '| Organisation Branch')

@section('content')
<div class="content">

     @if(Session::has('flash_message_error'))
                <div class="alert alert-error alert-block">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                    </button>
                <strong>{{ session('flash_message_error') }}</strong>
                </div>
                @endif
                @if(Session::has('flash_message_success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                    </button>
                <strong>{{ session('flash_message_success') }}</strong>
                </div>
          @endif
	    <div class="animated fadeIn">
		    <div class="col-lg-12">
		    <div class="card-box">
	    
	    <hr>
	    <div class="table-responsive">
	        <table class="table table-bordered table-striped">

	            <thead>
	                <tr>
	                    <th>Sl No</th>
	                    <th>Organisation Name</th>
	                    <th>Office City</th>
	                    <th>Office State</th>
	                    <th>Mailing Address</th>
	                    <th>Operations</th>
	                </tr>
	            </thead>

	            <tbody>

	            @php 
                $i = 1;
                @endphp

                @foreach ($organisations as $organisation)
                <tr>
                    <td> {{ $i }} </td>
                    <td>{{ $organisation->company_name }}</td>
                    <td>{{ $organisation->office_city }}</td>
                    <td>{{ $organisation->office_state }}</td>
                    <td>{{ $organisation->mailing_address }}</td>
                    <td>
                    <a href="{{url('/location-add/'.$organisation->id.'/addlocn/')}}" class="btn btn-info pull-left" style="margin-right: 3px;">Add Location</a>

                    </td>
                </tr>
                @php 
                $i++;
                @endphp
                @endforeach

	                 
	            </tbody>

	        </table>
	    </div>

       <a href="{{url('organisation-add')}}" class="btn btn-success">Add Organisation</a>
   
       <a  href="{{url('contactperson-add')}}" class="btn btn-success">Add Contact Person</a>
       
   </div>
  </div>
 </div>
</div>
<style>
	.card-box {
	    padding:20px;
	}
</style>
@endsection
