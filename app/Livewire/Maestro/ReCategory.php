<?php

declare(strict_types=1);

namespace App\Livewire\Maestro;

use App\Classes\Utilities\CommonQueries;
use App\Livewire\Forms\Maestro\CategoryForm;
use App\Models\Category;
use App\Traits\UtilityForm;
<<<<<<< HEAD
use Illuminate\Support\Collection;
=======
>>>>>>> 5e6df33 (Refactor `CommonQuerys` to `CommonQueries` across the codebase for improved naming consistency, update `CompanyWatcher`.)
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
<<<<<<< HEAD
            $this->form->categoryUpdate() :
            $this->form->categoryStore();
=======
                  $this->form->categoryUpdate() :
                  $this->form->categoryStore();
>>>>>>> 5e6df33 (Refactor `CommonQuerys` to `CommonQueries` across the codebase for improved naming consistency, update `CompanyWatcher`.)
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

<<<<<<< HEAD
    #[Computed]
    public function categories(): Collection
=======
    public function getCategoriesProperty()
>>>>>>> 5e6df33 (Refactor `CommonQuerys` to `CommonQueries` across the codebase for improved naming consistency, update `CompanyWatcher`.)
    {
        return Category::list([1, 2], null)->get();
    }

    #[Computed]
<<<<<<< HEAD
    public function states(): Collection
=======
    public function states()
>>>>>>> 5e6df33 (Refactor `CommonQuerys` to `CommonQueries` across the codebase for improved naming consistency, update `CompanyWatcher`.)
    {
        return CommonQueries::stateQuery([1, 2]);
    }
}
