@extends('layouts.app')

@section('title', 'Transaksi Rental')

@section('content')
<div class="page-header">
    <h1>Transaksi Rental</h1>
    <a href="{{ route('rentals.create') }}" class="btn btn-primary">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
        </svg>
        Buat Rental Baru
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h5>Daftar Semua Transaksi</h5>
        <span style="font-size:.8rem;color:var(--text-muted)">Total: {{ $rentals->total() }} transaksi</span>
    </div>
    <div class="card-body" style="padding:0">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Penyewa</th>
                        <th>NIK</th>
                        <th>Tanggal Sewa</th>
                        <th>Tanggal Kembali</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rentals as $index => $rental)
                    <tr>
                        <td style="color:var(--text-muted)">{{ $rentals->firstItem() + $index }}</td>
                        <td style="font-weight:600">{{ $rental->customer_name }}</td>
                        <td style="font-family:monospace;font-size:.82rem">{{ $rental->nik_number }}</td>
                        <td>{{ \Carbon\Carbon::parse($rental->start_date)->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($rental->end_date)->format('d M Y') }}</td>
                        <td style="font-weight:600;color:var(--success)">
                            Rp {{ number_format($rental->total_price, 0, ',', '.') }}
                        </td>
                        <td>
                            @if($rental->status === 'disewa')
                                <span class="badge badge-warning">Disewa</span>
                            @elseif($rental->status === 'dikembalikan')
                                <span class="badge badge-success">Dikembalikan</span>
                            @else
                                <span class="badge badge-danger">Dibatalkan</span>
                            @endif
                        </td>
                        <td>
                            <div style="display:flex;gap:6px">
                                <a href="{{ route('rentals.show', $rental) }}" class="btn btn-secondary btn-sm">Detail</a>
                                <a href="{{ route('rentals.edit', $rental) }}" class="btn btn-warning btn-sm">Status</a>
                                <form action="{{ route('rentals.destroy', $rental) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="text-align:center;color:var(--text-muted);padding:40px">
                            Belum ada transaksi rental. <a href="{{ route('rentals.create') }}" style="color:var(--primary)">Buat sekarang</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="pagination">
    {{ $rentals->links() }}
</div>
@endsection
