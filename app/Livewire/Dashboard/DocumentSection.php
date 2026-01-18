<?php

namespace App\Livewire\Dashboard;


use Filament\Tables\Contracts\HasTable;
use Livewire\Component;
use App\Models\User;
use App\Services\Datatable\DocumentFinancialTableService;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Table;
use Filament\Forms\Concerns\InteractsWithForms;
use App\Models\FinancialDocument;


class DocumentSection extends Component implements HasTable, HasForms
{
    use InteractsWithTable, InteractsWithForms;

    protected DocumentFinancialTableService $datatableService;
    public User $user;
    public Collection $financialDocuments;

    public function boot(DocumentFinancialTableService $datatableService)
    {
        $this->datatableService = $datatableService;
    }

    public function table(Table $table)
    {
        return $table
            ->query(
                FinancialDocument::where('user_id', $this->user->id)->latest()
            )
            ->actions($this->datatableService->makeActions())
            ->columns($this->datatableService->makeColumns())
            ->filters($this->datatableService->makeFilters())
            ->bulkActions($this->datatableService->makeBulkActions())
            ->defaultPaginationPageOption(10);
    }


    public function mount()
    {
        $this->user = Auth::user();
        $this->financialDocuments = $this->user->financialDocuments;
    }

    public function render()
    {
        return view('livewire.dashboard.document-section');
    }
}
