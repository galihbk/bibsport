<x-app-layout>
    @section('title', 'Tambah Event')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form step</h4>
            </div>
            <div class="card-body">
                <div id="smartwizard" class="form-wizard order-create">
                    <ul class="nav nav-wizard">
                        <li><a class="nav-link" href="#wizard_Service">
                                <span>1</span>
                            </a></li>
                        <li><a class="nav-link" href="#wizard_Time">
                                <span>2</span>
                            </a></li>
                        <li><a class="nav-link" href="#wizard_Details">
                                <span>3</span>
                            </a></li>
                        <li><a class="nav-link" href="#wizard_Payment">
                                <span>4</span>
                            </a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="wizard_Service" class="tab-pane" role="tabpanel">
                            <h3 class="text-center">Aturan pembuatan event</h3>
                            <ol class="mb-4">
                                <li style="list-style: inside;">Event hanya boleh dibuat oleh admin resmi dari
                                    penyelenggara lomba.</li>
                                <li style="list-style: inside;">Setiap event harus memiliki informasi yang valid dan
                                    dapat dipertanggungjawabkan.
                                </li>
                                <li style="list-style: inside;">Event harus memiliki setidaknya satu kategori lomba
                                    (misal: 5K, 10K).</li>
                                <li style="list-style: inside;">Admin bertanggung jawab atas data peserta yang
                                    terdaftar.</li>
                                <li style="list-style: inside;">Voucher diskon tidak boleh disalahgunakan dan harus
                                    sesuai dengan kebijakan promosi.
                                </li>
                            </ol>
                        </div>
                        <div id="wizard_Time" class="tab-pane" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-12 mb-2">
                                    <div class="mb-3">
                                        <label class="text-label form-label">Nama Event<span
                                                class="required">*</span></label>
                                        <input type="text" name="firstName" class="form-control"
                                            placeholder="Masukan nama event" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <div class="mb-3">
                                        <label class="text-label form-label">Jenis Event<span
                                                class="required">*</span></label>
                                        <select name="lastName" class="form-control" required>
                                            <option value="">Pilih...</option>
                                            <option value="Lari">Lari</option>
                                            <option value="Sepeda">Sepeda</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <div class="mb-3">
                                        <label class="text-label form-label">Lokasi Event<span
                                                class="required">*</span></label>
                                        <input type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <div class="mb-3">
                                        <label class="text-label form-label">Tanggal Mulai Event<span
                                                class="required">*</span></label>
                                        <input type="date" name="phoneNumber" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <div class="mb-3">
                                        <label class="text-label form-label">Tanggal Akhir Event<span
                                                class="required">*</span></label>
                                        <input type="date" name="phoneNumber" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <div class="mb-3">
                                        <label class="text-label form-label">Tanggal Mulai Registrasi<span
                                                class="required">*</span></label>
                                        <input type="date" name="phoneNumber" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <div class="mb-3">
                                        <label class="text-label form-label">Tanggal Akhir Registrasi<span
                                                class="required">*</span></label>
                                        <input type="date" name="phoneNumber" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <div class="mb-3">
                                        <label class="text-label form-label">Deskripsi<span
                                                class="required">*</span></label>
                                        <textarea type="date" name="phoneNumber" class="form-control" required></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <div class="mb-3">
                                        <label class="text-label form-label">Poster<span
                                                class="required">*</span></label>
                                        <input type="file" name="phoneNumber" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="wizard_Details" class="tab-pane" role="tabpanel">
                            <div id="category-container">
                                <div class="category-block">
                                    <h3 class="text-center">Kategori 1</h3>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <div class="mb-3">
                                                <label class="text-label form-label">Kategori Event<span
                                                        class="required">*</span></label>
                                                <input type="text" name="kategori[0][kategoriName]" class="form-control"
                                                    placeholder="Masukan nama event" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <div class="mb-3">
                                                <label class="text-label form-label">Kuota Peserta<span
                                                        class="required">*</span></label>
                                                <input type="text" name="kategori[0][kuota]" class="form-control"
                                                    placeholder="Masukan nama event" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <div class="mb-3">
                                                <label class="text-label form-label">Harga Tiket<span
                                                        class="required">*</span></label>
                                                <input type="text" name="kategori[0][price]" class="form-control"
                                                    placeholder="Masukan nama event" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <div class="mb-3">
                                                <label class="text-label form-label">Format BIB<span
                                                        class="required">*</span></label>
                                                <input type="text" name="kategori[0][formatBib]" class="form-control"
                                                    placeholder="Masukan nama event" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary my-3" id="addCategory">+ Tambah Kategori</button>

                        </div>
                        <div id="wizard_Payment" class="tab-pane" role="tabpanel">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('script')
    <script>
        $(document).ready(function() {
            // SmartWizard initialize
            $('#smartwizard').smartWizard();
            let categoryIndex = 1;

            document.getElementById('addCategory').addEventListener('click', function() {
                const container = document.getElementById('category-container');
                const newCategory = document.createElement('div');
                newCategory.classList.add('category-block');
                newCategory.innerHTML = `
        <h3 class="text-center">Kategori ${categoryIndex + 1}</h3>
        <hr>
        <div class="row">
            <div class="col-lg-6 mb-2">
                <div class="mb-3">
                    <label class="text-label form-label">Kategori Event<span class="required">*</span></label>
                    <input type="text" name="kategori[${categoryIndex}][nama_event]" class="form-control" placeholder="Masukan nama event" required>
                </div>
            </div>
            <div class="col-lg-6 mb-2">
                <div class="mb-3">
                    <label class="text-label form-label">Kuota Peserta<span class="required">*</span></label>
                    <input type="text" name="kategori[${categoryIndex}][kuota]" class="form-control" placeholder="Masukan kuota" required>
                </div>
            </div>
            <div class="col-lg-6 mb-2">
                <div class="mb-3">
                    <label class="text-label form-label">Harga Tiket<span class="required">*</span></label>
                    <input type="text" name="kategori[${categoryIndex}][harga]" class="form-control" placeholder="Masukan harga" required>
                </div>
            </div>
            <div class="col-lg-6 mb-2">
                <div class="mb-3">
                    <label class="text-label form-label">Format BIB<span class="required">*</span></label>
                    <input type="text" name="kategori[${categoryIndex}][bib]" class="form-control" placeholder="Masukan format BIB" required>
                </div>
            </div>
        </div>
    `;
                container.appendChild(newCategory);
                categoryIndex++;
            });
        });
    </script>
    @endsection
</x-app-layout>