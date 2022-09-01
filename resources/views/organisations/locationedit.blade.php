@extends('layouts.app')

@section('title', '| Add Organisation')

@section('content')



<div class="content">
	<div class="row">
		<div class='col-lg-12 col-lg-offset-12'>
			<form  enctype="multipart/form-data" action="{{url('location-edit/'.$organisation_locations->id.'/editlocn/')}}" method="post">
				

				<div class="animated fadeIn card p-3 new-loc" id="add-loc">
					<h3><i class='fa fa-map-marker'></i> Add Locations</h3>
					<hr>
                {{csrf_field()}}
          

					<div class="row d-flex align-items-center">
						<div class="col-md-11">

							<div class="row form-group">
								<div class="col-md-6">
									<label for="add-location-name">Location Name</label>
									<input type="text" class="form-control" id="organisation_location_name" name="organisation_location_name" placeholder="Enter Location Name" value="{{$organisation_locations->organisation_location_name}}" >

									<input type="hidden" class="form-control" id="organisation_name" name="organisation_name" value="{{$organisation_locations->organisation_name}}">
								</div>
								<div class="col-md-6">
									<label for="inputlocationaddr">Location Address</label>
									<textarea class="form-control" id="organisation_address" name="organisation_address" rows="1" placeholder="Enter Location Address">{{$organisation_locations->organisation_address}}</textarea>
								</div>  
							</div>
							<div class="row form-group">
								<div class="col-md-4">
									<label for="cont-addr-city">City</label>
									<input class="form-control" type="text" id="organisation_city" name="organisation_city" placeholder="Enter Location City" value="{{$organisation_locations->organisation_city}}">
									 
								</div>
								<div class="col-md-4">
									<label for="cont-addr-state">State</label>
									<input class="form-control" type="text" id="organisation_state" name="organisation_state" placeholder="Enter Location State" value="{{$organisation_locations->organisation_state}}">
									 
								</div>
								<div class="col-md-4">
									<label for="add-location-pin">Pin</label>
									<input type="text" class="form-control" id="organisation_pin" name="organisation_pin" placeholder="Enter Location Pin" value="{{$organisation_locations->organisation_pin}}">
								</div>  
							</div>
						</div>
						
					</div>
				</div>
				<button type="submit" class="btn btn-primary">Edit Location</button>
			</form>
		</div>
	</div>
</div>



<div class="content">
	<div class="row">
		<div class='col-lg-12 col-lg-offset-12'>

			<div class="animated fadeIn card p-3">
                <h3><i class='fa fa-user-plus'></i> Location Details</h3>
					<hr>

                    <div class="container-fluid agent-page">
                      <div class="card border-0">
                        <article class="card-body r-card">
                          <div class="customer-query">
                            <div class="registration writable">
                               
                              <div class="row table-xxx">
                                <div class="col-md-12">
                                <div class="panel-body">
                            <div class="table-responsive">
                            <table id="subview_grid" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info">
                                           <th>SL No</th>
                                           <th>Location Name</th>
                                           <th>Location Address</th>
                                           <th>Location City</th>
                                           <th>Location State</th>
                                           <th>Location PIN</th>
                                           <th></th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                 	<?php $i=1; ?>
                                   <tr>


	                                   	@foreach($edit_locations as $submission)
	                                   	
	                                   	<td>{{ $i++ }}</td>
                                        <td>{{ $submission->organisation_location_name }}</td>
	                                   	<td>{{ $submission->organisation_address }}</td>
	                                   	<td>{{ $submission->organisation_city }}</td>
	                                   	<td>{{ $submission->organisation_state }}</td>
	                                   	<td>{{ $submission->organisation_pin }}</td>
	                                   	<td>
	                                   		<a href="{{url('/location-edit/'.$submission->id.'/editlocn/')}}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
	                                   	</td>
	                                  
                                   </tr>
                                  	@endforeach
                                  
                                 </tbody>
                              </table>
                           </div>
                        </div>
                                </div> 
                             
                            </div>
                          </div>
                        </article>
                      </div>
                   </div>


							</div>
						</div>
					</div>
				</div>
<style>
	.content {
		padding:25px;
	}
</style>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

 

@endsection