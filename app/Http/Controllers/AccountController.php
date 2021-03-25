<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Account;
use App\Jobs\SendEmail;

class AccountController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => ['required', 'email'],
            'name' => ['required', 'string', 'alpha'],
            'surname' => ['required', 'string', 'alpha']
        ]);

        $new_account = Account::create($validatedData);

        SendEmail::dispatch($new_account);

        return redirect()->route('home');
    }
}
