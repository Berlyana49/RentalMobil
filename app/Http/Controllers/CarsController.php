<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::latest()->paginate(10);
        return view('cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'brand_model'        => 'required|string|max:255',
            'category'           => 'required|in:sedan,hatchback,suv,coupe,convertible',
            'rental_rate_per_day'=> 'required|integer|min:1',
            'plate_number'       => 'required|string|max:20|unique:cars,plate_number',
            'image'              => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only(['brand_model', 'category', 'rental_rate_per_day', 'plate_number']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('cars', 'public');
        }

        Car::create($data);

        return redirect()->route('cars.index')->with('success', 'Mobil berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        $car->load('rentalDetails.rental');
        return view('cars.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $request->validate([
            'brand_model'        => 'required|string|max:255',
            'category'           => 'required|in:sedan,hatchback,suv,coupe,convertible',
            'rental_rate_per_day'=> 'required|integer|min:1',
            'plate_number'       => 'required|string|max:20|unique:cars,plate_number,' . $car->id,
            'image'              => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only(['brand_model', 'category', 'rental_rate_per_day', 'plate_number']);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($car->image) {
                Storage::disk('public')->delete($car->image);
            }
            $data['image'] = $request->file('image')->store('cars', 'public');
        }

        $car->update($data);

        return redirect()->route('cars.index')->with('success', 'Data mobil berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        if ($car->image) {
            Storage::disk('public')->delete($car->image);
        }

        $car->delete();

        return redirect()->route('cars.index')->with('success', 'Mobil berhasil dihapus.');
    }
}
