<?php

namespace App\Livewire\Dashboard;


use Filament\Tables\Contracts\HasTable;
use Livewire\Component;
use App\Models\User;
use App\Services\DatatableService;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Table;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use App\Models\FinancialDocument;


class DocumentSection extends Component implements HasTable, HasForms
{
    use InteractsWithTable, InteractsWithForms;

    protected DatatableService $datatableService;
    public User $user;
    public Collection $financialDocuments;

    public function boot(DatatableService $datatableService)
    {
        $this->datatableService = $datatableService;
    }

    public function table(Table $table)
    {
        return $table
            ->query(
                FinancialDocument::where('user_id', $this->user->id)->latest()
            )
            ->columns($this->datatableService->financialDocumentColumns())
            ->filters($this->datatableService->financialDocumentFilters())
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
