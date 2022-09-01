@extends('layouts.app')

@section('title', '| Clients/Schools')

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
        </div>
    </div>
    @include('partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">{{ $subTitle }}</h3>
                <form action="{{ route('clients.store') }}" method="POST" role="form">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="name">Clients's Name/School <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('client_name') is-invalid @enderror" type="text" name="client_name"  value="{{ old('client_name', $client->client_name) }}" />
                            @error('client_name') {{ $message }} @enderror
                        </div>
                        <div id="app">
                         <example-component :clientid="{{ $client->id }}"></example-component>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="description">Email</label>
                            <input class="form-control @error('email') is-invalid @enderror" type="text" name="email"  value="{{ old('email', $client->email) }}"/>
                            @error('email') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="description">Phone</label>
                            <input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" " value="{{ old('phone', $client->phone) }}"/>
                            @error('phone') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="description">Contact Person name</label>
                            <input class="form-control @error('contact_name') is-invalid @enderror" type="text" name="contact_name"  value="{{ old('contact_name', $client->contact_name) }}"/>
                            @error('contact_name') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="status"
                                                   name="status"
                                                />Status
                                        </label>
                                    </div>
                                </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Client</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('clients.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection