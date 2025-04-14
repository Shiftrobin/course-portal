<!DOCTYPE html>
<html lang="en">
<head>
        <!-- Meta Tags -->
    <meta charset="utf-8">
    {!!  SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}

    @if( url()->current() == url('/'))
      <!-- json ld for home page -->
      {{-- {!! JsonLdMulti::generate() !!} --}}
      <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "EducationalOrganization",
            "name": "{{$HomeTitle ?? ''}}",
            "description": "{{$HomeDescription ?? ''}}",
            "url": "{{$actualLink ?? ''}}",
            "logo": "{{ asset('public/frontend') }}/assets/img/AIMS-Education.png",
            "foundingDate": "2017-02-22",
            "address": {
              "@type": "PostalAddress",
              "streetAddress": "Princess Caroline House (Ground Floor), 1 High St",
              "addressLocality": "Southend-on-Sea",
              "addressRegion": "Southend-on-Sea",
              "postalCode": "SS1 1JE",
              "addressCountry": "United Kingdom"
            },
            "contactPoint": {
              "@type": "ContactPoint",
              "telephone": "+44-0333-224-9183",
              "email": "uk@aimseducation.co.uk",
              "contactType": "Admissions"
            },
            "sameAs": [
              "https://www.facebook.com/aimseducationuk/",
              "https://x.com/AIMSeducationbd/",
              "https://www.youtube.com/@aims-education/",
              "https://www.instagram.com/aimseducationuk/"
            ]
          }
        </script>
    @endif

    @if( url()->current() !== url('/'))
         <!-- json ld for course single page-->
     <script type="application/ld+json">
        {
            "@context": "https://schema.org/",
            "@id": "{{$actualLink ?? ''}}",
            "@type": "Course",
            "name": "{{$courseName ?? ''}}",
            "Level": "{{$levelName ?? ''}}",
            "description": "{{$courseDescription ?? ''}}",
            "Entry Requirements": "{{$courseEntryRequirements ?? ''}}",
            "publisher": {
            "@type": "Organization",
            "name": "AIMS Education | Course Finder",
            "url": "{{route('home')}}"
            },
            "provider": {
            "@type": "Organization",
            "name": "{{$universityName ?? ''}}",
            "url": "{{route('home')}}"
            },
            "image": [
            "{{$courseImage ?? ''}}"
            ],
            "offers": [{
            "@type": "Offer",
            "category": "Paid",
            "FeesCurrency": "{{$courseCurrency ?? ''}}",
            "Fees": {{$courseFees ?? ''}},
            "Scholarship": "{{$courseScholarship ?? ''}}",
            "ScholarshipDetails": "{{$courseScholarshipDetails ?? ''}}"
            }],
            "hasCourseInstance": [{
            "@type": "CourseInstance",
            "courseMode": "Blended",
            "University": "{{$universityName ?? ''}}",
            "Campus": "{{$campusName ?? ''}}",
            "Country": "{{$countryName ?? ''}}",
            "courseSchedule": {
            "@type": "Schedule",
            "duration": "PT3H",
            "repeatFrequency": "Daily",
            "repeatCount": 31
                }
            }]
        }
    </script>
    @endif
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('public/frontend') }}/assets/img/favicon.ico" type="image/x-icon">
    <!-- css -->
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/css/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/css/animate.css">
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/css/main.css">
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/assets/css/custom.css">
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js" data-pagespeed-no-defer></script>
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('public/backend/assets/vendors/select2/select2.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-E6416K5P5Q"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-E6416K5P5Q');
    </script>
</head>
<body class="home-3">
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-lg-2">
                    <div class="logo">
                        <a href="https://aimseducation.co.uk/">
                            <img src="{{ asset('public/frontend') }}/assets/img/AIMS-Education.png" alt="logo">
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-lg-8">
                    <nav>
                        <ul>
                            <li><a href="https://aimseducation.co.uk/">Home</a></li>
                            <li><a class="active" href="{{ route('home') }}/">Courses</a></li>
                            <li><a href="https://experts.aimseducation.co.uk/">Our Experts</a></li>
                            <li><a href="https://aimseducation.co.uk/services-for-students/">Services</a></li>
                            <li><a href="https://aimseducation.co.uk/events/">Events</a></li>
                            <li><a href="https://aimseducation.co.uk/blogs/">Blogs</a></li>
                            <li><a href="https://aimseducation.co.uk/contact/">Contact Us</a></li>
                        </ul>
                    </nav>
                    <div class="mobile-menu">
                        <i class="ti-menu"></i>
                        <i class="ti-close"></i>
                    </div>
                </div>
                <div class="col-md-4 col-lg-2">
                    <div class="social-icon">
                        <ul>
                            <li><a href="https://www.facebook.com/Aimseducation.fb"><i class="ti-facebook"></i></a></li>
                            <li><a href="https://twitter.com/AIMSeducationbd"><i class="ti-twitter-alt"></i></a></li>
                            <li><a href="https://www.youtube.com/channel/UCMGZaEa4yxQUj74KE6quIPw"><i class="ti-youtube"></i></a></li>
                            <li><a href="https://www.instagram.com/aimseducationuk/"><i class="ti-instagram"></i></a></li>
                            <li><a href="https://uk.linkedin.com/company/aimseducationuk"><i class="ti-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
