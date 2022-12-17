@extends('adminlte::page')

@section('title', 'cadastrar Perfil')

@section('content_header')
  <h1>Cadastrar Novo Plano</h1>
@stop

@section('content')
  <div class="card">
    <div class="card-body">
      <form action="{{ route('profiles.store') }}" class="form" method="POST">
        @csrf
        @include('admin.pages.profiles._partials.form')
      </form>
    </div>
  </div>
@endsection