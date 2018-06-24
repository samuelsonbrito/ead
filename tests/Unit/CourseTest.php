<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Sale;

class CourseTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testListMyCourse()
    {
        $data = [];
        $sales = [];

        $sale = new Sale();
        $sales = $sale->getResults($data);

        //$this->assertJson($sales);

        //dd($sales);
    }

}
