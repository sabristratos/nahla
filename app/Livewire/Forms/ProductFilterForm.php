<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class ProductFilterForm extends Form
{
    #[Validate('nullable|string|max:100')]
    public string $search = '';

    #[Validate('nullable|numeric|min:0|max:9999')]
    public string $minPrice = '';

    #[Validate('nullable|numeric|min:0|max:9999')]
    public string $maxPrice = '';

    #[Validate('in:sort_order,name_ar,price,created_at')]
    public string $sortBy = 'sort_order';

    #[Validate('in:asc,desc')]
    public string $sortDirection = 'asc';

    public bool $showInactive = false;

    public function rules(): array
    {
        return [
            'search' => 'nullable|string|max:100',
            'minPrice' => 'nullable|numeric|min:0|max:9999|lt:maxPrice',
            'maxPrice' => 'nullable|numeric|min:0|max:9999|gt:minPrice',
            'sortBy' => 'in:sort_order,name_ar,price,created_at',
            'sortDirection' => 'in:asc,desc',
            'showInactive' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'search.max' => 'البحث لا يمكن أن يتجاوز 100 حرف',
            'minPrice.numeric' => 'السعر الأدنى يجب أن يكون رقم',
            'minPrice.min' => 'السعر الأدنى لا يمكن أن يكون أقل من 0',
            'minPrice.max' => 'السعر الأدنى لا يمكن أن يتجاوز 9999',
            'minPrice.lt' => 'السعر الأدنى يجب أن يكون أقل من السعر الأعلى',
            'maxPrice.numeric' => 'السعر الأعلى يجب أن يكون رقم',
            'maxPrice.min' => 'السعر الأعلى لا يمكن أن يكون أقل من 0',
            'maxPrice.max' => 'السعر الأعلى لا يمكن أن يتجاوز 9999',
            'maxPrice.gt' => 'السعر الأعلى يجب أن يكون أكبر من السعر الأدنى',
            'sortBy.in' => 'خيار الترتيب غير صالح',
            'sortDirection.in' => 'اتجاه الترتيب غير صالح',
        ];
    }

    public function clear(): void
    {
        $this->search = '';
        $this->minPrice = '';
        $this->maxPrice = '';
        $this->showInactive = false;
    }

    public function hasActiveFilters(): bool
    {
        return ! empty($this->search)
            || ! empty($this->minPrice)
            || ! empty($this->maxPrice)
            || $this->showInactive;
    }

    public function getSearchQuery(): string
    {
        return trim($this->search);
    }

    public function getMinPriceValue(): ?float
    {
        return ! empty($this->minPrice) ? (float) $this->minPrice : null;
    }

    public function getMaxPriceValue(): ?float
    {
        return ! empty($this->maxPrice) ? (float) $this->maxPrice : null;
    }
}
