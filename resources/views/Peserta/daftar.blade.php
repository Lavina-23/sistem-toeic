<x-layout>
    <x-sidebar />
    <section class="p-4 md:ml-64 h-auto mt-10 md:mt-0">
        <div class="max-w-6xl mx-auto p-6 bg-transparrent">
            @if ($registered)
                <div class="flex flex-col  mt-20 justify-center items-center md:flex-row gap-5 w-full">
                    <img class="h-[20rem]" src="https://i.ibb.co/Kj1HDCHX/hero-history.jpg" alt="hero-history"
                        border="0">
                    <div class="flex flex-col gap-2 items-start justify-center max-w-lg h-full">
                        <h1 class="text-3xl font-semibold">{{ __('daftar.title') }}</h1>
                        <p class="text-gray-500">{{ __('daftar.subtitle') }}</p>
                        <a href="https://itc-indonesia.com/?gad_campaignid=22363183331" target="_blank">
                            <x-primary-button
                                class="px-6 py-2 bg-yellowAccent text-white rounded-lg hover:bg-yellow-600">
                                {{ __('daftar.button') }}
                            </x-primary-button>
                        </a>
                    </div>
                </div>
            @else
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <h2 class="text-4xl font-bold text-center text-gray-900 mb-1">
                    {{ __('daftar.hititle') }}
                </h2>
                <h6 class="text-sm font-normal text-center text-gray-400 mb-6">
                    {{ __('daftar.hititleteks') }}
                </h6>

                <form method="POST" action="{{ route('peserta.store') }}" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- no_induk -->
                        <div>
                            <x-input-label for="no_induk" :value="__('daftar.nim_nidn_nip')" />
                            <x-text-input id="no_induk" class="mt-1 block w-full" type="number" name="no_induk"
                                :value="old('no_induk')" required autofocus />
                            <x-input-error :messages="$errors->get('no_induk')" class="mt-2" />
                        </div>

                        <!-- nik -->
                        <div>
                            <x-input-label for="nik" :value="__('daftar.nik')" />
                            <x-text-input id="nik" class="mt-1 block w-full" type="number" name="nik"
                                :value="old('nik')" required />
                            <x-input-error :messages="$errors->get('nik')" class="mt-2" />
                        </div>

                        <!-- no_telp -->
                        <div>
                            <x-input-label for="no_telp" :value="__('daftar.no_telp')" />
                            <x-text-input id="no_telp" class="mt-1 block w-full" type="number" name="no_telp"
                                :value="old('no_telp')" required />
                            <x-input-error :messages="$errors->get('no_telp')" class="mt-2" />
                        </div>

                        <!-- jurusan -->
                        <div>
                            <x-input-label for="jurusan" :value="__('daftar.jurusan')" />
                            <x-text-input id="jurusan" class="mt-1 block w-full" type="text" name="jurusan"
                                :value="old('jurusan')" required />
                            <x-input-error :messages="$errors->get('jurusan')" class="mt-2" />
                        </div>

                        <!-- program_studi -->
                        <div>
                            <x-input-label for="program_studi" :value="__('daftar.program_studi')" />
                            <x-text-input id="program_studi" class="mt-1 block w-full" type="text"
                                name="program_studi" :value="old('program_studi')" required />
                            <x-input-error :messages="$errors->get('program_studi')" class="mt-2" />
                        </div>

                        <!-- kampus -->
                        <div>
                            <x-input-label for="kampus" :value="__('daftar.kampus')" />
                            <select id="kampus" name="kampus"
                                class="mt-1 block w-full bg-white border-gray-300 rounded-md shadow-sm focus:ring-teal-500"
                                required>
                                <option value="">{{ __('daftar.pilih_kampus') }}</option>
                                @foreach (['Utama', 'PSDKU Kediri', 'PSDKU Lumajang', 'PSDKU Pamekasan'] as $option)
                                    <option value="{{ $option }}"
                                        {{ old('kampus') === $option ? 'selected' : '' }}>{{ $option }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('kampus')" class="mt-2" />
                        </div>
                    </div>

                    <!-- alamat -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="alamat_asal" :value="__('daftar.alamat_asal')" />
                            <textarea id="alamat_asal" name="alamat_asal"
                                class="mt-1 block w-full border-gray-300 focus:ring-teal-500 rounded-md shadow-sm" rows="3" required>{{ old('alamat_asal') }}</textarea>
                            <x-input-error :messages="$errors->get('alamat_asal')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="alamat_sekarang" :value="__('daftar.alamat_sekarang')" />
                            <textarea id="alamat_sekarang" name="alamat_sekarang"
                                class="mt-1 block w-full border-gray-300 focus:ring-teal-500 rounded-md shadow-sm" rows="3" required>{{ old('alamat_sekarang') }}</textarea>
                            <x-input-error :messages="$errors->get('alamat_sekarang')" class="mt-2" />
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="tgl_lahir" :value="__('Tanggal Lahir')" />
                            <input id="tgl_lahir" name="tgl_lahir" type="date"
                                class="mt-1 block w-full border-gray-300 focus:ring-teal-500 rounded-md shadow-sm"
                                value="{{ old('tgl_lahir') }}" required />
                            <x-input-error :messages="$errors->get('tgl_lahir')" class="mt-2" />
                        </div>



                        <!-- uploads -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <x-input-label for="ktp" :value="__('daftar.ktp')" />
                                <input id="ktp" class="mt-1 block w-full" type="file" name="ktp"
                                    required />
                                <x-input-error :messages="$errors->get('ktp')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="ktm" :value="__('daftar.ktm')" />
                                <input id="ktm" class="mt-1 block w-full" type="file" name="ktm"
                                    required />
                                <x-input-error :messages="$errors->get('ktm')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="foto" :value="__('daftar.foto')" />
                                <input id="foto" class="mt-1 block w-full" type="file" name="foto"
                                    required />
                                <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <x-primary-button class="mt-4">
                                {{ __('daftar.daftar') }}
                            </x-primary-button>
                        </div>
                </form>
            @endif
        </div>
    </section>
</x-layout>
