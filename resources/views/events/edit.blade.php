@extends('layouts.main')

@section('title', 'Editar Evento')

@section('content')
<div id="event-create-container" class="col-md-6 offset-md-3 py-5">
    <h1>Editar Evento</h1>
    <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="image">Imagem:</label>
            <input type="file" class="form-control" id="image" name="image">
            <img src="{{ asset('assets/img/events/' . $event->image) }}" alt="{{ $event->title }}" class="img-preview">
        </div>

        <div class="form-group mb-3">
            <label for="title">Evento:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Nome do evento" value="{{ $event->title }}">
        </div>

        <div class="form-group mb-3">
            <label for="date">Data do evento:</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ $event->date->format('Y-m-d') }}">
        </div>

        <div class="form-group mb-3">
            <label for="city">Cidade:</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Local do evento" value="{{ $event->city }}">
        </div>

        <div class="form-group mb-3">
            <label for="private">O evento é privado?:</label>
            <select class="form-control" id="private" name="private">
                <option value="0">Não</option>
                <option value="1" {{ $event->private ? 'selected' : '' }}>Sim</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="description">Descrição:</label>
            <textarea class="form-control" rows="5" id="description" name="description" placeholder="Nome do evento">{{ $event->description }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label for="items">Adicione items de infraestruturas:</label>
            
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Cadeiras"> Cadeiras
            </div>

            <div class="form-group">
                <input type="checkbox" name="items[]" value="Palco"> Palco
            </div>

            <div class="form-group">
                <input type="checkbox" name="items[]" value="Cerveja Grátis"> Cerveja Grátis
            </div>

            <div class="form-group">
                <input type="checkbox" name="items[]" value="Open Food"> Open Food
            </div>

            <div class="form-group">
                <input type="checkbox" name="items[]" value="Brindes"> Brindes
            </div>
        </div>

        <input type="submit" class="btn btn-primary" value="Criar Evento">
    </form>
</div>
@endsection