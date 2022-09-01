@extends('layouts.app')

@section('title', '| Edit Organisation')

@section('content')

<div class="content">

   <div class="animated fadeIn card">
	 <div class='col-lg-12 col-lg-offset-12 content'>

	    <h3><i class='fa fa-user-plus'></i> Edit Organisation</h3>
	    <hr>
        
        <form  enctype="multipart/form-data" action="{{url('organisation-edit/'.$updatorganisationDetails->id)}}" method="POST">
        
         @csrf
         @method('PUT')
          
           <div class="row form-group">
						<div class="col-md-6">
							<label for="">Organisation Name</label>
							<input type="text" class="form-control"name="company_name" id="company_name" placeholder="Enter Company Name" value="{{$updatorganisationDetails->company_name}}"> 
						</div>
						<div class="col-md-6">
							<label for="">Organisation Parent Name</label>
							<select class="form-control" name="company_parent_name">
								<option value="0">Select</option> 
								
							</select>

						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-6">
							<label for="">Office City</label>
							<input type="text" class="form-control" name="office_city" id="office_city" placeholder="Enter Office City" value="{{$updatorganisationDetails->office_city}}">
						</div>
						<div class="col-md-6">
							<label for="">Office State</label>
							<input type="text" class="form-control"  name="office_state" id="office_state" placeholder="Enter Office State" value="{{$updatorganisationDetails->office_state}}">
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-6">
							<label for="">Office Zip</label>
							<input type="text" class="form-control" name="office_pin" id="office_pin" placeholder="Enter Office Pin" value="{{$updatorganisationDetails->office_pin}}">
						</div>
						<div class="col-md-6">
							<label for="">Mailing Address</label>
							<input type="text" class="form-control"  name="mailing_address" id="mailing_address" placeholder="Enter Mailing Address" value="{{$updatorganisationDetails->mailing_address}}">
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-6">
							<label for="">Mailing City</label>
							<input type="text" class="form-control" name="mailing_city" id="mailing_city" placeholder="Enter Mailing City" value="{{$updatorganisationDetails->mailing_city}}">
						</div>
						<div class="col-md-6">
							<label for="">Mailing State</label>
							<input type="text" class="form-control" name="mailing_state" id="mailing_state"  placeholder="Enter Mailing State" value="{{$updatorganisationDetails->mailing_state}}">
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-6">
							<label for="">Mailing Zip</label>
							<input type="text" class="form-control" name="mailing_pin" id="mailing_pin" placeholder="Enter Mailing Zip" value="{{$updatorganisationDetails->mailing_pin}}">
						</div>
						<div class="col-md-6">
							<label for="">Company Fax</label>
							<input type="text" class="form-control" name="fax" id="fax" placeholder="Enter Company Fax" value="{{$updatorganisationDetails->fax}}">
						</div> 
					</div>
							<div class="row form-group">
								<div class="col-md-6">
									<label for="contact-per-name">Primary Contact Person Name</label>
									<input type="text" class="form-control" name="primary_contact_name" id="primary_contact_name" placeholder="Enter Name" value="{{$updatorganisationDetails->primary_contact_name}}">
								</div>
								<div class="col-md-6">
									<label for="contact-per-email">Primary Contact Person E-mail</label>
									<input type="email" class="form-control" name="primary_contact_email" id="primary_contact_email" placeholder="Enter E-mail id" value="{{$updatorganisationDetails->primary_contact_email}}">
								</div>  
							</div>
							<div class="row form-group">
								<div class="col-md-6">
									<label for="contact-per-phone">Primary Contact Person Phone</label>
									<input type="number" class="form-control" name="Primary_contact_phone" id="Primary_contact_phone" placeholder="Enter Phone No." value="{{$updatorganisationDetails->Primary_contact_phone}}">
								</div>
								<div class="col-md-6">
									<label for="contact-per-alt-phone">Primary Contact Person Alt-phone</label>
									<input type="number" class="form-control" name="Primary_contactalt_phone" id="Primary_contactalt_phone" placeholder="Enter Alt-phone No." value="{{$updatorganisationDetails->Primary_contactalt_phone}}">
								</div>  
							</div>
							<div class="row form-group">
								<div class="col-md-12">
									<label for="cont-addr">Primary Contact Person Address</label>
									<textarea class="form-control" id="Primary_contaddr" name="Primary_contaddr" rows="3" placeholder="Enter your Address">{{$updatorganisationDetails->Primary_contaddr}}</textarea> 
								</div>   
							</div>  
			
@foreach($updatorganisationlocationDetails as $updatestatus)

				<div class="animated fadeIn card p-3 new-loc" id="add-loc">
					<h3><i class='fa fa-map-marker'></i> Add Locations</h3>
					<hr>
					<div class="row d-flex align-items-center">
						<div class="col-md-11">

							<div class="row form-group">
								<div class="col-md-6">
									<label for="add-location-name">Location Name</label>
									<input type="text" class="form-control" id="organisation_location_name" name="organisation_location_name[]" placeholder="Enter Location Name" value="{{$updatestatus->organisation_location_name}}">
									<!-- <input type="text" class="form-control" value="{{$updatestatus->id}}"> -->
								</div>
								<div class="col-md-6">
									<label for="inputlocationaddr">Location Address</label>
									<textarea class="form-control" id="organisation_address" name="organisation_address[]" rows="1" placeholder="Enter Location Address">{{$updatestatus->organisation_address}}</textarea>
								</div>  
							</div>
							<div class="row form-group">
								<div class="col-md-4">
									<label for="cont-addr-city">City</label>
									<input class="form-control" type="text" id="organisation_city" name="organisation_city[]" placeholder="Enter Location City" value="{{$updatestatus->organisation_city}}">
									
								</div>
								<div class="col-md-4">
									<label for="cont-addr-state">State</label>
									<input class="form-control" type="text" id="organisation_state" name="organisation_state[]" placeholder="Enter Location State" value="{{$updatestatus->organisation_state}}">
									 
								</div>
								<div class="col-md-4">
									<label for="add-location-pin">Pin</label>
									<input type="text" class="form-control" id="organisation_pin" name="organisation_pin[]" placeholder="Enter Location Pin" value="{{$updatestatus->organisation_pin}}">
								</div>  
							</div>
						</div>
						<div class="col-md-1 text-right">
							<button type="button" name="Add" class="btn btn-primary assg-add"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
						</div>
					</div>
				</div>
		    @endforeach 
        	<button type="submit" class="btn btn-primary">Edit Organisation</button>

        </form>
	

    </div>
  </div>
</div>
<style>
.content {
    padding:25px;
}
</style>
@endsection