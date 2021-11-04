<?php

namespace Coderjerk\BirdElephant\Compliance;

use Coderjerk\BirdElephant\Request;

/**
 * Endpoints to help maintain Twitter data in compliance
 * with the Twitter Developer Agreement and Policy.
 *
 */
class BatchCompliance
{
    /**
     * The endpoint
     *
     * @var string
     */
    public $uri = 'compliance/jobs';


    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * Creates a new compliance job for Tweet IDs or user IDs
     *
     * @param string $type 'tweets' | 'users
     * @param string $name
     * @param boolean $resumable
     * @return object
     */
    public function createComplianceJob($type, $name, $resumable = false)
    {
        $params = [
            'type' => $type,
            'name' => $name,
            'resumable' => $resumable
        ];

        $request = new Request($this->credentials);

        return $request->bearerTokenRequest('POST', $this->uri, null, $params, false);
    }

    /**
     * Gets a single compliance job by ID.
     *
     * @param string $id
     * @return object
     */
    public function getComplianceJob($id)
    {
        $request = new Request($this->credentials);

        return $request->bearerTokenRequest('GET', $this->uri . '/' . $id, null, null, false);
    }

    /**
     * Gets a list of compliance jobs of a given type
     *
     * @param string $type 'tweets' | 'users'
     * @return object
     */
    public function getComplianceJobs($type)
    {
        $params = [
            'type' => $type,
        ];

        $request = new Request($this->credentials);

        return $request->bearerTokenRequest('GET', $this->uri, $params, null, false);
    }
}
