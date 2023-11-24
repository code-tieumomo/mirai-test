<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Account\StoreRequest;
use App\Http\Requests\V1\Account\UpdateRequest;
use App\Http\Resources\V1\AccountResource;
use App\Models\Account;
use App\Services\AccountService;
use Illuminate\Support\Facades\Log;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Log::channel('api')->info('Request to get all accounts', ['ip' => request()->ip()]);

        return AccountResource::collection(
            Account::filter()->sort()->paginate(config('app.pagination_per_page'))
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $dataValidated = $request->validated();

        $account = AccountService::createNewAccount($dataValidated);

        if ($account) {
            return new AccountResource($account);
        } else {
            return response()->json(['message' => 'Failed to create account'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $account = AccountService::getAccountById((int)$id);

        if ($account) {
            return new AccountResource($account);
        } else {
            return response()->json(['message' => 'Account not found'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $dataValidated = $request->validated();

        $account = AccountService::updateAccount($id, $dataValidated);

        if ($account) {
            return new AccountResource($account);
        } else {
            return response()->json(['message' => 'Failed to update account'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $isDeleted = AccountService::deleteAccount($id);

        if ($isDeleted) {
            return response()->json(['message' => 'Account deleted']);
        } else {
            return response()->json(['message' => 'Failed to delete account'], 500);
        }
    }
}
