<?php

namespace Tests\Unit\Helpers;

use Illuminate\Support\Collection;
use Tests\TestCase;

class CollectionTest extends TestCase
{
    public function test_create_random_subcollections()
    {
        $maxCollectionSize = 15;

        $collection = collect(range(1, $maxCollectionSize));
        $newCollection = create_random_subcollections($collection, 4);
        $this->assertCount(4, $newCollection);
        $this->assertEquals(Collection::class, get_class($newCollection));

        $newCollection->each(function($collection) use($maxCollectionSize) {
            $this->assertLessThanOrEqual($maxCollectionSize, $collection->count());
            // All itens on a subcollection should be unique
            $this->assertEquals($collection->count(), count(array_unique($collection->toArray())));
            $this->assertGreaterThanOrEqual(1, $collection->count());
        });
    }

    public function test_create_random_subcollections_with_empty_collection()
    {
        $result = create_random_subcollections(collect(), 10);
        $this->assertCount(0, $result);
    }
}
