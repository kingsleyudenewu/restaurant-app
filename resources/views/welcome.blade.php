<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="https://blackrockdigital.github.io/startbootstrap-full-width-pics/vendor/bootstrap/css/bootstrap.min.css" crossorigin="anonymous">



        <!-- Styles -->

    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Start Bootstrap</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header - set the background image for the header in the line below -->
    <header class="py-5 bg-image-full" style="background-image: url('https://www.thuisbezorgd.nl/en/campaign/Favourites/img/Desk_friends.jpg');background-position-x: 63%;
    background-position-y: 13%;
    background-size: cover;">
        <img class="img-fluid d-block mx-auto" src="http://placehold.it/200x200&text=Logo" alt="">
    </header>

    <!-- Content section -->
    <section class="py-5">
        <div class="container">
            <h1>Search Foor Your Restaurant</h1>
            <hr>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Password</label>
                    <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <table class="table table-dark">
                <thead class="thead-light">
                    <tr>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Popularity</th>
                        <th>Distance</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($restaurants as $value)
                    <tr>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->status }}</td>
                        <td>{{ $value->sortingValues->popularity }}</td>
                        <td>{{ $value->sortingValues->distance }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </section>






    <!-- Footer -->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2018</p>
        </div>
        <!-- /.container -->
    </footer>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://blackrockdigital.github.io/startbootstrap-full-width-pics/vendor/bootstrap/js/bootstrap.min.js" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    </body>
</html>
