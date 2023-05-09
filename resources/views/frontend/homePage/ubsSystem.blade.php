<div class="ubs-section bg-light ">
    <div class="container">
        <div class="row">
            <h2 class="text-center py-4">Our UBS System</h2>
            <div class="col-lg-6 col-md-6 col-sm-12 ">
                <h4 class="text-secondary  py-2">A complete Management Solution</h4>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Suscipit minima, est fugiat, similique
                    voluptatem eaque ducimus debitis tenetur, itaque illum quisquam culpa excepturi error ratione odit
                    libero possimus aliquam. Nobis!</p>
                <div class="row m-0 justify-content-evenly">
                    <div class="col-lg-4 col-md-6 col-sm-12 py-3 p-0 mb-2">
                        <div class="card p-0 mx-1">
                            <div class="card-body">
                                <div class="text-center step text-secondary mx-auto bg-light">01</div>
                                <h6 class="card-subtitle mb-2 text-muted"> Robust </h6>
                                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 py-3 p-0 mb-2">
                        <div class="card p-0 mx-1">
                            <div class="card-body">
                                <div class="text-center step text-secondary mx-auto bg-light">02</div>
                                <h6 class="card-subtitle mb-2 text-muted"> User Friendly </h6>
                                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 py-3 p-0 mb-2">
                        <div class="card p-0 mx-1">
                            <div class="card-body">
                                <div class="text-center step text-secondary mx-auto bg-light">03</div>
                                <h6 class="card-subtitle mb-2 text-muted"> Secure </h6>
                                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center py-2">
                        <button type="button" class="btn btn-dark">More...</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 d-flex align-items-center">
                <img src="{{ asset('assets/front/images/ubs/ubs.png') }}" alt="" srcset="">
            </div>

        </div>
        <div class="row pb-3 our-service">
            <div class="row py-3">
                <h4 class=" pt-4">Features</h4>
                <div class="col-lg-6 col-md-4 col-sm-12 ">
                    <img src="{{ asset('assets/front/images/ubs/img-2.png') }}" id="accordianUbsImg"
                        alt="" srcset="">
                </div>
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <div class="accordion" id="accordionUbs">
                        <div class="accordion-item" onclick="changeUBSImage(1)">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#ubsCollapseOne" aria-expanded="true" aria-controls="ubsCollapseOne">
                                    Mange User
                                </button>
                            </h2>
                            <div id="ubsCollapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordionUbs">
                                <div class="accordion-body">
                                    Give permission assign roles to registed user in the system
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item" onclick="changeUBSImage(2)">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#ubsCollapseTwo" aria-expanded="false" aria-controls="ubsCollapseTwo">
                                    Provides a Complete product Management system
                                </button>
                            </h2>
                            <div id="ubsCollapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionUbs">
                                <div class="accordion-body">
                                    <strong>This is the second item's accordion body.</strong> It is hidden by default,
                                    until the collapse plugin adds the appropriate classes that we use to style each
                                    element. These classes control the overall appearance, as well as the showing and
                                    hiding via CSS transitions. You can modify any of this with custom CSS or overriding
                                    our default variables. It's also worth noting that just about any HTML can go within
                                    the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item" onclick="changeUBSImage(3)">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#ubsCollapseThree" aria-expanded="false" aria-controls="ubsCollapseThree">
                                    Kepp track of your manufacted goods
                                </button>
                            </h2>
                            <div id="ubsCollapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionUbs">
                                <div class="accordion-body">
                                    <strong>This is the third item's accordion body.</strong> It is hidden by default,
                                    until the collapse plugin adds the appropriate classes that we use to style each
                                    element. These classes control the overall appearance, as well as the showing and
                                    hiding via CSS transitions. You can modify any of this with custom CSS or overriding
                                    our default variables. It's also worth noting that just about any HTML can go within
                                    the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item" onclick="changeUBSImage(4)">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#ubsCollapseFour" aria-expanded="false" aria-controls="ubsCollapseFour">
                                    Generate Reports
                                </button>
                            </h2>
                            <div id="ubsCollapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                data-bs-parent="#accordionUbs">
                                <div class="accordion-body">
                                    <strong>This is the third item's accordion body.</strong> It is hidden by default,
                                    until the collapse plugin adds the appropriate classes that we use to style each
                                    element. These classes control the overall appearance, as well as the showing and
                                    hiding via CSS transitions. You can modify any of this with custom CSS or overriding
                                    our default variables. It's also worth noting that just about any HTML can go within
                                    the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item" onclick="changeUBSImage(5)">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#ubsCollapseFive" aria-expanded="false"
                                    aria-controls="ubsCollapseFive">
                                    A complete CRM system
                                </button>
                            </h2>
                            <div id="ubsCollapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                                data-bs-parent="#accordionUbs2">
                                <div class="accordion-body">
                                    <strong>This is the third item's accordion body.</strong> It is hidden by default,
                                    until the collapse plugin adds the appropriate classes that we use to style each
                                    element. These classes control the overall appearance, as well as the showing and
                                    hiding via CSS transitions. You can modify any of this with custom CSS or overriding
                                    our default variables. It's also worth noting that just about any HTML can go within
                                    the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item" onclick="changeUBSImage(5)">
                            <h2 class="accordion-header" id="headingSix">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#ubsCollapseSix" aria-expanded="false" aria-controls="ubsCollapseSix">
                                    Manage Your Purchase Orders
                                </button>
                            </h2>
                            <div id="ubsCollapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                                data-bs-parent="#accordionUbs2">
                                <div class="accordion-body">
                                    <strong>This is the third item's accordion body.</strong> It is hidden by default,
                                    until the collapse plugin adds the appropriate classes that we use to style each
                                    element. These classes control the overall appearance, as well as the showing and
                                    hiding via CSS transitions. You can modify any of this with custom CSS or overriding
                                    our default variables. It's also worth noting that just about any HTML can go within
                                    the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item" onclick="changeUBSImage(5)">
                            <h2 class="accordion-header" id="headingSeven">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#ubsCollapseSeven" aria-expanded="false"
                                    aria-controls="ubsCollapseSeven">
                                    A complete HRM system
                                </button>
                            </h2>
                            <div id="ubsCollapseSeven" class="accordion-collapse collapse"
                                aria-labelledby="headingSeven" data-bs-parent="#accordionUbs2">
                                <div class="accordion-body">
                                    <strong>This is the third item's accordion body.</strong> It is hidden by default,
                                    until the collapse plugin adds the appropriate classes that we use to style each
                                    element. These classes control the overall appearance, as well as the showing and
                                    hiding via CSS transitions. You can modify any of this with custom CSS or overriding
                                    our default variables. It's also worth noting that just about any HTML can go within
                                    the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item" onclick="changeUBSImage(5)">
                            <h2 class="accordion-header" id="headingEight">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#ubsCollapseEight" aria-expanded="false"
                                    aria-controls="ubsCollapseEight">
                                    User Essential Feautes
                                </button>
                            </h2>
                            <div id="ubsCollapseEight" class="accordion-collapse collapse"
                                aria-labelledby="headingEight" data-bs-parent="#accordionUbs2">
                                <div class="accordion-body">
                                    <strong>This is the third item's accordion body.</strong> It is hidden by default,
                                    until the collapse plugin adds the appropriate classes that we use to style each
                                    element. These classes control the overall appearance, as well as the showing and
                                    hiding via CSS transitions. You can modify any of this with custom CSS or overriding
                                    our default variables. It's also worth noting that just about any HTML can go within
                                    the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>
        </div>
    </div>
    <div class="container-fluid   p-5 d-flex align-items-center high-business-section"
        style="height: 350px !important;background: url('{{ asset('assets/front/images/ubs/img-1.png') }}');');
               background-position: center; background-repeat: no-repeat; background-size: cover;">
        <div class="col-12 text-center">
            <h1 class="text-secondary">All management under one roof</h1>
            <button type="button" href="https://ubs.unipuller.com/" class="btn btn-dark">Get
                Started...</button>
        </div>
    </div>
    {{-- <div class="col-12 col-sm-6 col-lg-3 col-xl-3 buy-sell py-2">
        <a href="#">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">UBS services</h5>
                    <div class="row">
                        <div class="col-6 ">
                            <a href="{{ route('front.categories') }}" class="text-decoration-none">
                                <div class="card-item">
                                    <img class="lazy"
                                        data-src="{{ asset('assets/front/images/services/business-management.png') }}"
                                        alt="">
                                </div>
                                <p class="text-secondary card-text mb-2 text-center">
                                    Business Management
                                </p>
                            </a>

                        </div>
                        <div class="col-6 ">
                            <a href="{{ route('front.categories') }}" class="text-decoration-none">
                                <div class="card-item">
                                    <img class="lazy"
                                        data-src="{{ asset('assets/front/images/services/lead-management.png') }}"
                                        alt="">
                                </div>
                                <p class="text-secondary card-text mb-2 text-center">
                                    Lead Management
                                </p>
                            </a>

                        </div>
                        <div class="col-6">
                            <a href="{{ route('front.categories') }}" class="text-decoration-none">
                                <div class="card-item">
                                    <img class="lazy"
                                        data-src="{{ asset('assets/front/images/services/marketing-solution.png') }}"
                                        alt="">
                                </div>
                                <p class="text-secondary card-text mb-2 text-center">
                                    Marketing Solutions
                                </p>
                            </a>

                        </div>
                        <div class="col-6">
                            <a href="{{ route('front.categories') }}" class="text-decoration-none">
                                <div class="card-item">
                                    <img class="lazy"
                                        data-src="{{ asset('assets/front/images/services/sell-automation.png') }}"
                                        alt="">
                                </div>
                                <p class="text-secondary card-text mb-2 text-center">
                                    Sell Automation
                                </p>
                            </a>

                        </div>
                    </div>
                    <a href="#" class="card-link text-dark text-deconration-none mt-2">Show more details</a>
                </div>
            </div>

        </a>
    </div> --}}
</div>
<script>
    function changeUBSImage(check) {
        var image = document.getElementById("accordianUbsImg");
        if (check == 1) {
            image.classList.add("fade-out");
            setTimeout(function() {
                image.src = "{{ asset('assets/front/images/ubs/img-2.png') }}";
                image.classList.remove("fade-out");
            }, 500);
        } else if (check == 2) {
            image.classList.add("fade-out");
            setTimeout(function() {
                image.src = "{{ asset('assets/front/images/ubs/img-3.png') }}";
                image.classList.remove("fade-out");
            }, 500);

        } else if (check == 3) {
            image.classList.add("fade-out");
            setTimeout(function() {
                image.src = "{{ asset('assets/front/images/ubs/img-4.png') }}";
                image.classList.remove("fade-out");
            }, 500);

        } else if (check == 4) {
            image.classList.add("fade-out");
            setTimeout(function() {
                image.src = "{{ asset('assets/front/images/ubs/img-2.png') }}";
                image.classList.remove("fade-out");
            }, 500);

        } else if (check == 5) {
            image.classList.add("fade-out");
            setTimeout(function() {
                image.src = "{{ asset('assets/front/images/ubs/img-3.png') }}";
                image.classList.remove("fade-out");
            }, 500);

        }
    }
</script>
