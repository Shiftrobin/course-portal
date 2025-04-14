@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{ route('add.budget') }}" class="btn btn-inverse-info">Add Budget</a>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">
                            All Budget
                        </h6>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Country</th>
                                        <th>University</th>
                                        <th>Campus</th>
                                        <th>Level</th>
                                        <th>Budget Range</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($budgets as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item['country']['name'] }}</td>
                                            <td>{{ $item['university']['name'] }}</td>
                                            <td>{{ $item['campus']['name'] }}</td>
                                            <td>{{ $item['level']['name'] }}</td>
                                            <td>{{ $item->range }}</td>
                                            <td>
                                                @if (Auth::user()->can('edit.budget'))
                                                    <a href="{{ route('edit.budget', $item->id) }}"
                                                        class="btn btn-inverse-warning">Edit</a>
                                                @endif
                                                @if (Auth::user()->can('delete.budget'))
                                                    <a href="{{ route('delete.budget', $item->id) }}"
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
