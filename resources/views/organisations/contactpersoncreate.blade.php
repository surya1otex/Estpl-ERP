@extends('layouts.app')

@section('title', '| Add Organisation')

@section('content')

<div class="content">
	<div class="row">
		<div class='col-lg-12 col-lg-offset-12'>
			<form  enctype="multipart/form-data" action="{{url('contactperson-add')}}" method="post">
				<div class="animated fadeIn card p-3">
					<h3><i class='fa fa-address-card'></i> Select Address</h3>
					<hr>

					{{csrf_field()}}
					<div class="row form-group">
						<div class="col-md-6">
							<label for="cont-org-list">Organization Name</label>
							<select class="form-control" id="organisation_name" name="organisation_name">
								<option value="0">Select</option> 
								@foreach ($organisation as $key => $value)
	                      <option value="{{ $key }}">{{ $value }}</option>
	                     @endforeach
							</select>
						</div>
						<div class="col-md-6">
							<label for="cont-addr-list">Organization Address</label>
							<select class="form-control" id="organisation_address"
							name="organisation_address">
							 <option value='' >select..</option>
								
							</select> 
						</div>
					</div>
				</div>

				<div class="animated fadeIn card p-3 new-addr" id="add-addr">
					<h3><i class='fa fa-address-card'></i> Add Contact Person Details</h3>
					<hr>
					<div class="row d-flex align-items-center">
						<div class="col-md-11">
							<div class="row form-group">
								<div class="col-md-6">
									<label for="contact-per-name">Contact Person Name</label>
									<input type="text" class="form-control" name="organisation_contact_name[]" id="organisation_contact_name" placeholder="Enter Name" required>
								</div>
								<div class="col-md-6">
									<label for="contact-per-email">Contact Person E-mail</label>
									<input type="email" class="form-control" name="organisation_contact_email[]" id="organisation_contact_email" placeholder="Enter E-mail id">
								</div>  
							</div>
							<div class="row form-group">
								<div class="col-md-6">
									<label for="contact-per-phone">Contact Person Phone</label>
									<input type="number" class="form-control" name="organisation_contact_phone[]" id="organisation_contact_phone" placeholder="Enter Phone No.">
								</div>
								<div class="col-md-6">
									<label for="contact-per-alt-phone">Contact Person Alt-phone</label>
									<input type="number" class="form-control" name="organisation_contact_altphone[]" id="organisation_contact_altphone" placeholder="Enter Alt-phone No.">
								</div>  
							</div>
							<div class="row form-group">
								<div class="col-md-12">
									<label for="cont-addr">Contact Person Address</label>
									<textarea class="form-control" id="organisation_contact_address" name="organisation_contact_address[]" rows="1" placeholder="Enter your Address"></textarea> 
								</div>   
							</div>    
						</div>
						
					</div>
				</div>

				<button type="submit" class="btn btn-primary">Add Contact Person</button>
			</form>
		</div>
	</div>
</div>


<div class="content">
	<div class="row">
		<div class='col-lg-12 col-lg-offset-12'>

			<div class="animated fadeIn card p-3">
                <h3><i class='fa fa-user-plus'></i> Contact Person Details</h3>
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
                                           <th>Contact Person Name</th>
                                           <th>Contact Person E-mail</th>
                                           <th>Contact Person Phone</th>
                                           <th>Contact Person Alt-phone</th>
                                           <th>Contact Person Address</th>
                                           <th></th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                 	<?php $i=1; ?>
                                   <tr>

	                                   	@foreach($organisation_contact_infos as $submission)
	                                   	
	                                   	<td>{{ $i++ }}</td>
                                       <td>{{ $submission->organisation_contact_name }}</td>
	                                   	<td>{{ $submission->organisation_contact_email }}</td>
	                                   	<td>{{ $submission->organisation_contact_phone }}</td>
	                                   	<td>{{ $submission->organisation_contact_altphone }}</td>
	                                   	<td>{{ $submission->organisation_contact_address }}</td>
	                                   	<td>
	                                   		<a href="" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>
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

<script type="text/javascript">
    jQuery(document).ready(function ()
    {
            jQuery('select[name="organisation_name"]').on('change',function(){
               var countryID = jQuery(this).val();
               if(countryID)
               {
                  jQuery.ajax({
                     url : 'contactperson-add/getaddress/' +countryID,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('select[name="organisation_address"]').empty();
                        $('select[name="organisation_address"]').html('<option value="">Select Organisation Address</option>');
                        jQuery.each(data, function(key,value){
                           $('select[name="organisation_address"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="organisation_address"]').empty();
               }
            });
    });
    </script>
<!-- <script type="text/javascript">

	$("#add-addr .assg-add").click(function() {

		$("#add-addr").append(

			'<div id="addr-create-row"><hr><div class="row d-flex align-items-center"><hr><div class="col-md-11"><div class="row form-group"><div class="col-md-6"><label for="contact-per-name">Contact Person Name</label><input type="text" class="form-control" name="organisation_contact_name[]" id="organisation_contact_name" placeholder="Enter Name" required></div><div class="col-md-6"><label for="contact-per-email">Contact Person E-mail</label><input type="email" class="form-control" name="organisation_contact_email[]" id="organisation_contact_email" placeholder="Enter E-mail id"></div></div><div class="row form-group"><div class="col-md-6"><label for="contact-per-phone">Contact Person Phone</label><input type="number" class="form-control" name="organisation_contact_phone[]" id="organisation_contact_phone" placeholder="Enter Phone No."></div><div class="col-md-6"><label for="contact-per-alt-phone">Contact Person Alt-phone</label><input type="number" class="form-control" name="organisation_contact_altphone[]" id="organisation_contact_altphone" placeholder="Enter Alt-phone No."></div></div><div class="row form-group"><div class="col-md-12"><label for="cont-addr">Contact Person Address</label><textarea class="form-control" id="organisation_contact_address" name="organisation_contact_address[]" rows="1" placeholder="Enter your Address"></textarea></div></div></div><div class="col-md-1 text-right"><button type="button" name="Add" class="btn btn-danger issue-remove"><i class="fa fa-minus-circle" aria-hidden="true"></i></button></div></div></div>'

			);

	});

	$("body").on("click", "#add-addr .issue-remove", function() {

		$(this).closest('#addr-create-row').remove();

	});
</script> -->
@endsection