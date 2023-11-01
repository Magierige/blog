<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Schema;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function categories_table_exists(): void
    {
        $this->assertTrue(Schema::hasTable('categories'));
    }
}
