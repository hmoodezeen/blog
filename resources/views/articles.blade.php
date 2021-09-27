<!DOCTYPE html>
<html lang="en">
<head>

    <title>laravel- cms App</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">

    
</head>
<body>

    <nav class="navbar px-md-0 navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
        <a class="navbar-brand" href="/"><i>{</i>oders<i> ;</i></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="home" class="nav-link">Home</a></li>
            <li class="nav-item active"><a href="articles" class="nav-link">Articles</a></li>
            <li class="nav-item"><a href="about.html" class="nav-link">Team</a></li>
            <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>
            </ul>
        </div>
        </div>
    </nav>
    <!-- END nav -->

        <section class="ftco-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        @foreach ($posts as $post)
                <div class="case" data-aos="fade-up"
                data-aos-anchor-placement="center-bottom" >
                    <div class="row">
                    <div class="col-md-6 col-lg-6 col-xl-8 d-flex">
                        <a href="blog-single.html" class="img w-100 mb-3 mb-md-0" style="background-image: url({{asset('storage/'.$post->image)}});"></a>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-4 d-flex">
                        <div class="text w-100 pl-md-3">
                        <span class="subheading">{{ $post->category->name }}</span>
                        <h2><a href="{{route('posts.show', $post->id)}}">
                        {{ $post->title }}
                        </a></h2>
                        <ul class="media-social list-unstyled">
                            <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                        </ul>
                        <div class="meta">
                        <p class="mb-0">
                        <a href="#">{{ $post->created_at }}</a></p>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                @endforeach
                    </div>
                </div>
            </div>
        </section>

        


    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/scrollax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="js/google-map.js"></script>
    <script src="js/main.js"></script>

    </body>
    </html>