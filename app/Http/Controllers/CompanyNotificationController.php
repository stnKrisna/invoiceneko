<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Company;
use App\Models\DatabaseConfig;

class CompanyNotificationController extends Controller
{
    public function edit(Company $company)
    {
        $notifConfigs = [
            'weeklyInvoice' => 7,
            'monthlyInvoice' => 7,
            'yearlyInvoice' => 30,
            'notifRecipientAddress' => '',
        ];

        $storedKeyVal = DatabaseConfig::whereIn('key', [
            'weeklyInvoice',
            'monthlyInvoice',
            'yearlyInvoice',
            'notifRecipientAddress',
        ])->get();

        // Load stored result if it exists
        if ($storedKeyVal->count() != 0) {
            foreach ($storedKeyVal as $stored) {
                $notifConfigs[$stored->key] = $stored->value;
            }
        }

        return view('pages.company.notification.edit', ['company' => $company, 'notifConfigs' => $notifConfigs]);
    }

    public function store(Request $request, Company $company)
    {
        $allowedKey = ['weeklyInvoice', 'monthlyInvoice', 'yearlyInvoice', 'notifRecipientAddress'];

        foreach ($request->post() as $key => $value) {
            if (in_array($key, $allowedKey) && $value != null) {
                DatabaseConfig::updateOrCreate(
                    [
                        'key' => $key,
                        'company_id' => $company->id,
                    ],
                    [
                        'value' => $key != 'notifRecipientAddress' ? (int) $value : $value,
                    ],
                );
            }
        }

        return redirect()->route('company.notification.edit', ['company' => $company]);
    }
}
