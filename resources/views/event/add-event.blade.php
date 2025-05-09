<x-app-layout>
    @section('title', 'Tambah Event')

    <form action="" method="POST" enctype="multipart/form-data" id="eventForm">
        @csrf
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form Tambah Event</h4>
                </div>
                <div class="card-body">
                    <div id="smartwizard" class="form-wizard order-create">
                        <ul class="nav nav-wizard">
                            <li><a class="nav-link" href="#wizard_Service"><span>1</span></a></li>
                            <li><a class="nav-link" href="#wizard_Details"><span>2</span></a></li>
                        </ul>

                        <div class="tab-content">
                            {{-- Step 1: Info Event --}}
                            <div id="wizard_Service" class="tab-pane" role="tabpanel">
                                <h3 class="text-center">Form Event</h3>
                                <div class="row">
                                    <div class="col-lg-6 mb-2">
                                        <label>Nama Event<span class="required">*</span></label>
                                        <input type="text" name="nama_event" class="form-control" required>
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <label>Jenis Event<span class="required">*</span></label>
                                        <select name="jenis_event" class="form-control" required>
                                            <option value="">Pilih...</option>
                                            <option value="Lari">Lari</option>
                                            <option value="Sepeda">Sepeda</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <label>Lokasi Event<span class="required">*</span></label>
                                        <input type="text" name="lokasi_event" class="form-control" required>
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <label>Poster<span class="required">*</span></label>
                                        <input type="file" name="poster" class="form-control" required>
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <label>Tanggal Mulai Event<span class="required">*</span></label>
                                        <input type="date" name="tanggal_mulai" class="form-control" required>
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <label>Tanggal Akhir Event<span class="required">*</span></label>
                                        <input type="date" name="tanggal_akhir" class="form-control" required>
                                    </div>
                                    <div class="col-lg-12 mb-2">
                                        <label>Deskripsi<span class="required">*</span></label>
                                        <textarea name="deskripsi" id="editor1" class="form-control" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div id="wizard_Details" class="tab-pane" role="tabpanel">
                                <h3 class="text-center">Kategori Tiket</h3>
                                <div id="category-container">
                                    <div class="category-block" id="category-block-1">
                                        <h4 class="text-center">Kategori 1</h4>
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-6 mb-2">
                                                <label>Kategori Event</label>
                                                <input type="text" name="kategori[1][nama]" class="form-control"
                                                    required>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <label>Kuota Peserta</label>
                                                <input type="number" name="kategori[1][kuota]" class="form-control"
                                                    required>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <label>Harga Tiket</label>
                                                <input type="number" name="kategori[1][harga]" class="form-control"
                                                    required>
                                            </div>
                                            <div class="col-lg-6 mb-2">
                                                <label>Format BIB</label>
                                                <input type="text" name="kategori[1][bib]" class="form-control"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end mt-2">
                                    <button type="button" class="btn btn-outline-success btn-sm" id="addCategory"><i
                                            class="fa fa-plus"></i> Tambah Kategori</button>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <button class="btn btn-secondary" id="prevBtn">Sebelumnya</button>
                            <button class="btn btn-primary" id="nextBtn">Selanjutnya</button>
                            <button class="btn btn-success d-none" type="submit" id="submitBtn">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @section('script')
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('editor1', {
                toolbar: [{
                        name: 'basicstyles',
                        items: ['Bold', 'Italic']
                    },
                    {
                        name: 'paragraph',
                        items: ['NumberedList', 'BulletedList']
                    },
                    {
                        name: 'links',
                        items: ['Link', 'Unlink']
                    },
                    {
                        name: 'undo',
                        items: ['Undo', 'Redo']
                    }
                ],
                removePlugins: 'elementspath',
                resize_enabled: false
            });
            $('#smartwizard').smartWizard({
                selected: 0,
                toolbarSettings: {
                    toolbarPosition: 'none'
                },
            });

            let currentStep = 0;
            const totalSteps = 2;
            let categoryIndex = 0;

            const wizard = $('#smartwizard');
            const nextBtn = $('#nextBtn');
            const prevBtn = $('#prevBtn');
            const submitBtn = $('#submitBtn');

            nextBtn.on('click', function() {
                if (currentStep === 0) {
                    if (formInputs.filter(function() {
                            return !this.value;
                        }).length) {
                        alert('Semua field pada step 1 harus diisi.');
                        return;
                    }
                }

                if (currentStep === 1) {
                    const categoryInputs = $('input[name^="kategori"]');
                    if (categoryInputs.filter(function() {
                            return !this.value;
                        }).length) {
                        alert('Semua field pada kategori event harus diisi.');
                        return;
                    }
                }

                if (currentStep < totalSteps - 1) {
                    wizard.smartWizard("next");
                    currentStep++;
                    updateButtons();
                }
            });

            prevBtn.on('click', function() {
                if (currentStep > 0) {
                    wizard.smartWizard("prev");
                    currentStep--;
                    updateButtons();
                }
            });

            function updateButtons() {
                nextBtn.toggleClass('d-none', currentStep === totalSteps - 1);
                submitBtn.toggleClass('d-none', currentStep !== totalSteps - 1);
            }

            // Menambah kategori
            $('#addCategory').on('click', function() {
                const container = $('#category-container');
                categoryIndex++;

                const html = `
                        <div class="category-block" id="category-block-${categoryIndex}">
                            <h4 class="text-center">Kategori ${categoryIndex}</h4>
                            <hr>
                            <div class="row">
                                <div class="col-lg-6 mb-2">
                                    <label>Kategori Event</label>
                                    <input type="text" name="kategori[${categoryIndex}][nama]" class="form-control" required>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label>Kuota Peserta</label>
                                    <input type="number" name="kategori[${categoryIndex}][kuota]" class="form-control" required>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label>Harga Tiket</label>
                                    <input type="number" name="kategori[${categoryIndex}][harga]" class="form-control" required>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <label>Format BIB</label>
                                    <input type="text" name="kategori[${categoryIndex}][bib]" class="form-control" required>
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="button" class="btn btn-outline-danger btn-sm removeCategory" data-index="${categoryIndex}"><i class="fa fa-minus"></i> Hapus Kategori</button>
                            </div>
                        </div>
                    `;
                container.append(html);
            });

            // Menghapus kategori
            $(document).on('click', '.removeCategory', function() {
                const index = $(this).data('index');
                $(`#category-block-${index}`).remove();

                // Mengatur ulang nomor kategori setelah penghapusan
                categoryIndex--;
                $('#category-container').children('.category-block').each(function(i) {
                    $(this).find('h4').text(`Kategori ${i + 1}`);
                    $(this).attr('id', `category-block-${i + 1}`);
                    $(this).find('.removeCategory').data('index', i + 1);
                });
            });
        });
    </script>
    @endsection
</x-app-layout>