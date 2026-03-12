@extends('admin.layouts.app')

@section('title', 'Struktur Organisasi')
@section('page-title', 'Struktur Organisasi')
@section('page-subtitle', 'Kelola struktur organisasi Panti Asuhan')

@section('content')

<div class="card" style="margin-bottom:20px;">
    <div class="card-header">
        <span class="card-title">
            <i class="fas fa-sitemap" style="color:#1e40af;margin-right:8px;"></i>
            Struktur Organisasi
        </span>
        <a href="{{ route('admin.struktur.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus-circle"></i>
            Tambah Struktur
        </a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Gambar</th>
                    <th>Status / Jabatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                <tr>
                    <td style="font-weight:600;font-size:13.5px;">
                        {{ $item->nama }}
                    </td>
                    <td>
                        @if($item->gambar_path)
                            @php $imgUrl = asset('storage/'.$item->gambar_path); @endphp
                            <button type="button" class="img-thumb-btn" onclick="openImageModal('{{ $imgUrl }}', '{{ addslashes($item->nama) }}')" title="Klik untuk memperbesar">
                                <img src="{{ $imgUrl }}" alt="{{ $item->nama }}" style="width:60px;height:60px;object-fit:cover;border-radius:8px;border:1px solid #e2e8f0;cursor:pointer;display:block;">
                            </button>
                        @else
                            <span class="badge badge-gray">Tidak ada gambar</span>
                        @endif
                    </td>
                    <td style="font-size:13px;color:#64748b;">
                        {{ $item->jabatan }}
                    </td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('admin.struktur.edit', $item) }}" class="btn btn-secondary btn-sm" title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>
                            <a href="{{ route('admin.struktur.show', $item) }}" class="btn btn-secondary btn-sm" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.struktur.destroy', $item) }}" onsubmit="return confirm('Hapus data struktur ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align:center;padding:40px;color:#94a3b8;">
                        <i class="fas fa-inbox" style="font-size:32px;margin-bottom:10px;display:block;"></i>
                        Belum ada data struktur organisasi
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($items->hasPages())
    <div class="pagination-wrap">
        <span>Menampilkan {{ $items->firstItem() }}–{{ $items->lastItem() }} dari {{ $items->total() }} struktur</span>
        {{ $items->links('admin.partials.pagination') }}
    </div>
    @endif
</div>

{{-- Modal foto timbul saat diklik --}}
<div id="imageModal" class="image-modal" onclick="closeImageModal(event)">
    <span class="image-modal-close" onclick="closeImageModal(event)" title="Tutup">&times;</span>
    <img id="imageModalImg" class="image-modal-content" src="" alt="" onclick="event.stopPropagation()">
    <div id="imageModalCaption" class="image-modal-caption"></div>
</div>

@endsection

@push('styles')
<style>
.img-thumb-btn { background: none; border: none; padding: 0; cursor: pointer; }
.img-thumb-btn:hover img { box-shadow: 0 4px 12px rgba(0,0,0,.15); }
.image-modal {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,.85);
    align-items: center;
    justify-content: center;
    padding: 20px;
}
.image-modal.show { display: flex; flex-direction: column; }
.image-modal-close {
    position: absolute;
    top: 16px;
    right: 24px;
    color: #fff;
    font-size: 36px;
    font-weight: 300;
    cursor: pointer;
    line-height: 1;
    z-index: 1;
}
.image-modal-close:hover { opacity: .9; }
.image-modal-content {
    max-width: 90%;
    max-height: 85vh;
    object-fit: contain;
    border-radius: 8px;
    box-shadow: 0 8px 32px rgba(0,0,0,.4);
}
.image-modal-caption {
    color: #fff;
    text-align: center;
    padding: 12px 0 0;
    font-size: 14px;
}
</style>
@endpush

@push('scripts')
<script>
function openImageModal(src, caption) {
    var modal = document.getElementById('imageModal');
    var img = document.getElementById('imageModalImg');
    var cap = document.getElementById('imageModalCaption');
    if (modal && img) {
        img.src = src;
        img.alt = caption || '';
        cap.textContent = caption || '';
        modal.classList.add('show');
        document.body.style.overflow = 'hidden';
    }
}
function closeImageModal(e) {
    var modal = document.getElementById('imageModal');
    if (!modal) return;
    if (e && e.target !== modal && !e.target.classList.contains('image-modal-close')) return;
    modal.classList.remove('show');
    document.body.style.overflow = '';
}
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeImageModal(e);
});
</script>
@endpush

