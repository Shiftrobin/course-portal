@extends('admin.admin_dashboard')
@section('admin')


<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <a href="{{ route('add.admin') }}" class="btn btn-inverse-info">Add Admin </a>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
<div class="card">
  <div class="card-body">
    <h6 class="card-title">
       All Admin
    </h6>
    <div class="table-responsive">
      <table id="dataTableExample" class="table">
        <thead>
          <tr>
            <th>Sl</th>
            <th>Image</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Role</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>

        @foreach ($alladmin as $key => $admin)

          <tr>
            <td>{{ $key+1 }}</td>
            <td> <img src="{{ (!empty($item->photo)) ? url('upload/admin_images/'.$item->photo) : url('upload/no_image.jpg') }} style='width:70px; height:40px;' " alt=""> </td>
            <td>{{ $admin->name }}</td>
            <td>{{ $admin->email }}</td>
            <td>{{ $admin->phone }}</td>
            <td>
                @foreach ($admin->roles as $role  )
                    <span class="badge badge-pill bg-danger">{{ $role->name }}</span>
                @endforeach
            </td>
            <td>
                <a href="{{ route('edit.admin', $admin->id) }}" class="btn btn-inverse-warning">Edit</a>
                <a href="{{ route('delete.admin', $admin->id) }}" class="btn btn-inverse-danger" id="delete">Delete</a>
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
