@extends('layouts.app')

@section('title', 'Detail Mobil')

@section('content')
<div class="page-header">
    <h1>Detail Mobil</h1>
    <div style="display:flex;gap:8px">
        <a href="{{ route('cars.edit', $car) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('cars.index') }}" class="btn btn-secondary">← Kembali</a>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:24px">

    {{-- Info Mobil --}}
    <div class="card">
        <div class="card-header">
            <h5>Informasi Mobil</h5>
        </div>
        <div class="card-body">
            @if($car->image)
                <img src="{{ asset('storage/' . $car->image) }}"
                     alt="{{ $car->brand_model }}"
                     style="width:100%;max-height:200px;object-fit:cover;border-radius:8px;margin-bottom:20px">
            @endif

            <dl class="detail-list">
                <dt>ID</dt>
                <dd>#{{ $car->id }}</dd>

                <dt>Merek / Model</dt>
                <dd style="font-weight:600">{{ $car->brand_model }}</dd>

                <dt>Kategori</dt>
                <dd>
                    <span class="badge badge-info" style="text-transform:capitalize">
                        {{ $car->category }}
                    </span>
                </dd>

                <dt>Plat Nomor</dt>
                <dd style="font-family:monospace;font-weight:600;letter-spacing:.5px">{{ $car->plate_number }}</dd>

                <dt>Tarif / Hari</dt>
                <dd style="color:var(--success);font-weight:600">
                    Rp {{ number_format($car->rental_rate_per_day, 0, ',', '.') }}
                </dd>

                <dt>Ditambahkan</dt>
                <dd>{{ $car->created_at->format('d M Y') }}</dd>
            </dl>
        </div>
    </div>

    {{-- Riwayat Rental --}}
    <div class="card">
        <div class="card-header">
            <h5>Riwayat Penyewaan</h5>
            <span style="font-size:.8rem;color:var(--text-muted)">{{ $car->rentalDetails->count() }} transaksi</span>
        </div>
        <div class="card-body" style="padding:0">
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Penyewa</th>
                            <th>Tanggal</th>
                            <th>Hari</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($car->rentalDetails as $detail)
                        <tr>
                            <td>{{ $detail->rental->customer_name }}</td>
                            <td style="font-size:.8rem;color:var(--text-muted)">
                                {{ \Carbon\Carbon::parse($detail->rental->start_date)->format('d/m/Y') }}
                                →
                                {{ \Carbon\Carbon::parse($detail->rental->end_date)->format('d/m/Y') }}
                            </td>
                            <td>{{ $detail->days_count }} hari</td>
                            <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align:center;color:var(--text-muted);padding:30px">
                                Belum pernah disewa
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
