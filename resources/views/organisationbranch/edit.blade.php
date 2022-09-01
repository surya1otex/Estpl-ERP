@extends('layouts.app')

@section('title', '| Add Organisation')

@section('content')

<div class="content">

 <form  enctype="multipart/form-data" action="" method="post">
         @csrf


   <div class="animated fadeIn card bidder-details-container">
	 <div class='col-lg-12 col-lg-offset-12 content'>

	    <h3><i class='fa fa-user-plus'></i> Edit Organisation</h3>
	    <hr>

	    <div class="form-row">
		          <div class="form-group col-md-12">
							    <label for="">Organisation Name</label>

							      <select name="organisation_name[]" id="company_name" class="form-control">
                        
                            <?php echo $organisations_dropdown; ?>
                    </select>

							    <!-- <input class="form-control" type="text" name="" value="{{$branchs[0]->organisation_name}}"> -->
				    
				     </div>
		      </div>
        
    </div>
  </div>
                      

@foreach($branchs  as $branch)


  <div class="animated fadeIn card">
	 <div class='col-lg-12 col-lg-offset-12 content'>


		       <div class="form-row">
		          <div class="form-group col-md-12">
				    <label for="">Organisation Branch Name</label>
				   <!--  <select name="organisation_branchname[]" id="company_branch_name" >
                        <option value='' selected >select..</option>
                            <?php echo $organisations_dropdown; ?>
                    </select> -->
				    <input type="text" class="form-control" name="organisation_branchname[]" id="company_branch_name" value="{{$branch->organisation_branchname}}" >

				    <input type="text" name="branch_id[]" id="branch_id" value="{{$branch->id}}"> 
				  </div> 
		      </div>

		      <div class="form-row">
			        <div class="form-group col-md-12">
					     <label for="">Branch Address</label>
					     <textarea class="form-control"  name="organisation_address" id="company_branch_address" >{{$branch->organisation_address}}</textarea>
					  </div> 
		      </div>   

		      <div class="form-row">
		          <div class="form-group col-md-4">
				     <label for="">Branch city</label>
				     <input type="text" class="form-control" name="organisation_city" id="company_branch_city"  value="{{$branch->organisation_city}}"> 
				  </div>

				  <div class="form-group col-md-4">
				     <label for="">Branch state</label>
				     <input type="text" class="form-control" name="organisation_state" id="company_branch_state"  value="{{$branch->organisation_state}}"> 
				  </div>


				  <div class="form-group col-md-4">
				     <label for="">Branch Pin</label>
				     <input type="text" class="form-control" name="organisation_pin" id="company_branch_pin"  value="{{$branch->organisation_pin}}"> 
				  </div> 
				 
		      </div>   

    </div>
  </div>

@endforeach
  <div class="animated fadeIn card">
	 <div class='col-lg-12 col-lg-offset-12 content'>

	 	<button type="submit" class="btn btn-primary" >Edit Organisation Branch</button>


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


