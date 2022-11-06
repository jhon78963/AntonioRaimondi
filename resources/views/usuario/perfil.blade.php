@extends('layout.template')

@section('title')
    <title>AR | Perfil</title>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <form id="frmActualizarPerfil">
                    @method('put')
                    @csrf
                    <h5 class="card-header">Mi Perfíl</h5>
                    <!-- Account -->
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="{{ auth()->user()->perfil->upro_image }}" alt="user-avatar" class="d-block rounded"
                                height="100" width="100" id="uploadedAvatar" />
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block" style="color:white;">Subir nueva foto</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input type="file" id="upload" name="upro_image" class="account-file-input" hidden
                                        accept="image/png, image/jpeg" />
                                </label>
                                <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Reiniciar</span>
                                </button>

                                <p class="text-muted mb-0">Permitido JPG, GIF or PNG. Tamaño máximo de 800K</p>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="organization" class="form-label">Intitución Educativa</label>
                                <input type="text" class="form-control" id="upro_company" name="organization"
                                    value="{{ $usuario->upro_company }}" disabled>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="language" class="form-label">Nombre de Usuario</label>
                                <input class="form-control" type="text" id="state" name="user_name"
                                    value="{{ $usuario->usuario->user_name }}" disabled>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="firstName" class="form-label">Primer Nombre</label>
                                <input class="form-control" type="text" id="firstName"
                                    name="upro_firstName"value="{{ $usuario->upro_firstName }}">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="lastName" class="form-label">Apellidos</label>
                                <input class="form-control" type="text" name="upro_lastName" id="lastName"
                                    value="{{ $usuario->upro_lastName }}">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">E-mail</label>
                                <input class="form-control" type="text" id="email" name="upro_email"
                                    value="{{ $usuario->upro_email }}">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">Dirección</label>
                                <input type="text" class="form-control" id="address" name="upro_address"
                                    value="{{ $usuario->upro_address }}">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="state" class="form-label">Ciudad</label>
                                <input class="form-control" type="text" id="state" name="upro_city"
                                    value="{{ $usuario->upro_city }}">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="country">País</label>
                                <input class="form-control" type="text" id="state" name="upro_country"
                                    value="{{ $usuario->upro_country }}">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="zipCode" class="form-label">Código Postal</label>
                                <input type="text" class="form-control" id="zipCode" name="upro_postalCode"
                                    value="{{ $usuario->upro_postalCode }}" maxlength="6" />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="phoneNumber">Celular</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">PE (+51)</span>
                                    <input type="text" id="phoneNumber" name="upro_phoneNumber" class="form-control"
                                        value="{{ $usuario->upro_phoneNumber }}">
                                </div>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2" id="btn_guardar">Guardar</button>
                            <button type="reset" class="btn btn-outline-secondary">Cancelar</button>
                        </div>
                    </div>
                </form>
                <!-- /Account -->
            </div>
            <div class="card">
                <h5 class="card-header">Delete Account</h5>
                <div class="card-body">
                    <div class="mb-3 col-12 mb-0">
                        <div class="alert alert-warning">
                            <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
                            <p class="mb-0">Once you delete your account, there is no going back. Please be certain.
                            </p>
                        </div>
                    </div>
                    <form id="formAccountDeactivation" onsubmit="return false">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="accountActivation"
                                id="accountActivation" />
                            <label class="form-check-label" for="accountActivation">I confirm my account
                                deactivation</label>
                        </div>
                        <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
        $("#frmActualizarPerfil").submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('profiles.update', auth()->user()->user_id) }}',
                method: 'POST',
                dataType: 'json',
                data: new FormData($("#frmActualizarPerfil")[0]),
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btn_guardar').attr("disabled", true);
                    $('#btn_guardar').html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
                    );
                },
                success: function(data) {
                    let mensaje = data.mensaje;
                    let aboutme = data.aboutme;
                    let photo = data.photo;
                    toastr.success(mensaje, 'Actualización Existosa', {
                        timeOut: 3000
                    });
                },
                complete: function() {
                    $('#btn_guardar').text('Guardar');
                    $('#btn_guardar').attr("disabled", false);
                }
            });
        });
    </script>
@endsection
