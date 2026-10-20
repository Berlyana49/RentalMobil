<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rental;
use App\Models\RentalDetail;
use Illuminate\Http\Request;

class RentalsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rentals = Rental::latest()->paginate(10);
        return view('rentals.index', compact('rentals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cars = Car::all();
        return view('rentals.create', compact('cars'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'nik_number'    => 'required|string|max:20',
            'start_date'    => 'required|date',
            'end_date'      => 'required|date|after_or_equal:start_date',
            'car_id'        => 'required|exists:cars,id',
        ]);

        $car       = Car::findOrFail($request->car_id);
        $startDate = \Carbon\Carbon::parse($request->start_date);
        $endDate   = \Carbon\Carbon::parse($request->end_date);
        $daysCount = $startDate->diffInDays($endDate);

        // Minimal 1 hari
        if ($daysCount < 1) {
            $daysCount = 1;
        }

        $subtotal   = $car->rental_rate_per_day * $daysCount;
        $totalPrice = $subtotal;

        // Buat data rental
        $rental = Rental::create([
            'customer_name' => $request->customer_name,
            'nik_number'    => $request->nik_number,
            'start_date'    => $request->start_date,
            'end_date'      => $request->end_date,
            'total_price'   => $totalPrice,
            'status'        => 'disewa',
        ]);

        // Buat detail rental
        RentalDetail::create([
            'rental_id'  => $rental->id,
            'car_id'     => $car->id,
            'days_count' => $daysCount,
            'subtotal'   => $subtotal,
        ]);

        return redirect()->route('rentals.index')->with('success', 'Transaksi rental berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rental $rental)
    {
        $rental->load('rentalDetails.car');
        return view('rentals.show', compact('rental'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rental $rental)
    {
        return view('rentals.edit', compact('rental'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rental $rental)
    {
        $request->validate([
            'status' => 'required|in:disewa,dikembalikan,dibatalkan',
        ]);

        $rental->update([
            'status' => $request->status,
        ]);

        return redirect()->route('rentals.index')->with('success', 'Status rental berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rental $rental)
    {
        $rental->delete();

        return redirect()->route('rentals.index')->with('success', 'Data rental berhasil dihapus.');
    }
}
