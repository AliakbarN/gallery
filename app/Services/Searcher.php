<?php

namespace App\Services;

use App\Helpers\Date;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use InvalidArgumentException;
use Spatie\Searchable\ModelSearchAspect;
use Spatie\Searchable\Search;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Spatie\Searchable\SearchResultCollection;

class Searcher
{
    private ?string $model;
    private ?array $targets;
    private ?int $limit;
    private ?string $dateFrom;
    private ?string $dateTo;


    public function __construct(string $model = null, ?array $targets = null, ?int $limit = null, ?string $dateFrom = null, ?string $dateTo = null)
    {
        $this->model = $model;
        $this->targets = $targets;
        $this->limit = $limit;
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
    }

    public function search(mixed $needle): Collection
    {
        if ($needle === null) {
            $data = $this->model::all();

            return $this->filterByDate($data);
        }

        $search = new Search();
        $targets = $this->getTargets();
        $limit = $this->limit;

        $search->registerModel($this->model, function (ModelSearchAspect $aspect) use ($targets, $limit)
        {
            foreach ($targets as $target)
            {
                $aspect->addSearchableAttribute($target);
            }

            if ($limit !== null) {
                $aspect->limit($this->limit);
            }
        });

        $filtered = self::toCollection($search->search($needle));

        if ($this->dateFrom !== null || $this->dateTo !== null) {
            $filtered = $this->filterByDate($filtered);
        }

        return $filtered;
    }

    protected function filterByDate(Collection $collection): ?Collection
    {
        $dateFrom = $this->dateFrom;
        $dateTo = $this->dateTo;

        if ($dateFrom === null) {
            $dateFrom = Date::addOneDay($dateTo);
        } else if ($dateTo === null) {
            $dateTo = Date::addOneDay($this->dateFrom);
        }

        return $collection->whereBetween('created_at', [$dateFrom, $dateTo]);
    }

    public function setTargets(?array $targets): self
    {
        $this->targets = $targets;

        return $this;
    }

    protected function getTargets(): array
    {
        if ($this->targets !== null) {
            return $this->targets;
        }

        return Schema::getColumns((new ($this->model)())->getTable());
    }

    public function setModel(string $model): self
    {
        if (!$this->validateModel($model)) {
            throw new InvalidArgumentException('The class - ' . $model . ' should be a model and implement ' . Searchable::class);
        }

        $this->model = $model;

        return $this;
    }

    protected function validateModel(string $model): bool
    {
        if (is_subclass_of($model, Model::class) && in_array(Searchable::class, class_implements($model))) {
            return true;
        }

        return false;
    }

    public function setLimit(?int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }

    public function setDates(?string $from, ?string $to): self
    {
        $this->dateFrom = $from;
        $this->dateTo = $to;

        return $this;
    }

    public static function toCollection(SearchResultCollection $searchResult): Collection
    {
        $formRes = [];

        foreach ($searchResult as $searchItem)
        {
            $formRes[] = $searchItem->searchable;
        }

        return new Collection($formRes);
    }
}
