<x-layout>
    <x-sidebar />
    <section class="flex flex-col md:flex-row gap-6 p-6 md:ml-64 min-h-screen mt-10 md:mt-0 w-fit">
        <div class="w-full md:w-3/4">
            @if (!is_null($peserta))
                <div class="border-2 rounded-xl shadow-md p-8 bg-white">
                    <h1 class="text-3xl md:text-2xl font-bold text-center text-gray-900 mb-8">
                        {{ __('riwayat.title') }}
                    </h1>
                    <div class="grid grid-cols-1 gap-6">
                        <dl class="text-gray-900 divide-y divide-gray-200">
                            <div class="py-4">
                                <dt class="text-sm text-gray-500 mb-1">{{ __('riwayat.ID Peserta') }}</dt>
                                <dd class="text-base font-semibold">{{ $peserta->peserta_id }}</dd>
                            </div>
                            <div class="py-4">
                                <dt class="text-sm text-gray-500 mb-1">{{ __('riwayat.Nama') }}</dt>
                                <dd class="text-base font-semibold">{{ $peserta->nama }}</dd>
                            </div>
                            <div class="py-4">
                                <dt class="text-sm text-gray-500 mb-1">{{ __('riwayat.Nomor Identitas') }}</dt>
                                <dd class="text-base font-semibold">{{ $peserta->no_induk }}</dd>
                            </div>
                            <div class="py-4">
                                <dt class="text-sm text-gray-500 mb-1">{{ __('riwayat.Nik') }}</dt>
                                <dd class="text-base font-semibold">{{ $peserta->nik }}</dd>
                            </div>
                            <div class="py-4">
                                <dt class="text-sm text-gray-500 mb-1">{{ __('riwayat.Nomor Telepon') }}</dt>
                                <dd class="text-base font-semibold">{{ $peserta->no_telp }}</dd>
                            </div>
                        </dl>
                        <dl class="text-gray-900 divide-y divide-gray-200">
                            <div class="py-4">
                                <dt class="text-sm text-gray-500 mb-1">{{ __('riwayat.Alamat asal') }}</dt>
                                <dd class="text-base font-semibold">{{ $peserta->alamat_asal }}</dd>
                            </div>
                            <div class="py-4">
                                <dt class="text-sm text-gray-500 mb-1">{{ __('riwayat.Alamat Sekarang') }}</dt>
                                <dd class="text-base font-semibold">{{ $peserta->alamat_sekarang }}</dd>
                            </div>
                            <div class="py-4">
                                <dt class="text-sm text-gray-500 mb-1">{{ __('riwayat.Jurusan') }}</dt>
                                <dd class="text-base font-semibold">{{ $peserta->jurusan }}</dd>
                            </div>
                            <div class="py-4">
                                <dt class="text-sm text-gray-500 mb-1">{{ __('riwayat.Program Studi') }}</dt>
                                <dd class="text-base font-semibold">{{ $peserta->program_studi }}</dd>
                            </div>
                            <div class="py-4">
                                <dt class="text-sm text-gray-500 mb-1">{{ __('riwayat.Kampus') }}</dt>
                                <dd class="text-base font-semibold">{{ $peserta->kampus }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            @else
                <!-- No Data Section -->
                <div
                    class="flex flex-col md:flex-row gap-8 items-center justify-center w-full p-8 bg-white border-2 rounded-xl shadow-md">
                    <svg class="w-full max-w-md h-auto text-gray-800" aria-hidden="true" width="411" height="578"
                        viewBox="0 0 411 578" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <!-- SVG content remains unchanged -->
                        <path
                            d="M59 6C59 2.68629 61.6863 0 65 0H261C264.314 0 267 2.68629 267 6V245C267 248.314 264.314 251 261 251H65C61.6863 251 59 248.314 59 245V6Z"
                            fill="#1F2A37" />
                        <!-- ... (rest of the SVG paths and definitions remain the same) ... -->
                    </svg>
                    <div class="flex flex-col gap-4 items-center md:items-start justify-center max-w-lg">
                        <h1 class="text-3xl font-semibold text-gray-900">{{ __('riwayat.tidak_ada_data') }}</h1>
                        <p class="text-gray-600 text-center md:text-left">{{ __('riwayat.klik_untuk_daftar') }}</p>
                        <a href="{{ route('peserta.create') }}">
                            <x-primary-button
                                class="w-fit h-fit px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-all duration-200">
                                {{ __('riwayat.ikut_tes') }}
                            </x-primary-button>
                        </a>
                    </div>
                </div>
            @endif
        </div>
        <div
            class="{{ !is_null($score->score_total) ? 'block' : 'hidden' }} w-full md:w-2/4 border-2 rounded-xl shadow-md p-6 bg-white h-fit">
            <h2 class="text-xl font-semibold text-gray-800 mb-3">Nilai Total: {{ $score->score_total }}</h2>
            <div class="w-full h-5 bg-gray-200 rounded-full overflow-hidden">
                <div class="h-5 bg-gradient-to-r from-blue-500 to-blue-700 rounded-full transition-all duration-300"
                    style="width: {{ $score->score_total }}%"></div>
            </div>
        </div>
    </section>
</x-layout>
