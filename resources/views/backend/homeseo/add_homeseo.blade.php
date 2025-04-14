@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">

        <div class="row profile-body">

            <!-- middle wrapper start -->
            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="row">

                    <div class="card">
                        <div class="card-body">

                            <h6 class="card-title">
                                @if (@$editData)
                                    Edit Page SEO Properties
                                <a href="{{ route('all.homeseo') }}" class="btn btn-sm btn-inverse-info"> Go Back</a>
                                @else
                                     Add Page SEO Properties
                                @endif
                            </h6>

                            <form class="forms-sample" method="POST" action="{{ (@$editData)?route('update.homeseo',@$editData->id):route('store.homeseo') }}" id="myForm" enctype="multipart/form-data">
                                @csrf

                                <div class="row">

                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label for="exampleInputUsername1" class="form-label"> Page Name </label>

                                            <select name="page_name" 
                                                class="js-example-basic-single form-select select2-hidden-accessible  
                                                @error('page_name') is-invalid  @enderror"
                                                data-width="100%" tabindex="-1" aria-hidden="true"                                          
                                                id="page_name">

                                                <option selected='' disabled=''> Select Page Name</option>
                                                
                                                <option value="Home Page" {{ @$editData->page_name == 'Home Page' ? 'selected' : '' }}>
                                                    Home Page
                                                </option>
                                                <option value="Apply List Page" {{ @$editData->page_name == 'Apply List Page' ? 'selected' : '' }}>
                                                    Apply List Page
                                                </option>
                                                <option value="Apply by University Page" {{ @$editData->page_name == 'Apply by University Page' ? 'selected' : '' }}>
                                                   Apply by University Page
                                                </option>
                                                <option value="Apply by University and Course Page" {{ @$editData->page_name == 'Apply by University and Course Page' ? 'selected' : '' }}>
                                                   Apply by University and Course Page
                                                </option>

                                            </select>
                                            @error('page_name')
                                                <span>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label"> Title </label>
                                            <input type="text" name="title"
                                                class="form-control @error('title') is-invalid  @enderror"
                                                value="{{@$editData->title}}"
                                                >
                                            @error('title')
                                                <span>{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label"> Share Title </label>
                                            <input type="text" name="share_title"
                                                class="form-control @error('share_title') is-invalid  @enderror"
                                                value="{{@$editData->share_title}}"
                                                >
                                            @error('share_title')
                                                <span>{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label"> Description </label>
                                            <textarea name="description"  class="form-control @error('description') is-invalid  @enderror" id="description" rows="3">
                                                {{@$editData->description}}
                                            </textarea>
                                            @error('description')
                                                <span>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label"> Keywords </label>
                                            <textarea name="keywords"  class="form-control @error('keywords') is-invalid  @enderror" id="keywords" rows="3">
                                                {{@$editData->keywords}}
                                            </textarea>
                                            @error('keywords')
                                                <span>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                   <div class="col-sm-6">
                                      <div class="mb-3">
                                        <label for="page_image" class="mb-2">Page Image</label>
                                        <input type="file" name="page_image" class="form-control" id="image">
                                      </div>
                                   </div>
                                   <div class="col-sm-6">
                                      <div class="mb-3">
                                       <img id="showImage" src="{{(!empty(@$editData->page_image))?url('public/upload/home_seo/'.$editData->page_image):url('public/upload/no_image.jpg')}}" style="width: 150px; height: 150px; border:1px solid #000;" alt="">
                                      </div>
                                   </div>

                                </div>

                                <button type="submit" class="btn btn-primary me-2">{{ (@$editData)?"Update":"Submit" }}</button>

                            </form>

                        </div>
                    </div>

                </div>
            </div>
            <!-- middle wrapper end -->
        </div>

    </div>


    <script type="text/javascript">
        $(document).ready(function () {
            $('#myForm').validate({
            rules: {
                country_id: {
                required: true
                },
                name: {
                required: true
                },
            },
            messages: {
                name: {
                     required: 'Please enter country'
                 },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
            });
        });
     </script>

@endsection
