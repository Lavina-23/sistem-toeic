<x-layout>
    <x-sidebar />
    <section class="p-4 md:ml-64 h-auto mt-10 md:mt-0">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                {{ session('error') }}
            </div>
        @endif

        <h2 class="text-4xl font-bold text-center text-teal-900 mb-1">
            {{ __('😈 Sudah siap mengikuti tes TOEIC? 😈') }}
        </h2>
        <h6 class="text-sm font-normal text-center text-gray-400 mb-6">
            {{ __('Ambil langkah pasti menuju masa depan gemilang dengan skor TOEIC unggul') }}
        </h6>

        <form method="POST" action="{{ route('peserta.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col md:flex-row gap-5 w-full">
                <!-- nama -->
                {{-- <div class="w-full">
                    <x-input-label for="nama" :value="__('Nama Lengkap')" />
                    <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama"
                        :value="old('nama')" required autofocus autocomplete="nama" />
                    <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                </div> --}}
                <!-- no_induk -->
                <div class="w-full">
                    <x-input-label for="no_induk" :value="__('NIM/NIDN/NIP')" />
                    <x-text-input id="no_induk" class="block mt-1 w-full" type="text" name="no_induk"
                        :value="old('no_induk')" required autofocus autocomplete="no_induk" />
                    <x-input-error :messages="$errors->get('no_induk')" class="mt-2" />
                </div>
                <!-- NIK -->
                <div class="w-full">
                    <x-input-label for="nik" :value="__('NIK')" />
                    <x-text-input id="nik" class="block mt-1 w-full" type="text" name="nik"
                        :value="old('nik')" required />
                    <x-input-error :messages="$errors->get('nik')" class="mt-2" />
                </div>
                <!-- No Telp -->
                <div class="w-full">
                    <x-input-label for="no_telp" :value="__('No Telp')" />
                    <x-text-input id="no_telp" class="block mt-1 w-full" type="text" name="no_telp"
                        :value="old('no_telp')" required />
                    <x-input-error :messages="$errors->get('no_telp')" class="mt-2" />
                </div>
            </div>

            <div class="flex flex-col md:flex-row gap-5 w-full mt-4">
                <!-- Alamat Asal -->
                <div class="w-full">
                    <x-input-label for="alamat_asal" :value="__('Alamat Asal')" />
                    <textarea id="alamat_asal" name="alamat_asal" type="textarea"
                        class="w-full mt-1 border-gray-300 focus:ring-teal-500 rounded-md shadow-sm" rows="3" required>{{ old('alamat_asal') }}</textarea>
                    <x-input-error :messages="$errors->get('alamat_asal')" class="mt-2" />

                </div>

                <!-- Alamat Sekarang -->
                <div class="w-full">
                    <x-input-label for="alamat_sekarang" :value="__('Alamat Sekarang')" />
                    <textarea id="alamat_sekarang" name="alamat_sekarang" type="textarea"
                        class="w-full mt-1 border-gray-300 focus:ring-teal-500 rounded-md shadow-sm" rows="3" required>{{ old('alamat_sekarang') }}</textarea>
                    <x-input-error :messages="$errors->get('alamat_sekarang')" class="mt-2" />
                </div>
            </div>

            <div class="flex flex-col md:flex-row gap-5 w-full mt-4">
                <!-- Jurusan -->
                <div class="w-full">
                    <x-input-label for="jurusan" :value="__('Jurusan')" />
                    <x-text-input id="jurusan" class="block mt-1 w-full" type="text" name="jurusan"
                        :value="old('jurusan')" required />
                    <x-input-error :messages="$errors->get('jurusan')" class="mt-2" />
                </div>

                <!-- Program Studi -->
                <div class="w-full">
                    <x-input-label for="program_studi" :value="__('Program Studi')" />
                    <x-text-input id="program_studi" class="block mt-1 w-full" type="text" name="program_studi"
                        :value="old('program_studi')" required />
                    <x-input-error :messages="$errors->get('program_studi')" class="mt-2" />
                </div>

                <!-- Kampus -->
                <div class="w-full">
                    <x-input-label for="kampus" :value="__('Kampus')" />
                    <select id="kampus" name="kampus"
                        class="block mt-1 w-full bg-white border-gray-300 rounded-md shadow-sm focus:ring-teal-500 text-teal-700"
                        required>
                        <option value="">-- Pilih Kampus --</option>
                        @foreach (['Utama', 'PSDKU Kediri', 'PSDKU Lumajang', 'PSDKU Pamekasan'] as $option)
                            <option value="{{ $option }}" {{ old('kampus') === $option ? 'selected' : '' }}>
                                {{ $option }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('kampus')" class="mt-2" />
                </div>

            </div>

            <!-- KTP -->
            <div class="mt-4 w-fit">
                <x-input-label for="ktp" :value="__('KTP')" />
                <input id="ktp" class="block mt-1" type="file" name="ktp" required />
                <x-input-error :messages="$errors->get('ktp')" class="mt-2" />
            </div>

            <!-- KTM -->
            <div class="mt-4 w-fit">
                <x-input-label for="ktm" :value="__('KTM')" />
                <input id="ktm" class="block mt-1" type="file" name="ktm" required />
                <x-input-error :messages="$errors->get('ktm')" class="mt-2" />
            </div>

            <!-- Foto -->
            <div class="mt-4 w-fit">
                <x-input-label for="foto" :value="__('Foto')" />
                <input id="foto" class="block mt-1" type="file" name="foto" required />
                <x-input-error :messages="$errors->get('foto')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-4">
                    {{ __('Daftar') }}
                </x-primary-button>
            </div>
        </form>
    </section>
</x-layout>
