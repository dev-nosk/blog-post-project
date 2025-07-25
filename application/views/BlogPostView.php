<?php 
// var_dump('<pre>',$_SESSION['categories']); 
// die;
?>

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
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/view.css" />
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="transition: background-color 0.3s ease;">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">BlogPost</a>
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars text-white"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="<?= base_url() ?>">Home</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="categoryDropdown" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-th-list me-2"></i>Categories
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="categoryDropdown">
                            <?php foreach ($categories as $category): ?>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="<?= htmlspecialchars(base_url() . 'find/' . $category->id . '/' . urlencode($category->Name)) ?>">
                                        <span class="badge <?= htmlspecialchars($category->ColorTag) ?> me-2"></span>
                                        <span><?= htmlspecialchars($category->Name) ?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
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

    <div class="row">
        <div class="col-md-2 col-sm-0 d-none d-md-block">
            <div class="container mb-5 d-flex justify-content-end mt-5">
                <div class="card shadow-lg p-4 text-center" style="width: 280px; align-self: center;">
                    <h5 class="mb-3 text-primary">Advertisement</h5>
                    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 500px;">
                        <span class="text-muted"><?= isset($adContent) ? $adContent : 'Your Ad Here (728x90 or 280x500)' ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-12">
            <br>
            <h4 class="mb-4 text-primary text-center" style="font-family: 'Georgia', serif; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; border-bottom: 2px solid var(--primary-accent); padding-bottom: 10px;">
                Latest News
            </h4>
            <div class="container-fluid mb-5">
                <div class="owl-carousel owl-theme">
                     <?php foreach ($hight_lights as $highlight): ?>
                    <div class="item position-relative">
                        <img src="<?= base_url() . $highlight->ImagePath ?>" class="w-100 carousel-img rounded" alt="Voting" />
                        <div class="position-absolute top-0 start-0 m-3 d-inline-flex gap-1 flex-wrap">
                            <div class="category-label badge <?= $_SESSION['categories'][$highlight->CategoryId]->ColorTag ?>"><?= $_SESSION['categories'][$highlight->CategoryId]->Name ?></div>
                            <!-- <div class="category-label badge">#LabanPh</div> -->
                        </div>

                        <div class="title-label position-absolute bottom-0 start-0 mb-3 ms-3 px-4 py-2 rounded shadow">
                            <a target="_blank" href="<?= base_url() ?>article/1/<?= strtolower(preg_replace('/[^a-zA-Z0-9-]/', '-', $highlight->Title)) ?>" style="text-decoration:none;color:azure"><?= $highlight->Title ?></a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <br>
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
                        <?php foreach ($all_post as $post): ?>
                        <div class="col-md-4">
                            <div class="card h-100 position-relative">
                                <img src="<?= base_url() . $post->ImagePath ?>" class="card-img-top" alt="Debate">
                                <div class="position-absolute top-0 start-0 m-3">
                                    <span class="badge <?= $_SESSION['categories'][$post->CategoryId]->ColorTag ?>"><?= $_SESSION['categories'][$post->CategoryId]->Name ?></span>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title" style="font-family: 'Georgia', serif; font-weight: bold;"><?= $post->Title ?></h5>
                                    <p class="card-text" style="font-family: 'Georgia', serif;"><?= $post->ShortDescription ?></p>
                                    <a href="<?= base_url() ?>article/<?= $post->id ?>/<?= strtolower(preg_replace('/[^a-zA-Z0-9-]/', '-', $post->Title)) ?>" class="btn btn-outline-primary btn-sm" style="font-family: 'Georgia', serif;">Read More</a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                     
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
            </div>
        </div>
        <div class="col-md-2 col-sm-12 d-flex flex-column align-items-center">
            <!-- Advertisement Space -->
            <div class="container mb-5 d-flex justify-content-center mt-5 position-relative">
                <div class="card shadow-lg p-4 text-center" style="width: 280px; align-self: center;">
                    <button class="btn-close close-ad position-absolute top-0 end-0 m-2" aria-label="Close"></button>
                    <h5 class="mb-3 text-primary">Advertisement</h5>
                    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 150px;">
                        <span class="text-muted">Your Ad Here (728x90 or 300x250)</span>
                    </div>
                </div>
            </div>
            <div class="container mb-5 d-flex justify-content-center mt-5 position-relative">
                <div class="card shadow-lg p-4 text-center" style="width: 280px; align-self: center;">
                    <button class="btn-close close-ad position-absolute top-0 end-0 m-2" aria-label="Close"></button>
                    <h5 class="mb-3 text-primary">Advertisement</h5>
                    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 150px;">
                        <span class="text-muted">Your Ad Here (728x90 or 300x250)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="text-center text-muted py-4">
        &copy; 2025 Blog Post GoodMan | Powered by dev
    </footer>
    <!-- Accept Cookies -->
    <div id="cookieConsent" class="position-fixed bottom-0 start-0 w-100 bg-light p-3 shadow-lg" style="z-index: 1050; display: none;">
        <div class="container d-flex justify-content-between align-items-center">
            <p class="mb-0">We use cookies to improve your experience. By using our site, you agree to our <a href="<?= base_url() ?>policy" target="_blank" class="text-primary">Privacy Policy</a>.</p>
            <button id="acceptCookies" class="btn btn-primary btn-sm">Accept</button>
        </div>
    </div>
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"></script>

    <script>
        $(document).ready(function() {

            $('.close-ad').on('click', function() {
                $(this).closest('.card').fadeOut();
            });

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

            // Check if cookies are already accepted
            if (!localStorage.getItem('cookiesAccepted')) {
                $('#cookieConsent').fadeIn();
            }

            // Accept cookies
            $('#acceptCookies').on('click', function() {
                localStorage.setItem('cookiesAccepted', 'true');
                $('#cookieConsent').fadeOut();
            });
        });
    </script>
</body>

</html>