<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="{{asset('asset/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css"
            integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz"
             crossorigin="anonymous">
           
        <!-- Bootstrap Bundle with Popper -->
        <script src="{{asset('asset/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

        <title>Task Project for Zabai</title>
    </head>
    <body>
        {!! request()->segment(2) !!}
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link {{ ($data['nav'] == 'vote-question') ? 'active' : '' }}" aria-current="page" href="vote-question">Vote</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ ($data['nav'] == 'vote-result') ? 'active' : '' }}" href="vote-result">Voting Result</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ ($data['nav'] == 'question') ? 'active' : '' }}" href="question">Create Question</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
	   @yield('content')
 	
        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="  crossorigin="anonymous"></script>
 	    @stack('scripts')
    </body>
</html>