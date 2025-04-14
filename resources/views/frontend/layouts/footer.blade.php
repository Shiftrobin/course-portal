<div class="container">
    <div class="row">
        <div class="col-md-12">
    <img src="{{ asset('public/frontend') }}/assets/img/footer-banner.webp" alt="Footer Banner">
</div>
    </div>
</div>

<!--========================================================
                          FOOTER
  =========================================================-->
<footer class="pt10">
    <div class="footer-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <p>© Copyright {{ Date('Y') }} <a href="https://aimseducation.co.uk/" class="link2">AIMS Education</a>. All Rights
                        Reserved.</p>
                </div>
                <div class="col-md-7">
                    <ul>
                        <li><a href="https://aimseducation.co.uk/">Home</a></li>
                        <li><a href="https://aimseducation.co.uk/privacy-policy/">Privacy & Policy</a></li>
                        <li><a href="https://aimseducation.co.uk/contact/">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--========================================================
                        Loader and toTop
  =========================================================-->
{{-- <div id="preloader">
    <div class="preloader">
        <span></span>
        <span></span>
    </div>
</div> --}}

<div id="toTop">
    <i class="ti-arrow-up"></i>
</div>

<!-- js -->
{{-- <script src="{{ asset('public/frontend') }}/assets/js/jquery-3.3.1.min.js"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
    integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
<script src="{{ asset('public/frontend') }}/assets/js/popper.min.js"></script>
<script src="{{ asset('public/frontend') }}/assets/js/bootstrap.min.js"></script>
<script src="{{ asset('public/frontend') }}/assets/js/owl.carousel.min.js"></script>
<script src="{{ asset('public/frontend') }}/assets/js/jquery.fancybox.min.js"></script>
<script src="{{ asset('public/frontend') }}/assets/js/waypoints.min.js"></script>
<script src="{{ asset('public/frontend') }}/assets/js/jquery.counterup.min.js"></script>
<script src="{{ asset('public/frontend') }}/assets/js/wow.min.js"></script>
<script src="{{ asset('public/frontend') }}/assets/js/custom.js"></script>

<!-- Plugin js data table -->
<script src="{{ asset('public/backend/assets/vendors/select2/select2.min.js') }}"></script>
<!-- End plugin js data table -->

<!-- Custom js -->
<script src="{{ asset('public/backend/assets/js/select2.js') }}"></script>
<!-- End custom-->

@stack('scripts')



</body>

</html>
