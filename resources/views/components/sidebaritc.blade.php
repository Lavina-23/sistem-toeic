<x-layout>
    <section class="antialiased bg-gray-50">
        <nav class="md:hidden bg-white border-b border-gray-200 px-4 py-2.5 fixed left-0 right-0 top-0 z-50">
            <div class="flex flex-wrap justify-between items-center">
                <div class="flex justify-start items-center">
                    <button data-drawer-target="drawer-navigation" data-drawer-toggle="drawer-navigation"
                        aria-controls="drawer-navigation"
                        class="p-2 mr-2 text-gray-600 rounded-lg cursor-pointer md:hidden hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 focus:ring-2 focus:ring-gray-100">
                        <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <svg aria-hidden="true" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Toggle sidebar</span>
                    </button>
                    <a href="https://flowbite.com" class="flex items-center justify-between mr-4">
                        <img src="https://flowbite.s3.amazonaws.com/logo.svg" class="mr-3 h-8" alt="Flowbite Logo" />
                        <span class="self-center text-2xl font-semibold whitespace-nowrap">Flowbite</span>
                    </a>
                </div>
            </div>
        </nav>
        <!-- Sidebar -->
        <aside
            class="fixed top-0 left-0 z-40 w-64 h-screen pt-1 transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0"
            aria-label="Sidenav" id="drawer-navigation">
            <div class="overflow-y-auto py-5 px-3 h-screen bg-white">
                <ul class="space-y-2">
                    <li>
                        <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm">
                            <div class="flex flex-col items-center py-10">
                                <img class="w-24 h-24 mb-3 rounded-full shadow-lg"
                                    src="https://i.ibb.co.com/Df3sMdtT/amu.jpg" alt="amu" border="0">
                                <h5 class="mb-1 text-xl font-medium text-gray-900">{{ $userData['username'] }}</h5>
                                <span class="text-sm text-gray-500">{{ $userData['email'] }}</span>
                                {{-- <div class="flex mt-4 md:mt-6">
                                    <a href="#"
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-teal-700 rounded-lg hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800">Add
                                        friend</a>
                                    <a href="#"
                                        class="py-2 px-4 ms-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-teal-700 focus:z-10 focus:ring-4 focus:ring-gray-100ark:hover:bg-gray-700">Message</a>
                                </div> --}}
                            </div>
                        </div>
                    </li>
                </ul>
                <ul class="pt-5 mt-5 space-y-2 border-t border-gray-200">
                    <li>
                        <a href="{{ route('verification') }}"
                            class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100 group">
                            <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M3 5.983C3 4.888 3.895 4 5 4h14c1.105 0 2 .888 2 1.983v8.923a1.992 1.992 0 0 1-2 1.983h-6.6l-2.867 2.7c-.955.899-2.533.228-2.533-1.08v-1.62H5c-1.105 0-2-.888-2-1.983V5.983Zm5.706 3.809a1 1 0 1 0-1.412 1.417 1 1 0 1 0 1.412-1.417Zm2.585.002a1 1 0 1 1 .003 1.414 1 1 0 0 1-.003-1.414Zm5.415-.002a1 1 0 1 0-1.412 1.417 1 1 0 1 0 1.412-1.417Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="ml-3">{{ __('sidebaritc.verif') }}</span>
                        </a>
                    </li>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button
                                class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100 group w-full">
                                <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M16 12H4m12 0-4 4m4-4-4-4m3-4h2a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3h-2" />
                                </svg>
                                <span class="ml-3">{{ __('sidebaritc.logout') }}</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
            <div>
                <div class="absolute bottom-0 left-0 justify-start p-4 space-x-4 w-full flex bg-white z-20">
                    <button id="language-button"
                        class="w-full flex items-center p-2 text-base font-medium text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100 group">
                        <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="m13 19 3.5-9 3.5 9m-6.125-2h5.25M3 7h7m0 0h2m-2 0c0 1.63-.793 3.926-2.239 5.655M7.5 6.818V5m.261 7.655C6.79 13.82 5.521 14.725 4 15m3.761-2.345L5 10m2.761 2.655L10.2 15" />
                        </svg>
                        <span class="ml-3">{{ session('locale') == 'en' ? 'Language' : 'Language' }}</span>
                    </button>

                    <!-- Dropdown -->
                    <div class="hidden z-50 my-4 text-base list-none bg-white rounded divide-y divide-gray-100 shadow"
                        id="language-dropdown">
                        <ul class="py-1" role="none">
                            <li>
                                <a href="{{ route('language.switch', 'id') }}"
                                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100">
                                    <div class="inline-flex items-center">
                                        <svg aria-hidden="true" class="h-3.5 w-3.5 rounded-full mr-2"
                                            xmlns="http://www.w3.org/2000/svg" id="flag-icon-css-id"
                                            viewBox="0 0 512 512">
                                            <g fill-rule="evenodd">
                                                <path fill="#e70011" d="M0 0h512v256H0z" />
                                                <path fill="#fff" d="M0 256h512v256H0z" />
                                            </g>
                                        </svg>
                                        Indonesia
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('language.switch', 'en') }}"
                                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100">
                                    <div class="inline-flex items-center">
                                        <img src="{{ asset('images/uk.jpg') }}" alt="Mandarin Flag"
                                            class="h-4 w-4 rounded-full mr-2" />
                                        </svg>
                                        English
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('language.switch', 'zh') }}"
                                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100">
                                    <div class="inline-flex items-center">
                                        <img src="{{ asset('images/china.jpg') }}" alt="Mandarin Flag"
                                            class="h-4 w-4 rounded-full mr-2" />
                                        Mandarin
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('language.switch', 'kr') }}"
                                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100">
                                    <div class="inline-flex items-center">
                                        <img src="{{ asset('images/korean.webp') }}" alt="Korea Flag"
                                            class="h-4 w-4 rounded-full mr-2" />
                                        Korea
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('language.switch', 'jp') }}"
                                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100">
                                    <div class="inline-flex items-center">
                                        <img src="{{ asset('images/japan.png') }}" alt="Korea Flag"
                                            class="h-4 w-4 rounded-full mr-2" />
                                        Japan
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
    </section>
</x-layout>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const languageButton = document.getElementById("language-button");
        const languageDropdown = document.getElementById("language-dropdown");

        // Toggle dropdown when button is clicked
        languageButton.addEventListener("click", function(e) {
            e.stopPropagation();
            languageDropdown.classList.toggle("hidden");
        });

        // Close dropdown when clicking outside
        document.addEventListener("click", function(e) {
            if (!languageDropdown.contains(e.target) && !languageButton.contains(e.target)) {
                languageDropdown.classList.add("hidden");
            }
        });
    });
</script>
