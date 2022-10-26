@extends('errors::error')

@section('title', __('Unauthorized'))
@section('title_message', __('Acceso denegado :'))
@section('body_message', __('Oops! 😖 No estas autorizado para acceder a esta pagina.'))
@section('image_message')
    <img src="{{ asset('plantilla/assets/img/illustrations/page-misc-error-401.jpg') }}" alt="page-misc-error-401"
        width="500" class="img-fluid" data-app-dark-img="illustrations/page-misc-error-dark.jpg"
        data-app-light-img="illustrations/page-misc-error-401.jpg" />
@endsection
