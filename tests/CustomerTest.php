<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CustomerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->get('/api/v1/customers')
            ->seeJsonStructure([
                'customers' => [
                    '*' => [
                        'id',
                        'name',
                        'support_queue',
                        'active',
                        'notes'
                    ]
                ]
            ]);
    }
}
