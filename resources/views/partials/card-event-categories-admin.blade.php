<div class="row">
    @forelse($events as $event)
    <div class="col-xl-6">
        <div class="filter cm-content-box box-primary">
            <div class="content-title">
                <div class="cpa">
                    <i class="fa-solid fa-file-lines me-1"></i>{{$event->category_event}} - ({{$event->distance}}K)
                </div>
                <div class="tools d-flex">
                    <a href="javascript:void(0);" class="expand SlideToolHeader"><i class="fa-solid fa-chevron-down fal fa-angle-down"></i></a>
                    <div class="dropdown ms-3">
                        <a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" id="btn-add-ticket" href="#" data-title="Tambah Tiket {{$event->category_event}} - ({{$event->distance}}K)" data-id="{{$event->id}}">Tambah Tiket</a>
                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                            <a class="dropdown-item" href="javascript:void(0);">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cm-content-body form excerpt">
                <div class="card-body pt-2">
                    <div class="profile-statistics">
                        <div class="text-center">
                            <div class="row">
                                <div class="col">
                                    <h3 class="m-b-0">150</h3><span>Total</span>
                                </div>
                                <div class="col">
                                    <h3 class="m-b-0">140</h3><span>Pria</span>
                                </div>
                                <div class="col">
                                    <h3 class="m-b-0">45</h3><span>Wanita</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="accordion accordion-primary list-ticket-category{{$event->id}}" id="accordion-one-{{$event->id}}">
                        @forelse($event->tickets as $ticket)
                        <div class="accordion-item">
                            <div class="accordion-header collapsed rounded-lg d-flex justify-content-between" id="heading{{$ticket->id}}" data-bs-toggle="collapse" data-bs-target="#collapse{{$ticket->id}}" aria-controls="collapse{{$ticket->id}}" role="button" aria-expanded="false">
                                <span class="accordion-header-text">{{ $ticket->name_ticket }} (Rp. {{ number_format($ticket->price, 0, ',', '.') }})</span>
                                <div class="d-flex">
                                    <!-- <span class="accordion-header-indicator me-4"></span> -->
                                    <div class="dropdown me-0">
                                        <a href="javascript:void(0);" class="btn-link" data-bs-toggle="dropdown" aria-expanded="false">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" id="btn-add-voucher" href="#" data-title="Tambah Voucher {{$ticket->name_ticket}}" data-id="{{$ticket->id}}">Tambah Voucher</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Edit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="collapse{{$ticket->id}}" class="collapse" aria-labelledby="heading{{$ticket->id}}" data-bs-parent="#accordion-one-{{$event->id}}">
                                <div class="accordion-body-text">
                                    <div class="d-flex mb-3 border-bottom justify-content-between flex-wrap align-items-center">
                                        <div class="me-3 pb-3">
                                            <span class="text-black font-w500">Kuota Peserta: {{ $ticket->quota }} Peserta</span>
                                            <br>
                                            <span class="text-black font-w500">Tiket Aktif: {{ date('d-m-Y H:s', strtotime($ticket->ticket_start)) }} - {{ date('d-m-Y H:s', strtotime($ticket->ticket_end)) }}</span>
                                        </div>
                                    </div>
                                    <table class="table table-sm mb-0">
                                        <thead>
                                            <tr>
                                                <th class="align-middle">Kode Voucher</th>
                                                <th class="align-middle pe-7">Status</th>
                                                <th class="align-middle text-end">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="orders">
                                            @forelse($ticket->vouchers as $voucher)
                                            <tr class="btn-reveal-trigger">
                                                <td class="py-2">
                                                    <strong>{{ $voucher->code }}</strong></strong>
                                                </td>
                                                <td class="py-2 text-end">
                                                    @php
                                                    $now = \Carbon\Carbon::now();

                                                    if ($voucher->discount_end <= $now) {
                                                        $status='Kadaluarsa' ;
                                                        } elseif ($voucher->quota_used >= $voucher->quota) {
                                                        $status = 'Habis';
                                                        }else{
                                                        $status = 'Aktif';
                                                        }

                                                        $badgeClass = match ($status) {
                                                        'Aktif' => 'badge-success',
                                                        'Kadaluarsa' => 'badge-danger',
                                                        'Habis' => 'badge-warning',
                                                        };
                                                        @endphp

                                                        <span class="badge {{ $badgeClass }}">
                                                            {{ ucfirst($status) }}
                                                        </span>

                                                </td>
                                                <td class="py-2 text-end">
                                                    <div class="dropdown text-sans-serif">
                                                        <button class="btn btn-primary tp-btn-light sharp" type="button" id="order-dropdown-{{ $voucher->id }}" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" viewBox="0 0 24 24">
                                                                    <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                                    <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                                    <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                                                </svg>
                                                            </span>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end border py-0" aria-labelledby="order-dropdown-{{ $voucher->id }}">
                                                            <div class="py-2">
                                                                <a class="dropdown-item" href="javascript:void(0);">Edit</a>
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item text-danger" href="javascript:void(0);">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted">Belum ada voucher untuk tiket ini.</td>
                                            </tr>
                                            @endforelse
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-muted">Belum ada tiket untuk event ini.</div>
                        @endforelse
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