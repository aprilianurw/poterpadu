@extends('layouts.app')
@section('title', 'login')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    
</body>
</html>
    <section class="vh-80">
        <div class="container py-5 h-100">
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <img src="{{asset('loginn.png')}}"
                         class="img-fluid" alt="Phone image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1 border">
              <form action="/login" method="POST">
                @csrf
                <div class="divider d-flex align-items-center my-4">
                  <p class="text-center fw-bold mx-3 mb-0" style="font-size: 200%;">Login</p>
                </div>
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="username">Username</label>
                            <input type="text" id="username" class="form-control form-control-lg" name="username"
                                   required autocomplete="username"/>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" id="password" class="form-control form-control-lg" name="password"
                                   required/>
                        </div>

                        <div class="text-danger errors">
                            <p class="err-message"></p>
                        </div>
                        @csrf

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>
                        <br> belum memiliki akun?</br> <a href="{{url('/register')}}">Register</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('footer')
    <script type="module">
        $('form').submit(async function (e) {
            e.preventDefault();
            let username = $('#username').val();
            let password = $('#password').val();

            await axios({
                method: 'post',
                url: 'http://localhost:8000/login',
                data: {
                    username,
                    password
                }
            }).then(async () => {
                await swal.fire({
                    title: 'Login berhasil!',
                    text: 'Redirecting to dashboard...',
                    icon: 'success',
                    timer: 1000,
                    showConfirmButton: false
                })
                window.location = '/dashboard'
                console.log('success')
            }).catch(({response}) => {
                if (!$('.err-message').text()) {
                    $('.err-message').append(document.createTextNode(response.data.errors.message))
                }
            })

        })
    </script>
@endsection
