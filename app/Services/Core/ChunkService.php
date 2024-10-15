<?php

namespace App\Services\Core;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

class ChunkService
{
    public function chunkById(Builder $query, int $count, callable $callback, string $column = 'id'): void
    {
        $lastId = 0;
        do {
            $collection = $this->getChunkResults($lastId, $count, $query, $column);

            if (0 >= $collection->count()) {
                break;
            }

            $return = $callback($collection);

            if ($return === false) {
                break;
            }

            $lastId += $count;

        } while (true);

    }

    protected function getChunkResults($lastId, $count, Builder $query, string $column = 'id'): Collection
    {
        return $query->where($column, '>', $lastId)->limit($count)->get();
    }

}
