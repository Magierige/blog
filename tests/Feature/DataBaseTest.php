<?php

namespace Tests\Feature;

use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class DataBaseTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test om te controleren of er een database is.
     *
     * @return void
     */
    public function test_database()
    {
        try {
            DB::connection()->getPDO();
            $data = true;
         } catch (Exception $e) {
            $data;
         }
        $this->assertTrue($data);
    }
}
