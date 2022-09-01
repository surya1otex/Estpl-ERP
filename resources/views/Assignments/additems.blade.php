@extends('layouts.app')

@section('title', '| Clients/Schools')

@section('content')
<div class="app-title my-4">
    <div class="row">
        <div class='col-lg-12 col-lg-offset-12'>
          <h1><i class="fa fa-tags"></i> {{ $subTitle}}</h1>
        </div>
    </div>
</div>

<div class="row d-flex align-items-center">

<div class="col-md-12 animated fadeIn card p-3 new-assgn" id="assign-details">
            <h3>Item Details for : {{ $assignment->subject }}</h3>
            <hr>
            <div class="row">
                <div class="col-md-11">
                    <div class="row form-group">
                        <div class="col-md-4">
                            <label class="control-label">Select Item</label>
                            <input type="hidden" id="assgnment_id" value="{{ $assignment->id }} ">
                            <select class="form-control js-example-basic-single" name="product_id[]" id="item_id">
                                <option value="0"> Please select a Item </option>
                                @foreach($items as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Model Number</label>
                            <input type="text" class="form-control" name="model_number[]" id="model_id" placeholder="Enter Model Number">
                        </div>
                        <div class="col-md-4">
                        <label class="control-label">Location</label>
                        <select class="form-control" name="location" id="location">
                         <option value="0"> Please select a Item </option>
                          @foreach($locations as $location)
                           <option value="{{ $location->id }}">{{ $location->organisation_location_name }}</option>
                          @endforeach
                       </select>
                        </div>

                    </div>
                    <div class="row form-group">
                        <div class="col-md-3">
                            <label class="control-label">Seriel Number</label>
                            <input type="text" class="form-control" name="serial_number[]" id="serial_id" placeholder="Enter Seriel Number">
                        </div>
                        <div class="col-md-3">
                            <label class="control-label">Warrenty Issued Date</label>
                            <input type="date"class="form-control" id="issued_date_id" name="issued_date[]">
                        </div>  
                        <div class="col-md-3">
                          <label class="control-label">Warranty Expires</label>
                          <select id="warrenty_issue_id" class="form-control" name="issue_expires[]">
                            <option value="0" selected>Choose...</option>
                            <option value="1">1 yr</option> 
                            <option value="2">2 yrs</option>
                            <option value="3">3 yrs</option>
                            <option value="4">4 yrs</option>
                            <option value="5">5 yrs</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                          <label class="control-label">Distributor</label>
                          <input type="text" name="distributor" class="form-control" id="distributor" placeholder="Enter Distributor Name">
                   </div>
                </div>   
            </div>

        </div>
</div>

  </div>
  <div class="row">
        <div class="col-10 d-flex justify-content-center text-center">
         <button type="button" class="btn btn-primary" value="Add Item" onclick="addItems()">Add Item</button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <td>Product</td>
                                <td>Model</td>
                                <td>Location</td>
                                <td>Distributor</td>
                                <td>Serial number</td>
                                <td>Warranty Issued</td>
                                <td>Warranty Expires</td>
                            </tr>

                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
    //alert('All Set');
    //$('.js-example-basic-single').select2();

    fetchRecords();

})




function addItems() {
 var assignmentID = $("#assgnment_id").val();
 var productID = $("#item_id").val();
 var model = $("#model_id").val();
 var location = $("#location").val();
 var distributor = $("#distributor").val();
 var slno = $("#serial_id").val();
 var wariss = $("#issued_date_id").val();
 var warexp = $("#warrenty_issue_id").val();
 
 if(productID != '0' && model != '' && location != '' && slno != '' && wariss != '' && warexp != ''){

 $.ajax({
        url: '{{ url('assignments/additems') }}',
        type: 'POST',
        dataType: 'json',
        data: {
            productID: productID,
            assignmentID: assignmentID,
            model: model,
            location: location,
            distributor: distributor,
            slno: slno,
            warissue: wariss,
            warexp: warexp,
            "_token": "{{ csrf_token() }}"
        },
        success: function(response){
           // alert(response.product_id);
            console.log(response);
          //if(response > 0){
            //var id = response;
            var findnorecord = $('#sampleTable tr.norecord').length;

            if(findnorecord > 0){
             $('#sampleTable tr.norecord').remove();
            }
            var id = response[0].id;
            var product = response[0].product;
            var model = response[0].model;
            var location = response[0].location;
            var distributor = response[0].distributor;
            var slno = response[0].serial;
            var war_issue = response[0].war_issue;
            var war_exp = response[0].war_exp;
            var tr_str = "<tr>"+
            "<td>" + product + "</td>" +
            "<td>" + model + "</td>" +
            "<td>" + location + "</td>" +
            "<td>" + distributor + "</td>" +
            "<td>" + slno + "</td>" +
            "<td>" + war_issue + "</td>" +
            "<td>" + war_exp + "</td>" +
            "<td><input type='button' value='Remove' class='btn btn-danger delete' data-id='"+id+"' ></td>"+
            "</tr>";

            // $("#userTable tbody").append(tr_str);
            $("#sampleTable tbody").append(tr_str);

         // }else if(response == 0){
            //alert('Username already in use.');
          //}else{
            //alert(response);
          //}
          // Empty the input fields
           $("#item_id").val('0');
          // $("#item_id").select2("val", "");
           $('#model_id').val('');
           $('#location').val('0');
           $('#serial_id').val('');
           $('#warrenty_issue_id').val('0');
           $('#issued_date_id').val('');
        }

        });
      }
      else {
        alert('Fill all fields first');
      }

        //else 

}

$(document).on("click", ".delete" , function() {
  var delete_id = $(this).data('id');
  var el = this;
  $.ajax({
    url: '{{ url('assignments/delete_items/') }}' +'/'+ delete_id,
    type: 'get',
    success: function(response){
      $(el).closest( "tr" ).remove();
      alert(response);
    }
  });
});


// Fetch records
function fetchRecords(){
    var assignment_id = $("#assgnment_id").val();
  $.ajax({
    url: '{{ url('assignments/fetchitems') }}',
    type: 'POST',
    dataType: 'json',
    data:{
      assignmentID: assignment_id,
      "_token": "{{ csrf_token() }}"
    },
    success: function(response){
        console.log(response);
        
      var len = 0;
      $('#sampleTable tbody tr:not(:first)').empty(); // Empty <tbody>
      if(response != null){
        len = response.length;
      }

      if(len > 0){
        for(var i=0; i<len; i++){
          var id = response[i].id
          var product = response[i].product;
          var model = response[i].model;
          var location = response[i].location;
          var distributor = response[i].distributor;
          var slno = response[i].serial;
          var war_issue = response[i].war_issue;
          var war_exp = response[i].war_exp;
         // var serviceid = response[i].serviceids[i];
          
if(response[i].serviceids.includes(id)) {
  var sttus = 'disabled';
}
else {
  sttus = '';
}
          //alert(serviceid);
          var tr_str = "<tr>" +
          "<td>" +  product + "</td>" +
          "<td>" + model + "</td>" +
          "<td>" + location + "</td>" +
          "<td>" + distributor + "</td>" +
          "<td>" + slno + "</td>" +
          "<td>" + war_issue + "</td>" +
          "<td>" + war_exp + "</td>" +
          "<td><input type='button' value='Remove' class='btn btn-danger delete' "+sttus+" data-id='"+id+"' ></td>"+
          "</tr>";

          $("#sampleTable tbody").append(tr_str);

        }
      }else{
        var tr_str = "<tr class='norecord'>" +
        "<td align='center' colspan='4'>No Items found.</td>" +
        "</tr>";

        $("#sampleTable tbody").append(tr_str);
      }
     // alert(response[1].services);
    }
  });
}

//$('.js-example-basic-single').select2();
</script>
    


@endsection

@push('scripts')

@endpush

