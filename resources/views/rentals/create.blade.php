@extends('layouts.app')

@section('title', 'Buat Rental Baru')

@section('content')
<div class="page-header">
    <h1>Buat Rental Baru</h1>
    <a href="{{ route('rentals.index') }}" class="btn btn-secondary">← Kembali</a>
</div>

<div class="card" style="max-width:680px">
    <div class="card-header">
        <h5>Form Transaksi Rental Mobil</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('rentals.store') }}" method="POST">
            @csrf

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
                <div class="form-group" style="grid-column:1/-1">
                    <label for="customer_name" class="form-label">Nama Penyewa <span style="color:var(--danger)">*</span></label>
                    <input type="text" id="customer_name" name="customer_name"
                           class="form-control @error('customer_name') is-invalid @enderror"
                           value="{{ old('customer_name') }}"
                           placeholder="Nama lengkap penyewa">
                    @error('customer_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group" style="grid-column:1/-1">
                    <label for="nik_number" class="form-label">Nomor NIK (KTP) <span style="color:var(--danger)">*</span></label>
                    <input type="text" id="nik_number" name="nik_number"
                           class="form-control @error('nik_number') is-invalid @enderror"
                           value="{{ old('nik_number') }}"
                           placeholder="16 digit nomor NIK">
                    @error('nik_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="start_date" class="form-label">Tanggal Mulai Sewa <span style="color:var(--danger)">*</span></label>
                    <input type="date" id="start_date" name="start_date"
                           class="form-control @error('start_date') is-invalid @enderror"
                           value="{{ old('start_date', now()->format('Y-m-d')) }}">
                    @error('start_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="end_date" class="form-label">Tanggal Kembali <span style="color:var(--danger)">*</span></label>
                    <input type="date" id="end_date" name="end_date"
                           class="form-control @error('end_date') is-invalid @enderror"
                           value="{{ old('end_date', now()->addDay()->format('Y-m-d')) }}">
                    @error('end_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="car_id" class="form-label">Pilih Mobil <span style="color:var(--danger)">*</span></label>
                <select id="car_id" name="car_id"
                        class="form-select @error('car_id') is-invalid @enderror">
                    <option value="">-- Pilih Mobil --</option>
                    @foreach($cars as $car)
                        <option value="{{ $car->id }}" {{ old('car_id') == $car->id ? 'selected' : '' }}
                                data-rate="{{ $car->rental_rate_per_day }}">
                            {{ $car->brand_model }} — {{ $car->plate_number }}
                            (Rp {{ number_format($car->rental_rate_per_day, 0, ',', '.') }}/hari)
                        </option>
                    @endforeach
                </select>
                @error('car_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Preview Kalkulasi --}}
            <div id="calc-preview" style="
                background:rgba(79,70,229,.1);
                border:1px solid rgba(79,70,229,.3);
                border-radius:10px;
                padding:16px;
                margin-bottom:20px;
                display:none;
            ">
                <p style="font-size:.8rem;color:var(--text-muted);margin-bottom:8px;font-weight:600">KALKULASI SEMENTARA</p>
                <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;text-align:center">
                    <div>
                        <div id="calc-days" style="font-size:1.4rem;font-weight:700;color:var(--primary)">0</div>
                        <div style="font-size:.75rem;color:var(--text-muted)">Hari</div>
                    </div>
                    <div>
                        <div style="font-size:.75rem;color:var(--text-muted);margin-bottom:4px">Tarif/hari</div>
                        <div id="calc-rate" style="font-weight:600">Rp 0</div>
                    </div>
                    <div>
                        <div style="font-size:.75rem;color:var(--text-muted);margin-bottom:4px">Total Estimasi</div>
                        <div id="calc-total" style="font-size:1.1rem;font-weight:700;color:var(--success)">Rp 0</div>
                    </div>
                </div>
            </div>

            <div style="display:flex;gap:12px">
                <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                <a href="{{ route('rentals.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

<script>
    function updateCalc() {
        const carSelect  = document.getElementById('car_id');
        const startInput = document.getElementById('start_date');
        const endInput   = document.getElementById('end_date');
        const preview    = document.getElementById('calc-preview');

        const selectedOption = carSelect.options[carSelect.selectedIndex];
        const rate = parseInt(selectedOption.dataset.rate || 0);
        const start = new Date(startInput.value);
        const end   = new Date(endInput.value);

        if (!isNaN(start) && !isNaN(end) && end >= start && rate > 0) {
            let days = Math.round((end - start) / (1000 * 60 * 60 * 24));
            if (days < 1) days = 1;
            const total = days * rate;

            document.getElementById('calc-days').textContent  = days;
            document.getElementById('calc-rate').textContent  = 'Rp ' + rate.toLocaleString('id-ID');
            document.getElementById('calc-total').textContent = 'Rp ' + total.toLocaleString('id-ID');
            preview.style.display = 'block';
        } else {
            preview.style.display = 'none';
        }
    }

    document.getElementById('car_id').addEventListener('change', updateCalc);
    document.getElementById('start_date').addEventListener('change', updateCalc);
    document.getElementById('end_date').addEventListener('change', updateCalc);
    updateCalc();
</script>
@endsection
