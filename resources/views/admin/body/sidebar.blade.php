<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
            <span><img src='{{ asset('/public/backend/assets/images/AIMS-Education.png') }}' alt="Logo" /></span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">

            <li class="nav-item nav-category"> Modules </li>
            @if (Auth::user()->can('application.menu'))
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#application" role="button"
                    aria-expanded="false" aria-controls="application">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Application </span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="application">
                    <ul class="nav sub-menu">
                        @if (Auth::user()->can('all.application'))
                            <li class="nav-item">
                                <a href="{{ route('all.application') }}" class="nav-link">All Application</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </li>
            @endif

            @if (Auth::user()->can('course.menu'))
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#course" role="button" aria-expanded="false"
                        aria-controls="course">
                        <i class="link-icon" data-feather="book"></i>
                        <span class="link-title">Course </span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="course">
                        <ul class="nav sub-menu">
                            @if (Auth::user()->can('all.course'))
                                <li class="nav-item">
                                    <a href="{{ route('all.course') }}" class="nav-link">All Course</a>
                                </li>
                            @endif
                            @if (Auth::user()->can('add.course'))
                                <li class="nav-item">
                                    <a href="{{ route('add.course') }}" class="nav-link">Add Course</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif

            @if (Auth::user()->can('budget.menu'))
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#budget" role="button"
                        aria-expanded="false" aria-controls="budget">
                        <i class="link-icon" data-feather="dollar-sign"></i>
                        <span class="link-title">Budget </span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="budget">
                        <ul class="nav sub-menu">
                            @if (Auth::user()->can('all.budget'))
                                <li class="nav-item">
                                    <a href="{{ route('all.budget') }}" class="nav-link">All Budget</a>
                                </li>
                            @endif
                            @if (Auth::user()->can('add.budget'))
                                <li class="nav-item">
                                    <a href="{{ route('add.budget') }}" class="nav-link">Add Budget</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif

            @if (Auth::user()->can('level.menu'))
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#level" role="button" aria-expanded="false"
                        aria-controls="level">
                        <i class="link-icon" data-feather="pen-tool"></i>
                        <span class="link-title">Level </span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="level">
                        <ul class="nav sub-menu">
                            @if (Auth::user()->can('all.level'))
                                <li class="nav-item">
                                    <a href="{{ route('all.level') }}" class="nav-link">All Level</a>
                                </li>
                            @endif
                            @if (Auth::user()->can('add.level'))
                                <li class="nav-item">
                                    <a href="{{ route('add.level') }}" class="nav-link">Add Level</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif

            @if (Auth::user()->can('campus.menu'))
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#campus" role="button" aria-expanded="false"
                        aria-controls="campus">
                        <i class="link-icon" data-feather="map"></i>
                        <span class="link-title">Campus </span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="campus">
                        <ul class="nav sub-menu">
                            @if (Auth::user()->can('all.campus'))
                                <li class="nav-item">
                                    <a href="{{ route('all.campus') }}" class="nav-link">All Campus</a>
                                </li>
                            @endif
                            @if (Auth::user()->can('add.campus'))
                                <li class="nav-item">
                                    <a href="{{ route('add.campus') }}" class="nav-link">Add Campus</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif

            @if (Auth::user()->can('university.menu'))
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#university" role="button"
                        aria-expanded="false" aria-controls="university">
                        <i class="link-icon" data-feather="home"></i>
                        <span class="link-title">University </span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="university">
                        <ul class="nav sub-menu">
                            @if (Auth::user()->can('all.university'))
                                <li class="nav-item">
                                    <a href="{{ route('all.university') }}" class="nav-link">All University</a>
                                </li>
                            @endif
                            @if (Auth::user()->can('add.university'))
                                <li class="nav-item">
                                    <a href="{{ route('add.university') }}" class="nav-link">Add University</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif

            @if (Auth::user()->can('country.menu'))
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#country" role="button" aria-expanded="false"
                    aria-controls="country">
                    <i class="link-icon" data-feather="globe"></i>
                    <span class="link-title">Country </span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="country">
                    <ul class="nav sub-menu">
                        @if (Auth::user()->can('all.country'))
                            <li class="nav-item">
                                <a href="{{ route('all.country') }}" class="nav-link">All Country</a>
                            </li>
                        @endif
                        @if (Auth::user()->can('add.country'))
                            <li class="nav-item">
                                <a href="{{ route('add.country') }}" class="nav-link">Add Country</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </li>
            @endif

            @if (Auth::user()->can('course_name.menu'))
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#course_name" role="button"
                    aria-expanded="false" aria-controls="course_name">
                    <i class="link-icon" data-feather="book-open"></i>
                    <span class="link-title">Course Name </span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="course_name">
                    <ul class="nav sub-menu">
                        @if (Auth::user()->can('all.course_name'))
                            <li class="nav-item">
                                <a href="{{ route('all.course_name') }}" class="nav-link">All Course Name</a>
                            </li>
                        @endif
                        @if (Auth::user()->can('add.course_name'))
                            <li class="nav-item">
                                <a href="{{ route('add.course_name') }}" class="nav-link">Add Course Name</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </li>
            @endif

            <li class="nav-item nav-category"> Landmark Pages SEO </li>

            @if (Auth::user()->can('homeseo.menu'))
            <li class="nav-item">
               <a class="nav-link" data-bs-toggle="collapse" href="#homeseo" role="button"
                   aria-expanded="false" aria-controls="homeseo">
                   <i class="link-icon" data-feather="home"></i>
                   <span class="link-title">Pages SEO </span>
                   <i class="link-arrow" data-feather="chevron-down"></i>
               </a>
               <div class="collapse" id="homeseo">
                   <ul class="nav sub-menu">
                       @if (Auth::user()->can('all.homeseo'))
                           <li class="nav-item">
                               <a href="{{ route('all.homeseo') }}" class="nav-link">All Pages SEO</a>
                           </li>
                       @endif
                       @if (Auth::user()->can('add.homeseo'))
                           <li class="nav-item">
                               <a href="{{ route('add.homeseo') }}" class="nav-link">Add SEO</a>
                           </li>
                       @endif
                   </ul>
               </div>
             </li>
            @endif

            @if (Auth::user()->can('role.menu'))
                <li class="nav-item nav-category"> Authentication</li>

                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#advancedUI" role="button"
                        aria-expanded="false" aria-controls="advancedUI">
                        <i class="link-icon" data-feather="lock"></i>
                        <span class="link-title"> Role & Permissions </span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="advancedUI">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{ route('all.permission') }}" class="nav-link">All Permission</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('all.role') }}" class="nav-link">All Role</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('add.roles.permission') }}" class="nav-link">Role In Permission</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('all.roles.permission') }}" class="nav-link">All Role In
                                    Permission</a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif

            @if (Auth::user()->can('admin.menu'))
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#admin" role="button"
                        aria-expanded="false" aria-controls="admin">
                        <i class="link-icon" data-feather="users"></i>
                        <span class="link-title"> Manage Admin Users </span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="admin">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{ route('all.admin') }}" class="nav-link">All Admin</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('add.admin') }}" class="nav-link">Add Admin</a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif



            <li class="nav-item nav-category">Others</li>
            <li class="nav-item">
                {{-- <a href="#" target="_blank" class="nav-link">
                    <i class="link-icon" data-feather="settings"></i>
                    <span class="link-title">Settings</span>
                </a> --}}
                <a href="{{ url('/cc') }}" target="_blank" rel="nofollow" class="nav-link">
                    <i class="link-icon" data-feather="eye"></i>
                    <span class="link-title">Cache Clear</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
