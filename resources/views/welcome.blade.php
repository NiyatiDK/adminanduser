<html>
    <head>
        <title>Admin Registration</title>
    </head>
    <body>
        <form action="{{ route('register')}}" method="post">
            @csrf

            @if (count($errors) > 0)
                <!-- Start Box Body -->
                <div class="box-body">
                    <div class="alert alert-danger alert-dismissible" id="dangerAlert">
                        {{trans('Whoops! There were some problems with your input.')}} <br><br>
                        <ul class="list-unstyled m-0">
                            @foreach ($errors->all() as $error)
                                <li><i class="far fa-times-circle"></i> {{$error}}</li>
                            @endforeach
                        </ul>

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                </div><!-- /.box-body -->
            @endif
            <h1><b>Admin Registration</b></h1>
            <div>
                <label for="">Enter user name: </label>
                <input type="text" name="user_name" id="">
            </div>
            <div>
                <label for="">Enter Email:     </label>
                <input type="text" name="email" id="">
            </div>
            <div>
                <label for="">Enter Password:   </label>
                <input type="password" name="password" id="">
            </div>
            <div>
                <input type="submit" value="Register">
            </div>
        </form>
    </body>
</html>