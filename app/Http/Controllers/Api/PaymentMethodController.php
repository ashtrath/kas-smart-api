<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentMethod\StorePaymentMethodRequest;
use App\Http\Requests\PaymentMethod\UpdatePaymentMethodRequest;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payment_method = PaymentMethod::all();

        return $this->sendResponse('Payment methods retrieved successfully.', $payment_method);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentMethodRequest $request)
    {
        $payment_method = PaymentMethod::create($request->all());

        return $this->sendResponse('Payment method created successfully.', $payment_method, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentMethodRequest $request, int $id)
    {
        $payment_method = PaymentMethod::find($id);
        if (! $payment_method) {
            return $this->sendError('Payment method not found.');
        }

        $payment_method->update($request->all());

        return $this->sendResponse('Payment method updated successfully.', $payment_method);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $payment_method = PaymentMethod::find($id);
        if (! $payment_method) {
            return $this->sendError('Payment method not found.');
        }

        $payment_method->delete();

        return $this->sendResponse('Payment method deleted successfully.', null, 204);
    }
}
