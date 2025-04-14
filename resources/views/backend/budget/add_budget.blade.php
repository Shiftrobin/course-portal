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
                                    Edit Budget Name
                                <a href="{{ route('all.budget') }}" class="btn btn-sm btn-inverse-info"> Go Back</a>
                                @else
                                    Add Budget Name
                                @endif
                            </h6>

                            <form class="forms-sample" method="POST" action="{{ (@$editData)?route('update.budget',@$editData->id):route('store.budget') }}" id="myForm">
                                @csrf

                                <div class="row">

                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label"> Country Name</label>
                                            <select name="country_id"
                                            class="js-example-basic-single form-select select2-hidden-accessible"
                                            data-width="100%" tabindex="-1" aria-hidden="true" id="country_id">
                                                 <option value="">Select Country</option>
                                                @foreach ($countries as $country )
                                                       <option value="{{ $country->id }}" {{ (@$editData->country_id==$country->id)?"selected":""}}>{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>

                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label"> University Name </label>
                                            <select name="university_id"
                                            class="js-example-basic-single form-select select2-hidden-accessible"
                                            data-width="100%" tabindex="-1" aria-hidden="true" id="university_id">
                                                 <option value="">Select University</option>

                                            </select>
                                        </div>

                                    </div>

                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label"> Campus Name </label>
                                            <select name="campus_id"
                                            class="js-example-basic-single form-select select2-hidden-accessible"
                                            data-width="100%" tabindex="-1" aria-hidden="true" id="campus_id">
                                                 <option value="">Select Campus</option>

                                            </select>
                                        </div>

                                    </div>


                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label class="form-label"> Level Name </label>
                                            <select name="level_id"
                                            class="js-example-basic-single form-select select2-hidden-accessible"
                                            data-width="100%" tabindex="-1" aria-hidden="true" id="level_id">
                                                 <option value="">Select Level</option>

                                            </select>
                                        </div>

                                    </div>

                                    <div class="col-sm-4">
                                        <div class="mb-3">
                                            <label for="exampleInputUsername1" class="form-label"> Budget Range Name </label>

                                            <select name="range" 
                                                class="js-example-basic-single form-select select2-hidden-accessible  
                                                @error('range') is-invalid  @enderror"
                                                data-width="100%" tabindex="-1" aria-hidden="true"                                          
                                                id="range">

                                                <option selected='' disabled=''> Select Budget Range </option>
                                                
                                                <option value="Below £15000" {{ @$editData->range == 'Below £15000' ? 'selected' : '' }}>
                                                    Below £15000
                                                </option>
                                                <option value="Between £15000-£20000" {{ @$editData->range == 'Between £15000-£20000' ? 'selected' : '' }}>
                                                    Between £15000-£20000
                                                </option>
                                                <option value="Over £20000" {{ @$editData->range == 'Over £20000' ? 'selected' : '' }}>
                                                    Over £20000
                                                </option>


                                                <option value="Below $15000" {{ @$editData->range == 'Below $15000' ? 'selected' : '' }}>
                                                    Below $15000
                                                </option>
                                                <option value="Between $15000-$20000" {{ @$editData->range == 'Between $15000-$20000' ? 'selected' : '' }}>
                                                    Between $15000-$20000
                                                </option>
                                                <option value="Over $20000" {{ @$editData->range == 'Over $20000' ? 'selected' : '' }}>
                                                    Over $20000
                                                </option>


                                                <option value="Below €15000" {{ @$editData->range == 'Below €15000' ? 'selected' : '' }}>
                                                    Below €15000
                                                </option>
                                                <option value="Between €15000-€20000" {{ @$editData->range == 'Between €15000-€20000' ? 'selected' : '' }}>
                                                    Between €15000-€20000
                                                </option>
                                                <option value="Over €20000" {{ @$editData->range == 'Over €20000' ? 'selected' : '' }}>
                                                    Over €20000
                                                </option>


                                                 <option value="Below 15000 zł‎" {{ @$editData->range == 'Below 15000 zł‎' ? 'selected' : '' }}>
                                                    Below 15000 zł‎
                                                </option>
                                                <option value="Between 15000 zł‎-20000 zł‎" {{ @$editData->range == 'Between 15000 zł‎-20000 zł‎' ? 'selected' : '' }}>
                                                    Between 15000 zł‎-20000 zł‎
                                                </option>
                                                <option value="Over 20000 zł‎" {{ @$editData->range == 'Over 20000 zł‎' ? 'selected' : '' }}>
                                                    Over 20000 zł‎
                                                </option>

                                                
                                                <option value="Below 15000 Ft" {{ @$editData->range == 'Below 15000 Ft' ? 'selected' : '' }}>
                                                    Below 15000 Ft
                                                </option>
                                                <option value="Between 15000 Ft-20000 Ft" {{ @$editData->range == 'Between 15000 Ft-20000 Ft' ? 'selected' : '' }}>
                                                    Between 15000 Ft-20000 Ft
                                                </option>
                                                <option value="Over 20000 Ft" {{ @$editData->range == 'Over 20000 Ft' ? 'selected' : '' }}>
                                                    Over 20000 Ft
                                                </option>
                                                
                                                <option value="Below 15000 kr" {{ @$editData->range == 'Below 15000 kr' ? 'selected' : '' }}>
                                                    Below 15000 kr
                                                </option>
                                                <option value="Between 15000 kr-20000 kr" {{ @$editData->range == 'Between 15000 kr-20000 kr' ? 'selected' : '' }}>
                                                    Between 15000 kr-20000 kr
                                                </option>
                                                <option value="Over 20000 kr" {{ @$editData->range == 'Over 20000 kr' ? 'selected' : '' }}>
                                                    Over 20000 kr
                                                </option>

                                                <option value="Below 15000 AED" {{ @$editData->range == 'Below 15000 AED' ? 'selected' : '' }}>
                                                    Below 15000 AED
                                                </option>
                                                <option value="Between 15000 AED-20000 AED" {{ @$editData->range == 'Between 15000 AED-20000 AED' ? 'selected' : '' }}>
                                                    Between 15000 AED-20000 AED
                                                </option>
                                                <option value="Over 20000 AED" {{ @$editData->range == 'Over 20000 AED' ? 'selected' : '' }}>
                                                    Over 20000 AED
                                                </option>

                                            </select>
                                            @error('range')
                                                <span>{{ $message }}</span>
                                            @enderror
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
                university_id: {
                required: true
                },
                campus_id: {
                required: true
                },
                level_id: {
                    required: true
                },
                range: {
                required: true
                },
            },
            messages: {

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

    <script>
        $(function(){
            $(document).on('change','#country_id',function(){
                var country_id = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('default.get-university') }}",
                    data: {country_id:country_id},
                    success: function (data) {
                        var html = '<option value=""> Select University</option>';
                        $.each(data,function(key,v){
                            html += '<option value="'+v.id+'">'+v.name+'</option>';
                        });
                        $('#university_id').html(html);
                        var university_id = "{{ @$editData->university_id }}";
                        if(university_id !=''){
                            $('#university_id').val(university_id).trigger('change');
                        }
                    }
                });
            });
        });
    </script>

    <script>
        $(function(){
            var country_id = "{{ @$editData->country_id }}";
            if(country_id){
                $('#country_id').val(country_id).trigger('change');
            }
        });
    </script>

    <script>
        $(function(){
            $(document).on('change','#university_id',function(){
                var university_id = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('default.get-campus') }}",
                    data: {university_id:university_id},
                    success: function (data) {
                        var html = '<option value=""> Select Campus</option>';
                        $.each(data,function(key,v){
                            html += '<option value="'+v.id+'">'+v.name+'</option>';
                        });
                        $('#campus_id').html(html);
                        var campus_id = "{{ @$editData->campus_id }}";
                        if(campus_id !=''){
                            $('#campus_id').val(campus_id).trigger('change');
                        }
                    }
                });
            });
        });
    </script>

    <script>
        $(function(){
            $(document).on('change','#campus_id',function(){
                var campus_id = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('default.get-level') }}",
                    data: {campus_id:campus_id},
                    success: function (data) {
                        var html = '<option value=""> Select Level</option>';
                        $.each(data,function(key,v){
                            html += '<option value="'+v.id+'">'+v.name+'</option>';
                        });
                        $('#level_id').html(html);
                        var level_id = "{{ @$editData->level_id }}";
                        if(level_id !=''){
                            $('#level_id').val(level_id);
                        }
                    }
                });
            });
        });
    </script>

@endsection
