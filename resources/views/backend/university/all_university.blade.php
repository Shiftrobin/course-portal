@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{ route('add.university') }}" class="btn btn-inverse-info">Add University</a>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">
                            All University
                        </h6>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Country</th>
                                        <th>University</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($universities as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item['country']['name'] }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                @if ($item->status == '1')
                                                    <a href="{{route('university.status', $item->id)}}" class="btn btn-sm btn-success">Active</a>
                                                @else
                                                    <a href="{{route('university.status', $item->id)}}" class="btn btn-sm btn-danger">Inactive</a>
                                                @endif
                                            </td>   
                                            <td>
                                                @if (Auth::user()->can('edit.university'))
                                                    <a href="{{ route('edit.university', $item->id) }}"
                                                        class="btn btn-inverse-warning">Edit</a>
                                                @endif
                                                @if (Auth::user()->can('delete.university'))
                                                    <a href="{{ route('delete.university', $item->id) }}"
                                                        class="btn btn-inverse-danger" id="delete">Delete</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
