@extends('layouts.app')

@section('title', '| Categories')

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
        @if($role == 'Admin')
        <a href="{{ route('assignment.create') }}" class="btn btn-primary pull-right">Create New Project Orders</a>
        @endif
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
                                <th>PO Subject </th>
                                <th>District </th>
                                <th class="text-center"> Block </th>
                                <th>Client Code</th>
                                <th>Status</th>
                                <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                            </tr>
                        </thead>
                        <tbody>
                             @php
                             $cnt = 1;
                             @endphp

                             @foreach($assignments as $assignment)

                                    <tr>
                                        <td>{{ $cnt }} </td>
                                        <td>{{ $assignment->subject }}</td>
                                        <td>{{ $assignment->district->district }}</td>
                                        <td>{{ $assignment->block->block }}</td>
                                        <td>{{ $assignment->organisation->company_name }}</td>
                                        <td>{{ ($assignment->status == 0) ? 'Completed' : 'Pending' }}</td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group" aria-label="Second group">
                                            <a href="{{ route('assignment.details', $assignment->id ) }}" class="btn btn-sm btn-primary">View Details</a>
                                            &nbsp; <a href="{{ route('assignment.add.items', $assignment->id) }}" class="btn btn-sm btn-primary">Add Items</a>
                                                <!-- @if($role == 'Admin')
                                                <a href="" class="btn btn-sm btn-primary">Modify</a>
                                                @else
                                                <a href="{{ route('assignment.details', $assignment->id ) }}" class="btn btn-sm btn-primary">View Details</a>
                                                @endif -->
                                            </div>
                                        </td>
                                    </tr>
                                 @php $cnt++; @endphp
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