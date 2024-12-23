<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Http\Resources\AddressResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AddressController extends Controller
{
    /**
     * Get all addresses with optional search functionality.
     */
    public function index(Request $request)
    {
        $addresses = Address::query()
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%$search%");
            })
            ->paginate(30);

        Log::info('Addresses retrieved successfully', ['count' => $addresses->total()]);

        return AddressResource::collection($addresses);
    }

    /**
     * Get a single address by ID.
     */
    public function show($id)
    {
        $address = Address::findOrFail($id);

        Log::info('Address retrieved successfully', ['address_id' => $id]);

        return new AddressResource($address);
    }

    /**
     * Create a new address.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|uuid',
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'zipcode' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ]);

        $address = Address::create($validated);

        Log::info('Address created successfully', ['address_id' => $address->id]);

        return new AddressResource($address);
    }

    /**
     * Update an existing address.
     */
    public function update(Request $request, $id)
    {
        $address = Address::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'nullable|uuid',
            'name' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'zipcode' => 'nullable|string|max:10',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
        ]);

        $address->update($validated);

        Log::info('Address updated successfully', ['address_id' => $address->id]);

        return new AddressResource($address);
    }

    /**
     * Delete an address by ID.
     */
    public function destroy($id)
    {
        $address = Address::findOrFail($id);

        $address->delete();

        Log::info('Address deleted successfully', ['address_id' => $id]);

        return response()->json(['message' => 'Address deleted successfully']);
    }
}
