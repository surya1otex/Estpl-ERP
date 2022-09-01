@extends('layouts.app')

@section('title', '| Clients/Schools')

@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
    </div>
</div>
@include('partials.flash')

<form action="{{ route('assignment.store') }}" method="POST" role="form">
    <div class="row">
        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">{{ $subTitle }}</h3>
                @csrf
                <div class="tile-body">
                    <div class="form-group">
                        <label class="control-label" for="name">Assignment Subject <span class="m-l-5 text-danger">
                                *</span></label>
                        <input class="form-control @error('subject') is-invalid @enderror" type="text"
                            name="subject" value="{{ old('subject') }}" />
                        @error('client_name') {{ $message }} @enderror
                    </div>
                    <div id="app">
                        <block-component></block-component>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="description">Client Code</label>
                                <select name="client_id" id="client_id"
                                    class="form-control @error('client_id') is-invalid @enderror">
                                    <option value="0">Please Select</option>
                                    @foreach($clients as $client)
                                    <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                                    @endforeach
                                </select>
                                @error('client_id') {{ $message }} @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
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
                    <!-- <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="status"
                                                   name="status"
                                                />Status
                                        </label>
                                    </div>
                                </div> -->

                </div>
                <div class="tile-footer">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save
                        Assignment</button>
                    &nbsp;&nbsp;&nbsp;
                    <a class="btn btn-secondary" href="{{ route('clients.index') }}"><i
                            class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 newrow">
            <h3>Assignments Detail</h3>
            <div class="row">
                <div class="col-md-5">
                    <label class="control-label">Select Item</label>

                    <select name="new" id="hidden_item_fetch">
                        
                        @foreach($items as $st)
                        <option value="{{ $st->id }}">{{ $st->name }}</option>
                        @endforeach
                    </select>


                    <select class="form-control" name="product_id[]">
                        <option value="0"> Please select a Item </option>
                        @foreach($items as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5">
                    <label class="control-label">Item Count</label>
                    <input type="number" class="form-control" name="counts[]">
                </div>

                <div class="col-md-2 pt10">
                   <button type="button" name="Add" class="btn btn-primary assg-add"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
                </div>
            </div>
        </div>
    </div>
</form>

<style>
 .pt10 {
     padding-top:22px;
 }
 #hidden_item_fetch {
        display: none;
    }
 </style>

@endsection
