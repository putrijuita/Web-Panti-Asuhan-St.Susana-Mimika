@extends('admin.layouts.app')

@section('title', 'Tambah Dokumentasi Video')
@section('page-title', 'Tambah Dokumentasi Video')
@section('page-subtitle', 'Unggah dokumentasi video kegiatan panti')

@section('content')
<div class="card">
    <div class="card-header">
        <span class="card-title">
            <i class="fas fa-plus-circle" style="margin-right:8px;color:#16a34a;"></i>
            Form Tambah Dokumentasi Video
        </span>
        <a href="{{ route('admin.dokumentasi-video.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="card-body">
        <form id="dokumentasi-video-form" action="{{ route('admin.dokumentasi-video.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="video" class="form-label">File Dokumentasi <span style="color:#ef4444;">*</span></label>
                <input type="file" name="video" id="video" class="form-control" required>
                <small style="font-size:12px;color:#64748b;display:block;margin-top:4px;">
                    Bisa mengunggah semua jenis file video tanpa batasan durasi. Ukuran file tetap dibatasi oleh konfigurasi server/PHP.
                </small>
                @error('video')
                    <div style="color:#b91c1c;font-size:12px;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <div id="upload-progress-wrapper" style="display:none;margin-top:12px;">
                <label class="form-label" style="font-size:13px;color:#0f172a;">Proses unggah ke server</label>
                <div class="progress" style="height:20px;">
                    <div
                        id="upload-progress-bar"
                        class="progress-bar progress-bar-striped progress-bar-animated"
                        role="progressbar"
                        style="width:0%;"
                        aria-valuenow="0"
                        aria-valuemin="0"
                        aria-valuemax="100"
                    >
                        0%
                    </div>
                </div>
                <small id="upload-progress-text" style="font-size:12px;color:#64748b;display:block;margin-top:4px;">
                    Mengunggah file, mohon tunggu hingga 100%.
                </small>
            </div>

            <div class="form-group">
                <label for="nama" class="form-label">Nama Video <span style="color:#ef4444;">*</span></label>
                <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required>
                @error('nama')
                    <div style="color:#b91c1c;font-size:12px;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea name="keterangan" id="keterangan" class="form-control" rows="4">{{ old('keterangan') }}</textarea>
                @error('keterangan')
                    <div style="color:#b91c1c;font-size:12px;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan
            </button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('dokumentasi-video-form');
        if (!form) return;

        const fileInput = document.getElementById('video');
        const progressWrapper = document.getElementById('upload-progress-wrapper');
        const progressBar = document.getElementById('upload-progress-bar');
        const progressText = document.getElementById('upload-progress-text');
        const submitButton = form.querySelector('button[type="submit"]');

        form.addEventListener('submit', function (event) {
            // Jika tidak ada file, kirim biasa saja
            if (!fileInput || !fileInput.files || fileInput.files.length === 0) {
                return;
            }

            event.preventDefault();

            const formData = new FormData(form);
            const xhr = new XMLHttpRequest();

            xhr.open('POST', form.action, true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

            if (progressWrapper) {
                progressWrapper.style.display = 'block';
            }
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengunggah...';
            }

            xhr.upload.addEventListener('progress', function (e) {
                if (!e.lengthComputable) return;
                const percent = Math.round((e.loaded / e.total) * 100);

                if (progressBar) {
                    progressBar.style.width = percent + '%';
                    progressBar.setAttribute('aria-valuenow', percent);
                    progressBar.textContent = percent + '%';
                }

                if (progressText) {
                    progressText.textContent = 'Mengunggah ' + percent + '%. Mohon jangan menutup halaman ini.';
                }
            });

            xhr.onreadystatechange = function () {
                if (xhr.readyState !== XMLHttpRequest.DONE) {
                    return;
                }

                // Anggap berhasil untuk semua status sukses/redirect (200–399),
                // karena Laravel biasanya merespons dengan redirect 302 setelah menyimpan.
                if (xhr.status >= 200 && xhr.status < 400) {
                    window.location.href = "{{ route('admin.dokumentasi-video.index') }}";
                } else {
                    if (submitButton) {
                        submitButton.disabled = false;
                        submitButton.innerHTML = '<i class="fas fa-save"></i> Simpan';
                    }

                    alert('Terjadi kesalahan saat mengunggah ke server. Silakan coba lagi, dan bila tetap gagal, hubungi admin server untuk pengecekan konfigurasi.');
                }
            };

            xhr.send(formData);
        });
    });
</script>
@endpush

