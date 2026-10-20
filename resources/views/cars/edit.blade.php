@extends('layouts.app')

@section('title', 'Edit Mobil')

@section('content')
<div class="page-header">
    <h1>Edit Mobil</h1>
    <a href="{{ route('cars.index') }}" class="btn btn-secondary">← Kembali</a>
</div>

<div class="card" style="max-width:640px">
    <div class="card-header">
        <h5>Form Edit: {{ $car->brand_model }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('cars.update', $car) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="brand_model" class="form-label">Merek / Model Mobil <span style="color:var(--danger)">*</span></label>
                <input type="text" id="brand_model" name="brand_model"
                       class="form-control @error('brand_model') is-invalid @enderror"
                       value="{{ old('brand_model', $car->brand_model) }}">
                @error('brand_model')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="category" class="form-label">Kategori <span style="color:var(--danger)">*</span></label>
                <select id="category" name="category"
                        class="form-select @error('category') is-invalid @enderror">
                    @foreach(['sedan','hatchback','suv','coupe','convertible'] as $cat)
                        <option value="{{ $cat }}"
                            {{ old('category', $car->category) == $cat ? 'selected' : '' }}>
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
                       value="{{ old('rental_rate_per_day', $car->rental_rate_per_day) }}" min="1">
                @error('rental_rate_per_day')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="plate_number" class="form-label">Plat Nomor <span style="color:var(--danger)">*</span></label>
                <input type="text" id="plate_number" name="plate_number"
                       class="form-control @error('plate_number') is-invalid @enderror"
                       value="{{ old('plate_number', $car->plate_number) }}"
                       style="text-transform:uppercase">
                @error('plate_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Foto Mobil Saat Ini</label>
                @if($car->image)
                    <div style="margin-bottom:10px">
                        <img src="{{ asset('storage/' . $car->image) }}"
                             alt="{{ $car->brand_model }}"
                             style="width:140px;height:90px;object-fit:cover;border-radius:8px;border:1px solid var(--border)">
                    </div>
                @else
                    <p style="font-size:.82rem;color:var(--text-muted);margin-bottom:10px">Belum ada foto.</p>
                @endif
                <label for="image" class="form-label">Ganti Foto (Opsional)</label>
                <input type="file" id="image" name="image"
                       class="form-control @error('image') is-invalid @enderror"
                       accept="image/jpg,image/jpeg,image/png,image/webp">
                <small style="color:var(--text-muted);font-size:.78rem">Biarkan kosong jika tidak ingin mengganti foto.</small>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div style="display:flex;gap:12px;margin-top:8px">
                <button type="submit" class="btn btn-warning">Update Mobil</button>
                <a href="{{ route('cars.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
