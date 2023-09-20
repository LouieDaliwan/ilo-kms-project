<?php

namespace Domain\Users\Actions;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\QueryBuilder;

class UsersListActions
{
    protected string $model = User::class;

    public function __invoke($args = [])
    {
        $model = QueryBuilder::for($this->model)
            ->allowedFilters(['first_name', 'last_name', 'email'])
            ->paginate($this->getPerPage())
            ->appends(request()->query());

        $sorted = $this->sortAndOrder($model);

        return new LengthAwarePaginator($sorted, $model->total(), $model->perPage());
    }

    /**
     * Retrieve the items per page value.
     *
     * @return mixed
     */
    protected function getPerPage(): ?int
    {
        $perPage = request()->get('itemsPerPage') == '-1' ? 'all' : request()->get('itemsPerPage');

        return strtolower($perPage) === 'all'
            ? count($this->model->get())
            : (int) $perPage;
    }

    public function sortAndOrder($model = null)
    {
        return $this->isFilteredOrderKeyAscending() ? $model->sortBy($this->getFilteredSortKey()) : $model->sortByDesc($this->getFilteredSortKey());
    }

    /**
     * Check if the filted sort key is ascending.
     */
    protected function isFilteredOrderKeyAscending(): bool
    {
        return $this->getFilteredOrderKey() == 'asc';
    }

    /**
     * Retrieve the order key from url.
     */
    protected function getFilteredOrderKey(): string
    {
        return request()->get('order') ?? 'asc';
    }

    /**
     * Retrieve the sort key from url parameter
     * and check if it exists as attribute or column.
     *
     * @param  string|null  $default
     */
    protected function getFilteredSortKey($default = 'id'): string
    {
        return request()->get('sort') ?? $default;
    }
}
