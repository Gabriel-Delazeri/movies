<?php

namespace Tests\Feature\App\Http\Controllers;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class MovieControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function test_is_working()
    {
        $response = $this->get('/');

        $response->assertViewIs('movies.index');
    }
}
