<?php

namespace Tests\Feature;

use App\Models\Activity;
use Tests\TestCase;

class ActivityTest extends TestCase
{
    /**
     * Test content of the activity.
     *
     * @return void
     */
    public function testActivityContent()
    {
        $activity = new Activity();
        $activity->title = 'testTitle';
        $activity->description = 'testDescription';
        $activity->location = 'testLocation';
        $activity->date = '2021-12-12';
        $activity->association_id = '1';

        $this->assertEquals($activity->title, 'testTitle');
        $this->assertEquals($activity->description, 'testDescription');
        $this->assertEquals($activity->location, 'testLocation');
        $this->assertEquals($activity->date, '2021-12-12');
        $this->assertEquals($activity->association_id, '1');
    }
}
