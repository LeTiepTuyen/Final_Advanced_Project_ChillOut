<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{
    // Add a new address
    public function addAddress(Request $request)
    {
        $data = $request->validate([
            'userId' => 'required|string',
            'name' => 'required|string',
            'address' => 'required|string',
            'zipcode' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
        ]);

        $address = Address::create($data);
        return response()->json($address, 201);
    }

    // Update an address
    public function updateAddress(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'sometimes|string',
            'address' => 'sometimes|string',
            'zipcode' => 'sometimes|string',
            'city' => 'sometimes|string',
            'country' => 'sometimes|string',
        ]);

        $address = Address::find($id);

        if (!$address) {
            return response()->json(['message' => 'Address not found'], 404);
        }

        $address->update($data);
        return response()->json($address, 200);
    }

    // Get address by user
    public function getAddressByUser($userId)
    {
        $address = Address::where('user_id', $userId)->first();

        if (!$address) {
            return response()->json(['message' => 'Address not found'], 404);
        }

        return response()->json($address, 200);
    }
}
