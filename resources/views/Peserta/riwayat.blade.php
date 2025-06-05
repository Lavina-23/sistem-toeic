<x-layout>
    <x-sidebar />
    <section class="p-4 md:ml-60 h-auto mt-10 md:mt-0 bg-gray-50 min-h-screen grid gap-6">
        <div class="flex justify-between items-end gap-6 h-full">
            @if (!is_null($score))
                <div class="w-full h-full">
                    <div class="border-2 rounded-xl shadow-md px-8 py-6 bg-white h-full">
                        <h2 class="text-2xl font-bold text-gray-800 mb-3">Hasil Tes Terbaru</h2>
                        <div class="grid gap-4">
                            <div>
                                <div class="flex justify-between mb-1">
                                    <h2 class="text-sm font-medium text-gray-800">Total Score</h2>
                                    <h2 class="text-sm font-medium text-gray-800">
                                        {{ $score->score_total }}/{{ 900 }}
                                    </h2>
                                </div>
                                <div x-data="{ pct: 0 }" x-init="setTimeout(() => { pct = {{ $score->score_total }} / {{ 900 }} * 100 }, 100)" class="space-y-1">
                                    <!-- Progress Bar Container -->
                                    <div class="w-full bg-gray-200 rounded-full overflow-hidden h-5">
                                        <!-- Animated Bar -->
                                        <div :style="`width: ${pct}%`"
                                            class="h-5 bg-gradient-to-r from-primaryLight via-primaryMid to-primary rounded-full transition-all duration-1000">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between mb-1">
                                    <h2 class="text-sm font-medium text-gray-800">Score Reading</h2>
                                    <h2 class="text-sm font-medium text-gray-800">
                                        {{ $score->score_r }}/{{ 900 }}
                                    </h2>
                                </div>
                                <div x-data="{ pct: 0 }" x-init="setTimeout(() => { pct = {{ $score->score_r }} / {{ 900 }} * 100 }, 100)" class="space-y-1">
                                    <!-- Progress Bar Container -->
                                    <div class="w-full bg-gray-200 rounded-full overflow-hidden h-5">
                                        <!-- Animated Bar -->
                                        <div :style="`width: ${pct}%`"
                                            class="h-5 bg-gradient-to-r from-primaryLight via-primaryMid to-primary rounded-full transition-all duration-1000">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between mb-1">
                                    <h2 class="text-sm font-medium text-gray-800">Score Listening</h2>
                                    <h2 class="text-sm font-medium text-gray-800">
                                        {{ $score->score_l }}/{{ 900 }}
                                    </h2>
                                </div>
                                <div x-data="{ pct: 0 }" x-init="setTimeout(() => { pct = {{ $score->score_l }} / {{ 900 }} * 100 }, 100)" class="space-y-1">
                                    <!-- Progress Bar Container -->
                                    <div class="w-full bg-gray-200 rounded-full overflow-hidden h-5">
                                        <!-- Animated Bar -->
                                        <div :style="`width: ${pct}%`"
                                            class="h-5 bg-gradient-to-r from-primaryLight via-primaryMid to-primary rounded-full transition-all duration-1000">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800 my-3">Hasil Tes Sebelumnya</h2>
                        <div class="grid gap-4">
                            <div>
                                <div class="flex justify-between mb-1">
                                    <h2 class="text-sm font-medium text-gray-800">Total Score</h2>
                                    <h2 class="text-sm font-medium text-gray-800">
                                        {{ $score->last_score_total }}/{{ 900 }}
                                    </h2>
                                </div>
                                <div x-data="{ pct: 0 }" x-init="setTimeout(() => { pct = {{ $score->last_score_total }} / {{ 900 }} * 100 }, 100)" class="space-y-1">
                                    <!-- Progress Bar Container -->
                                    <div class="w-full bg-gray-200 rounded-full overflow-hidden h-5">
                                        <!-- Animated Bar -->
                                        <div :style="`width: ${pct}%`"
                                            class="h-5 bg-gradient-to-r from-yellowLight via-yellowAccent to-yellowAccent rounded-full transition-all duration-1000">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between mb-1">
                                    <h2 class="text-sm font-medium text-gray-800">Score Reading</h2>
                                    <h2 class="text-sm font-medium text-gray-800">
                                        {{ $score->last_score_r }}/{{ 900 }}
                                    </h2>
                                </div>
                                <div x-data="{ pct: 0 }" x-init="setTimeout(() => { pct = {{ $score->score_r }} / {{ 900 }} * 100 }, 100)" class="space-y-1">
                                    <!-- Progress Bar Container -->
                                    <div class="w-full bg-gray-200 rounded-full overflow-hidden h-5">
                                        <!-- Animated Bar -->
                                        <div :style="`width: ${pct}%`"
                                            class="h-5 bg-gradient-to-r from-yellowLight via-yellowAccent to-yellowAccent rounded-full transition-all duration-1000">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between mb-1">
                                    <h2 class="text-sm font-medium text-gray-800">Score Listening</h2>
                                    <h2 class="text-sm font-medium text-gray-800">
                                        {{ $score->last_score_l }}/{{ 900 }}
                                    </h2>
                                </div>
                                <div x-data="{ pct: 0 }" x-init="setTimeout(() => { pct = {{ $score->last_score_l }} / {{ 900 }} * 100 }, 100)" class="space-y-1">
                                    <!-- Progress Bar Container -->
                                    <div class="w-full bg-gray-200 rounded-full overflow-hidden h-5">
                                        <!-- Animated Bar -->
                                        <div :style="`width: ${pct}%`"
                                            class="h-5 bg-gradient-to-r from-yellowLight via-yellowAccent to-yellowAccent rounded-full transition-all duration-1000">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="text-xs text-gray-500 mt-3">
                            <li><span class="underline">Total Score:</span> Jumlah keseluruhan poin yang diperoleh dalam
                                satu
                                kali tes.</li>
                            <li><span class="underline">Score Reading:</span> Skor yang mencerminkan kemampuan memahami
                                teks tertulis dalam bahasa
                                Inggris.</li>
                            <li><span class="underline">Score Listening:</span> Skor yang mencerminkan kemampuan
                                memahami percakapan lisan dalam
                                bahasa
                                Inggris</li>
                        </ul>
                    </div>
                </div>
            @else
                <div class="w-full h-full">
                    <div class="flex border-2 rounded-xl shadow-md p-8 gap-4 bg-white justify-center items-end h-full">
                        <img class="w-auto max-w-[20rem] h-64" src="https://i.ibb.co/DgmHFbTQ/score-null1.jpg"
                            alt="score-null1" border="0">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800 mt-3">Hasil Tes</h2>
                            <p class="text-gray-600 text-sm w-52 text-left">Hasil tes TOEIC kamu nanti akan
                                ditampilkan
                                disini.
                            </p>
                        </div>
                    </div>
                </div>
            @endif
            <div class="max-w-lg grid gap-6 w-full md:w-3/4 h-full">
                <div class="max-w-full p-6 bg-white border-2 border-gray-200 rounded-lg shadow-lg">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Score
                            Tertinggi
                        </h5>
                    </a>
                    <div class="flex flex-col md:flex-row gap-4 justify-between text-center">
                        <div>
                            <h1 class="text-2xl font-extrabold text-primary">{{ $score->highest_score ?? 0 }}</h1>
                            <p>Total</p>
                        </div>
                        <div>
<<<<<<< HEAD
                            <h1 class="text-2xl font-extrabold text-yellowAccent">{{ $score->highest_score_r ?? 0 }}</h1>
                            <p>Reading</p>
                        </div>
                        <div>
                            <h1 class="text-2xl font-extrabold text-redMain">{{ $score->highest_score_l ?? 0 }}</h1>
=======
                            <h1 class="text-2xl font-extrabold text-primary">{{ $score->highest_score_r ?? 0 }}</h1>
                            <p>Reading</p>
                        </div>
                        <div>
                            <h1 class="text-2xl font-extrabold text-primary">{{ $score->highest_score_l ?? 0 }}</h1>
>>>>>>> cc20eaa4c5d54fd2f776ebe6c7db5b258ccfb0e2
                            <p>Listening</p>
                        </div>
                    </div>
                </div>
                <div class="w-full bg-white rounded-xl shadow-md border-2 p-4 md:p-6">
                    <h1 class="text-gray-900 text-2xl leading-none font-bold mb-2">Perjalanan Skor TOEIC-ku</h1>
                    <p class="text-gray-500 text-sm leading-none mb-6">Tetap semangat! Lihat sejauh mana
                        kemajuan yang sudah kamu capai.</p>
                    <div id="line-chart"></div>
                </div>
            </div>
        </div>
        <div class="w-full">
            @if (!is_null($peserta))
                <div class="border-2 rounded-xl shadow-md p-8 bg-white">
                    <h1 class="text-3xl md:text-2xl font-bold text-center text-gray-900 mb-8">
                        {{ __('riwayat.title') }}
                    </h1>
                    <div class="flex gap-6">
                        <dl class="text-gray-900 divide-y divide-gray-200 w-full">
                            <div class="py-2">
                                <dt class="text-sm text-gray-500 mb-1">{{ __('riwayat.ID Peserta') }}</dt>
                                <dd class="text-base font-semibold">{{ $peserta->peserta_id }}</dd>
                            </div>
                            <div class="py-2">
                                <dt class="text-sm text-gray-500 mb-1">{{ __('riwayat.Nama') }}</dt>
                                <dd class="text-base font-semibold">{{ $peserta->nama }}</dd>
                            </div>
                            <div class="py-2">
                                <dt class="text-sm text-gray-500 mb-1">{{ __('riwayat.Nomor Identitas') }}</dt>
                                <dd class="text-base font-semibold">{{ $peserta->no_induk }}</dd>
                            </div>
                            <div class="py-2">
                                <dt class="text-sm text-gray-500 mb-1">{{ __('riwayat.Nik') }}</dt>
                                <dd class="text-base font-semibold">{{ $peserta->nik }}</dd>
                            </div>
                            <div class="py-2">
                                <dt class="text-sm text-gray-500 mb-1">{{ __('riwayat.Nomor Telepon') }}</dt>
                                <dd class="text-base font-semibold">{{ $peserta->no_telp }}</dd>
                            </div>
                        </dl>
                        <dl class="text-gray-900 divide-y divide-gray-200 w-full">
                            <div class="py-2">
                                <dt class="text-sm text-gray-500 mb-1">{{ __('riwayat.Alamat asal') }}</dt>
                                <dd class="text-base font-semibold">{{ $peserta->alamat_asal }}</dd>
                            </div>
                            <div class="py-2">
                                <dt class="text-sm text-gray-500 mb-1">{{ __('riwayat.Alamat Sekarang') }}</dt>
                                <dd class="text-base font-semibold">{{ $peserta->alamat_sekarang }}</dd>
                            </div>
                            <div class="py-2">
                                <dt class="text-sm text-gray-500 mb-1">{{ __('riwayat.Jurusan') }}</dt>
                                <dd class="text-base font-semibold">{{ $peserta->jurusan }}</dd>
                            </div>
                            <div class="py-2">
                                <dt class="text-sm text-gray-500 mb-1">{{ __('riwayat.Program Studi') }}</dt>
                                <dd class="text-base font-semibold">{{ $peserta->program_studi }}</dd>
                            </div>
                            <div class="py-2">
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
                    <img class="w-auto max-w-[20rem] h-44" src="https://i.ibb.co/v6jGGZ68/score-null.jpg"
                        alt="score-null" border="0">
                    <div class="flex flex-col gap-4 items-center md:items-start justify-center max-w-lg">
                        <h1 class="text-3xl font-semibold text-gray-900">{{ __('riwayat.tidak_ada_data') }}</h1>
                        <p class="text-gray-600 text-center md:text-left">{{ __('riwayat.klik_untuk_daftar') }}</p>
                        <a href="{{ route('peserta.create') }}">
                            <x-primary-button
                                class="w-fit h-fit px-6 py-3 bg-teal-600 hover:bg-teal-700 text-white rounded-lg transition-all duration-200">
                                {{ __('riwayat.ikut_tes') }}
                            </x-primary-button>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>
</x-layout>
