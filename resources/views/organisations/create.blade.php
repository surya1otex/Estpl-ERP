@extends('layouts.app')

@section('title', '| Add Organisation')

@section('content')



<div class="content">
	<div class="row">
		<div class='col-lg-12 col-lg-offset-12'>
			<form  enctype="multipart/form-data" action="{{url('organisation-add')}}" method="post">
				<div class="animated fadeIn card p-3">

					<h3><i class='fa fa-user-plus'></i> Add Organisation</h3>
					<hr>

					{{csrf_field()}}


					<div class="row form-group">
						<div class="col-md-6">
							<label for="">Organisation Name</label>
							<input type="text" class="form-control"name="company_name" id="company_name" placeholder="Enter Company Name" required> 
						</div>
						<div class="col-md-6">
							<label for="">Organisation Parent Name</label>
							<select class="form-control" name="company_parent_name">
								<option value="0">Select</option> 
								@foreach ($organisations as $organisation)
									<option value="{{ $organisation->id }}">{{ $organisation->company_name }}</option>
								@endforeach
							</select>

						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-6">
							<label for="">Office City</label>
							<input type="text" class="form-control" name="office_city" id="office_city" placeholder="Enter Office City">
						</div>
						<div class="col-md-6">
							<label for="">Office State</label>
							<input type="text" class="form-control"  name="office_state" id="office_state" placeholder="Enter Office State">
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-6">
							<label for="">Office Zip</label>
							<input type="text" class="form-control" name="office_pin" id="office_pin" placeholder="Enter Office Pin">
						</div>
						<div class="col-md-6">
							<label for="">Mailing Address</label>
							<input type="text" class="form-control"  name="mailing_address" id="mailing_address" placeholder="Enter Mailing Address">
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-6">
							<label for="">Mailing City</label>
							<input type="text" class="form-control" name="mailing_city" id="mailing_city" placeholder="Enter Mailing City">
						</div>
						<div class="col-md-6">
							<label for="">Mailing State</label>
							<input type="text" class="form-control" name="mailing_state" id="mailing_state"  placeholder="Enter Mailing State">
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-6">
							<label for="">Mailing Zip</label>
							<input type="text" class="form-control" name="mailing_pin" id="mailing_pin" placeholder="Enter Mailing Zip">
						</div>
						<div class="col-md-6">
							<label for="">Company Fax</label>
							<input type="text" class="form-control" name="fax" id="fax" placeholder="Enter Company Fax">
						</div> 
					</div>
							<div class="row form-group">
								<div class="col-md-6">
									<label for="contact-per-name">Primary Contact Person Name</label>
									<input type="text" class="form-control" name="primary_contact_name" id="primary_contact_name" placeholder="Enter Name">
								</div>
								<div class="col-md-6">
									<label for="contact-per-email">Primary Contact Person E-mail</label>
									<input type="email" class="form-control" name="primary_contact_email" id="Primarycontact_email" placeholder="Enter E-mail id">
								</div>  
							</div>
							<div class="row form-group">
								<div class="col-md-6">
									<label for="contact-per-phone">Primary Contact Person Phone</label>
									<input type="number" class="form-control" name="Primary_contact_phone" id="Primary_contact_phone" placeholder="Enter Phone No.">
								</div>
								<div class="col-md-6">
									<label for="contact-per-alt-phone">Primary Contact Person Alt-phone</label>
									<input type="number" class="form-control" name="Primary_contactalt_phone" id="Primary_contactalt_phone" placeholder="Enter Alt-phone No.">
								</div>  
							</div>
							<div class="row form-group">
								<div class="col-md-12">
									<label for="cont-addr">Primary Contact Person Address</label>
									<textarea class="form-control" id="Primary_contaddr" name="Primary_contaddr" rows="3" placeholder="Enter your Address"></textarea> 
								</div>   
							</div>  
				</div>

				<!-- <div class="animated fadeIn card p-3 new-loc" id="add-loc">
					<h3><i class='fa fa-map-marker'></i> Add Locations</h3>
					<hr>
					<div class="row d-flex align-items-center">
						<div class="col-md-11">

							<div class="row form-group">
								<div class="col-md-6">
									<label for="add-location-name">Location Name</label>
									<input type="text" class="form-control" id="organisation_location_name" name="organisation_location_name[]" placeholder="Enter Location Name" required>
								</div>
								<div class="col-md-6">
									<label for="inputlocationaddr">Location Address</label>
									<textarea class="form-control" id="organisation_address" name="organisation_address[]" rows="1" placeholder="Enter Location Address"></textarea>
								</div>  
							</div>
							<div class="row form-group">
								<div class="col-md-4">
									<label for="cont-addr-city">City</label>
									<input class="form-control" type="text" id="organisation_city" name="organisation_city[]" placeholder="Enter Location City">
									 
								</div>
								<div class="col-md-4">
									<label for="cont-addr-state">State</label>
									<input class="form-control" type="text" id="organisation_state" name="organisation_state[]" placeholder="Enter Location State">
									 
								</div>
								<div class="col-md-4">
									<label for="add-location-pin">Pin</label>
									<input type="text" class="form-control" id="organisation_pin" name="organisation_pin[]" placeholder="Enter Location Pin">
								</div>  
							</div>
						</div>
						<div class="col-md-1 text-right">
							<button type="button" name="Add" class="btn btn-primary assg-add"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
						</div>
					</div>
				</div> -->
				<button type="submit" class="btn btn-primary">Add Organisation</button>
			</form>
		</div>
	</div>
</div>

<!-- <div class="content">
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
                                        
                                     </tr>
                                 </thead>
                                 <tbody>
                                 	<?php $i=1; ?>
                                   <tr>
	                                   	@foreach($organisation_locations as $submission)
	                                   	
	                                   	<td>{{ $i++ }}</td>
	                                   	<td>{{ $submission->organisation_location_name }}</td>
	                                   	<td>{{ $submission->organisation_address }}</td>
	                                   	<td>{{ $submission->organisation_city }}</td>
	                                   	<td>{{ $submission->organisation_state }}</td>
	                                   	<td>{{ $submission->organisation_pin }}</td>

	                                   
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
</div> -->


<style>
	.content {
		padding:25px;
	}
</style>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

 
<!-- <script type="text/javascript">

	
	$("#add-loc .assg-add").click(function() {

		$("#add-loc").append(

			'<div id="loc-create-row"><hr><div class="row d-flex align-items-center"><div class="col-md-11"><div class="row form-group"><div class="col-md-6"><label for="add-location-name">Location Name</label><input type="text" class="form-control" id="organisation_location_name" name="organisation_location_name[]" placeholder="Enter Location Name" required></div><div class="col-md-6"><label for="inputlocationaddr">Location Address</label><textarea class="form-control" id="organisation_address" name="organisation_address[]" rows="1" placeholder="Enter Location Address"></textarea></div></div><div class="row form-group"><div class="col-md-4"><label for="cont-addr-city">City</label><input type="text" class="form-control" id="organisation_city" name="organisation_city[]" placeholder="Enter Location City"> </div><div class="col-md-4"><label for="cont-addr-state">State</label><input type="text" class="form-control" id="organisation_state" name="organisation_state[]" placeholder="Enter Location State"></div><div class="col-md-4"><label for="add-location-pin">Pin</label><input type="text" class="form-control"  id="organisation_pin" name="organisation_pin[]" placeholder="Enter Location Pin"></div></div></div><div class="col-md-1 text-right"><button type="button" name="Add" class="btn btn-danger issue-remove"><i class="fa fa-minus-circle" aria-hidden="true"></i></button></div></div></div>'

			);

	});

	$("body").on("click", "#add-loc .issue-remove", function() {

		$(this).closest('#loc-create-row').remove();

	});

</script> -->
@endsection