@extends('app')
@section('content')

<div class="container w-25 border p-4 mt-4">
    <form action="{{route('categories.store')}}" method="post">
        @csrf

        @if (session('success'))
            <h6 class="alert alert-success">{{session('success')}}</h6>
        @endif

        @error('name')

            <h6 class="alert alert-danger">{{$message}}</h6>
        @enderror

        <div class="mb-3">
            <label for="name" class="form-label">Nombre de categoria</label>
            <input id="name" type="text" class="form-control" name="name">
        </div>
        <div class="mb-3">
            <label for="color" class="form-label">Color de categoria</label>
            <input id="color" type="color" class="form-control" name="color">
        </div>
        <button type="submit" class="btn btn-primary">Crear nueva categoria</button>
    </form>

    <div>
        @foreach ($categories as $category)
            <div class="row py-1 mt-3">
                <div class="col-md-9 d-flex align-items-center">
                    <a class="d-flex align-items-center gap-2" href="{{route('categories.show', ['category'=>$category->id]) }}">
                        <span class="color-container" style="background-color: {{$category->color}} ; "></span>{{$category->name}}</a>
                </div>
                <div class="col-md-3 d-flex justify-content-end">
                  <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modal{{$category->id}}">
                    Eliminar
                  </button>
                </div>
            </div>

            <div class="modal fade" id="modal{{$category->id}}" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar categoria</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    Al eliminar la categoria <strong>{{$category->name}}</strong> se eliminan todas las tareas asignadas a la misma.
                    ¿Está seguro que desea eliminar la categoria <strong>{{$category->name}}</strong>?
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form action="{{ route('categories.destroy', ['category'=>$category->id]) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Eliminar</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
        @endforeach
    </div>
    </div>

@endsection
