@extends('layouts.main')

@section('title', $event->title)

@section('content')
<div class="col-md-8 offset-md-2 py-5">
    <div class="row">
        <div id="image-container" class="col-md-6">
            <img src="{{ asset('assets/img/events/' . $event->image) }}" alt="{{ $event->title }}" class="img-fluid">
        </div>
        <div id="info-container" class="col-md-6">
            <h1>{{ $event->title }}</h1>
            <p class="event-city"><ion-icon name="location-outline"></ion-icon> {{ $event->city }}</p>
            <p class="event-participants"><ion-icon name="people-outline"></ion-icon> {{ count($event->users) }} Participantes</p>
            <p class="event-owner"><ion-icon name="star-outline"></ion-icon> {{ $event->user->name }}</p>
            
            @auth
                @if(!$hasUserJoined)
                <form action="{{ route('events.join', $event->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary" id="event-submit">Confirmar Presença</button>
                </form>
                @else
                <p class="mt-4 already-joined-msg">Você já está participando deste evento!</p>
                @endif
            @endauth

            @guest
            <p>É preciso ter uma conta para participar deste evento, <a href="{{ route('login') }}" title="Login">faça login</a> em sua conta ou <a href="{{ route('register') }}" title="Criar Conta">crie uma nova</a></p>   
            @endguest

            <h3 class="mt-4">O evento conta com:</h3>
            <ul id="items-list">
                @foreach($event->items as $item)
                <li><ion-icon name="play-outline"></ion-icon> <span>{{ $item }}</span></li>
                @endforeach
            </ul>
        </div>
        <div class="md-12 mt-1" id="description-container">
            <h3>Sobre o evento:</h3>
            <p class="event-description">{{ $event->description }}</p>
        </div>
    </div>
</div>
@endsection