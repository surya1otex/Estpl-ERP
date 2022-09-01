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
                   
                    <td>
                    <a href="{{url('/edit-organisationbranch/'.$organisation->id)}}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

      
                    </td>
                </tr>
                @php 
                $i++;
                @endphp
                @endforeach

	                <!-- <tr>
	                    <td>1</td>
	                    <td>TCS</td>
	                    <td><a href="" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a></td>
	                </tr>
	                <tr>
	                    <td>2</td>
	                    <td>E-square</td>
	                    <td><a href="" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a></td>
	                </tr>
	                <tr>
	                    <td>3</td>
	                    <td>Infosys</td>
	                    <td><a href="" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a></td>
	                </tr> -->
	               
	            </tbody>

	        </table>
	    </div>

      <a href="{{url('Add-branch')}}" class="btn btn-success">Add Organisation Branch</a>
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
