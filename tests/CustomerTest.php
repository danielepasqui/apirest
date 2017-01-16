<?php


class CustomerTest extends TestCase
{
    /**
     * A basic test example.
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
                        'notes',
                    ],
                ],
            ]);
    }
}
