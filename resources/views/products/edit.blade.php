@extends('layouts.app')

@section('title', '| Categories')

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-shopping-bag"></i> {{ $pageTitle }} - {{ $subTitle }}</h1>
        </div>
    </div>
    @include('partials.flash')
    <div class="row user">
        <div class="col-md-9">
            <div class="tab-content">
                <div class="tab-pane active" id="general">
                    <div class="tile">
                        <form action="{{ route('products.update') }}" method="POST" role="form" enctype="multipart/form-data">
                            @csrf
                            <h3 class="tile-title">Product Information</h3>
                            <hr>
                            <div class="tile-body">
                                <div class="form-group">
                                    <label class="control-label" for="name">Name</label>
                                    <input
                                        class="form-control @error('name') is-invalid @enderror"
                                        type="text"
                                        placeholder="Enter attribute name"
                                        id="name"
                                        name="name"
                                        value="{{ old('name', $product->name) }}"
                                    />
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <div class="invalid-feedback active">
                                        <i class="fa fa-exclamation-circle fa-fw"></i> @error('name') <span>{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="sku">SKU</label>
                                            <input
                                                class="form-control @error('sku') is-invalid @enderror"
                                                type="text"
                                                placeholder="Enter product sku"
                                                id="sku"
                                                name="sku"
                                                value="{{ old('sku', $product->sku) }}"
                                            />
                                            <div class="invalid-feedback active">
                                                <i class="fa fa-exclamation-circle fa-fw"></i> @error('sku') <span>{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="brand_id">Vendor</label>
                                            <select name="vendor_id" id="vendor_id" class="form-control @error('vendor_id') is-invalid @enderror">
                                                <option value="0">Select a brand</option>
                                                @foreach($vendors as $vendor)
                                                    @if ($product->vendor_id == $vendor->id)
                                                        <option value="{{ $vendor->id }}" selected>{{ $vendor->name }}</option>
                                                    @else
                                                        <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback active">
                                                <i class="fa fa-exclamation-circle fa-fw"></i> @error('brand_id') <span>{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label" for="categories">Categories</label>
                                            <select name="category_id" id="categories" class="form-control">
                                                @foreach($categories as $category)


                                                    @if ($product->category_id == $category->id)
                                                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                                    @else
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endif

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="price">Price</label>
                                            <input
                                                class="form-control @error('price') is-invalid @enderror"
                                                type="text"
                                                placeholder="Enter product price"
                                                id="price"
                                                name="price"
                                                value="{{ old('price', $product->price) }}"
                                            />
                                            <div class="invalid-feedback active">
                                                <i class="fa fa-exclamation-circle fa-fw"></i> @error('price') <span>{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="quantity">Quantity</label>
                                            <input
                                                class="form-control @error('quantity') is-invalid @enderror"
                                                type="number"
                                                placeholder="Enter product quantity"
                                                id="quantity"
                                                name="quantity"
                                                value="{{ old('quantity', $product->quantity) }}"
                                            />
                                            <div class="invalid-feedback active">
                                                <i class="fa fa-exclamation-circle fa-fw"></i> @error('quantity') <span>{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="form-group">
                                     <label class="control-label">Product Image</label>
                                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" />
                                     @error('image') {{ $message }} @enderror
                                    </div>
                                    </div>
                                </div>


                                <!-- <div class="row">


                                </div> -->


                                <div class="form-group">
                                    <label class="control-label" for="description">Description</label>
                                    <textarea name="description" id="description" rows="8" class="form-control">{{ old('description', $product->description) }}</textarea>
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="status"
                                                   name="status"
                                                   {{ $product->status == 1 ? 'checked' : '' }}
                                                />Status
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="tile-footer">
                                <div class="row d-print-none mt-2">
                                    <div class="col-12 text-right">
                                        <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Product</button>
                                        <a class="btn btn-danger" href="{{ route('products.index') }}"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Go Back</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/select2.min.js') }}"></script>
    <script>
        $( document ).ready(function() {
            $('#categories').select2();
        });
    </script>
@endpush