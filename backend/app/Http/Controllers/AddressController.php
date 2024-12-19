<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Services\ErrorHandler;
use App\Services\LogHandler;

class AddressController extends Controller
{
    // Add a new address
    public function addAddress(Request $request)
    {
        LogHandler::logInfo('Attempting to add a new address.', ['request_data' => $request->all()]);

        // Validate the request
        $data = $request->validate([
            'userId' => 'required|string',
            'name' => 'required|string',
            'address' => 'required|string',
            'zipcode' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
        ]);

        // Example: Forbidden condition (e.g., invalid userId format)
        ErrorHandler::abortIfForbidden(!is_numeric($data['userId']), 'Invalid userId format.', ['userId' => $data['userId']]);

        // Create the address
        $address = Address::create($data);

        LogHandler::logInfo('Address created successfully.', ['address_id' => $address->id, 'user_id' => $data['userId']]);

        return response()->json([
            'success' => true,
            'data' => $address
        ], 201);
    }

    // Update an address
    public function updateAddress(Request $request, $id)
    {
        LogHandler::logInfo('Attempting to update address.', ['address_id' => $id, 'request_data' => $request->all()]);

        // Validate the request
        $data = $request->validate([
            'name' => 'sometimes|string',
            'address' => 'sometimes|string',
            'zipcode' => 'sometimes|string',
            'city' => 'sometimes|string',
            'country' => 'sometimes|string',
        ]);

        // Find the address
        $address = Address::find($id);

        ErrorHandler::abortIfNotFound($address, 'Address not found for update.', ['address_id' => $id]);

        // Forbidden condition example
        ErrorHandler::abortIfForbidden(empty($data), 'No update data provided.', ['address_id' => $id]);

        // Update the address
        $address->update($data);

        LogHandler::logInfo('Address updated successfully.', ['address_id' => $id]);

        return response()->json([
            'success' => true,
            'data' => $address
        ], 200);
    }

    // Get address by user
    public function getAddressByUser($userId)
    {
        LogHandler::logInfo('Fetching address for user.', ['user_id' => $userId]);

        // Example: Forbidden condition (e.g., invalid userId format)
        ErrorHandler::abortIfForbidden(!is_numeric($userId), 'Invalid userId format.', ['user_id' => $userId]);

        // Retrieve the address
        $address = Address::where('user_id', $userId)->first();

        ErrorHandler::abortIfNotFound($address, 'Address not found for user.', ['user_id' => $userId]);

        LogHandler::logInfo('Address retrieved successfully.', ['user_id' => $userId, 'address_id' => $address->id]);

        return response()->json([
            'success' => true,
            'data' => $address
        ], 200);
    }
}
