@extends('layouts.home')

@section('title', 'Event Lari')

@section('content')
<main class="main">
    <section id="team" class="team section">

        <!-- Section Title -->
        <!-- <div class="container section-title aos-init aos-animate" data-aos="fade-up">
            <h2 class="text-center">Event</h2>
            <form method="GET" action="{{ route('home') }}" class="row g-3 mb-4">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Cari event..." value="{{ request('search') }}">
                </div>
                <div class="col-md-4">
                    <select name="category" class="form-control">
                        <option value="">Semua Kategori</option>
                        <option value="">
                        </option>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </form>
        </div> -->

        <div class="container">

            <div class="row gy-4">
                @forelse($events as $event)
                <div class="col-lg-3 col-md-6 d-flex align-items-stretch aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                    <div class="team-member">
                        <div class="member-img">
                            <img src="{{ asset('storage/posters/' . $event->poster_url) }}" class=" img-fluid" alt="">
                        </div>
                        <div class="member-info">
                            <a href="{{ route('home.event-detail', ['slug' => $event->slug]) }}">
                                <h4>{{ $event->event_name }}</h4>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-center">Tidak ada event ditemukan.</p>
                @endforelse
            </div>
            <div class="d-flex justify-content-center">
                {{ $events->withQueryString()->links() }}
            </div>
        </div>
    </section>
</main>
@endsection