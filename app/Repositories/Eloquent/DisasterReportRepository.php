<?php

namespace App\Repositories\Eloquent;

use App\Models\DisasterReport;
use App\Repositories\Contracts\DisasterReportRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class DisasterReportRepository implements DisasterReportRepositoryInterface
{
    public function paginateForIndex(array $filters = []): LengthAwarePaginator
    {
        // TODO: apply search, filter, sort, and authorization scope.
        return DisasterReport::query()->latest('id')->paginate($filters['per_page'] ?? 15);
    }

    public function findById(int $id): ?object
    {
        // TODO: eager-load relations needed by detail pages.
        return DisasterReport::query()->find($id);
    }

    public function createDraft(array $payload): object
    {
        // TODO: validate business rules in service before create.
        return DisasterReport::query()->create($payload);
    }

    public function updateDraft(int $id, array $payload): object
    {
        $model = DisasterReport::query()->findOrFail($id);
        $model->fill($payload);
        $model->save();

        return $model;
    }

    public function deleteDraft(int $id): void
    {
        // TODO: replace hard delete with soft delete if required.
        DisasterReport::query()->findOrFail($id)->delete();
    }
}
