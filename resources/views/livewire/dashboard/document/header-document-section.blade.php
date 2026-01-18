<div class="py-8 px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col text-center mb-6 -mt-4">
        <h1 class="text-3xl md:text-4xl tracking-tight font-extrabold text-black dark:text-white italic uppercase">
            Financial <span class="text-gray-400 font-light">Documents</span>
        </h1>
        <div class="mt-2 flex justify-center">
            <div class="h-1 w-20 bg-black dark:bg-white rounded-full"></div>
        </div>
    </div>

    <div class="max-w-5xl mx-auto">
        <section
            class="grid grid-cols-2 md:grid-cols-5 gap-0 border border-gray-200 dark:border-gray-800 rounded-xl overflow-hidden shadow-sm  ">

            <div
                class="flex flex-col items-center justify-center py-6 px-4 border-b md:border-b-0 md:border-r border-gray-100 dark:border-gray-900 transition-colors  ">
                <span class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1">Total</span>
                <span class="text-2xl font-mono font-black text-black dark:text-white">
                    {{ $totalDocuments }}
                </span>
            </div>

            <div
                class="flex flex-col items-center justify-center py-6 px-4 border-b md:border-b-0 md:border-r border-gray-100 dark:border-gray-900 transition-colors ">
                <span class="text-[10px] font-bold uppercase tracking-widest mb-1 text-yellow-500">Drafted</span>
                <span class="text-2xl font-mono font-black text-black dark:text-white">
                    {{ $drafted }}
                </span>
            </div>

            <div
                class="flex flex-col items-center justify-center py-6 px-4 border-b md:border-b-0 md:border-r border-gray-100 dark:border-gray-900 transition-colors  ">
                <span
                    class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1 text-blue-500/80">Validated</span>
                <span class="text-2xl font-mono font-black text-black dark:text-white">
                    {{ $validated }}
                </span>
            </div>

            <div
                class="flex flex-col items-center justify-center py-6 px-4 border-b md:border-b-0 md:border-r border-gray-100 dark:border-gray-900 transition-colors ">
                <span
                    class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1 text-emerald-500/80">Paid</span>
                <span class="text-2xl font-mono font-black text-black dark:text-white">
                    {{ $paid }}
                </span>
            </div>

            <div class="flex flex-col items-center justify-center py-6 px-4 transition-colors ">
                <span
                    class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1 text-red-700">Archived</span>
                <span class="text-2xl font-mono font-black text-black dark:text-white">
                    {{ $archived }}
                </span>
            </div>

        </section>
    </div>
</div>