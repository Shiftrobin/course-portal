@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">              
                    <a href="{{ route('add.homeseo') }}" class="btn btn-inverse-info">Add SEO Properties</a>            

            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">
                            All Page SEO
                        </h6>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Page Name</th>
                                        <th>Title</th>
                                        <th>Share Title</th>
                                        {{-- <th>Description</th>
                                        <th>Keywords</th> --}}
                                        <th>Page Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($homeseo as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->page_name }}</td>
                                        <td>{{ $item->title }}</td>
                                        {{-- <td>{{ $item->share_title }}</td>
                                        <td>{{ $item->description }}</td> --}}
                                        <td>{{ $item->keywords }}</td>
                                        <td><img src="{{(!empty($item->page_image))?url('public/upload/home_seo/'.$item->page_image):url('public/upload/no_image.jpg')}}"
                                            style="width: 50px; height: 50px; border:1px solid #000;" alt="{{ $item->title }}"></td>
                                           <td>
                                           @if (Auth::user()->can('edit.homeseo'))
                                           <a href="{{ route('edit.homeseo', $item->id) }}"
                                                            class="btn btn-inverse-warning">Edit</a>
                                            @endif
                                            @if (Auth::user()->can('delete.homeseo'))
                                              <a href="{{ route('delete.homeseo', $item->id) }}"
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
