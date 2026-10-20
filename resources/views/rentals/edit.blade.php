@extends('layouts.app')

@section('title', 'Update Status Rental')

@section('content')
<div class="page-header">
    <h1>Update Status Rental</h1>
    <a href="{{ route('rentals.index') }}" class="btn btn-secondary">← Kembali</a>
</div>

<div class="card" style="max-width:500px">
    <div class="card-header">
        <h5>Rental #{{ $rental->id }} — {{ $rental->customer_name }}</h5>
    </div>
    <div class="card-body">

        {{-- Info Singkat --}}
        <div style="
            background:var(--bg3);
            border-radius:8px;
            padding:14px;
            margin-bottom:24px;
            font-size:.875rem;
        ">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px">
                <div>
                    <span style="color:var(--text-muted)">Penyewa:</span><br>
                    <strong>{{ $rental->customer_name }}</strong>
                </div>
                <div>
                    <span style="color:var(--text-muted)">Total Harga:</span><br>
                    <strong style="color:var(--success)">Rp {{ number_format($rental->total_price, 0, ',', '.') }}</strong>
                </div>
                <div>
                    <span style="color:var(--text-muted)">Mulai:</span><br>
                    {{ \Carbon\Carbon::parse($rental->start_date)->format('d M Y') }}
                </div>
                <div>
                    <span style="color:var(--text-muted)">Kembali:</span><br>
                    {{ \Carbon\Carbon::parse($rental->end_date)->format('d M Y') }}
                </div>
            </div>
        </div>

        <form action="{{ route('rentals.update', $rental) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="status" class="form-label">Status Rental <span style="color:var(--danger)">*</span></label>
                <select id="status" name="status"
                        class="form-select @error('status') is-invalid @enderror">
                    <option value="disewa"
                        {{ old('status', $rental->status) === 'disewa' ? 'selected' : '' }}>
                        🟡 Disewa
                    </option>
                    <option value="dikembalikan"
                        {{ old('status', $rental->status) === 'dikembalikan' ? 'selected' : '' }}>
                        🟢 Dikembalikan
                    </option>
                    <option value="dibatalkan"
                        {{ old('status', $rental->status) === 'dibatalkan' ? 'selected' : '' }}>
                        🔴 Dibatalkan
                    </option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div style="display:flex;gap:12px;margin-top:8px">
                <button type="submit" class="btn btn-warning">Simpan Status</button>
                <a href="{{ route('rentals.show', $rental) }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
