<?php

namespace App\Livewire;

use App\Livewire\Forms\ProductFilterForm;
use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
class ProductIndex extends Component
{
    use WithPagination;

    public ProductFilterForm $filters;

    #[Url(as: 'search')]
    public string $search = '';

    #[Url(as: 'min_price')]
    public string $minPrice = '';

    #[Url(as: 'max_price')]
    public string $maxPrice = '';

    #[Url(as: 'sort')]
    public string $sortBy = 'sort_order';

    #[Url(as: 'direction')]
    public string $sortDirection = 'asc';

    public bool $showInactive = false;

    // Combined sort option for select dropdown
    public string $sortOption = 'sort_order-asc';

    public bool $isLoading = false;

    public function mount(): void
    {
        // Initialize form with URL parameters
        $this->filters->search = $this->search;
        $this->filters->minPrice = $this->minPrice;
        $this->filters->maxPrice = $this->maxPrice;
        $this->filters->sortBy = $this->sortBy;
        $this->filters->sortDirection = $this->sortDirection;
        $this->filters->showInactive = $this->showInactive;

        // Initialize combined sort option
        $this->sortOption = $this->sortBy.'-'.$this->sortDirection;
    }

    public function updated($property): void
    {
        if (in_array($property, ['search', 'minPrice', 'maxPrice', 'sortBy', 'sortDirection', 'showInactive', 'sortOption'])) {
            $this->syncUrlWithFilters();
            $this->resetPage();
        }
    }

    public function updatingSearch($value): void
    {
        $this->isLoading = true;
        $this->filters->search = $value;
        $this->resetPage();
    }

    public function updatingMinPrice($value): void
    {
        $this->isLoading = true;
        $this->filters->minPrice = $value;
        $this->resetPage();
    }

    public function updatingMaxPrice($value): void
    {
        $this->isLoading = true;
        $this->filters->maxPrice = $value;
        $this->resetPage();
    }

    public function updatingSortBy($value): void
    {
        $this->filters->sortBy = $value;
        $this->resetPage();
    }

    public function updatingSortOption($value): void
    {
        if (is_string($value) && str_contains($value, '-')) {
            [$field, $direction] = explode('-', $value, 2);
            $this->setSortBy($field, $direction);
        }
    }

    public function clearFilters(): void
    {
        $this->filters->clear();
        $this->syncUrlWithFilters();
        $this->resetPage();
    }

    public function setSortBy(string $field, string $direction = 'asc'): void
    {
        $this->filters->sortBy = $field;
        $this->filters->sortDirection = $direction;
        $this->sortBy = $field;
        $this->sortDirection = $direction;
        $this->resetPage();
    }

    public function setPriceRange(string $min = '', string $max = ''): void
    {
        $this->filters->minPrice = $min;
        $this->filters->maxPrice = $max;
        $this->syncUrlWithFilters();
        $this->resetPage();
    }

    private function syncUrlWithFilters(): void
    {
        $this->search = $this->filters->search;
        $this->minPrice = $this->filters->minPrice;
        $this->maxPrice = $this->filters->maxPrice;
        $this->sortBy = $this->filters->sortBy;
        $this->sortDirection = $this->filters->sortDirection;
        $this->showInactive = $this->filters->showInactive;
    }

    #[Computed(cache: true, key: 'price-stats')]
    public function priceStats(): object
    {
        return Product::getCachedPriceStats();
    }

    #[Computed]
    public function products(): LengthAwarePaginator
    {
        $this->filters->validate();

        // Add a small delay to make loading states visible for fast queries
        if (config('app.debug')) {
            usleep(300000); // 300ms delay in development
        }

        $query = Product::query();

        // Apply search filter with proper escaping
        if ($searchTerm = $this->filters->getSearchQuery()) {
            $searchTerm = '%'.str_replace(['%', '_'], ['\%', '\_'], $searchTerm).'%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name_ar', 'like', $searchTerm)
                    ->orWhere('description_ar', 'like', $searchTerm)
                    ->orWhere('ingredients_ar', 'like', $searchTerm);
            });
        }

        // Apply price filters
        if ($minPrice = $this->filters->getMinPriceValue()) {
            $query->where('price', '>=', $minPrice);
        }

        if ($maxPrice = $this->filters->getMaxPriceValue()) {
            $query->where('price', '<=', $maxPrice);
        }

        // Apply active filter
        if (! $this->filters->showInactive) {
            $query->where('is_active', true);
        }

        // Apply sorting
        $query->orderBy($this->filters->sortBy, $this->filters->sortDirection);

        $result = $query->paginate(12);

        // Reset loading state after query completes
        $this->isLoading = false;

        return $result;
    }

    public function render()
    {
        return view('livewire.product-index', [
            'products' => $this->products,
            'totalProducts' => $this->priceStats->total_count ?? 0,
            'minPriceAvailable' => $this->priceStats->min_price ?? 0,
            'maxPriceAvailable' => $this->priceStats->max_price ?? 100,
        ]);
    }
}
