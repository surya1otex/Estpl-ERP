@extends('layouts.app')

@section('title', '| Categories')

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
        <a href="{{ route('clients.create') }}" class="btn btn-primary pull-right">Add Client/School</a>
    </div>
    @include('partials.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Client's Name </th>
                                <th> District </th>
                                <th class="text-center"> Block </th>
                                <th class="text-center"> Email </th>
                                <th class="text-center"> Phone </th>
                                <th class="text-center"> Contact name </th>
                                <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clients as $client)

                                    <tr>
                                        <td>{{ $client->id }}</td>
                                        <td>{{ $client->client_name }}</td>
                                        <td>{{ $client->district->district }}</td>
                                        <td>{{ $client->block->block }}</td>
                                        <td class="text-center">{{ $client->email }}</td>
                                        <td class="text-center">{{ $client->phone }}</td>
                                        <td class="text-center">{{ $client->contact_name }}</td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group" aria-label="Second group">
                                                <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                                <a href="{{ route('clients.delete', $client->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
@endpush