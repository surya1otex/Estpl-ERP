@extends('layouts.app')

@section('title', '| Categories')

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
            <h3>{{ $path }}</h3>
        </div>
        <a href="{{ route('products.create') }}" class="btn btn-primary pull-right">Add Product</a>
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
                            <th> SKU </th>
                            <th> Name </th>
                            <th class="text-center"> Vendor </th>
                            <th class="text-center"> Categories </th>
                            <th class="text-center"> Image </th>
                            <th class="text-center"> Price </th>
                            <th class="text-center"> Status </th>
                            <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->sku }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ isset($product->vendor) ? $product->vendor->name : 'Unknown' }}</td>
                                    <td>{{ isset($product->category) ? $product->category->name : 'Unknown' }}</td>
                                    <td><img src="{{ asset('storage/'.$product->image) }}" height="60"  /></td>
                                    <td>{{ $product->price }}</td>
                                    <td class="text-center">
                                        @if ($product->status == 1)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Not Active</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Second group">
                                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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