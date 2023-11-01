<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Schema;

class ReactionTest extends TestCase
{
    
    use RefreshDatabase;
    /** @test */
    public function reactions_table_exists()
    {
        $this->assertTrue(Schema::hasTable('reactions'));
    }
}
