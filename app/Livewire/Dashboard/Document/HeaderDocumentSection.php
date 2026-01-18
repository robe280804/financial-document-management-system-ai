<?php

namespace App\Livewire\Dashboard\Document;

use Livewire\Component;
use App\Enums\DocumentStatus;
use App\Services\FinancialDocumentService;
use Illuminate\Database\Eloquent\Collection;

class HeaderDocumentSection extends Component
{
    public int $totalDocuments;
    public int $drafted;
    public int $validated;
    public int $paid;
    public int $archived;

    public function mount(FinancialDocumentService $financialDocumentService, Collection $financialDocuments)
    {
        $this->totalDocuments = $financialDocuments->count();
        $this->drafted = $financialDocumentService->filterDocumentByStatus($financialDocuments, DocumentStatus::DRAFT)->count();
        $this->validated = $financialDocumentService->filterDocumentByStatus($financialDocuments, DocumentStatus::VALIDATED)->count();
        $this->paid = $financialDocumentService->filterDocumentByStatus($financialDocuments, DocumentStatus::PAID)->count();
        $this->archived = $financialDocumentService->filterDocumentByStatus($financialDocuments, DocumentStatus::ARCHIVED)->count();
    }

    public function render()
    {
        return view('livewire.dashboard.document.header-document-section');
    }
}
