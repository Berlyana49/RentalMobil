@extends('layouts.app')

@section('title', 'Detail Rental')

@section('content')
<div class="page-header">
    <h1>Detail Rental #{{ $rental->id }}</h1>
    <div style="display:flex;gap:8px">
        <a href="{{ route('rentals.edit', $rental) }}" class="btn btn-warning">Ubah Status</a>
        <a href="{{ route('rentals.index') }}" class="btn btn-secondary">← Kembali</a>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:24px">

    {{-- Info Penyewa --}}
    <div class="card">
        <div class="card-header">
            <h5>Informasi Penyewa</h5>
            @if($rental->status === 'disewa')
                <span class="badge badge-warning">Disewa</span>
            @elseif($rental->status === 'dikembalikan')
                <span class="badge badge-success">Dikembalikan</span>
            @else
                <span class="badge badge-danger">Dibatalkan</span>
            @endif
        </div>
        <div class="card-body">
            <dl class="detail-list">
                <dt>ID Transaksi</dt>
                <dd>#{{ $rental->id }}</dd>

                <dt>Nama Penyewa</dt>
                <dd style="font-weight:600">{{ $rental->customer_name }}</dd>

                <dt>Nomor NIK</dt>
                <dd style="font-family:monospace">{{ $rental->nik_number }}</dd>

                <dt>Tanggal Mulai</dt>
                <dd>{{ \Carbon\Carbon::parse($rental->start_date)->format('d F Y') }}</dd>

                <dt>Tanggal Kembali</dt>
                <dd>{{ \Carbon\Carbon::parse($rental->end_date)->format('d F Y') }}</dd>

                <dt>Total Harga</dt>
                <dd style="font-size:1.1rem;font-weight:700;color:var(--success)">
                    Rp {{ number_format($rental->total_price, 0, ',', '.') }}
                </dd>

                <dt>Dibuat</dt>
                <dd>{{ $rental->created_at->format('d M Y, H:i') }}</dd>
            </dl>
        </div>
    </div>

    {{-- Detail Mobil yang Disewa --}}
    <div class="card">
        <div class="card-header">
            <h5>Rincian Mobil Disewa</h5>
        </div>
        <div class="card-body" style="padding:0">
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Mobil</th>
                            <th>Plat</th>
                            <th>Hari</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rental->rentalDetails as $detail)
                        <tr>
                            <td>
                                <div style="font-weight:600">{{ $detail->car->brand_model }}</div>
                                <div style="font-size:.78rem;color:var(--text-muted);text-transform:capitalize">{{ $detail->car->category }}</div>
                            </td>
                            <td style="font-family:monospace;font-size:.82rem">{{ $detail->car->plate_number }}</td>
                            <td>{{ $detail->days_count }} hari</td>
                            <td style="font-weight:600">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align:center;color:var(--text-muted);padding:30px">
                                Tidak ada detail
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($rental->rentalDetails->count() > 0)
            <div style="padding:14px 16px;border-top:1px solid var(--border);display:flex;justify-content:space-between;align-items:center">
                <span style="font-size:.85rem;color:var(--text-muted)">TOTAL BAYAR</span>
                <span style="font-size:1.1rem;font-weight:700;color:var(--success)">
                    Rp {{ number_format($rental->total_price, 0, ',', '.') }}
                </span>
            </div>
            @endif
        </div>
    </div>

</div>
@endsection
