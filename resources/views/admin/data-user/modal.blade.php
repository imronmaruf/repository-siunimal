<div id="modalAdd" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" data-bs-backdrop="static"
    data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah User</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('data-user.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}" id="name" name="name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" id="email" name="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-form-label">Role</label>
                            <div class="col-md-10">
                                <select class="form-control form-select @error('role') is-invalid @enderror"
                                    name="role" id="role">
                                    <option value="">-- Pilih Role --</option>
                                    @foreach ($roles as $data)
                                        <option value="{{ $data->role }}"
                                            {{ old('role') == $data->role ? 'selected' : '' }}>{{ $data->role }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="col-form-label">Status</label>
                            <div class="col-md-10">
                                <select class="form-control form-select @error('status') is-invalid @enderror"
                                    name="status" id="status">
                                    <option value="">-- Pilih Status --</option>
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status }}"
                                            {{ old('status') == $status ? 'selected' : '' }}>
                                            {{ $status }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach ($dataUser as $user)
    <div id="modalEdit{{ $user->id }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit User</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('data-user.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div>
                                    <label for="name" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $user->name) }}" id="name" name="name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email', $user->email) }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="col-form-label">Role</label>
                                <div class="col-md-10">
                                    <select class="form-control form-select @error('role') is-invalid @enderror"
                                        name="role" id="role">
                                        <option value="">-- Pilih Role --</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->role }}"
                                                {{ old('role', $user->role) == $role->role ? 'selected' : '' }}>
                                                {{ $role->role }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="col-form-label">Status</label>
                                <div class="col-md-10">
                                    <select class="form-control form-select @error('status') is-invalid @enderror"
                                        name="status" id="status">
                                        <option value="">-- Pilih Status --</option>
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status }}"
                                                {{ old('status', $user->status) == $status ? 'selected' : '' }}>
                                                {{ $status }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
