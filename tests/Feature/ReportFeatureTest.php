<?php

namespace Tests\Feature;

use App\Models\Dosage;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tymon\JWTAuth\Facades\JWTAuth;

class ReportFeatureTest extends TestCase
{
    use RefreshDatabase;

    private $token;

    protected function setUp(): void
    {
        parent::setUp();

        // configure the jwt and refresh expires to only 1 minute because it's a test.
        config(['jwt.ttl' => 1, 'refresh_ttl' => 1]);

        // create a user
        $user = factory(User::class)->create();

        // generate a JWT Token from user inserted in DB and save in $token property
        $this->token = JWTAuth::fromUser($user);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_can_generate_dosage_report()
    {
        // create 10 dosage
        factory(Dosage::class, 10)->create();

        $response = $this->get('/api/reports/dosage-report', ['Authorization' => 'Bearer ' . $this->token]);

        $response->assertOk();
    }

}
