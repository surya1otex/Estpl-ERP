@extends('layouts.app')

@section('title', '| Categories')

@section('content')
<div class="app-title">
        <div>
            <h1><i class="fa fa-briefcase"></i> {{ $pageTitle }}</h1>
            <!-- <h3 class="tile-title">{{ $subTitle }}</h3> -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-10">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Item </th>
                                <th> Project Order</th>
                                <th> Status</th>
                                <!-- <th> Status </th> -->
                                <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                        $sl = 1;
                        print_r($assmntsdetails);
                        @endphp
                        @foreach ($services as $service)
                        <tr>
                          <td>{{ $sl }}</td>
                          <td>{{ $service->product->name }}</td>
                          <td>{{ $service->assignment->subject }}</td>
                          <td>{{ ($service->status == 0) ? 'Completed' : 'Pending' }}</td>
                           @if(in_array($service->id, $assmntsdetails))
                                  <td><a href="{{ route('assignment.edit.action', $service->id) }}" class="btn btn-sm btn-primary">Update Action</a></td>
                                @else
                                  <td><a href="{{ route('assignment.action', $service->id) }}" class="btn btn-sm btn-primary">Take Action</a></td>
                            @endif

                       </tr>
                       @php
                        $sl++
                        @endphp
                       @endforeach
</tbody>

</table>
</div>
</div>
</div>
</div>
@endsection