<?php

namespace App\Livewire\Dashboard;

use App\Services\FinancialDocumentService;
use Livewire\Component;
use App\Models\User;
use App\Services\FinancialDocument;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use App\Enums\DocumentStatus;

class DocumentSection extends Component
{
    public User $user;
    public Collection $financialDocuments;
    public $drafted;
    public $validated;
    public $paid;
    public $archived;


    public function mount(FinancialDocumentService $financialDocumentService)
    {
        $this->user = Auth::user();
        $this->financialDocuments = $this->user->financialDocuments;

        $this->drafted   = $financialDocumentService->filterDocumentByStatus($this->financialDocuments, DocumentStatus::DRAFT);
        $this->validated = $financialDocumentService->filterDocumentByStatus($this->financialDocuments, DocumentStatus::VALIDATED);
        $this->paid      = $financialDocumentService->filterDocumentByStatus($this->financialDocuments, DocumentStatus::PAID);
        $this->archived  = $financialDocumentService->filterDocumentByStatus($this->financialDocuments, DocumentStatus::ARCHIVED);
    }

    public function render()
    {
        return view('livewire.dashboard.document-section');
    }
}
