<?php

namespace SpiritSystems\DayByDay\Contacts\Http\Controllers;

use App\Models\Client;
use App\Models\Contact;
use Ramsey\Uuid\Uuid;
use SpiritSystems\DayByDay\Contacts\Http\Requests\Contacts\StoreContactRequest;
use SpiritSystems\DayByDay\Contacts\Http\Requests\Contacts\UpdateContactRequest;
use SpiritSystems\DayByDay\Core\Http\Controllers\DayByDayController;
use Yajra\DataTables\Facades\DataTables;

class ContactsController extends DayByDayController
{
    public function index()
    {
        return view('contacts.index', [
            'dataRoute' => route('contacts.data'),
        ]);
    }

    public function createClientContact($clientId)
    {
        $client = Client::where('external_id', $clientId)->firstOrFail();

        return view('contacts.create', ['lockedClient' => $client]);
    }

    public function create($clientId)
    {
        return $clientId;
    }

    public function show($contact)
    {
        $contact = Contact::where('external_id', $contact)->firstOrFail();

        return view('contacts.edit', ['contact' =>$contact]);
    }

    public function store(StoreContactRequest $request)
    {
        $client = Client::findOrFail($request->client_id);

        $contact = Contact::create([
            'external_id' => Uuid::uuid4()->toString(),
            'name' => $request->name,
            'email' => $request->email,
            'primary_number' => $request->primary_number,
            'secondary_number' => $request->secondary_number,
            'client_id' => $request->client_id,
        ]);

        Session()->flash('flash_message', __('Contact successfully added'));
        return redirect()->route('clients.show', $client->external_id);
    }

    public function update($contact, UpdateContactRequest $request)
    {
        $client = Client::findOrFail($request->client_id);
        $contact = Contact::where('external_id',$contact)->firstOrFail();
        $contact->fill([
            'external_id' => Uuid::uuid4()->toString(),
            'name' => $request->name,
            'email' => $request->email,
            'primary_number' => $request->primary_number,
            'secondary_number' => $request->secondary_number,
            'client_id' => $request->client_id,
        ])->save();        
        Session()->flash('flash_message', __('Contact successfully updated'));
        return redirect()->route('clients.show', $client->external_id);
    }

    public function destroy()
    {
    }

    public function clientData($clientId)
    {
        $clients = Contact::select([
            'contacts.external_id',
            'contacts.name',
            'contacts.email',
            'contacts.primary_number',
            'clients.external_id as clients_id',
            'clients.company_name',
        ])->join('clients', 'contacts.client_id', 'clients.id')->where('clients.external_id', $clientId);

        $data = DataTables::of($clients)
            ->addColumn('companynamelink', function ($clients) {
                return '<a href="/clients/'.$clients->clients_id.'">'.$clients->company_name.'</a>';
            })
            ->addColumn('namelink', function ($clients) {
                return '<a href="/contacts/'.$clients->external_id.'" ">'.$clients->name.'</a>';
            })
            ->addColumn('view', '
                <a href="{{ route(\'clients.show\', $external_id) }}" class="btn btn-link" >'.__('View').'</a>')
            ->addColumn('edit', '
                <a href="{{ route(\'clients.edit\', $external_id) }}" class="btn btn-link" >'.__('Edit').'</a>')
            ->addColumn('delete', '
                <form action="{{ route(\'clients.destroy\', $external_id) }}" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <input type="submit" name="submit" value="'.__('Delete').'" class="btn btn-link" onClick="return confirm(\'Are you sure? All the clients tasks, leads, projects, etc will be deleted as well\')"">
            {{csrf_field()}}
            </form>')
            ->rawColumns(['namelink', 'companynamelink', 'view', 'edit', 'delete'])
            ->make(true);

        return $data;
    }

    /**
     * Make json respnse for datatables.
     * @return mixed
     */
    public function anyData()
    {
        $clients = Contact::select([
            'contacts.external_id',
            'contacts.name',
            'contacts.email',
            'contacts.primary_number',
            'clients.external_id as clients_id',
            'clients.company_name',
        ])->join('clients', 'contacts.client_id', 'clients.id');

        $data = DataTables::of($clients)
            ->addColumn('companynamelink', function ($clients) {
                return '<a href="/clients/'.$clients->clients_id.'">'.$clients->company_name.'</a>';
            })
            ->addColumn('namelink', function ($clients) {
                return '<a href="/clients/'.$clients->external_id.'" ">'.$clients->name.'</a>';
            })
            ->addColumn('view', '
                <a href="{{ route(\'clients.show\', $external_id) }}" class="btn btn-link" >'.__('View').'</a>')
            ->addColumn('edit', '
                <a href="{{ route(\'clients.edit\', $external_id) }}" class="btn btn-link" >'.__('Edit').'</a>')
            ->addColumn('delete', '
                <form action="{{ route(\'clients.destroy\', $external_id) }}" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <input type="submit" name="submit" value="'.__('Delete').'" class="btn btn-link" onClick="return confirm(\'Are you sure? All the clients tasks, leads, projects, etc will be deleted as well\')"">
            {{csrf_field()}}
            </form>')
            ->rawColumns(['namelink', 'companynamelink', 'view', 'edit', 'delete'])
            ->make(true);

        return $data;
    }
}
