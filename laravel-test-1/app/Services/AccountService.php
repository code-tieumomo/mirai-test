<?php

namespace App\Services;

use App\Models\Account;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class AccountService
{
    /**
     * Get an account by id
     *
     * @param  int  $id
     * @return bool|Account
     */
    public static function getAccountById(int $id): bool|Account
    {
        try {
            Log::channel('api')->info('Request to account', [
                'ip' => request()->ip(),
                'id' => $id,
            ]);

            return Account::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Log::channel('api_error')->error('Failed to get account', [
                'ip'   => request()->ip(),
                'id'   => $id,
                'data' => $e->getMessage(),
            ]);

            return false;
        }
    }

    /**
     * Create new account
     *
     * @param  array  $data
     * @return bool|Account
     */
    public static function createNewAccount(array $data): bool|Account
    {
        $account = Account::create([
            'login'    => $data['login'],
            'password' => md5($data['password']),
            'phone'    => $data['phone'],
        ]);

        if ($account) {
            Log::channel('api')->info('Created account', [
                'ip'   => request()->ip(),
                'data' => $data,
            ]);

            return $account;
        }

        Log::channel('api_error')->error('Failed to create account', [
            'ip'   => request()->ip(),
            'data' => $data,
        ]);

        return false;
    }

    /**
     * Delete an account by id
     *
     * @param  string  $id
     * @return bool
     */
    public static function deleteAccount(string $id): bool
    {
        try {
            $account = Account::findOrFail($id);

            if ($account->delete()) {
                Log::channel('api')->info('Deleted account', [
                    'ip' => request()->ip(),
                    'id' => $id,
                ]);

                return true;
            }
        } catch (Exception $e) {
            Log::channel('api_error')->error('Failed to delete account', [
                'ip'   => request()->ip(),
                'id'   => $id,
                'data' => $e->getMessage(),
            ]);

            return false;
        }

        return false;
    }

    /**
     * Update an account by id
     *
     * @param  string  $id
     * @param  mixed   $dataValidated
     * @return bool|Account
     */
    public static function updateAccount(string $id, mixed $dataValidated): bool|Account
    {
        try {
            $account = Account::findOrFail($id);

            if ($account->update($dataValidated)) {
                Log::channel('api')->info('Updated account', [
                    'ip'   => request()->ip(),
                    'id'   => $id,
                    'data' => $dataValidated,
                ]);

                return $account;
            }
        } catch (Exception $e) {
            Log::channel('api_error')->error('Failed to update account', [
                'ip'   => request()->ip(),
                'id'   => $id,
                'data' => $e->getMessage(),
            ]);

            return false;
        }

        return false;
    }
}
