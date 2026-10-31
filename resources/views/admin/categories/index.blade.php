@extends('layouts.admin')

@section('content')
<style>
.categories-page{--g:#496b55;--gd:#304b39;--sage:#edf3eb;--border:#e3e8e0;--text:#29332c;--muted:#788078;width:100%;color:var(--text)}
.categories-page *{box-sizing:border-box}
.categories-heading{display:flex;align-items:flex-end;justify-content:space-between;gap:18px;flex-wrap:wrap;margin-bottom:26px}
.categories-eyebrow{margin:0 0 8px;color:var(--g);font-size:11px;font-weight:700;letter-spacing:2px;text-transform:uppercase}
.categories-title{margin:0;font:600 clamp(28px,4vw,38px) Georgia,'Times New Roman',serif}
.categories-description{margin:9px 0 0;color:var(--muted);font-size:14px;line-height:1.7}
.categories-add{display:inline-flex;align-items:center;justify-content:center;gap:9px;padding:12px 18px;border-radius:10px;background:var(--g);color:#fff!important;text-decoration:none!important;font-size:13px;font-weight:700;box-shadow:0 5px 14px rgba(73,107,85,.15);transition:.2s}
.categories-add:hover{background:var(--gd);transform:translateY(-1px)}
.categories-alert{margin-bottom:20px;padding:14px 16px;border:1px solid #d2e8d3;border-radius:11px;background:#edf7ed;color:#27613a;font-size:13px;line-height:1.7}
.categories-card{overflow:hidden;background:#fff;border:1px solid var(--border);border-radius:16px;box-shadow:0 8px 26px rgba(40,60,42,.045)}
.categories-card-head{display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;padding:20px 23px;border-bottom:1px solid var(--border)}
.categories-card-head h2{margin:0;font-size:16px;font-weight:700}
.categories-count{padding:6px 10px;border-radius:999px;background:var(--sage);color:var(--gd);font-size:11px;font-weight:700}
.categories-table-wrap{width:100%;overflow-x:auto}
.categories-table{width:100%;min-width:560px;border-collapse:collapse}
.categories-table thead th{padding:15px 20px;border-bottom:1px solid var(--border);background:#f7f8f5;color:#68736a;font-size:10px;font-weight:700;letter-spacing:.8px;text-align:left;text-transform:uppercase;white-space:nowrap}
.categories-table tbody td{padding:17px 20px;border-bottom:1px solid #eef0eb;color:var(--text);font-size:13px;vertical-align:middle}
.categories-table tbody tr:last-child td{border-bottom:0}
.categories-table tbody tr:hover{background:#fcfdfb}
.category-number{color:#8b948b;font-size:12px;font-weight:600}
.category-name{font-weight:700}
.category-slug{display:inline-block;padding:6px 9px;border:1px solid #e8ece6;border-radius:7px;background:#fafbf9;color:var(--muted);font:11px Consolas,Monaco,monospace;overflow-wrap:anywhere}
.category-actions{display:flex;align-items:center;gap:7px;white-space:nowrap}
.category-action{display:inline-flex;align-items:center;justify-content:center;min-height:34px;padding:8px 11px;border:0;border-radius:8px;font:700 11px inherit;text-decoration:none!important;cursor:pointer;transition:.2s}
.category-action:hover{filter:brightness(.94);transform:translateY(-1px)}
.category-edit{background:#e8f1e7;color:#365b3e!important}
.category-delete{background:#fff0ee;color:#b33c34}
.categories-empty{padding:48px 20px!important;color:var(--muted)!important;text-align:center}
.categories-empty-icon{display:flex;align-items:center;justify-content:center;width:54px;height:54px;margin:0 auto 14px;border-radius:16px;background:var(--sage);color:var(--g);font-size:24px}
.categories-empty strong{display:block;margin-bottom:5px;color:var(--text);font-size:14px}
.categories-empty span{font-size:12px}
@media(max-width:640px){.categories-heading{align-items:stretch}.categories-add{width:100%}.categories-card-head{padding:17px}.categories-table thead th,.categories-table tbody td{padding:13px}}
</style>

<div class="categories-page">
    <header class="categories-heading">
        <div>
            <p class="categories-eyebrow">Bloomcraft Admin</p>
            <h1 class="categories-title">Data Kategori</h1>
            <p class="categories-description">Kelola kategori untuk menjaga katalog produk Bloomcraft tetap terorganisir.</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="categories-add">
            <span aria-hidden="true">+</span> Tambah Kategori
        </a>
    </header>

    @if(session('success'))
        <div class="categories-alert" role="status">{{ session('success') }}</div>
    @endif

    <section class="categories-card">
        <div class="categories-card-head">
            <h2>Daftar Kategori</h2>
            <span class="categories-count">{{ $categories->count() }} kategori</span>
        </div>

        <div class="categories-table-wrap">
            <table class="categories-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Slug</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td><span class="category-number">{{ $loop->iteration }}</span></td>
                            <td><span class="category-name">{{ $category->name }}</span></td>
                            <td><span class="category-slug">{{ $category->slug }}</span></td>
                            <td>
                                <div class="category-actions">
                                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="category-action category-edit">Edit</a>
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="category-action category-delete">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="categories-empty">
                                <div class="categories-empty-icon" aria-hidden="true">♡</div>
                                <strong>Belum ada kategori</strong>
                                <span>Tambahkan kategori pertama untuk mengelompokkan produk Bloomcraft.</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection
