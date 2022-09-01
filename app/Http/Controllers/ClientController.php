<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\ClientContract;
use App\Http\Controllers\BaseController;

class ClientController extends BaseController
{
    protected $clientRepository;

    public function __construct(ClientContract $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function index()
    {
        $clients = $this->clientRepository->listClients();

        $this->setPageTitle('Clients', 'List of all clients / Schools');
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        //$categories = $this->categoryRepository->listCategories('id', 'asc');
       // $clients = $this->categoryRepository->treeList();

        $this->setPageTitle('Clients', 'Create new Client');
        return view('clients.create');
    }

    public function store(Request $request)
    {
       $this->validate($request, [
        'client_name'      =>  'required|max:191',
        'email' =>  'required|max:191',
        'phone'     =>  'required|max:191'
       ]);

      $params = $request->except('_token');

      $client = $this->clientRepository->createClient($params);

      if (!$client) {
        return $this->responseRedirectBack('Error occurred while creating category.', 'error', true, true);
      }
      return $this->responseRedirect('clients.index', 'Category added successfully' ,'success',false, false);
    }

    public function edit($id)
    {
        $client = $this->clientRepository->findClientById($id);
    
        $this->setPageTitle('Clients / Schools', 'Edit Client : '.$client->client_name);
        return view('clients.edit', compact('client'));
    }
}
