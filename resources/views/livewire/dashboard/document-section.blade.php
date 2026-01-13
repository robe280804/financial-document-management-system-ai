<div>
    <!-- Header:  info like title, counter, create, filter ... -->
    <livewire:dashboard.document.header-document-section :financialDocuments="$financialDocuments">

        <div>
            {{ $this->table }}
        </div>
</div>