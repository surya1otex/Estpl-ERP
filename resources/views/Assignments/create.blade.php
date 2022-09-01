@extends('layouts.app')

@section('title', '| Clients/Schools')

@section('content')
<div class="app-title my-4">
    <div class="row">
        <div class='col-lg-12 col-lg-offset-12'>
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
        </div>
    </div>
</div>
@include('partials.flash')

<div class="content pb-4">
    <div class="row">
        <div class='col-lg-12 col-lg-offset-12'>
            <form action="{{ route('assignment.store') }}" method="POST" role="form">
                  @csrf
                <div class="animated fadeIn card p-3">

                    <h3><!-- <i class='fa fa-user-plus'></i>  -->{{ $subTitle }}</h3>
                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label" for="name">Order Subject <span class="m-l-5 text-danger">
                                *</span></label>
                                <input class="form-control @error('subject') is-invalid @enderror" type="text"
                                name="subject" value="{{ old('subject') }}" />
                                @error('client_name') {{ $message }} @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="app">
                                <block-component></block-component>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="description">Orgasination Code</label>
                                <select name="client_id" id="client_id"
                                class="form-control @error('client_id') is-invalid @enderror">
                                <option value="0">Please Select</option>
                                @foreach($clients as $client)
                                <option value="{{ $client->id }}">{{ $client->company_name }}</option>
                                @endforeach
                            </select>
                            @error('client_id') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="col-md-6" style="display:none">
                        <div class="form-group">
                            <label class="control-label" for="description">User Code</label>
                            <select name="user_id" id="user_id"
                            class="form-control @error('user_id') is-invalid @enderror">
                            <option value="0">Please Select</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->fullname }}</option>
                            @endforeach
                        </select>
                        @error('user_id') {{ $message }} @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="tile-footer row">
        <div class="col-md-12">
            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Project Order</button>
            &nbsp;&nbsp;&nbsp;
            <a class="btn btn-secondary" href="{{ route('clients.index') }}"><i
                class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
            </div>
        </div>
    </form>
</div>
</div>
</div>


<style>
   .pt10 {
       padding-top:22px;
   }
   #hidden_item_fetch {
    display: none;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">

    //add locations
    $("#assign-details .assg-add").click(function() {

        $("#assign-details").append(

            '<div id="assign-create-row"><hr><div class="row d-flex align-items-center"><div class="col-md-11"><div class="row form-group"><div class="col-md-6"><label class="control-label">Select Item</label><select class="form-control" name="product_id[]"><option value="0">Please select an Item</option>'+optionValues+'</select></div><div class="col-md-6"><label class="control-label">Model Number</label><input type="text" class="form-control" name="model_number[]" id="model-id" placeholder="Enter Model Number"></div></div><div class="row form-group"><div class="col-md-4"><label class="control-label">Seriel Number</label><input type="text" class="form-control" name="serial_number[]" id="seriel-id" placeholder="Enter Seriel Number"></div><div class="col-md-4"><label class="control-label">Warrenty Issued Date</label><input type="date"class="form-control" id="issued-date-id" name="issued_date[]"></div><div class="col-md-4"><label class="control-label">Warranty Expires</label><select id="warrenty-issue-id" name="issue_expires[]" class="form-control"><option selected>Choose...</option><option value="1">1 yr</option><option value="2">2 yrs</option><option value="3">3 yrs</option><option value="4">4 yrs</option><option value="5">5 yrs</option></select></div></div></div><div class="col-md-1 text-right"><button type="button" name="Add" class="btn btn-danger issue-remove"><i class="fa fa-minus-circle" aria-hidden="true"></i></button></div></div></div>'

            );

    });

    $("body").on("click", "#assign-details .issue-remove", function() {

        $(this).closest('#assign-create-row').remove();

    });

</script>

@endsection
