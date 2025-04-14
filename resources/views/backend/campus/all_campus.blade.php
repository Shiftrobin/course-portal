@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{ route('add.campus') }}" class="btn btn-inverse-info">Add Campus</a>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">
                            All Campus
                        </h6>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Country</th>
                                        <th>University</th>
                                        <th>Campus</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($campus as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item['country']['name'] }}</td>
                                            <td>{{ $item['university']['name'] }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                @if (Auth::user()->can('edit.campus'))
                                                    <a href="{{ route('edit.campus', $item->id) }}"
                                                        class="btn btn-inverse-warning">Edit</a>
                                                @endif
                                                @if (Auth::user()->can('delete.campus'))
                                                    <a href="{{ route('delete.campus', $item->id) }}"
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
