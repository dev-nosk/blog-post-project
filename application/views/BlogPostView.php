<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Politics Blog - Gen Z Voter Influence</title>

    <!-- MDBootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.css" rel="stylesheet" />

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />


    <style>
        :root {
            --primary-accent: #1E90FF;
            --secondary-accent: #FF6B00;
            --text-color: #222222;
            --bg-light: #F7F7F7;
        }

        body {
            background-color: #f5f6ff;
            color: var(--text-color);
            font-family: 'Segoe UI', sans-serif;
        }

        .carousel-img {
            height: 400px;
            object-fit: cover;
        }

        .card-img-top {
            height: 180px;
            object-fit: cover;
        }

        .blog-header {
            background: linear-gradient(to right, #0f4c81, #1E90FF);
            color: white;
            padding: 60px 30px;
        }

        .navbar {
            background-color: #0f4c81 !important;
        }

        .btn-primary,
        .btn-outline-primary {
            border-color: var(--primary-accent);
            color: var(--primary-accent);
        }

        .btn-primary {
            background-color: var(--primary-accent);
            color: white;
        }

        .btn-outline-primary:hover {
            background-color: var(--secondary-accent);
            border-color: var(--secondary-accent);
            color: white;
        }

        .category-label.badge {
            background-color: var(--primary-accent);
        }

        .title-label {
            background-color: rgba(255, 255, 255, 0.9);
            color: var(--text-color);
        }

        footer {
            background-color: var(--bg-light);
        }

        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .title-label {
            background-color: rgba(34, 34, 34, 0.85);
            /* semi-transparent dark */
            color: #ffffff;
            /* white text */
            font-family: 'Georgia', serif;
            /* elegant, readable */
            font-weight: 600;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
            border-left: 5px solid var(--primary-accent);
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 90%;
            /* prevents overflow on mobile */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .title-label:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="transition: background-color 0.3s ease;">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">BlogPost</a>
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars text-white"></i>
            </button>
            <div class="collapse navbar-collapse overflow-auto" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="categoryDropdown" role="button" data-mdb-toggle="dropdown" aria-expanded="false">Categories</a>
                        <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                            <li><a class="dropdown-item" href="#">Elections</a></li>
                            <li><a class="dropdown-item" href="#">Policy</a></li>
                            <li><a class="dropdown-item" href="#">International Affairs</a></li>
                            <li><a class="dropdown-item" href="#">Climate & Environment</a></li>
                            <li><a class="dropdown-item" href="#">Youth Politics</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa-regular fa-circle-user" style="font-size: 30px;"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Blog Header -->
    <header class="blog-header text-center">
        <h1 class="display-4 fw-bold">Blog Post By GoodMan</h1>
        <p class="lead">"ma ano ulam?"</p>
    </header>
    <!-- Advertisement Space -->
    <div class="container mb-5 d-flex justify-content-end" style="position: absolute;right: 0;top:50%">
        <div class="card shadow-lg p-4 text-center" style="width: 250px; align-self: center;">
            <h5 class="mb-3 text-primary">Advertisement</h5>
            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 150px;">
                <span class="text-muted">Your Ad Here (728x90 or 300x250)</span>
            </div>
        </div>
        
    </div>
    <!-- Image Carousel with Items -->
    <div class="container my-5">
        <div class="owl-carousel owl-theme">
            <div class="item position-relative">
                <img src="<?= base_url() ?>assets/images/paquio.jpg" class="w-100 carousel-img rounded" alt="Voting" />
                <div class="position-absolute top-0 start-0 m-3 d-inline-flex gap-1 flex-wrap">
                    <div class="category-label badge">SPORTS</div>
                    <div class="category-label badge">#LabanPh</div>
                </div>

                <div class="title-label position-absolute bottom-0 start-0 mb-3 ms-3 px-4 py-2 rounded shadow">
                    Pacman vs Barrios: A Fight for the Ages
                </div>
            </div>
            <div class="item position-relative">
                <img src="<?= base_url() ?>assets/images/paquio2.jpg" class="w-100 carousel-img rounded" alt="Voting" />
                <div class="category-label badge position-absolute top-0 start-0 m-3">SPORTS</div>
                <div class="title-label position-absolute bottom-0 start-0 mb-3 ms-3 px-4 py-2 rounded shadow">
                    Manny Pacquiao turns back clock but settles for draw with Mario Barrios
                </div>
            </div>
            <div class="item position-relative">
                <img src="<?= base_url() ?>assets/images/paquio3.jpg" class="w-100 carousel-img rounded" alt="Voting" />
                <div class="category-label badge position-absolute top-0 start-0 m-3">SPORTS</div>
                <div class="title-label position-absolute bottom-0 start-0 mb-3 ms-3 px-4 py-2 rounded shadow">
                    Pacquiao recovers movement from his ‘greatest fight’
                </div>
            </div>
        </div>
    </div>

    <!-- Blog Post Content -->
    <div class="container">
        <article class="card shadow p-4 mb-5 bg-white rounded">
            <h2 class="h4 mb-3 text-primary">JUST NOW!</h2>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit...</p>
        </article>
    </div>

    <!-- More News Section -->
    <div class="container mb-5">
        <h4 class="mb-4 text-primary text-center" style="font-family: 'Georgia', serif; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; border-bottom: 2px solid var(--primary-accent); padding-bottom: 10px;">
            More News
        </h4>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="<?= base_url() ?>assets/images/blog-post.png" class="card-img-top" alt="Debate">
                    <div class="card-body">
                        <h5 class="card-title" style="font-family: 'Georgia', serif; font-weight: bold;">Debate Season Begins</h5>
                        <p class="card-text" style="font-family: 'Georgia', serif;">Candidates spar over education and inflation ahead of 2026 elections.</p>
                        <a href="#" class="btn btn-outline-primary btn-sm" style="font-family: 'Georgia', serif;">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="<?= base_url() ?>assets/images/blog-post.png" class="card-img-top" alt="Climate March">
                    <div class="card-body">
                        <h5 class="card-title" style="font-family: 'Georgia', serif; font-weight: bold;">Youth Climate March Hits Capital</h5>
                        <p class="card-text" style="font-family: 'Georgia', serif;">Thousands of Gen Z activists demand government action on emissions and jobs.</p>
                        <a href="#" class="btn btn-outline-primary btn-sm" style="font-family: 'Georgia', serif;">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="<?= base_url() ?>assets/images/blog-post.png" class="card-img-top" alt="Protest">
                    <div class="card-body">
                        <h5 class="card-title" style="font-family: 'Georgia', serif; font-weight: bold;">Global Protests: Youth Demand Change</h5>
                        <p class="card-text" style="font-family: 'Georgia', serif;">From Manila to Madrid, Gen Z protests push back against corruption.</p>
                        <a href="#" class="btn btn-outline-primary btn-sm" style="font-family: 'Georgia', serif;">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Get Newspaper & Social Subscribe -->
    <div class="container mb-5">
        <div class="row g-4">
            <!-- Get Newspaper -->
            <div class="col-md-6">
                <div class="card shadow-sm p-4 h-100">
                    <h5 class="text-primary mb-3">Get Our Newspaper</h5>
                    <p>Stay updated with weekly political insights and analysis.</p>
                    <form>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Enter your email" aria-label="Email">
                            <button class="btn btn-primary" type="submit">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Social Media Subscribe -->
            <div class="col-md-6">
                <div class="card shadow-sm p-4 h-100 text-center">
                    <h5 class="text-primary mb-3">Follow Us</h5>
                    <p>Get the latest updates on your favorite platforms.</p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="https://twitter.com/" target="_blank" class="btn btn-outline-primary">
                            <i class="fab fa-twitter me-2"></i> Twitter
                        </a>
                        <a href="https://facebook.com/" target="_blank" class="btn btn-outline-primary">
                            <i class="fab fa-facebook-f me-2"></i> Facebook
                        </a>
                        <a href="https://instagram.com/" target="_blank" class="btn btn-outline-primary">
                            <i class="fab fa-instagram me-2"></i> Instagram
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center text-muted py-4">
        &copy; 2025 Blog Post GoodMan | Powered by dev
    </footer>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"></script>

    <script>
        $(document).ready(function() {
         

            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 15,
                nav: true,
                dots: true,
                autoplay: true,
                autoplayTimeout: 4000,
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 2
                    },
                    992: {
                        items: 3
                    }
                }
            });
        });
    </script>
</body>

</html>