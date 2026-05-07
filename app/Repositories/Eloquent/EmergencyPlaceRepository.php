<?php

namespace App\Repositories\Eloquent;

use App\Models\EmergencyPlace;
use App\Repositories\Contracts\EmergencyPlaceRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EmergencyPlaceRepository implements EmergencyPlaceRepositoryInterface
{
    public function paginateForIndex(array $filters = []): LengthAwarePaginator
    {
        // TODO: apply search, filter, sort, and authorization scope.
        return EmergencyPlace::query()->latest('id')->paginate($filters['per_page'] ?? 15);
    }

    public function findById(int $id): ?object
    {
        // TODO: eager-load relations needed by detail pages.
        return EmergencyPlace::query()->find($id);
    }

    public function createDraft(array $payload): object
    {
        // TODO: validate business rules in service before create.
        return EmergencyPlace::query()->create($payload);
    }

    public function updateDraft(int $id, array $payload): object
    {
        $model = EmergencyPlace::query()->findOrFail($id);
        $model->fill($payload);
        $model->save();

        return $model;
    }

    public function deleteDraft(int $id): void
    {
        // TODO: replace hard delete with soft delete if required.
        EmergencyPlace::query()->findOrFail($id)->delete();
    }
}
