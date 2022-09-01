@extends('layouts.app')

@section('title', '| Add Organisation Branch')

@section('content')

<div class="content">

 <form  enctype="multipart/form-data" action="" method="post">
         {{csrf_field()}}

   <div class="animated fadeIn card bidder-details-container">
	 <div class='col-lg-12 col-lg-offset-12 content'>

	    <h3><i class='fa fa-user-plus'></i> Add Organisation Branch</h3>
	    <hr>
        
		       <div class="form-row">
		          <div class="form-group col-md-12">
				    <label for="">Organisation Name</label>
				    <select class="form-control" name="organisation_name" id="org_name">
                    <option value=''>select..</option>
                        @foreach($organisations as $branch)
                          <option value="{{$branch->id}}"
                            
                             >{{$branch->company_name}}</option>

                        @endforeach
                        </select> 
				  </div>
		      </div>
           
    </div>
  </div>


  <div class="animated fadeIn card">
	 <div class='col-lg-12 col-lg-offset-12 content'>


		       <div class="form-row">
		          <div class="form-group col-md-12">
				    <label for="">Organisation Branch Name</label>
				    <input type="text" class="form-control" name="organisation_branchname[]" id="company_branch_name"> 
				  </div>
				 
		      </div>


		      <div class="form-row">
		          <div class="form-group col-md-12">
				     <label for="">Branch Address</label>
				     <textarea class="form-control"  name="organisation_address[]" id="company_branch_address"></textarea>
				  </div>
				 
		      </div>

		      <div class="form-row">
		          <div class="form-group col-md-4">
				     <label for="">Branch city</label>
				     <input type="text" class="form-control" name="organisation_city[]" id="company_branch_city"> 
				  </div>

				  <div class="form-group col-md-4">
				     <label for="">Branch state</label>
				     <input type="text" class="form-control" name="organisation_state[]" id="company_branch_state"> 
				  </div>


				  <div class="form-group col-md-4">
				     <label for="">Branch Pin</label>
				     <input type="text" class="form-control" name="organisation_pin[]" id="company_branch_pin"> 
				  </div>
				 
		      </div>
		      <div class="form-row">

		          <button id="addusr_0" href="javascript:void(0);" type="button" class="btn btn-success issue-add"><i class="material-icons col-green">add</i></button>
             </div>

    </div>
  </div>

  <div class="animated fadeIn card">
	 <div class='col-lg-12 col-lg-offset-12 content'>

	 	<button type="submit" class="btn btn-primary" >Add Organisation Branch</button>


	 </div>
 </div>

 </form>

</div>

<style>
.content {
    padding:25px;
}
</style>


@endsection


