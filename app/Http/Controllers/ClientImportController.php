<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateClientRequest;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Company;
use App\Models\Recipient;
use Illuminate\Http\UploadedFile;

class ClientImportController extends Controller
{
    /**
     * Display client import form
     * @param Company $company
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Company $company)
    {
        return view('pages.client.import');
    }

    /**
     * Store list of clients
     * @param CreateClientRequest $request
     * @param Company $company
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Company $company)
    {
        $validated = $request->validate([
            'clientImport' => 'file|required|mimes:csv,txt|max:10240',
        ]);

        $this->storeImportFile($request->file('clientImport'), $company->id);

        flash('Client Created', 'success');

        return redirect()->route('client.index', ['company' => $company]);
    }

    private function storeImportFile(UploadedFile $file, $companyId)
    {
        $csv = array_map('str_getcsv', file($file->getRealPath()));
        array_walk($csv, function (&$a) use ($csv) {
            $a = array_combine($csv[0], $a);
        });
        array_shift($csv);

        foreach ($csv as $row) {
            $client = new Client();
            $client->company_id = $companyId;

            foreach ($client->getFillable() as $clientProperty) {
                $client[$clientProperty] = $row[$clientProperty] ?? '';
            }

            $client->save();

            $recipient = new Recipient();
            $recipient->salutation = $client->contactsalutation;
            $recipient->first_name = $client->contactfirstname;
            $recipient->last_name = $client->contactlastname;
            $recipient->email = $client->contactemail;
            $recipient->phone = $client->contactphone;
            $recipient->company_id = $client->company_id;
            $client->recipients()->save($recipient);
        }
    }
}
