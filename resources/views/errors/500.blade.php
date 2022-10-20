@extends('errors::error')

@section('title', __('Server Error'))
@section('title_message', __('Error De Servidor Interno :'))
@section('body_message', __('Oops! 😖 Parece que algo salió mal.'))
@section('image_message')
    <img src="{{ asset('plantilla/assets/img/illustrations/page-misc-error-500.jpg') }}" alt="page-misc-error-500"
        width="500" class="img-fluid" data-app-dark-img="illustrations/page-misc-error-dark.png"
        data-app-light-img="illustrations/page-misc-error-500.png" />
@endsection
