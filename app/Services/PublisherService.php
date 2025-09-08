<?php

namespace App\Services;

use App\Models\Publisher;

class PublisherService
{
    public function getPublishers($limit, $search = null)
    {
        $filters = ['search' => $search];
        return Publisher::filter($filters)->published()->latest()->limit($limit)->get();
    }

}
