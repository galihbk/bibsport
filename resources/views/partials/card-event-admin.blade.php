<div class="row">
    @forelse ($events as $event)
    <div class="col-lg-12 col-xl-6 col-xxl-4">
        <div class="card">
            <div class="card-body">
                <div class="row m-b-30">
                    <div class="col-md-5 col-xxl-12">
                        <div class="new-arrival-product mb-4 mb-xxl-4 mb-md-0">
                            <div class="new-arrivals-img-contnent">
                                <img class="img-fluid" src="{{ asset('storage/posters/' . $event->poster_url) }}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-xxl-12">
                        <div class="new-arrival-content position-relative">
                            <h4><a href="{{route('event.detail',$event->id)}}">{{ $event->event_name }}</a></h4>
                            <div class=" comment-review star-rating">
                                @if ($event->event_validation == 1)
                                <span class="badge badge-lg light badge-primary">Terverifikasi</span>
                                @elseif($event->event_validation == 0)
                                <span class="badge badge-lg light badge-secondary">Diajukan</span>
                                @elseif($event->event_validation == 2)
                                <span class="badge badge-lg light badge-danger">Ditolak</span>
                                @endif
                            </div>
                            <p class="product-para">Tanggal: {{ \Carbon\Carbon::parse($event->start_date_event)->format('d M Y') }}</p>
                            <p class="product-para">Lokasi: {{ $event->location_event }}</p>
                            <p class="text-content">{{ \Str::limit(strip_tags($event->description), 100, '...') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="alert alert-warning">Tidak ada event ditemukan.</div>
    </div>
    @endforelse
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $events->links() }}
</div>