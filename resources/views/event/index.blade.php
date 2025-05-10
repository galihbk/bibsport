<x-app-layout>
    @section('title', 'Event')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">

                    <a href="{{ route('event.add-event') }}" class="btn btn-primary">Add
                        Event</a>
                    <div class="d-flex">
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control">
                                <button class="btn btn-primary" type="submit"><i
                                        class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <div id="event-list">
                @include('partials.card-event-admin', ['events' => $events])
            </div>
        </div>
    </div>
    @section('script')
    <script>
        setTimeout(function() {
            const alertBox = document.getElementById('success-alert');
            if (alertBox) {
                alertBox.style.transition = 'opacity 0.5s ease';
                alertBox.style.opacity = '0';
                setTimeout(() => alertBox.remove(), 500);
            }
        }, 5000);
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                let query = $(this).val();

                $.ajax({
                    url: "{{ route('events.search') }}",
                    type: "GET",
                    data: {
                        query: query
                    },
                    success: function(data) {
                        $('#event-list').html(data);
                    }
                });
            });
        });
    </script>
    @endsection
</x-app-layout>