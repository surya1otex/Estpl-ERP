@extends('layouts.app')

@section('title', '| Categories')

@section('content')

<div class="app-title">
    <div>
        <h1><i class="fa fa-briefcase"></i> {{ $pageTitle }}</h1>
        <h2 style="margin-top:20px"> {{ $pageSubtitle }}</h2>
        <h3 class="tile-title">{{ $subTitle }}</h3>
        <h4>Installation Count : {{ $job_details->counts }}</h4>
    </div>
</div>
<form action="{{ route('assignment.update.action') }}" method="POST" role="form" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <div class="tile">
                <div class="form-group">
                    <label class="control-label" for="status">Select Status</label>
                    <input type="hidden" name="action_takenID" value="{{ $job_details->id }}">
                    <input type="hidden" name="assignment_id" value="{{ $job_details->assignment_id }}">
                    <select class="form-control" name="update_status" id="upd_status">
                        <option value="0">Choose Status</option>
                        <option value="1">Partially Completed</option>
                        <option value="2">Fully Completed</option>
                    </select>
                </div>
                <div class="form-group" id="cntt_section">
                    <label class="control-label" for="counts">Comments</label>
                    <input type="text" class="form-control" name="comments"><label style="float:right; margin-top:10px; margin-bottom:10px"><button type="button" id="addimg" value="Add" class="btn btn-primary">Add More Images</button></label>
                </div>
                <div class="form-group" id="images-area">
                    <label>Upload Photo</label>
                    <input type="file" name="file[]" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
$("#addimg").click(function(){
    var newrow = '<input type="file" name="file[]" class="form-control">';
    $("#images-area").append(newrow);
})
</script>
@endsection