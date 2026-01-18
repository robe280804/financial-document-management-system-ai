<?php

namespace App\Services\Datatable;


interface DatatableInterface
{
    function makeColumns(): array;
    function makeFilters(): array;
    function makeActions(): array;
    function makeBulkActions(): array;
}
