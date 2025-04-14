@extends('frontend.layouts.master')
@section('title', 'Apply Now')
@section('content')

    <section class="breadcrumb breadcrumb-img">
        <div class="container">
            <div class="row">
                <div class="col">
                    <img style="display: none;" src="{{ asset('public/frontend') }}/assets/img/courses-cover.webp" alt="courses cover image" fetchpriority="high" loading="eager" />
                    <p class="header_title">Apply Now</p>                 
                </div>
            </div>
        </div>
    </section>

<div class="mt40">
    <div class="container-fluid apply-form-padding">
      <div class="row no-gutters">


          <div class="col-lg-6 wow fadeInLeft" data-wow-delay=".3s">

            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                      <div class="curriculum-subject">
                        <h1 style="
                        font-size: 20px;
                        "
                        class="font-weight-bold"
                        >
                        <span><i class="fas fa-university"></i></span>
                       <span> {{ $course_data->name ?? '' }} </span>
                        </h1>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="curriculum-subject">
                        <h2
                        style="
                        font-size: 17px;
                        "
                        class="font-weight-bold"
                        >
                        <span><i class="fas fa-book-reader"></i></span>
                        <span> {{ $university_data->name ?? '' }}</span>
                        </h2>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="curriculum-subject font-weight-bold">
                        <span><i class="fas fa-building"></i></span>
                        <span> Campus: {{ $campus_data->name ?? '' }}</span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="curriculum-subject font-weight-bold">
                         <span><i class="fas fa-money-bill"></i></span>
                         <span> Tution Fees: {{ $course_data->currency ?? '' }}{{ $course_data->fees ?? ''}}</span>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="curriculum-subject font-weight-bold">
                        <i class="fas fa-graduation-cap"></i>
                        {{ (!empty($course_data->scholarship) )?'Scholarship: '.$course_data->scholarship : '' }}
                      </div>
                    </div>

                    <div class="col-md-12 mt40">
                        <div class="bg-light">
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#home">Overview</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#menu1">Entry requirements</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#menu2">Scholarship</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div id="home" class="container tab-pane active"><br>
                                    {!! $course_data->overview ?? '' !!}
                                </div>
                                <div id="menu1" class="container tab-pane fade"><br>
                                    {!! $course_data->entry_requirements ?? '' !!}
                                </div>
                                <div id="menu2" class="container tab-pane fade"><br>
                                    {!! $course_data->scholarship_details ?? '' !!}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="col-lg-6 wow fadeInRight" data-wow-delay=".3s">
          <div class="apply-form bxw">

            <div class="text-center py-4">
              <h2>Apply to your desired course</h2>
            </div>

            {{-- <div class="error" id="message"></div> --}}

            <form id="frmAppl" class="frmAppl" enctype="multipart/form-data">
                @csrf

              <div class="row">

               <div class="col-md-12">
                    <label for="course name">Course</label>
                    <input type="text" name="course" id="course" class="form-control text-capitalize" value="{{ $course_data->name ?? ''}}" readonly>
                </div>
                <div class="col-md-9">
                    <label for="university">University</label>
                    <input type="text" name="university" id="university" class="form-control" value=" {{ $university_data->name ?? ''}}" readonly>
                </div>
                <div class="col-md-3">
                    <label for="campus">Campus</label>
                    <input type="text" name="campus" id="campus" class="form-control" value=" {{ $campus_data->name ?? ''}}" readonly>
                </div>
                <div class="col-md-12">
                  <label for="name">Name<span class="text-danger">*</span></label>
                  <input type="text" name="name" id="name" class="form-control" placeholder="Your Name" required>
                </div>
                <div class="col-md-6">
                    <label for="nationality">Nationality<span class="text-danger">*</span></label>
                    <select name="nationality" id="nationality" class="form-control js-example-basic-single form-select select2-hidden-accessible"
                    data-width="100%" tabindex="-1" aria-hidden="true" style="height:45px !important; padding:7px !important;" required>
                        @include('frontend.components.country_list')
                   </select>
                </div>
                <div class="col-md-6">
                  <label for="phone">Phone<span class="text-danger">*</span></label>
                  <input
                        type="tel"
                        name="phone"
                        id="phone"
                        class="form-control"
                        placeholder="Your Phone Number"
                        title="Please use minimum 11 digit phone number or maximum 15 digit phone number with no dashes or dots"
                        required
                  >
                </div>
                <div class="col-md-12">
                  <label for="address">Address</label>
                  <input type="text" name="address" id="address" class="form-control" placeholder="Your Address">
                </div>
                <div class="col-md-12">
                  <label for="email">Email<span class="text-danger">*</span></label>
                  <input type="email" name="email" id="email" class="form-control" placeholder="Your Email Address" required>
                </div>
                <div class="col-md-12">
                    <label for="qualificaiton">Qualificaiton</label>
                    <input type="text" name="qualification" id="qualification" class="form-control" placeholder="Your Last Qualification">
                </div>


                <div class="col-md-6">
                    <label for="cv">Upload your CV (File size not more than 1MB) </label>
                    <input type="file" name="cv" id="cv" class="form-control" style="padding-bottom: 45px;">
                </div>
                <div class="col-md-6">
                    <label for="sop">Upload your SOP (File size not more than 1MB) </label>
                    <input type="file" name="sop" id="sop" class="form-control" style="padding-bottom: 45px;">
                </div>
                <div class="col-md-6">
                    <label for="passport">Upload your Passport (File size not more than 1MB) </label>
                    <input type="file" name="passport" id="passport" class="form-control" style="padding-bottom: 45px;">
                </div>
                <div class="col-md-6">
                    <label for="ielts">Upload your IELTS Certificate (File size not more than 1MB) </label>
                    <input type="file" name="ielts" id="ielts" class="form-control" style="padding-bottom: 45px;">
                </div>
                <div class="col-md-6">
                    <label for="transcript">Upload your Academic Transcript (File size not more than 1MB) </label>
                    <input type="file" name="transcript" id="transcript" class="form-control" style="padding-bottom: 45px;">
                </div>
                <div class="col-md-6">
                    <label for="certificate">Upload your Academic Certificate (File size not more than 1MB) </label>
                    <input type="file" name="certificate" id="certificate" class="form-control" style="padding-bottom: 45px;">
                </div>

                <div class="col-md-12">
                    <label for="message">Message</label>
                    <textarea class="form-control" name="msg" id="msg" placeholder="Type Your Message"></textarea>
                </div>
                <div class="col-md-12">
                  <label for="consent" class="mt-2">Consent<span class="text-danger">*</span></label>
                  <label class="mt-20 checkbox-container"><input type="checkbox" required> I agree to the terms and receiving notifications from AIMS Education <a href="https://aimseducation.co.uk/privacy-policy/" class="link" target="_blank">View Full Terms</a><span class="checkmark"></span></label>
                </div>
                <div class="col-md-12">
                    {{-- google captcha v2 --}}
                    {!! NoCaptcha::renderJs() !!}
                    {!! NoCaptcha::display() !!} 
                </div>
                <div class="col-md-12 py-4">
                  <button type="submit" id="submitBtn" class="btn btn-danger">Submit</button>
                </div>
                <div class="col-md-12 py-3">                    
                    {{-- before send data spinner --}}
                    <div class="spinner-border text-info loader" role="status">
                      <span class="sr-only">Loading...</span>
                    </div>
                </div>
              </div>
            </form>
          </div>
        </div>


      </div>
    </div>
  </div>

  <div class="container mt80">
    <div class="row">
      <div class="col">
        <h2 class="wow fadeInUp title-big" data-wow-delay=".3s">If you have troubles, please don't hesitate to get in
          touch <br> via
          <a href="https://experts.aimseducation.co.uk/"
            class="link" target="_blank">Our Experts</a></h2>
      </div>
    </div>
  </div>


{{-- data send sucess modal  --}}
  <!-- Modal bootstrap:4.3 -->
  <div class="modal fade" id="succssMsg" tabindex="-1" role="dialog" aria-labelledby="showMsgModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
              <h3 class="pt-3 text-center">Thanks, you're all set. One of our advisers will contact you soon.</h3>
          </div>
          <div class="modal-header">
              <button type="button" class="btn btn-secondary mx-auto d-block pb-2" data-dismiss="modal">Close</button>
          </div>
        </div>
    </div>
  </div>

  {{-- data send failed modal  --}}
  <!-- Modal bootstrap:4.3 -->
  <div class="modal fade" id="failMsg" tabindex="-1" role="dialog" aria-labelledby="showMsgModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
              <h3 class="pt-3 text-center"> Some error occurred. Wait for sometime and check back later. </h3>
          </div>
          <div class="modal-header">
              <button type="button" class="btn btn-secondary mx-auto d-block pb-2" data-dismiss="modal">Close</button>
          </div>
        </div>
    </div>
  </div>


  <div class="counter mtb80 wow fadeInUp" data-wow-delay=".3s">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <h2 class="c-orange"><span>25</span>K <i class="fas fa-plus"></i> <strong>Happy Students</strong></h2>
          <img src="{{ asset('public/frontend') }}/assets/img/counter-shape-1.png" alt="Happy Students" />
        </div>
        <div class="col-md-4">
          <h2 class="c-red"><span>40</span>K <i class="fas fa-plus"></i> <strong>Courses</strong></h2>
          <img src="{{ asset('public/frontend') }}/assets/img/counter-shape-2.png" alt="Courses" />
        </div>
        <div class="col-md-4">
          <h2 class="c-green"><span>100</span> <i class="fas fa-percent"></i> <strong>Satisfaction</strong></h2>
          <img src="{{ asset('public/frontend') }}/assets/img/counter-shape-3.png" alt="Satisfaction" />
        </div>
      </div>
    </div>
  </div>

@endsection

@push("scripts")
<script>
$(".spinner-border").hide();

$("#frmAppl").on("submit", function(event) {    
    event.preventDefault();   
    var error_ele = document.getElementsByClassName('err-msg');
    if (error_ele.length > 0) {
        for (var i=error_ele.length-1;i>=0;i--){
            error_ele[i].remove();
        }
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        url: "{{ route('apply.now.store') }}",
        type: "POST",
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        processData: false,
        cache: false,
        beforeSend: function() {
            $("#submitBtn").prop('disabled', true);
            $(".spinner-border").show();
        },
        complete: function () {
            $(".spinner-border").hide();
        },
        success: function(data) {
            if (data.success) {
                $("#frmAppl")[0].reset();
                $("#succssMsg").modal('show');

            }
            else {
                $.each(data.error, function(key, value) {
                    var el = $(document).find('[name="'+key + '"]');
                    el.before($('<span class= "err-msg text-danger">:' + value[0] + '</span>'));

                });
            }
            $("#submitBtn").prop('disabled', false);
        },
        error: function (err) {
            //$("#message").html('<span class= "err-msg text-danger"> Some Error Occurred! </span>')
              if(err){                
                $("#failMsg").modal('show');
              }          
            }
        });
    });
</script>

@endpush

