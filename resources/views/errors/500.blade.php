@extends('errors::minimal')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', __($exception->getMessage() ?: 'Error en el servidor'))

@section('advise', __($exception->getHeaders()['0'] ?: 'Contacar al administrador del sistema.'))
