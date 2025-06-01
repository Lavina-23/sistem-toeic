<x-layout>
    <x-sidebar :userData="$userData" />
    <section class="p-4 md:ml-64 h-auto mt-0">
        <div class="max-w-full p-6 -mt-4">
            <h1 class="text-4xl font-bold text-primary mb-6 text-center">{{ __('jadwalTes.title') }}</h1>

            <div class="bg-white border rounded-lg shadow-sm p-6 mb-6">
                <div class="flex flex-col gap-4">
                    <h2 class="text-lg md:text-xl font-semibold text-yellowAccent text-center">
                        {{ __('jadwalTes.sub_title') }}</h2>
                    <p class="text-sm font-normal text-center text-gray-400">{{ __('jadwalTes.description') }}</p>
                </div>
            </div>

            <div class="w-full flex flex-col items-center">
                <div class="w-full h-[600px] border border-gray-300 rounded-lg overflow-hidden mb-4">
                    @if ($pengumuman && $pengumuman->file)
                        <object data="{{ asset('storage/' . $pengumuman->file) }}" type="application/pdf"
                            class="w-full h-full">
                            <p class="text-center p-6">
                                {{ __('jadwalTes.notsupport') }}
                            </p>
                        </object>
                    @else
                        <p class="text-gray-500 text-center py-8">{{ __('jadwalTes.notyet') }}</p>
                    @endif
                </div>

                @if ($pengumuman && $pengumuman->file)
                    <a href="{{ asset('storage/' . $pengumuman->file) }}" download
                        class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-[#F2AB19] hover:bg-[#d49916] rounded-lg focus:ring-4 focus:ring-yellow-300">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        {{ __('jadwalTes.download') }}
                    </a>
                @endif
            </div>

            <!-- Additional Information Section -->
            <div class="bg-white border rounded-lg shadow-sm p-6 mt-6">
                <h2 class="text-lg md:text-xl font-semibold text-[#00247D] mb-4">
                    {{ __('jadwalTes.section_info_title') }}</h2>

                <div class="space-y-4 text-sm font-normal text-gray-600">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-red-600 mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="ml-3">{{ __('jadwalTes.info_1') }}</p>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-red-600 mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="ml-3">{{ __('jadwalTes.info_2') }}</p>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-red-600 mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="ml-3">{{ __('jadwalTes.info_3') }}</p>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-red-600 mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="ml-3">{{ __('jadwalTes.info_4') }}</p>
                    </div>
                </div>
            </div>

            <!-- Contact Section -->
            <div class="bg-white border rounded-lg shadow-sm p-6 mt-6">
                <h2 class="text-lg md:text-xl font-semibold text-primary mb-4">
                    {{ __('jadwalTes.section_contact_title') }}</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-normal text-gray-900">{{ __('jadwalTes.contact_phone') }}</p>
                            <p class="text-sm text-gray-500">{{ __('jadwalTes.value_phone') }}</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-normal text-gray-900">{{ __('jadwalTes.contact_email') }}</p>
                            <p class="text-sm text-gray-500">toeic@polinema.ac.id</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-normal text-gray-900">{{ __('jadwalTes.contact_hours') }}</p>
                            <p class="text-sm text-gray-500">{{ __('jadwalTes.value_hours') }}</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-normal text-gray-900">{{ __('jadwalTes.contact_location') }}</p>
                            <p class="text-sm text-gray-500">{{ __('jadwalTes.value_location') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
</x-layout>
