@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{ route('add.course') }}" class="btn btn-inverse-info">Add Course</a>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">
                            All Course
                        </h6>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Course Name</th>
                                        <th>University</th>
                                        <th>Overview</th>
                                        <th>Fees</th>
                                        <th>Campus</th>
                                        <th>Budget Range</th>
                                        <th>Scholarship</th>
                                        <th>Level</th>
                                        <!--<th>Country</th>-->
                                        <!--<th>URL</th>-->
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($courses as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td style="text-wrap: balance;width:20%;">
                                               <a href="{{ route('home'); }}/apply/{{ $item['university']['slug'] }}/{{ $item->slug }}/{{ $item->id }}"
                                                  target="_blank"
                                                  class="text-white"> {{ $item->name }}
                                               </a>
                                               <p class="mt-2">
                                                @if (Auth::user()->can('edit.course'))
                                                        <a href="{{ route('edit.course', $item->id) }}"
                                                            class="text-white btn btn-xs btn-inverse-warning">Edit</a>
                                                @endif
                                                @if (Auth::user()->can('delete.course'))
                                                    <a href="{{ route('delete.course', $item->id) }}"
                                                        class="text-white btn btn-xs btn-inverse-danger" id="delete">Delete</a>
                                                @endif
                                                </p>
                                            </td>
                                            <td style="text-wrap: balance;width:20%;">{{ $item['university']['name'] }}</td>
                                            <td style="text-wrap: balance;width:10%;">
                                                @if ($item->overview > 0)
                                                    {{ 'Yes' }}
                                                @endif
                                                {{-- {!! \Illuminate\Support\Str::limit($item->overview,10) !!} --}}
                                            </td>
                                            <td style="text-wrap: balance;width:10%;">{{ $item->currency }} {{ $item->fees }}</td>
                                            <td style="text-wrap: balance;width:10%;">{{ $item['campus']['name'] }}</td>
                                            <td style="text-wrap: balance;width:10%;">{{ $item['budget']['range'] }}</td>
                                            <td style="text-wrap: balance;width:10%;">{{ $item->currency }} {{ $item->scholarship }} </td>
                                            <td style="text-wrap: balance;width:10%;">{{ $item['level']['name'] }}</td>
                                            {{--
                                            <td>{{ $item['country']['name'] }}</td
                                            <td> {{ route('home'); }}/apply/{{ $item['univesity']['slug'] }}/{{ $item->slug }}/{{ $item->id }} </td> --}}
                                            {{-- <td>
                                                @if (Auth::user()->can('edit.course'))
                                                    <a href="{{ route('edit.course', $item->id) }}"
                                                        class="btn btn-xs btn-inverse-warning">Edit</a>
                                                @endif
                                                @if (Auth::user()->can('delete.course'))
                                                    <a href="{{ route('delete.course', $item->id) }}"
                                                        class="btn btn-xs btn-inverse-danger" id="delete">Delete</a>
                                                @endif
                                            </td> --}}
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
