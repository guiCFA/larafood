@extends('adminlte::page')

@section('title', 'Permissão')

@section('content_header')
 <ol class="breadcrumb">
    <li class="breadcrumb-item"> <a href="{{ route('admin.index') }}">Dashboard</a> </li>
    <li class="breadcrumb-item active"> <a href="{{ route('permissions.index') }}">Perfis</a> </li>
  </ol>

  <h1>Permissão <a href="{{ route('permissions.create') }}" class="btn btn-dark"> <i class="fas fa-plus-square"></i> </a></h1>
@stop

@section('content')
  <div class="card">
    <div class="card-header">
      <form action="{{ route('permissions.search') }}" method="POST" class="form form-inline">
        @csrf
        <input type="text" name="filter" placeholder="Filtro" class="form-control" value="{{ $filters['filter'] ?? '' }}">
        <button type="submit" class="btn btn-dark">Filtrar</button>
      </form>
    </div>
    <div class="card-body">
      <table class="table table-condensed">
        <thead>
          <tr>
            <th>Nome</th>
            <th width="50">Ações</th>
          </tr>
        </thead>
        <tbody>
          @foreach($permissions as $permission)
            <tr>
              <td>
                {{ $permission->name }}
              </td>
              <td style="width:250px">
                <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-info">Edit</a>
                <a href="{{ route('permissions.show', $permission->id) }}" class="btn btn-warning">VER</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="card-footer">
      @if (isset($filters))
        {!! $permissions->appends($filters)->links() !!}
      @else  
        {!! $permissions->links() !!}
      @endif
    </div>
  </div>
@stop