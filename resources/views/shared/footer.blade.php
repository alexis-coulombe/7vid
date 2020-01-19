<footer class="sticky-footer page-footer font-small unique-color-dark">
    <div style="background-color: #d43a3a;">
        <div class="container">
            @guest
                <div class="row py-4 d-flex align-items-center">
                    <div class="col-md-6 col-lg-5 text-center text-md-left mb-4 mb-md-0">
                        <h6 class="mb-0">Share video and get access to all features by creating an account!</h6>
                    </div>
                    <div class="col-md-6 col-lg-7 text-center text-md-right">
                        <a href="{{ route('login') }}" style="color: #fff">
                            <i class="fas fa-sign-in-alt"></i>
                            <span>Create an account / Login</span>
                        </a>
                    </div>
                </div>
            @endguest
            @auth
                <hr>
            @endauth
        </div>
    </div>
    <div class="container text-center text-md-left mt-5">
        <div class="row mt-3">
            <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                <h6 class="text-uppercase font-weight-bold">{{ config('APP_NAME') }}</h6>
                <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                <p>
                    A free video-hosting website that allows members to store and serve video content. Share unlimited video all around the world.
                </p>
            </div>

            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                <h6 class="text-uppercase font-weight-bold">Products</h6>
                <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                <p>
                    <a href="#!">MDBootstrap</a>
                </p>
                <p>
                    <a href="#!">MDWordPress</a>
                </p>
                <p>
                    <a href="#!">BrandFlow</a>
                </p>
                <p>
                    <a href="#!">Bootstrap Angular</a>
                </p>
            </div>
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                <h6 class="text-uppercase font-weight-bold">Useful links</h6>
                <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                <p>
                    <a href="#!">About</a>
                </p>
                <p>
                    <a href="{{ route('home.privacy') }}">Privacy policy</a>
                </p>
            </div>

            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                <h6 class="text-uppercase font-weight-bold">Contact</h6>
                <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                <p>
                    <i class="fas fa-envelope mr-3"></i> <a href="mailto:contact@7vid.org" aria-label="Contact by email">contact@7vid.org</a>
                </p>
            </div>
        </div>
    </div>

    <div class="footer-copyright text-center py-3">© {{ date('Y') }} Copyright
    </div>
</footer>

<a class="scroll-to-top rounded" aria-label="Scroll to top" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
