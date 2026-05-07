<?php

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface EvacuationRouteRepositoryInterface
{
    public function paginateForIndex(array $filters = []): LengthAwarePaginator;

    public function findById(int $id): ?object;

    public function createDraft(array $payload): object;

    public function updateDraft(int $id, array $payload): object;

    public function deleteDraft(int $id): void;
}
