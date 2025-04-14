@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{ route('all.application') }}" class="btn btn-inverse-info">Back to Application List</a>
            </ol>
        </nav> 

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">
                            Show Application
                        </h6>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table table-bordered">
                                <tbody>
                                    
                                    <tr>
                                        <td>Application Date And Time</td>
                                        <td>{{ $application->created_at->format('D - d - M - Y - H:i:s') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Name</td>
                                        <td>{{ $application->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Resident</td>
                                        <td>{{ $application->nationality }}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td>{{ $application->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>{{ $application->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Qualification</td>
                                        <td>{{ $application->qualification }}</td>
                                    </tr>
                                    <tr>
                                        <td>Message</td>
                                        <td>{{ $application->msg }}</td>
                                    </tr>
                                    <tr>
                                        <td>Course</td>
                                        <td>{{ $application->course }}</td>
                                    </tr>
                                    <tr>
                                        <td>University</td>
                                        <td>{{ $application->university }}</td>
                                    </tr>
                                    <tr>
                                        <td>Level</td>
                                        <td>{{ $application->level }}</td>
                                    </tr>

                                
                                    <tr>
                                        <td>CV</td>
                                        <td>
                                           @if (count((array)$application->cv)>0)
                                            <a href="{{url('public/upload/application_docs/'.$application->cv)}}" alt="docs" target="_blank"> Download CV </a>
                                           @else
                                            There is no file
                                           @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>SOP</td>
                                        <td>
                                           @if (count((array)$application->sop)>0)
                                            <a href="{{url('public/upload/application_docs/'.$application->sop)}}" alt="docs" target="_blank"> Download SOP </a>
                                           @else
                                            There is no file
                                           @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Passport</td>
                                        <td>
                                           @if (count((array)$application->passport)>0)
                                            <a href="{{url('public/upload/application_docs/'.$application->passport)}}" alt="docs" target="_blank"> Download Passport </a>
                                           @else
                                            There is no file
                                           @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>IELTS Certificate</td>
                                        <td>
                                           @if (count((array)$application->ielts)>0)
                                            <a href="{{url('public/upload/application_docs/'.$application->ielts)}}" alt="docs" target="_blank"> Download IELTS Certificate </a>
                                           @else
                                            There is no file
                                           @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Academic Transcript</td>
                                        <td>
                                           @if (count((array)$application->transcript)>0)
                                            <a href="{{url('public/upload/application_docs/'.$application->transcript)}}" alt="docs" target="_blank"> Download Academic Transcript </a>
                                           @else
                                            There is no file
                                           @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Academic Certificate</td>
                                        <td>
                                           @if (count((array)$application->certificate)>0)
                                            <a href="{{url('public/upload/application_docs/'.$application->certificate)}}" alt="docs" target="_blank"> Download Academic Certificate </a>
                                           @else
                                            There is no file
                                           @endif
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
