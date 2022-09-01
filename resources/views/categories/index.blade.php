@extends('layouts.app')

@section('title', '| Categories')

@section('content')
<div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
            <a href="{{ route('categories.create') }}" class="btn btn-primary">Add Category</a>
        </div>
        
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Name </th>
                                <th> Slug </th>
                                <th class="text-center"> Parent </th>
                                <th class="text-center"> Image </th>
                                <th style="width:100px; min-width:100px;" class="text-center text-danger"><i class="fa fa-bolt"> </i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $index = 1;
                            @endphp
                            @foreach($categories as $category)
                                @if ($category->id != 1)
                                    <tr>
                                        <td>{{ $index }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td>{{ isset($category->parent) ? $category->parent->name : 'Unknown' }}</td>
                                        <td>
                                            @if($category->image != "")
                                            <img src="{{ asset('storage/'.$category->image) }}" height="60" width="60" />
                                             @else
                                               <img src="https://t4.ftcdn.net/jpg/00/89/55/15/360_F_89551596_LdHAZRwz3i4EM4J0NHNHy2hEUYDfXc0j.jpg" height="60" width="60" />
                                            @endif

                                        </td>

                                        <td class="text-center">
                                            <div class="btn-group" role="group" aria-label="Second group">
                                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                                <a href="{{ route('categories.delete', $category->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                                @php
                                $index++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection