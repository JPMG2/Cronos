<?php

declare(strict_types=1);

namespace App\Livewire\Maestro;

use App\Classes\Utilities\CommonQuerys;
use App\Livewire\Forms\Maestro\CategoryForm;
use App\Models\Category;
use App\Traits\UtilityForm;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

final class ReCategory extends Component
{
    use UtilityForm;

    public CategoryForm $form;

    public $opencategory = false;

    #[Title(' - Categorías')]
    public function render()
    {
        return view('livewire.maestro.re-category');
    }

    public function queryCategory(): void
    {
        $result = $this->isupdate ?
                  $this->form->categoryUpdate() :
                  $this->form->categoryStore();
        $messageType = $this->isupdate ? 'msgUpdate' : 'msgCreate';
        $message = $this->showQueryMessage($result, $messageType);
        $this->showToastAndClear($message);
        $this->clearForm();
    }

    public function clearForm(): void
    {
        $this->form->reset();
        $this->isupdate = false;
        $this->opencategory = false;
    }

    public function infoCategory(Category $category): void
    {
        $this->form->loadDataCategories($category);
        $this->opencategory = true;
        $this->isupdate = true;
    }

    public function getCategoriesProperty()
    {
        return Category::list()->get();
    }

    #[Computed]
    public function states()
    {
        return CommonQuerys::stateQuery([1, 2]);
    }
}
