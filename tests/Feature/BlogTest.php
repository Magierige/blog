<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Schema;

class BlogTest extends TestCase
{
    
    use RefreshDatabase;
    /** @test */
    public function blogs_table_exists(): void
    {
        
        $this->assertTrue(Schema::hasTable('blogs'));
    }
}
