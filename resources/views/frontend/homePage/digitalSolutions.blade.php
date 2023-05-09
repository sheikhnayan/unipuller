<script>
    function addDetail(check) {
        var addText = document.getElementById(check);
        if (check == 'ms') {
            addText.classList.add("fade-out");
            setTimeout(function() {
                addText.innerHTML =
                    "Social Media has changed the way we interact & do business while creating a new avenue to grow our earning exponentially. While it’s easy to use social media.";
                addText.classList.remove("fade-out");
            }, 500);
        } else if (check == 'dc') {
            addText.classList.add("fade-out");
            setTimeout(function() {
                addText.innerHTML =
                    "75% of the content we consume is digital. Whether you are looking to make stand-alone digital content for your brand’s identity or series of infographics content for your campaign or looking to run the social media management by yourself. ";
                addText.classList.remove("fade-out");
            }, 500);
        }
        else if (check == 'wd') {
            addText.classList.add("fade-out");
            setTimeout(function() {
                addText.innerHTML =
                    "The Internet opened up the world when social media expanded it. We excel in both and deeply recognize the basic of creating the internet. Unlike traditional digital marketing company, we focus on creating great web experience and analyzing the performance with an end-goal in mind. ";
                addText.classList.remove("fade-out");
            }, 500);
        }
        else if (check == 'smm') {
            addText.classList.add("fade-out");
            setTimeout(function() {
                addText.innerHTML =
                    "Harnessing its true power is a different ball game. We have several years of EXPERIENCE, CUSTOMER’S TRUST & CERTIFIED social media planners, buyers & content developers to create a great experience";
                addText.classList.remove("fade-out");
            }, 500);
        }
        else if (check == 'oa') {
            addText.classList.add("fade-out");
            setTimeout(function() {
                addText.innerHTML =
                    "Online Advertisement is our core expertise from the beginning. With certification from ad giants like Google, Facebook, LinkedIn, Microsoft and other online, we have years of experience not just in media buying, but also planning & custom reporting for our partners.  ";
                addText.classList.remove("fade-out");
            }, 500);
        }
        else if (check == 'seo') {
            addText.classList.add("fade-out");
            setTimeout(function() {
                addText.innerHTML =
                    "Our online framework is built on search. without its power of showcasing your product, service and brand message, you are bound to fail in your short & long-time online game.";
                addText.classList.remove("fade-out");
            }, 500);
        }
        else if (check == 'cm') {
            addText.classList.add("fade-out");
            setTimeout(function() {
                addText.innerHTML =
                    "Content Marketing is the other fold of online advertisement. If you are looking to build a sustainable content house for your brand, we are here to provide you with brand research, selecting buyer persona and content plan ";
                addText.classList.remove("fade-out");
            }, 500);
        }
    }

    function removeDetail(check) {
        var addText = document.getElementById(check)
            addText.classList.add("fade-out");
            setTimeout(function() {
                addText.innerHTML = "";
                addText.classList.remove("fade-out");
            }, 500);
    }
</script>
<div class="digital-section bg-light pt-5 ">
    <div class="container">
        <h2 class="text-center">Digital Solutions</h2>
        <div class="row">
            <p class="text-center">We are committed to creating an actionable strategy, online marketing & technology
                solution for our
                partners. As a multidisciplinary company, we operate as a unified, design-led team. We’re passionate
                about what we do, and are driven by a desire to solve challenging problems on behalf of our
                partners.</p>

        </div>
        <div class="row">
            <h4 class="mb-0 pt-3">Feautres</h4>
            <div class="col-lg-3 col-md-6 col-sm-12"  onmouseover="addDetail('ms')" onmouseout="removeDetail('ms')">
                <div class="card"
                    style="height: 330px !important;background: url('{{ asset('assets/front/images/ds/ms.png') }}');');
                        background-position: center; background-repeat: no-repeat; background-size: cover;">
                    <div class="card__content">
                        <div class="card__content-inner">
                            <div class="card__title">MARKETING STRATEGY</div>
                            <div class="card__description" id="ms"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12"  onmouseover="addDetail('wd')" onmouseout="removeDetail('wd')">
                <div class="card"
                    style="height: 330px !important;background: url('{{ asset('assets/front/images/ds/wd.png') }}');');
                        background-position: center; background-repeat: no-repeat; background-size: cover;">
                    <div class="card__content">
                        <div class="card__content-inner">
                            <div class="card__title">WEB DEVELOPMENT</div>
                            <div class="card__description" id="wd">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12" onmouseover="addDetail('smm')" onmouseout="removeDetail('smm')">
                <div class="card"
                    style="height: 330px !important;background: url('{{ asset('assets/front/images/ds/smm.png') }}');');
                        background-position: center; background-repeat: no-repeat; background-size: cover;">
                    <div class="card__content">
                        <div class="card__content-inner">
                            <div class="card__title">SOCIAL MEDIA MARKETING</div>
                            <div class="card__description" id="smm"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12" onmouseover="addDetail('oa')" onmouseout="removeDetail('oa')">
                <div class="card"
                    style="height: 330px !important;background: url('{{ asset('assets/front/images/ds/oa.png') }}');');
                        background-position: center; background-repeat: no-repeat; background-size: cover;">
                    <div class="card__content">
                        <div class="card__content-inner">
                            <div class="card__title">ONLINE ADVERTISING</div>
                            <div class="card__description" id="oa"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12" onmouseover="addDetail('seo')" onmouseout="removeDetail('seo')">
                <div class="card"
                    style="height: 330px !important;background: url('{{ asset('assets/front/images/ds/seo.png') }}');');
                        background-position: center; background-repeat: no-repeat; background-size: cover;">
                    <div class="card__content">
                        <div class="card__content-inner">
                            <div class="card__title">SEARCH ENGINE OPTIMIZATION
                            </div>
                            <div class="card__description" id="seo">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12" onmouseover="addDetail('cm')" onmouseout="removeDetail('cm')">
                <div class="card"
                    style="height: 330px !important;background: url('{{ asset('assets/front/images/ds/cmpr.png') }}');');
                        background-position: center; background-repeat: no-repeat; background-size: cover;">
                    <div class="card__content">
                        <div class="card__content-inner">
                            <div class="card__title">CONTENT MARKETING</div>
                            <div class="card__description"  id="cm"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12" onmouseover="addDetail('dc')" onmouseout="removeDetail('dc')">
                <div class="card"
                    style="height: 330px !important;background: url('{{ asset('assets/front/images/ds/dc.png') }}');');
                        background-position: center; background-repeat: no-repeat; background-size: cover;">
                    <div class="card__content">
                        <div class="card__content-inner">
                            <div class="card__title">DIGITAL CONTENT</div>
                            <div class="card__description" id="dc"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
