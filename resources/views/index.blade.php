@extends('layouts.main')

@section('title', 'Início')

@section('content')
<div id="search-container" class="col-md-12">
    <h1>Busque um evento</h1>
    <form action="{{ route('homepage') }}" method="GET">
        <input type="text" id="search" name="search" class="form-control" placeholder="Procurar..." value="{{ $search ?? null }}">
    </form>
</div>
<section class="container">
    <div id="events-container" class="container col-md-12">
        @if($search)
        <h2>Buscando por: {{ $search }}</h2>
        @else
        <h2>Próximos eventos</h2>
        @endif
        
        <p class="subtitle">Veja os eventos nos próximos dias</p>
        <div id="cards-container" class="row">
            @forelse($events as $event)
            <div class="card col-md-3">
                <img src="{{ asset('assets/img/events/' . $event->image) }}" alt="{{ $event->title }}">
                <div class="card-body">
                    <p class="card-date">{{ date('d/m/Y', strtotime($event->date)) }}</p>
                    <h3 class="card-title">{{ $event->title }}</h3>
                    <p class="card-participantes">{{ count($event->users) }} Participantes</p>
                    <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary">Saber mais</a>
                </div>
            </div>
            @empty
                @if($search)
                <p class="m-0 p-0">Não foi possível encontrar nenhum evento com {{ $search }}! <a href="{{ route('homepage') }}">Ver todos</a></p>
                @else
                <p class="m-0 p-0">Não há eventos disponíveis</p>
                @endif
            @endforelse
        </div>
    </div>
</section>
@endsection
