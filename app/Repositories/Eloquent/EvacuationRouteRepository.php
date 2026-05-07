<?php

namespace App\Repositories\Eloquent;

use App\Models\EvacuationRoute;
use App\Repositories\Contracts\EvacuationRouteRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EvacuationRouteRepository implements EvacuationRouteRepositoryInterface
{
    public function paginateForIndex(array $filters = []): LengthAwarePaginator
    {
        // TODO: apply search, filter, sort, and authorization scope.
        return EvacuationRoute::query()->latest('id')->paginate($filters['per_page'] ?? 15);
    }

    public function findById(int $id): ?object
    {
        // TODO: eager-load relations needed by detail pages.
        return EvacuationRoute::query()->find($id);
    }

    public function createDraft(array $payload): object
    {
        // TODO: validate business rules in service before create.
        return EvacuationRoute::query()->create($payload);
    }

    public function updateDraft(int $id, array $payload): object
    {
        $model = EvacuationRoute::query()->findOrFail($id);
        $model->fill($payload);
        $model->save();

        return $model;
    }

    public function deleteDraft(int $id): void
    {
        // TODO: replace hard delete with soft delete if required.
        EvacuationRoute::query()->findOrFail($id)->delete();
    }
}
