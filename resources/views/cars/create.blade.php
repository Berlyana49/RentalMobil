@extends('layouts.app')

@section('title', 'Tambah Mobil')

@section('content')
<div class="page-header">
    <h1>Tambah Mobil</h1>
    <a href="{{ route('cars.index') }}" class="btn btn-secondary">← Kembali</a>
</div>

<div class="card" style="max-width:640px">
    <div class="card-header">
        <h5>Form Tambah Mobil Baru</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="brand_model" class="form-label">Merek / Model Mobil <span style="color:var(--danger)">*</span></label>
                <input type="text" id="brand_model" name="brand_model"
                       class="form-control @error('brand_model') is-invalid @enderror"
                       value="{{ old('brand_model') }}"
                       placeholder="Contoh: Toyota Avanza 2022">
                @error('brand_model')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="category" class="form-label">Kategori <span style="color:var(--danger)">*</span></label>
                <select id="category" name="category"
                        class="form-select @error('category') is-invalid @enderror">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach(['sedan','hatchback','suv','coupe','convertible'] as $cat)
                        <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}
                                style="text-transform:capitalize">
                            {{ ucfirst($cat) }}
                        </option>
                    @endforeach
                </select>
                @error('category')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="rental_rate_per_day" class="form-label">Tarif Sewa / Hari (Rp) <span style="color:var(--danger)">*</span></label>
                <input type="number" id="rental_rate_per_day" name="rental_rate_per_day"
                       class="form-control @error('rental_rate_per_day') is-invalid @enderror"
                       value="{{ old('rental_rate_per_day') }}"
                       placeholder="Contoh: 300000" min="1">
                @error('rental_rate_per_day')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="plate_number" class="form-label">Plat Nomor <span style="color:var(--danger)">*</span></label>
                <input type="text" id="plate_number" name="plate_number"
                       class="form-control @error('plate_number') is-invalid @enderror"
                       value="{{ old('plate_number') }}"
                       placeholder="Contoh: B 1234 ABC"
                       style="text-transform:uppercase">
                @error('plate_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="image" class="form-label">Foto Mobil</label>
                <input type="file" id="image" name="image"
                       class="form-control @error('image') is-invalid @enderror"
                       accept="image/jpg,image/jpeg,image/png,image/webp">
                <small style="color:var(--text-muted);font-size:.78rem">Format: JPG, PNG, WEBP. Maks 2MB.</small>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div style="display:flex;gap:12px;margin-top:8px">
                <button type="submit" class="btn btn-primary">Simpan Mobil</button>
                <a href="{{ route('cars.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
