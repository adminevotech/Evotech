<?php

namespace App\Services;

use App\Constants\Media_Collections;
use App\Models\Client;

class ClientService
{
    public function createClient($request)
    {
        $client = Client::create($request->validated());
        add_media_item($client, $request->photo, Media_Collections::CLIENT);

    }

    public function updateClient($request, $client)
    {
        $client->update($request->validated());
        add_media_item($client, $request->photo, Media_Collections::CLIENT);
    }
}
