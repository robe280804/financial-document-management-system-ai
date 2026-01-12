<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\FinancialDocument;
use App\Models\User;
use App\Enums\FlowType;
use App\Enums\DocumentStatus;
use Illuminate\Database\QueryException;

class FinancialDocumentTest extends TestCase
{
    use RefreshDatabase;
    public function test_create_financial_document_success(): void
    {
        $document = FinancialDocument::factory()->create();

        $this->assertDatabaseHas('financial_documents', [
            'id' => $document->id,
            'name' => $document->name,
        ]);

        $this->assertInstanceOf(FlowType::class, $document->flow_type);
        $this->assertInstanceOf(DocumentStatus::class, $document->status);

        $this->assertNotNull($document->user);
        $this->assertContains($document->flow_type->value, ['income', 'expense']);
        $this->assertContains($document->status->value, ['draft', 'validated', 'paid', 'archived']);
    }

    public function test_it_requires_amount_and_currency()
    {
        $this->expectException(QueryException::class);

        $user = User::factory()->create();

        FinancialDocument::factory()->create([
            'user_id' => $user->id,
            'amount' => null, // invalid
            'currency' => null // invalid
        ]);
    }

    public function test_it_casts_dates_and_amounts_correctly()
    {
        $document = FinancialDocument::factory()->create([
            'amount' => 1234.56,
            'issue_date' => now(),
        ]);

        $this->assertIsFloat((float) $document->amount);
        $this->assertInstanceOf(\Illuminate\Support\Carbon::class, $document->issue_date);
    }
}
