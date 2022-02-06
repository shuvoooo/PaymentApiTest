<?php

namespace App\Http\Controllers;

use HubSpot\Client\Crm\Contacts\ApiException;
use HubSpot\Client\Crm\Contacts\Model\SimplePublicObjectInput;
use HubSpot\Discovery\Discovery;
use HubSpot\Factory;
use Illuminate\Http\Request;


class HubSpotController extends Controller
{
    private function HubspotFactory(): Discovery
    {
        return Factory::createWithApiKey(env('HUBSPOT_API_KEY'));
    }

    public function index()
    {
        $client = $this->HubspotFactory();

        $contactList = $client->crm()->contacts()->basicApi()->getPage(100, null, null, null, false);

        $contacts = $contactList->getResults();

        return view('hubspot.index', compact('contacts'));
    }

    public function create()
    {
        return view('hubspot.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            "company" => "required",
            "email" => "required",
            "firstname" => "required",
            "lastname" => "required",
            "phone" => "required"
        ]);

        $client = $this->HubspotFactory();

        $properties = [
            "email" => $request->email,
            "firstname" => $request->firstname,
            "lastname" => $request->lastname,
            "phone" => $request->phone,
            "company" => $request->company
        ];

        $SimplePublicObjectInput = new SimplePublicObjectInput(['properties' => $properties]);


        try {
            $apiResponse = $client->crm()->contacts()->basicApi()->create($SimplePublicObjectInput);

            return redirect()->route('hubspot.index')->with('success', 'Contact created successfully');
        } catch (ApiException $e) {
            echo "Exception when calling basic_api->create: ", $e->getMessage();
        }
    }


    public function show($id)
    {
        $contact = $this->HubspotFactory()->crm()->contacts()->basicApi()->getById($id);
        dd($contact);
    }


    public function edit($id)
    {
        $contact = $this->HubspotFactory()->crm()->contacts()->basicApi()->getById($id);

        $contact = $contact->getProperties();

        return view('hubspot.edit', compact('contact'));

    }


    public function update(Request $request, $id)
    {
        $request->validate([
            "company" => "required",
            "email" => "required",
            "firstname" => "required",
            "lastname" => "required",
            "phone" => "required"
        ]);

        $client = $this->HubspotFactory();

        $properties = [
            "email" => $request->email,
            "firstname" => $request->firstname,
            "lastname" => $request->lastname,
            "phone" => $request->phone,
            "company" => $request->company
        ];

        $SimplePublicObjectInput = new SimplePublicObjectInput(['properties' => $properties]);


        try {
            $apiResponse = $client->crm()->contacts()->basicApi()->update($id, $SimplePublicObjectInput);

            return redirect()->route('hubspot.index')->with('success', 'Contact updated successfully');
        } catch (ApiException $e) {
            echo "Exception when calling basic_api->update: ", $e->getMessage();
        }
    }

    public function destroy($id)
    {
        $client = $this->HubspotFactory();

        try {
            $apiResponse = $client->crm()->contacts()->basicApi()->archive($id);

            return redirect()->route('hubspot.index')->with('success', 'Contact deleted successfully');
        } catch (ApiException $e) {
            echo "Exception when calling basic_api->delete: ", $e->getMessage();
        }
    }

}
