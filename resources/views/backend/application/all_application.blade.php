@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{ route('application.download') }}" class="btn btn-inverse-info">Download in Excel</a>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">
                            All Application
                        </h6>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Action</th>
                                        <th>Application Date And Time</th>
                                        <th>Name</th>
                                        <th>Nationality</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Qualification</th>
                                        <th>Message</th>
                                        <th>Course</th>
                                        <th>University</th>
                                        <th>Level</th>


                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($applications as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                @if (Auth::user()->can('show.application'))
                                                    <a href="{{ route('show.application', $item->id) }}"
                                                        class="btn btn-inverse-warning">Details</a>
                                                @endif
                                                @if (Auth::user()->can('delete.application'))
                                                    <a href="{{ route('delete.application', $item->id) }}"
                                                        class="btn btn-inverse-danger" id="delete">Delete</a>
                                                @endif
                                            </td>
                                            <td>{{ $item->created_at->format('D - d - M - Y - H:i:s') }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->nationality }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->qualification }}</td>
                                            <td>{{ $item->msg }}</td>
                                            <td>{{ $item->course }}</td>
                                            <td>{{ $item->university }}</td>
                                            <td>{{ $item->level }}</td>


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
