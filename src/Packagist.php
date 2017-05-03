<?php

namespace Statagist;

use Spatie\Packagist\Packagist as p;

class Packagist extends p
{
    /**
     * @param string $resource
     * @param array  $query
     *
     * @return array
     */
    public function makeRequest($resource, array $query = [])
    {
        $query['ts'] = time();
        $packages = $this->client
            ->get("{$this->baseUrl}{$resource}", compact('query'))
            ->getBody()
            ->getContents();

        return json_decode($packages, true);
    }
}
