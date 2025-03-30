@extends('errors::minimal')

@section('title', __('Acceso denegado'))
@section('code', '403')

@section('message', __($exception->getMessage() ?: 'Acceso denegado'))

@section('advise', __($exception->getHeaders()['0'] ?: 'You do not have permission to access this resource.'))

