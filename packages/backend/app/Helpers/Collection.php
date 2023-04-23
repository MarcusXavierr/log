<?php

use Illuminate\Support\Collection;

if (! function_exists('create_random_subcollections')) {
    /**
     * This function takes a collection of type X and returns a new collection containing Y subcollections of type X,
     * where each subcollection is a subset of elements from the original collection.
     */
    function create_random_subcollections(Collection $collection, int $newCollectionSize): Collection
    {
        if ($newCollectionSize < 1 || $collection->count() < 1) {
            return collect();
        }

        $randomSubCollectionSize = rand(1, $collection->count());
        $subcollection = $collection->random($randomSubCollectionSize);

        return create_random_subcollections($collection, $newCollectionSize - 1)->prepend($subcollection);
    }
}
