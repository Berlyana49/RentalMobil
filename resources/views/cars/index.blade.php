@extends('layouts.app')

@section('title', 'Data Mobil')

@section('content')
<div class="page-header">
    <h1>Data Mobil</h1>
    <a href="{{ route('cars.create') }}" class="btn btn-primary">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Mobil
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h5>Daftar Semua Mobil</h5>
        <span style="font-size:.8rem;color:var(--text-muted)">Total: {{ $cars->total() }} mobil</span>
    </div>
    <div class="card-body" style="padding:0">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Gambar</th>
                        <th>Merek / Model</th>
                        <th>Kategori</th>
                        <th>Plat Nomor</th>
                        <th>Tarif / Hari</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cars as $index => $car)
                    <tr>
                        <td style="color:var(--text-muted)">{{ $cars->firstItem() + $index }}</td>
                        <td>
                            @if($car->image)
                                <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->brand_model }}" class="car-img">
                            @else
                                <div class="car-img-placeholder">No<br>Foto</div>
                            @endif
                        </td>
                        <td style="font-weight:600">{{ $car->brand_model }}</td>
                        <td>
                            <span class="badge badge-info" style="text-transform:capitalize">
                                {{ $car->category }}
                            </span>
                        </td>
                        <td style="font-family:monospace;letter-spacing:.5px">{{ $car->plate_number }}</td>
                        <td>Rp {{ number_format($car->rental_rate_per_day, 0, ',', '.') }}</td>
                        <td>
                            <div style="display:flex;gap:6px">
                                <a href="{{ route('cars.show', $car) }}" class="btn btn-secondary btn-sm">Detail</a>
                                <a href="{{ route('cars.edit', $car) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('cars.destroy', $car) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus mobil ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="text-align:center;color:var(--text-muted);padding:40px">
                            Belum ada data mobil. <a href="{{ route('cars.create') }}" style="color:var(--primary)">Tambah sekarang</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="pagination">
    {{ $cars->links() }}
</div>
@endsection
