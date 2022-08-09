@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
<div class="col-md-8 offset-md-2 pt-5 dashboard-title-container">
    <h1>Meus Eventos</h1>
</div>

<div class="col-md-8 offset-md-2 pt-5 dashboard-events-container">
    @if(count($events))
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Titulo</th>
                <th scope="col">Participantes</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <td scope="row">{{ $loop->index + 1 }}</td>
                <td scope="row"> <a href="{{ route('events.show', $event->id) }}" title="{{ $event->title }}">{{ $event->title }}</a></td>
                <td scope="row">{{ count($event->users) }}</td>
                <td scope="row">
                    <a href="{{ route('events.edit', $event->id) }}" class="btn btn-info edit-btn"><ion-icon name="create-outline"></ion-icon> Editar</a>
                    <form action="{{ route('events.delete', $event->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger delete-btn"><ion-icon name="trash-outline"></ion-icon> Deletar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p class="m-0 p-0">Você ainda não tem eventos! <a href="{{ route('events.create') }}">Criar Evento</a></p>
    @endif
</div>

<div class="col-md-8 offset-md-2 pt-5 dashboard-title-container">
    <h1>Eventos que estou participando</h1>
</div>

<div class="col-md-8 offset-md-2 py-5 dashboard-events-container">
    @if(count($events))
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Titulo</th>
                <th scope="col">Participantes</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($eventsAsParticipant as $event)
            <tr>
                <td scope="row">{{ $loop->index + 1 }}</td>
                <td scope="row"> <a href="{{ route('events.show', $event->id) }}" title="{{ $event->title }}">{{ $event->title }}</a></td>
                <td scope="row">{{ count($event->users) }}</td>
                <td scope="row">
                    <form action="{{ route('events.leave', $event->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger delete-btn">Sair do evento</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p class="m-0 p-0">Você ainda não está participando de nenhum evento! <a href="{{ route('homepage') }}">Veja todos os eventos</a></p>
    @endif
</div>
@endsection
