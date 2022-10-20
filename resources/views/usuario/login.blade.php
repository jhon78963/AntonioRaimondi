<!doctype html>
<html lang="en">

<head>
    <title>AR | Login</title>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" type="image/png" href="loginn/images/icono.png">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('loginn/css/style.css') }}">

</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">I. E. ANTONIO RAIMONDI</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <img src="{{ asset('loginn/images/logo.jpg') }}" alt="" class="img img-fluid">
                        {{-- <div class="img" style="background-image: url(loginn/images/logo.jpg);">

                        </div> --}}
                        <div class="login-wrap p-4 p-md-5">
                            <div class="row" id="alertError" style="display: none;">
                                <div class="col-12">
                                    <div class="alert alert-danger" role="alert">
                                        <p>Whoops! Ocurrieron algunos errores</p>
                                        <ul id="listaErrores">
                                            @error('user_name')
                                                <li>{{ $message }}</li>
                                            @enderror
                                            @error('user_password')
                                                <li>{{ $message }}</li>
                                            @enderror
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4">LOGIN</h3>
                                </div>
                                <div class="w-100">
                                    <p class="social-media d-flex justify-content-end">
                                        <a href="#"
                                            class="social-icon d-flex align-items-center justify-content-center"><span
                                                class="fa fa-facebook"></span></a>
                                        <a href="#"
                                            class="social-icon d-flex align-items-center justify-content-center"><span
                                                class="fa fa-twitter"></span></a>
                                    </p>
                                </div>
                            </div>
                            <form class="signin-form" id="frmLogin">
                                @csrf
                                <div class="form-group mb-3">
                                    <label class="label" for="name">Username</label>
                                    <input type="text" class="form-control @error('user_name') is-invalid @enderror"
                                        name="user_name" id="user_name" placeholder="Username">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="password">Password</label>
                                    <input type="password"
                                        class="form-control @error('user_password') is-invalid @enderror"
                                        name="user_password" id="user_password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3"
                                        id="btnLogin">
                                        Entrar
                                    </button>
                                </div>
                                <div class="form-group d-md-flex">
                                    <div class="w-50 text-left">
                                        <label class="checkbox-wrap checkbox-primary mb-0">Recuerdame
                                            <input type="checkbox" id="recuerdame" name="recuerdame" checked>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="w-50 text-md-right">
                                        <a href="#">¿Olvidaste tu contraseña?</a>
                                    </div>
                                </div>
                            </form>
                            <p class="text-center">¿No estas registrado? <a data-toggle="tab"
                                    href="#signup">Registrate</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('loginn/js/jquery.min.js') }}"></script>
    <script src="{{ asset('loginn/js/popper.js') }}"></script>
    <script src="{{ asset('loginn/js/bootstrap.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('loginn/js/main.js') }}"></script>

    <script>
        $(function() {
            enviarLogin();
        });

        var enviarLogin = function() {
            $("#frmLogin").on("submit", function(e) {
                e.preventDefault();

                $.ajax({
                    url: '{{ route('login.validar') }}',
                    method: 'POST',
                    dataType: 'json',
                    data: new FormData($("#frmLogin")[0]),
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $("#alertError").hide();
                        $('#btnLogin').attr("disabled", true);
                        $('#btnLogin').html(
                            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Validando...'
                        );
                    },
                    success: function(data) {
                        if (!data.error) {
                            let mensaje = data.mensaje;
                            let usuario = data.user_name;
                            $("#frmLogin")[0].reset();
                            Swal.fire({
                                icon: 'success',
                                title: 'Login Exitoso!',
                                text: mensaje + usuario.user_name,
                                showConfirmButton: false,
                                timer: 3000
                            })
                            window.location.href = '{{ route('bienvenido.index') }}';
                        } else {
                            let mensaje = data.mensaje;
                            $("#listaErrores").html('<li>' + mensaje + '</li>');
                            $("#alertError").show();
                            $('#btnLogin').text('Entrar');
                            $('#btnLogin').attr("disabled", false);
                        }

                    },
                    error: function(data) {
                        let errores = data.responseJSON.errors;
                        let msjError = '';
                        Object.values(errores).forEach(function(valor) {
                            msjError += '<li>' + valor[0] + '</li>';
                        });
                        $("#listaErrores").html(msjError);
                        $("#alertError").show();
                        $('#btnLogin').text('Entrar');
                        $('#btnLogin').attr("disabled", false);
                    },
                    complete: function() {
                        $('#btnLogin').text('Entrar');
                        $('#btnLogin').attr("disabled", false);
                    },
                });
            });
        }
    </script>

</body>

</html>
