@extends('layouts.app')

@section('title', '| Categories')

@section('content')

<div class="app-title">
        <div>
            <h1><i class="fa fa-briefcase"></i> {{ $pageTitle }}</h1>
            <h3 class="tile-title">{{ $subTitle }}</h3>
            <p>{{ json_encode($sld_actions) }}</p>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                <button type="button" style="float:right" id="asggmnt" class="btn btn-info btn-lg asgbutton" data-toggle="modal" data-target="#myModal" disabled>Assign to Engineer</button>
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Item </th>
                                <th> Model</th>
                                <th>Serial Number</th>
                                <th>Warranty Issued On</th>
                                <th>Warranty Expires</th>
                                <th>Action</th>
                                <!-- <th> Status </th> -->
                                <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $cnt = 1;
                            print_r($sld_actions);
                            @endphp
                           @foreach ($assignments_details as $details)
                             <tr>
                                <td>{{ $cnt }}</td>
                                <td>{{ $details->product->name  }}</td>
                                <td>{{ $details->model }}</td>
                                <td>{{ $details->serial_number }}</td>
                                <td>{{ $details->war_issued_at }}</td>
                                <td>{{ $details->war_expires_at }}</td>
                                <td>
                                  <input type="checkbox" @if(in_array($details->id, $sld_actions) ) disabled checked @endif class="form-control chkasgg" id="slctuser_{{ $details->id }}" value="{{ $details->id }}" data-productid="{{ $details->product_id }}">
                              </td>
                                <td><a href="" class="btn btn-sm btn-primary">Task Pending</a>
                                <!-- <td>{{ ($details->status == 1) ? 'Pending': 'Done' }} -->
                                <!-- @if(in_array($details->id, $sld_actions))
                                  <td><a href="{{ route('assignment.edit.action', $details->id) }}" class="btn btn-sm btn-primary">Update Action</a></td>
                                @else
                                  <td><a href="{{ route('assignment.action', $details->id) }}" class="btn btn-sm btn-primary">Take Action</a></td>
                                @endif -->
                             </tr>
                             @php $cnt++; @endphp
                           @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
      <!-- Modal -->
      <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" id="modal">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Select a Service Engineer</h4>

        </div>
        <div class="modal-body">
        <select class="form-control" id="engineer_code">
           <option value="0">Choose Engineer</option>
           @foreach($users as $user)
              <option value="{{ $user->id }}">{{ $user->fullname }}</option>
            @endforeach
         </select>
         <input type="hidden" value="{{ $assignment->id }}" id="po-id">
        </div>
        <div class="modal-footer">
          <a href="#" class="btn btn-primary" onclick="assignto()" data-dismiss="modal">Assign</a>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script type="text/javascript">
    var assgnlists = {{ json_encode($sld_actions) }};
    console.log(assgnlists);
    
  // $('#slctuser_3').prop("checked", true);
  // $('#slctuser_3').prop("disabled", true);

  // $('#slctuser_4').prop("checked", true);
  // $('#slctuser_4').prop("disabled", true);

$(document).ready(function(){
  var chked = $(".chkasgg").is('[disabled]');
  
  
 // alert(chked);
});


  $('.chkasgg').change(function() 
  { 

    //alert($('.chkasgg:checked').length);
    if($('.chkasgg:checked').length || ($('.chkasgg').is(':disabled')) ){
        $('#asggmnt').prop("disabled", false);
    }
    else {
        $('#asggmnt').prop("disabled", true);
    }

  }); 


   var i = 0;
   var arr = [];
   var lists = [];
   var items = [];

   let _token   = $('meta[name="csrf-token"]').attr('content');
   let poid = $("#po-id").val();
   
//    $('.slctuser').each(function () {
//            arr[i++] = $(this).val();
//        });

if(arr.length > 1) {
  arr.splice(0, arr.length);
 }
$('.asgbutton').click(function(){
        //arr.splice(0,arr.length);
        //arr = [];
        
    $('.chkasgg:checked').each(function (i) {
       
      var assnval = $(this).val();
     // console.log(assgnlists);
      //alert(assnval);
      //alert(assgnlists);
      // alert(item_id);
           //arr[i++] = $(this).val();
           //console.log(i);

           if( !assgnlists.includes(Number(assnval)) ) {
            
            var item_id = $(this).data('productid');
            arr.push($(this).val());
            items.push(item_id);
            assgnlists.push($(this).val());
          //if( $(this).val() != assgnlists[i] ) {
          
          //alert('It not includes');

          //alert(assnval);

          //if(assgnlists.includes(assnval)) {

            //alert('it included it');
            //fruits.includes("Mango");


            // var item_id = $(this).data('productid');
            //  arr.push($(this).val());
            //  items.push(item_id);


          // }

         //  else {
            // alert(assgnlists);
           //}
        }

      
        //else {
         // alert('not includes');
        //}
      
        
       }); 

       console.log(arr);
})

function assignto() {

 // console.log(items);
  let engineer_code = $("#engineer_code").val();
  //console.log(arr);

  // if (confirm("Are You Sure want to Assign to this user ?")) {

    
      $.ajax({
        url: "{{ url('assignments/assign_user') }}",
        type:"POST",
        data:{
          taskids: arr,
          itemids: items,
          po_id:poid,
          engg_code:engineer_code,
          "_token": "{{ csrf_token() }}"
        },
        success:function(response){
         // alert(response.asnitms);
          //console.log(response);
          if(response) {

             for(let i =0; i < response.asnitms.length; i++) {
              //lists.push(response.asnitms[i]);

                 // alert(response.lists[i]);

                // console.log(lists);

               $('#slctuser_' + response.asnitms[i]).prop("disabled", true);
               $('#slctuser_' + response.lists[i]).removeClass("chkasgg");
               $('#slctuser_' + response.lists[i]).addClass("intro");
 
               var myIndex = arr.indexOf(response.asnitms[i]);
               var itemIndex = items.indexOf(response.asnitms[i]);
               // if (myIndex !== -1) {

                   arr.splice(myIndex, 1);
                   items.splice(itemIndex, 1);

               //}

               //alert(myIndex);
             }
             location.reload();
             //arr = ['1'];
          }
        },
        error: function(error) {
         console.log(error);
          // $('#nameError').text(response.responseJSON.errors.name);
        }
        
       });
       
      }
       

       //console.log('hello printed');
      // $('#sampleTable').DataTable();
  </script>
@endsection
@push('scripts')

@endpush