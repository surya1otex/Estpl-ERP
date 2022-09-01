@extends('layouts.app')

@section('title', '| Categories')

@section('content')

<div class="app-title">
    <div>
        <h1><i class="fa fa-briefcase"></i> {{ $pageTitle }}</h1>
        <h2 style="margin-top:20px"> {{ $pageSubtitle }}</h2>
        <h3 class="tile-title" style="color:red">{{ $subTitle }}</h3>
        <h4>Installation Count : {{ $job_details->counts }}</h4>
    </div>
</div>
<!-- <p>{{ print_r($actionlogs) }}</p> -->
<div class="row">
    <div class="col-md-6">

    <form action="{{ route('assignment.save.action') }}" method="POST" role="form" enctype="multipart/form-data">
      @csrf
        <div class="tile">
            <div class="form-group">
                <label class="control-label" for="status">Select Status</label>
                <input type="hidden" name="action_takenID" value="{{ $job_details->id }}">
                <input type="hidden" name="assignment_id" value="{{ $job_details->assignment_id }}">
                <input type="hidden" name="count_t_install" value="{{ $job_details->counts }}">
                <select class="form-control" name="update_status" id="upd_status_one">
                    <option value="0">Choose Status</option>
                    <option value="1" {{ ($action_details_list->update_status == 1) ? 'echo selected=selected' : '' }} >Partially Completed</option>
                    <option value="2" {{ ($action_details_list->update_status == 2) ? 'echo selected=selected' : '' }}>Fully Completed</option>
                </select>
            </div>
            <div class="form-group" id="count_lo_exx">
                <label class="control-label" for="counts">Comments</label>
                <input type="text" class="form-control" name="comments" value="{{ $action_details_list->comments }}"><label style="float:right; margin-top:10px; margin-bottom:10px"><button type="button" id="addimg" value="Add" class="btn btn-primary">Add More Images</button></label>
            </div>
            <div class="form-group" id="images-area">
                <label>Upload Photo</label>
                <input type="file" name="file[]" class="form-control">
                
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Update</button>
             </div>
             
        </div>
        <div class="form-group">
            @foreach($action_images as $acimages)
            <img src="{{ asset('storage/actionimages/'.$acimages->image) }}" height="75"/>
            @endforeach
          </div>
        </form>


</div>
<div class="col-md-6">
<table class="table">
<thead>
<tr>
   <th>Item</th>
   <th>Comments</th>
   <th>Update Status</th>
   <th>Image</th>
</tr>
</thead>
<tbody>
@foreach($actionlogs as $actnlog)
<tr>
    <td>{{ $actnlog->name }}</td>
    <td>{{ $actnlog->comments }}</td>
    <td>{{ ($actnlog->update_status == '1') ? 'Partially Done' : 'Completed' }}</td>
    <td>
      @if(!empty($actnlog->image))
        <image src="{{ asset('storage/actionimages/'.$actnlog->image) }}" height="100px" />
         @else
         <image src="https://upvidhansabhaproceedings.gov.in/upla-ind-theme/images/no_thumb.jpg" height="100px">
        @endif
    </td>
    <td></td>
</tr>
@endforeach
</tbody>
</table>
</div>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
$("#addimg").click(function(){
    var newrow = '<input type="file" name="file[]" class="form-control">';
    $("#images-area").append(newrow);
})
</script>
@endsection