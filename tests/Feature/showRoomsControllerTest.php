<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class showRoomsControllerTest extends TestCase
{

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/rooms');
        
        $response->assertStatus(200)
                ->assertSeeText('Type')
                ->assertViewIs('rooms.index')
                ->assertViewHas('rooms');
    }

    public function testRoomParameter()
    {
        $roomTypes = factory('App\RoomTypes' , 3)->create();
        $rooms = factory('App\Room' , 20)->create();
        $roomType = $roomTypes->random();

        $response = $this->get('rooms/' , $roomType->id);

        $response->assertStatus(200)
        ->assertSeeText('Type')
        ->assertViewIs('rooms.index')
        ->assertViewHas('rooms');
    }
}
