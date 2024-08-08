@can('mahasiswa-only')

    <div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="scrollableModalTitle"
        data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollableModalTitle">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="editProfileForm" action="{{ route('profile-setting.update', $mahasiswa->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <!-- Input File Foto -->
                            <div class="col-md-12 mb-3">
                                <label for="photo">Foto Profil</label>
                                <div>
                                    <img id="photoPreview" src="{{ asset('admin/img/foto/' . $mahasiswa->foto) }}"
                                        alt="Foto Profil" class="img-fluid mb-2" style="max-height: 200px;">
                                </div>
                                <input type="file" class="form-control" id="foto" name="foto" accept="image/*"
                                    onchange="previewImage(event)">
                                @error('foto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="name">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name', $mahasiswa->name) }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="nim">NIM</label>
                                <input type="number" class="form-control" id="nim" name="nim"
                                    value="{{ old('nim', $mahasiswa->nim) }}">
                                @error('nim')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', $user->email) }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="hp">Nomor HP</label>
                                <input type="number" class="form-control" id="hp" name="hp"
                                    value="{{ old('hp', $mahasiswa->hp) }}">
                                @error('hp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            @foreach (['dosen_pembimbing_kp', 'dosen_pembimbing_tga_1', 'dosen_pembimbing_tga_2', 'dosen_penguji_tga_1', 'dosen_penguji_tga_2'] as $dosenField)
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label
                                            for="{{ $dosenField }}">{{ ucfirst(str_replace('_', ' ', $dosenField)) }}</label>
                                        <select class="form-control form-select @error($dosenField) is-invalid @enderror"
                                            name="{{ $dosenField }}" id="{{ $dosenField }}">
                                            <option value="">-- Pilih Dosen --</option>
                                            @foreach ($dataDosen as $dosen)
                                                <option value="{{ $dosen->id }}"
                                                    {{ old($dosenField, $mahasiswa->$dosenField) == $dosen->id ? 'selected' : '' }}>
                                                    {{ $dosen->name }}</option>
                                            @endforeach
                                        </select>
                                        @error($dosenField)
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="cancelButton">Batal</button>
                            <button type="button" class="btn btn-primary" id="confirmSaveButton">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        function previewImage(event) {
            const photoPreview = document.getElementById('photoPreview');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    photoPreview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            } else {
                // Jika tidak ada file, tampilkan foto lama
                photoPreview.src = "{{ asset('admin/img/foto/' . $mahasiswa->foto) }}"; // Ganti dengan path foto lama
            }
        }

        document.getElementById('confirmSaveButton').addEventListener('click', function() {
            Swal.fire({
                title: 'Yakin ingin mengubah data?',
                text: "Data yang telah diubah akan disimpan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, simpan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('editProfileForm').submit();
                }
            });
        });

        document.getElementById('cancelButton').addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah penutupan modal langsung
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Perubahan yang belum disimpan akan hilang.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, batal!',
                cancelButtonText: 'Tidak, lanjutkan'
            }).then((result) => {
                if (result.isConfirmed) {
                    var modal = bootstrap.Modal.getInstance(document.getElementById('editProfile'));
                    modal.hide(); // Tutup modal jika pengguna mengonfirmasi
                }
            });
        });
    </script>
@endcan
