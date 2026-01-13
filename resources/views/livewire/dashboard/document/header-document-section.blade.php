<div>
    <div class="flex flex-col text-center">
        <h1 class="text-2xl tracking-tight leading-none font-bold">
            Financial Documents
        </h1>
        <!--
        <p class="text-sm text-gray-400 mt-1">
            <span class="font-medium ">Create, Update, Share and analyze</span>
            your financial documents here
        </p>
    -->
    </div>

    <div class="max-w-4xl mx-auto mt-3">
        <section class="flex flex-wrap items-center justify-center gap-4 md:gap-10 py-3 px-6">

            <div class="flex items-center gap-2">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-400">Total</span>
                <span class="  px-2 py-0.5  text-sm font-mono font-bold">{{
                    $totalDocuments }}</span>
            </div>

            <div class="flex items-center gap-2">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-400">Drafted</span>
                <span class="  px-2 py-0.5  text-sm font-mono font-bold">{{
                    $drafted
                    }}</span>
            </div>

            <div class="flex items-center gap-2">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-400">Validated</span>
                <span class="  px-2 py-0.5  text-sm font-mono font-bold">{{
                    $validated
                    }}</span>
            </div>

            <div class="flex items-center gap-2">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-400">Paid</span>
                <span class="  px-2 py-0.5 text-sm font-mono font-bold">{{
                    $paid
                    }}</span>
            </div>

            <div class="flex items-center gap-2">
                <span class="text-xs font-semibold uppercase tracking-wider text-gray-400">Archived</span>
                <span class=" x-2 py-0.5 text-sm font-mono font-bold">{{
                    $archived
                    }}</span>
            </div>

        </section>
    </div>
</div>