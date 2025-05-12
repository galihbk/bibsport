@extends('layouts.home')

@section('title', 'Event Lari')

@section('content')
<main class="main">
    <div class="container py-3">
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <img src="{{ asset('storage/posters/' . $event->poster_url) }}" alt="" width="100%">
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Deskripsi</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">SKB</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">{!! $event->description !!}
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">{!! $event->skb !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                @foreach($category as $c)
                <div class="card mb-3">
                    <div class="card-header">Tiket {{$c->category_event}} - {{$c->distance}}K</div>
                    <div class="card-body">
                        <div class="row invoice-card-row">
                            @foreach($c->tickets as $ticket)
                            <a href="{{ route('home.event-register', ['id' => $ticket->id]) }}">
                                <div class="col-lg-12">
                                    <div class="card bg-warning invoice-card">
                                        <div class="card-body d-flex">
                                            <div>
                                                <h2 class="text-white invoice-num">{{$ticket->price}}</h2>
                                                <span class="text-white fs-18">{{$ticket->name_ticket}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="card mb-3">
                    <div class="card-header">Organizer</div>
                    <div class="card-body">
                        <img src="{{ asset('storage/profile/' . $user->image) }}" alt="" width="100%">
                        <div class="d-flex">
                            <div>
                                <p><strong>Nama Organizer </strong></p>
                                <p><strong>Email </strong></p>
                            </div>
                            <div class="ms-2">
                                <p> : {{$user->name}}</p>
                                <p> : {{$user->organizer_type}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection