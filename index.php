<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--Bootstrap icons link-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!--Mapbox css link (optional)-->
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css' rel='stylesheet' />

    <!--Custom styles link-->
    <link rel="stylesheet" href="CSS/style.css">

    <title>LP Budgeting</title>
</head>
<body>
<!--HEADER START-->
<!--navbar start-->
<nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 fixed-top">
    <div class="container">
        <a href="#" class="navbar-brand">LP<span class="text-warning">Budgeting</span></a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navmenu"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navmenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="#learn" class="nav-link">What you will learn</a>
                </li>
                <li class="nav-item">
                    <a href="#questions" class="nav-link">Questions</a>
                </li>
                <li class="nav-item">
                    <a href="#instructors" class="nav-link">Instructors</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!--navbar end-->
<!--HEADER END-->

<!--BODY START-->
<!--Showcase start-->
<section class="bg-dark text-light p-5 p-lg-0 pt-lg-5 text-center text-sm-start">
    <div class="container">
        <div class="d-sm-flex align-items-center justify-content-between">
            <div>
                <h1>Become a <span class="text-warning"> Web Developer</span></h1>
                <p class="lead my-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur culpa
                    cum delectus deleniti dicta eaque earum, incidunt neque nesciunt numquam optio quae quidem quod
                    sapiente, similique ullam,
                    veritatis vero voluptatem?
                </p>
                <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#enroll">Start The Enrollment</button>
            </div>
            <img class="img-fluid w-50 d-none d-sm-block" src="img/placeholder.jpg" alt="placeholder">
        </div>
    </div>

</section>
<!--Showcase end-->

<!--Newsletter start-->
<section class="bg-primary text-light p-5">
    <div class="container">
        <div class="d-md-flex justify-content-between align-items-center">
            <h3 class="mb-3 mb-md-0">Sign up for Our Newsletter</h3>

            <div class="input-group">
                <input
                        type="text"
                        class="form-control news-input"
                        placeholder="Enter Email"
                        >
                <button
                        class="btn btn-dark btn-lg"
                        type="button"
                       >Button</button>
            </div>

        </div>
    </div>
</section>
<!--Newsletter end-->

<!--Boxes start-->
<section class="p-5">
    <div class="container">
<!--g-4 gives a gap between all the boxes-->
        <div class="row text-center g-4">
            <div class="col-md">
                <div class="card bg-dark text-light">
                    <div class="card-body text-center">
                        <div class="h1 mb-3">
                        <i class="bi bi-laptop"></i>
                        </div>
                        <h3 class="card-title mb-3">
                            Virtual
                        </h3>
                        <p class="card-text">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores, veniam?Lorem ipsum dolor sit amet.
                        </p>
                        <a href="#" class="btn btn-primary">Read more</a>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="card bg-secondary text-light">
                    <div class="card-body text-center">
                        <div class="h1 mb-3">
                            <i class="bi bi-person-square"></i>
                        </div>
                        <h3 class="card-title mb-3">Hybrid</h3>
                        <p class="card-text">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores, veniam?Lorem ipsum dolor sit amet.
                        </p>
                        <a href="#" class="btn btn-dark">Read more</a>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="card bg-dark text-light">
                    <div class="card-body text-center">
                        <div class="h1 mb-3">
                            <i class="bi bi-people"></i>
                        </div>
                        <h3 class="card-title mb-3">In Person</h3>
                        <p class="card-text">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores, veniam?Lorem ipsum dolor sit amet.
                        </p>
                        <a href="#" class="btn btn-primary">Read more</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Boxes end-->
<!--Learn Sections start-->
<section id="learn" class="p-5">
    <div class="container">
        <div class="row align-item-center justify-content-between">
            <div class="col-md">
                <img src="img/placeholder.jpg" class="img-fluid" alt="">
            </div>
            <div class="col-md p-5">
                <h2>Learn the fundamentals</h2>
                <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut autem cum doloremque hic iusto maxime nihil obcaecati ratione, sint voluptate!</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto consequuntur, distinctio ea est ex, incidunt
                    ipsa labore laborum laudantium maiores nobis odit perspiciatis qui ratione reiciendis velit vitae voluptate voluptatibus.</p>
                <a href="#" class="btn btn-light mt-3"> <i class="bi bi-chevron-right"></i> Read more</a>
            </div>
        </div>
    </div>
</section>

<section id="learn" class="p-5 bg-dark text-light">
    <div class="container">
        <div class="row align-item-center justify-content-between">
            <div class="col-md p-5">
                <h2>Learn React</h2>
                <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut autem cum doloremque hic iusto maxime nihil obcaecati ratione, sint voluptate!</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto consequuntur, distinctio ea est ex, incidunt
                    ipsa labore laborum laudantium maiores nobis odit perspiciatis qui ratione reiciendis velit vitae voluptate voluptatibus.</p>
                <a href="#" class="btn btn-light mt-3"> <i class="bi bi-chevron-right"></i> Read more</a>
            </div>
            <div class="col-md">
                <img src="img/placeholder.jpg" class="img-fluid" alt="placeholder">
            </div>
        </div>
    </div>
</section>
<!--Learn Sections end-->

<!--Question Accordion start-->
<section class="p-5" id="questions">
    <div class="container">
        <h2 class="text-center mb-4">Frequently asked questions</h2>
        <div class="accordion accordion-flush" id="questions">
            <!--item 1-->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#question-1">
                        Where exactly are you located?
                    </button>
                </h2>
                <div id="question-1" class="accordion-collapse collapse" data-bs-parent="#questions">
                    <div class="accordion-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusant
                        ium corporis deleniti dicta dolorem ea, eveniet expedita explicabo neque nobis omnis
                        qui quo repudiandae ullam, veniam voluptate! Debitis dolorum et iure nobis officia quo rem. Amet
                        architecto debitis, dolore dolores eveniet ipsam molestiae, necessitatibus neque nulla odio quas, sunt temporibus voluptas.</div>
                </div>
            </div>
            <!--item 2-->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#question-2">
                        How much does it cost to attend?
                    </button>
                </h2>
                <div id="question-2" class="accordion-collapse collapse" data-bs-parent="#questions">
                    <div class="accordion-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusant
                        ium corporis deleniti dicta dolorem ea, eveniet expedita explicabo neque nobis omnis
                        qui quo repudiandae ullam, veniam voluptate! Debitis dolorum et iure nobis officia quo rem. Amet
                        architecto debitis, dolore dolores eveniet ipsam molestiae, necessitatibus neque nulla odio quas, sunt temporibus voluptas.</div>
                </div>
            </div>
            <!--item 3-->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#question-3">
                        What do I need to know?
                    </button>
                </h2>
                <div id="question-3" class="accordion-collapse collapse" data-bs-parent="#questions">
                    <div class="accordion-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusant
                        ium corporis deleniti dicta dolorem ea, eveniet expedita explicabo neque nobis omnis
                        qui quo repudiandae ullam, veniam voluptate! Debitis dolorum et iure nobis officia quo rem. Amet
                        architecto debitis, dolore dolores eveniet ipsam molestiae, necessitatibus neque nulla odio quas, sunt temporibus voluptas.</div>
                </div>
            </div>
            <!--item 4-->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#question-4">
                        How do I sign up?
                    </button>
                </h2>
                <div id="question-4" class="accordion-collapse collapse" data-bs-parent="#questions">
                    <div class="accordion-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusant
                        ium corporis deleniti dicta dolorem ea, eveniet expedita explicabo neque nobis omnis
                        qui quo repudiandae ullam, veniam voluptate! Debitis dolorum et iure nobis officia quo rem. Amet
                        architecto debitis, dolore dolores eveniet ipsam molestiae, necessitatibus neque nulla odio quas, sunt temporibus voluptas.</div>
                </div>
            </div>
            <!--item 5-->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#question-5">
                        Do you help me find a job?
                    </button>
                </h2>
                <div id="question-5" class="accordion-collapse collapse" data-bs-parent="#questions">
                    <div class="accordion-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusant
                        ium corporis deleniti dicta dolorem ea, eveniet expedita explicabo neque nobis omnis
                        qui quo repudiandae ullam, veniam voluptate! Debitis dolorum et iure nobis officia quo rem. Amet
                        architecto debitis, dolore dolores eveniet ipsam molestiae, necessitatibus neque nulla odio quas, sunt temporibus voluptas.</div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Question Accordion end-->
s
<!--Instructors/Review start-->
<section id="instructors" class="p-5 bg-primary">
    <div class="container">
        <h2 class="text-center text-white">Our instructors</h2>
        <p class="lead text-center text-white mb-5">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad architecto cum dolores id magni maxime quia recusandae sapiente suscipit vel!
        </p>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="card bg-light">
                    <div class="card-body text-center">
                        <img src="https://randomuser.me/api/portraits/men/10.jpg" class="rounded-circle mb-3" alt="">
                        <h3 class="card-title mb-3">John Doe</h3>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum enim est eveniet minima ratione, similique!</p>
                        <a href="#"><i class="bi bi-twitter text-dark mx-1"></i></a>
                        <a href="#"><i class="bi bi-facebook text-dark mx-1"></i></a>
                        <a href="#"><i class="bi bi-linkedin text-dark mx-1"></i></a>
                        <a href="#"><i class="bi bi-instagram text-dark mx-1"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card bg-light">
                    <div class="card-body text-center">
                        <img src="https://randomuser.me/api/portraits/women/8.jpg" class="rounded-circle mb-3" alt="">
                        <h3 class="card-title mb-3">Jane Doe</h3>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum enim est eveniet minima ratione, similique!</p>
                        <a href="#"><i class="bi bi-twitter text-dark mx-1"></i></a>
                        <a href="#"><i class="bi bi-facebook text-dark mx-1"></i></a>
                        <a href="#"><i class="bi bi-linkedin text-dark mx-1"></i></a>
                        <a href="#"><i class="bi bi-instagram text-dark mx-1"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card bg-light">
                    <div class="card-body text-center">
                        <img src="https://randomuser.me/api/portraits/men/13.jpg" class="rounded-circle mb-3" alt="">
                        <h3 class="card-title mb-3">Steve Smith</h3>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum enim est eveniet minima ratione, similique!</p>
                        <a href="#"><i class="bi bi-twitter text-dark mx-1"></i></a>
                        <a href="#"><i class="bi bi-facebook text-dark mx-1"></i></a>
                        <a href="#"><i class="bi bi-linkedin text-dark mx-1"></i></a>
                        <a href="#"><i class="bi bi-instagram text-dark mx-1"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card bg-light">
                    <div class="card-body text-center">
                        <img src="https://randomuser.me/api/portraits/women/19.jpg" class="rounded-circle mb-3" alt="">
                        <h3 class="card-title mb-3">Sarah Smith</h3>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum enim est eveniet minima ratione, similique!</p>
                        <a href="#"><i class="bi bi-twitter text-dark mx-1"></i></a>
                        <a href="#"><i class="bi bi-facebook text-dark mx-1"></i></a>
                        <a href="#"><i class="bi bi-linkedin text-dark mx-1"></i></a>
                        <a href="#"><i class="bi bi-instagram text-dark mx-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Instructors/Review end-->
<!--Contact & Map start-->
<section class="p-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md">
                <h2 class="text-center mb-4">Contact info</h2>
                <ul class="list-group list-group-flush lead">
                    <li class="list-group-item">
                        <span class="fw-bold">Main Location:</span> 50 Main st Boston MA
                    </li>
                    <li class="list-group-item">
                        <span class="fw-bold">Enrollment Phone:</span> (555) 555-555
                    </li>
                    <li class="list-group-item">
                        <span class="fw-bold">Student Phone:</span> (333) 333-333
                    </li>
                    <li class="list-group-item">
                        <span class="fw-bold">Enrollment Email:</span> enroll@mail.com
                    </li>

                </ul>
            </div>
            <div class="col-md">
                <div id="map"></div>
            </div>
        </div>
    </div>
</section>
<!--Contact & Map end-->
<!--Footer start-->
<footer class="p-5 bg-dark text-white text-center position-relative">
    <div class="container">
        <p class="lead">Copyright &copy: 2021 LukaP</p>
        <a href="#" class="position-absolute bottom-0 end-0 p-5">
            <i class="bi bi-arrow-up-circle h1"></i>
        </a>
    </div>
</footer>
<!--Footer end-->
<!--Modal start-->
<!-- Modal -->
<div class="modal fade" id="enroll" tabindex="-1" aria-labelledby="enrollLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="enrollLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="lead">Fill out this form we will get back to you</p>
                <form action="">
                    <div class="mb-3">
                        <label for="first-name" class="col-form-label">First Name:</label>
                        <input type="text" class="form-control" id="first-name">
                    </div>
                    <div class="mb-3">
                        <label for="first-name" class="col-form-label">Last Name:</label>
                        <input type="text" class="form-control" id="last-name">
                    </div>
                    <div class="mb-3">
                        <label for="first-name" class="col-form-label">Email:</label>
                        <input type="text" class="form-control" id="email">
                    </div>
                    <div class="mb-3">
                        <label for="first-name" class="col-form-label">Phone:</label>
                        <input type="text" class="form-control" id="phone">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>
<!--Modal end-->




<!--BODY END-->
<!--Javascript links -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<!--Mapbox link(optional)-->
<script src='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js'></script>
<script>
    mapboxgl.accessToken = 'pk.eyJ1IjoibHVrYXAxMjM0IiwiYSI6ImNsMGUyZm9zMzBlbjcza216dHVpaHp1MGsifQ.YiIO8BXNFO_5ulU7cekvnQ';
    let map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [-71.060982,42.35725],
        zoom:18,
    });
</script>

</body>
</html>