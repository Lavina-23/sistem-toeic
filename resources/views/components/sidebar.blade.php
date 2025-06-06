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
                                    src="https://i.ibb.co/zTw3JG7Q/profile.jpg" alt="profile" border="0">
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
                        <a href="{{ route('peserta.create') }}"
                            class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100 group">
                            <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M8 7V2.221a2 2 0 0 0-.5.365L3.586 6.5a2 2 0 0 0-.365.5H8Zm2 0V2h7a2 2 0 0 1 2 2v.126a5.087 5.087 0 0 0-4.74 1.368v.001l-6.642 6.642a3 3 0 0 0-.82 1.532l-.74 3.692a3 3 0 0 0 3.53 3.53l3.694-.738a3 3 0 0 0 1.532-.82L19 15.149V20a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Z"
                                    clip-rule="evenodd" />
                                <path fill-rule="evenodd"
                                    d="M17.447 8.08a1.087 1.087 0 0 1 1.187.238l.002.001a1.088 1.088 0 0 1 0 1.539l-.377.377-1.54-1.542.373-.374.002-.001c.1-.102.22-.182.353-.237Zm-2.143 2.027-4.644 4.644-.385 1.924 1.925-.385 4.644-4.642-1.54-1.54Zm2.56-4.11a3.087 3.087 0 0 0-2.187.909l-6.645 6.645a1 1 0 0 0-.274.51l-.739 3.693a1 1 0 0 0 1.177 1.176l3.693-.738a1 1 0 0 0 .51-.274l6.65-6.646a3.088 3.088 0 0 0-2.185-5.275Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="ml-3">{{ __('sidebar.register_test') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('peserta.dashboard') }}"
                            class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100 group">
                            <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M6 5V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h1a2 2 0 0 1 2 2v2H3V7a2 2 0 0 1 2-2h1ZM3 19v-8h18v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm5-6a1 1 0 1 0 0 2h8a1 1 0 1 0 0-2H8Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="ml-3">{{ __('sidebar.dashboard') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('peserta.history') }}"
                            class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100 group">
                            <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M8 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1h2a2 2 0 0 1 2 2v15a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h2Zm6 1h-4v2H9a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2h-1V4Zm-6 8a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H9a1 1 0 0 1-1-1Zm1 3a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Z"
                                    clip-rule="evenodd" />
                            </svg>

                            <span class="ml-3">{{ __('sidebar.history') }}</span>
                        </a>
                    <li>
                        <a href="{{ route('peserta.requestDokumen') }}"
                            class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100 group">
                            <svg class="w-6 h-6 text-gray-800" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M3 3v18h18M7 8h8M7 12h6m-6 4h4" />
                            </svg>
                            <span class="ml-3">Request Dokumen</span>
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" onsubmit="return confirmLogout(event)">
                            @csrf
                            <button
                                type="submit"
                                class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100 group w-full">
                                <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M16 12H4m12 0-4 4m4-4-4-4m3-4h2a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3h-2" />
                                </svg>
                                <span class="ml-3">{{ __('sidebar.logout') }}</span>
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
                        <span class="ml-3">{{ session('locale') == 'en' ? 'Languange' : 'Language' }}</span>
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
                                    class="block py-3 px-4 text-sm text-gray-700 hover:bg-gray-100">
                                    <div class="inline-flex items-center">
                                        <img src="{{ asset('images/china.jpg') }}" alt="Mandarin Flag"
                                            class="h-4 w-4 rounded-full mr-2" />
                                        Mandarin
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

    // Fungsi konfirmasi logout custom
    function confirmLogout(event) {
        event.preventDefault();  // cegah submit default dulu

        // Buat elemen overlay konfirmasi
        const confirmation = document.createElement('div');
        confirmation.style.position = 'fixed';
        confirmation.style.top = '0';
        confirmation.style.left = '0';
        confirmation.style.width = '100vw';
        confirmation.style.height = '100vh';
        confirmation.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
        confirmation.style.display = 'flex';
        confirmation.style.justifyContent = 'center';
        confirmation.style.alignItems = 'center';
        confirmation.style.zIndex = '9999';

        confirmation.innerHTML = `
        <div class="fade-in" style="
            background: white; 
            padding: 24px 30px; 
            border-radius: 12px; 
            max-width: 320px; 
            width: 90%; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            text-align: center;
            font-family: Arial, sans-serif;
        ">
            <p style="
                margin-bottom: 24px; 
                font-weight: 600; 
                font-size: 18px; 
                color: #111;
            ">
            Apakah kamu yakin ingin logout?
            </p>
            <button id="confirm-yes" style="
                margin-right: 12px; 
                padding: 10px 24px; 
                background-color: #22c55e; 
                color: white; 
                border: none; 
                border-radius: 6px; 
                font-weight: 600;
                font-size: 16px;
                cursor: pointer;
                transition: background-color 0.2s ease;
            " 
            onmouseover="this.style.backgroundColor='#16a34a';" 
            onmouseout="this.style.backgroundColor='#22c55e';"
            >
            Ya
            </button>
            <button id="confirm-no" style="
                padding: 10px 24px; 
                background-color: #ef4444; 
                color: white; 
                border: none; 
                border-radius: 6px; 
                font-weight: 600;
                font-size: 16px;
                cursor: pointer;
                transition: background-color 0.2s ease;
            "
            onmouseover="this.style.backgroundColor='#b91c1c';" 
            onmouseout="this.style.backgroundColor='#ef4444';"
            >
            Tidak
            </button>
        </div>
        `;


        document.body.appendChild(confirmation);

        // Tombol Ya: submit form
        document.getElementById('confirm-yes').onclick = function () {
            event.target.submit();
            document.body.removeChild(confirmation);
        };

        // Tombol Tidak: hapus konfirmasi
        document.getElementById('confirm-no').onclick = function () {
            document.body.removeChild(confirmation);
        };

        return false; // agar form tidak submit otomatis sebelum konfirmasi
    }
</script>
