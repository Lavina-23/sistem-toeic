<x-layout>
    <x-sidebar />
    <section class="p-4 md:ml-52 h-auto mt-10 md:mt-0 bg-gray-50 min-h-screen">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">🎓 Daftar Peserta</h1>

        <div class="w-full overflow-x-auto bg-white rounded-xl shadow-md border border-gray-200 p-4">
            <div class="overflow-auto max-h-[500px]"> <!-- Tambah scroll dan sticky -->
                @livewire('peserta-table')
            </div>
        </div>
        
    </section>
</x-layout>
