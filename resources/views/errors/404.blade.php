@extends('errors::error')

@section('title', __('Not Found'))
@section('title_message', __('Pagina No Encontrada :'))
@section('body_message', __('Oops! 😖 La URL solicitada no se encontró en este servidor.'))
@section('image_message')
    <img src="{{ asset('plantilla/assets/img/illustrations/page-misc-error-404.png') }}" alt="page-misc-error-404"
        width="500" class="img-fluid" data-app-dark-img="illustrations/page-misc-error-dark.png"
        data-app-light-img="illustrations/page-misc-error-404.png" />
@endsection
