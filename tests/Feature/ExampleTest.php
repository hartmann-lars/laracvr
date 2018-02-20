<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CvrFeatureTest extends TestCase
{
    protected $cvr = 37361798;

    /**
     * Basic cvr lookup
     * @return assertStatus 200
     */
    public function testShowCvr()
    {
        $response = $this->get('/show/'.$this->cvr);

        $response->assertStatus(200);
    }
}
