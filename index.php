<?php
    require_once('./lib/read_plaintxt.php');
    require_once('./lib/read_json.php');
    require_once('./lib/read_csv.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <?php
            $plainText = readPlainTextData('./data/pages/companyName.txt');
            echo '<title>' . $plainText . '</title>'
        ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Premium Bootstrap 5 Landing Page Template" />
        <meta name="keywords" content="bootstrap 5, premium, marketing, multipurpose" />
        <meta content="Themesbrand" name="author" />

        <!-- favicon -->
        <?php
            $plainText = readPlainTextData('./data/pages/iconPath.txt');
            echo '<link rel="shortcut icon" href="' . $plainText . '" />'
        ?>
        
        <!-- css -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="css/materialdesignicons.min.css" rel="stylesheet" type="text/css" />
        <link href="css/style.min.css" rel="stylesheet" type="text/css" />
    </head>

    <body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-offset="20">
        <!-- Loader -->
        <div id="preloader">
            <div id="status">
                <div class="spinner">
                    <div class="bounce1"></div>
                    <div class="bounce2"></div>
                    <div class="bounce3"></div>
                  </div>
            </div>
        </div>

        <!--Navbar Start-->
        <nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top" id="navbar">
            <div class="container">
                <?php
                    $plainText = readPlainTextData('./data/pages/companyName.txt');
                    echo '<h2>' . $plainText . '</h2>'
                ?>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav ms-auto navbar-center" id="navbar-navlist">
                        <?php
                            $navData = readCSVData('./data/data2.csv');
                            foreach ($navData as $key => $nav) {
                                echo '
                                    <li class="nav-item">
                                         <a href="#' . $nav[0] . '" class="nav-link">' . $nav[1] . '</a>
                                    </li>
                                ';
                            }
                        ?>   
                    </ul>
                </div>
            </div>
            <!-- end container -->
        </nav>
        <!-- Navbar End -->

        <!-- Overview Start -->
        <section class="hero-3 bg-center position-relative" style="background-image: url(images/hero-3-bg.png);" id="Overview">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="text-center">
                            <h1 class="font-weight-semibold mb-4 hero-3-title">Overview</h1>
                            <?php
                                $plainText = readPlainTextData('./data/pages/overview.txt');
                                echo '<p class="mb-5 text-muted subtitle w-75 mx-auto">' . $plainText . '</p>'
                            ?>
                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div>
        </section>
        <!-- Overview End -->

        <!-- Mission Statement start -->
        <section class="section" id="Mission">
            <div class="container">
                <div class="row justify-content-center mb-5">
                    <div class="col-lg-7 text-center">
                        <h2 class="fw-bold">Mission Statement</h2>
                        <?php
                            $plainText = readPlainTextData('./data/pages/missionStatement.txt');
                            echo '<p class="text-muted">' . $plainText . '</p>'
                        ?> 
                    </div>
                </div>
            </div>
            <!-- end container -->
        </section>
        <!-- Mission Statement end -->

        <!-- Product start -->
        <section class="section bg-gradient-primary" id="Products">
            <div class="bg-overlay-img" style="background-image: url(images/demos.png);"></div>
                <div class="container">
                    <div class="row justify-content-center mb-5">
                        <div class="col-lg-7 text-center">
                            <h2 class="text-white fw-bold">Key Products & Services:</h2>
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="tab-content" id="pricingpills-tabContent">
                                <div class="tab-pane fade show active" id="pills-monthly" role="tabpanel" aria-labelledby="pills-monthly-tab">
                                    <div class="row">
                                        <!-- start col -->
                                        <?php
                                            $data = readJsonData('./data/products/products.json');
                                            foreach ($data as $key => $product) {
                                                echo '
                                                <div class="col-lg-4">
                                                    <div class="card plan-card mt-4 rounded text-center border-0 shadow overflow-hidden">
                                                        <div class="card-body px-4 py-5">
                                                            <h4 class="text-uppercase mb-4 pb-1">' . $product['name'] . '</h4>
                                                            <p><span class="fw-bold">' . $product['description'] . '</span></p>
                                                            <h5>Applications:</h5>
                                                            <ul>
                                                ';
                                            
                                                foreach ($product['applications'] as $appName => $appDescription) {
                                                    echo '<li class="text-muted">' . $appDescription . '</li>';
                                                }
                                            
                                                echo '
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                ';
                                            }
                                        ?>
                                        <!-- end col -->
                                    </div>
                                    <!-- end row -->
                                </div>
                                <!-- end monthly tab pane -->
                            </div>
                            <!-- end tab content -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- end container -->
            </div>
        </section>
        <!-- Product end -->

        <!-- Awards start -->
        <section class="section" id="Awards">
            <div class="container">
                <div class="row justify-content-center mb-4">
                    <div class="col-lg-7 text-center">
                        <h2 class="fw-bold">Our Awards</h2>
                    </div>
                </div>
                <div class="row">
                    <?php
                        $awardData = readCSVData('./data/awards/awards.csv');
                        foreach ($awardData as $key => $award) {
                            echo '
                                <div class="col-lg-4">
                                    <div class="card mt-4 border-0 shadow-lg">
                                        <div class="card-body p-4">
                                            <h4 class="font-size-22 my-4 text-center">' . $award[0] . '</h4>
                                            <p class="text-muted text-center">' . $award[1] . '</p>
                                        </div>
                                    </div>
                                </div>
                            ';
                        }
                    ?>   
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>
        <!-- Awards end -->

        <!-- Team start -->
        <section class="section bg-light" id="team" style="background-image: url(images/cta-bg.png);">
            <div class="container">
                <div class="row justify-content-center mb-4">
                    <div class="col-lg-7 text-center">
                        <h2 class="fw-bold">Our Team Members</h2>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
                <div class="row">
                    <!-- start col -->
                    <?php
                        $data = readJsonData('./data/team/team.json');
                        foreach ($data as $key => $person) {
                            echo '
                            <div class="col-lg-3 col-sm-6">
                                <div class="team-box mt-4 position-relative overflow-hidden rounded text-center shadow-lg">                    
                                    <div class="p-4">
                                        <h5 class="font-size-19 mb-1">' . $person['name'] . '</h5>
                                        <h6 class="text-muted text-uppercase font-size-14 mb-0 p-3">' . $person['title'] . '</h6>
                                        <p class="text-muted">' . $person['details'] . '</p>
                                    </div>
                                </div>
                            </div>
                            ';
                        }
                    ?>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>
        <!-- Team end -->

        <!-- Contact us start -->
        <section class="section" id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="fw-bold mb-4">Get in Touch</h2>
                        <?php
                                $plainText = readPlainTextData('./data/pages/contact.txt');
                                echo '<p class="text-muted mb-5">' . $plainText . '</p>'
                        ?>
                        <div>
                            <form method="post" name="myForm" onsubmit="return validateForm()">
                                <p id="error-msg"></p>
                                <div id="simple-msg"></div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="name" class="text-muted form-label">Name</label>
                                            <input name="name" id="name" type="text" class="form-control" placeholder="Enter name*" >
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="email" class="text-muted form-label">Email</label>
                                            <input name="email" id="email" type="email" class="form-control" placeholder="Enter email*">
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-12">
                                        <div class="mb-4">
                                            <label for="subject" class="text-muted form-label">Subject</label>
                                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter Subject.." />
                                        </div>
                                        <div class="mb-4 pb-2">
                                            <label for="comments" class="text-muted form-label">Message</label>
                                            <textarea name="comments" id="comments" rows="4" class="form-control" placeholder="Enter message..."></textarea>
                                        </div>
                                        <button type="submit" id="submit" name="send" class="btn btn-primary">Send Message</button>
                                    </div>
                                    <!-- end col -->
                                </div>
                                <!-- end row -->
                            </form>
                            <!-- end form -->
                        </div>
                        
                    </div>
                    <!-- end col -->
                    <div class="col-lg-5 ms-lg-auto">
                        <div class="mt-5 mt-lg-0">
                            <img src="images/contact.png" alt="" class="img-fluid d-block"/>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>
        <!-- Contact us end -->

        <!-- Footer Start -->
        <footer class="footer" style="background-image: url(images/footer-bg.png);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-4">
                            <?php
                                $footerData = readCSVData('./data/data3.csv');
                                foreach ($footerData as $key => $footer) {
                                    echo '
                                    <h2 class="text-white-50 my-4">' . $footer[0] . '</h2>
                                    <p class="text-white-50 my-4">' . $footer[1] . '</p>
                                    ';
                                }
                            ?>   
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-lg-6 ms-lg-auto">
                        <div class="row">
                            <div class="col-lg-4 col-6 justify-content-center">
                                <div class="mt-4 mt-lg-0">
                                    <h4 class="text-white font-size-18 mb-3">Quick Links</h4>
                                    <ul class="list-unstyled footer-sub-menu">
                                    <?php
                                        $footerData = readCSVData('./data/data2.csv');
                                        foreach ($footerData as $key => $footer) {
                                            echo '
                                                <li><a href="#' . $footer[0] . '" class="footer-link">' . $footer[1] . '</a></li>
                                            ';
                                        }
                                    ?>   
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-5">
                            <p class="text-white-50 f-15 mb-0">
                                <script>
                                document.write(new Date().getFullYear())
                            </script> 
                            <?php
                                $plainText = readPlainTextData('./data/pages/copyright.txt');
                                echo '' . $plainText . '</p>'
                            ?> 
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </footer>
        <!-- Footer End -->
        
        <!-- Style switcher -->
        <div id="style-switcher">
            <div class="bottom">
                <a href="javascript: void(0);" id="mode" class="mode-btn text-white">
                    <p class="mode-light">&#9789;</p>
                    <p style="color:#343a40" class="mode-dark">&#9788;</p>
                </a>
                <a href="javascript: void(0);" class="settings" onclick="toggleSwitcher()"><i class="mdi mdi-cog  mdi-spin"></i></a>
            </div>
        </div>

        <!-- javascript -->
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/smooth-scroll.polyfills.min.js"></script>

        <script src="https://unpkg.com/feather-icons"></script>

        <!-- App Js -->
        <script src="js/app.js"></script>
    </body>
</html>
