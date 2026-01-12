<?php

namespace App\Services;

use App\Enums\DocumentStatus;

class FinancialDocumentService
{
    public function filterDocumentByStatus($financialDocuments, DocumentStatus $filterStatus)
    {
        return $financialDocuments->filter(function ($document) use ($filterStatus) {
            return $document->status == $filterStatus;
        });
    }
}
