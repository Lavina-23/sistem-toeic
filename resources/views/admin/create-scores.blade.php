<x-layout>
    <x-sidebaradmin />
    <section class="p-4 md:ml-52 h-auto mt-10 md:mt-0 bg-gray-50 min-h-screen">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">{{ __('scoreAdmin.title') }}</h1>
        
        <!-- Import Form -->
        <div class="w-full bg-white rounded-xl shadow-md border border-gray-200 p-6 mb-6">
            @if (session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('score.import') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-gray-700 mb-2 font-medium">{{ __('scoreAdmin.file') }}</label>
                    <input type="file" name="file" accept=".xls,.xlsx" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-teal-200">
                </div>
                <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-[#001a5c] transition">
                    Import
                </button>
            </form>
        </div>

        <!-- Score Data Table -->
        <div class="w-full bg-white rounded-xl shadow-md border border-gray-200 overflow-hidden">
            <div class="flex justify-between items-center p-6 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-200">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">{{__('scoreAdmin.manti')}}</h2>
                    <p class="text-sm text-gray-600 mt-1">{{__('scoreAdmin.manage')}}</p>
                </div>
                <div class="text-right">
                    <div class="text-sm text-gray-600">Total Records</div>
                    <div class="text-2xl font-bold text-blue-600">{{ $scores->count() }}</div>
                </div>
            </div>

            <div class="p-6">
                @if($scores->count() > 0)
                    <!-- Search and Filter -->
                    <div class="mb-6 space-y-4">
                        <div class="flex flex-col lg:flex-row gap-4">
                            <div class="flex-[3]">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                    <input type="text" id="searchInput" placeholder="🔍 Cari berdasarkan nama atau no induk..."
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                </div>
                            </div>
                            <div class="flex flex-wrap gap-3 flex-[3]">
                                <select id="categoryFilter" class="px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white min-w-[220px]">
                                    <option value="">🏷️ Semua Kategori</option>
                                    @foreach($scores->pluck('category')->unique()->filter() as $category)
                                        <option value="{{ $category }}">{{ $category }}</option>
                                    @endforeach
                                </select>
                                <select id="groupFilter" class="px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white min-w-[220px]">
                                    <option value="">👥 Semua Group</option>
                                    @foreach($scores->pluck('group')->unique()->filter() as $group)
                                        <option value="{{ $group }}">{{ $group }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                        </div>
                    </div>

                <!-- Table -->
                <div class="overflow-x-auto shadow-lg rounded-lg border border-gray-200">
                    <table class="min-w-full table-fixed border-collapse bg-white">
                        <thead>
                            <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b-2 border-gray-200">
                                <th class="w-16 px-3 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">No</th>
                                <th class="w-24 px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">{{__('scoreAdmin.Result')}}</th>
                                <th class="w-48 px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">{{__('scoreAdmin.name')}}</th>
                                <th class="w-32 px-4 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">{{__('scoreAdmin.niduk')}}</th>
                                <th class="w-28 px-4 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">{{__('scoreAdmin.ScrlL')}}</th>
                                <th class="w-28 px-4 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">{{__('scoreAdmin.ScrlR')}}</th>
                                <th class="w-32 px-4 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">{{__('scoreAdmin.total')}}</th>
                                <th class="w-24 px-4 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">{{__('scoreAdmin.group')}}</th>
                                <th class="w-28 px-4 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">{{__('scoreAdmin.pos')}}</th>
                                <th class="w-32 px-4 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">{{__('scoreAdmin.cat')}}</th>
                                <th class="w-28 px-4 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider border-r border-gray-200">{{__('scoreAdmin.date')}}</th>
                            </tr>
                        </thead>
                        <tbody id="scoreTableBody" class="bg-white divide-y divide-gray-100">
                            @foreach($scores as $index => $score)
                                <tr class="hover:bg-blue-50 transition-colors duration-200 score-row" data-name="{{ strtolower($score->name) }}" data-no-induk="{{ $score->no_induk }}" data-category="{{ $score->category }}" data-group="{{ $score->group }}">
                                    <td class="px-3 py-4 text-sm font-medium text-gray-900 border-r border-gray-100">
                                        <div class="flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full text-xs font-bold">
                                            {{ $index + 1 }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-900 border-r border-gray-100 font-mono">
                                        {{ $score->result_no ?? '-' }}
                                    </td>
                                    <td class="px-4 py-4 text-sm font-semibold text-gray-900 border-r border-gray-100">
                                        <div class="truncate" title="{{ $score->name }}">
                                            {{ $score->name }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-900 border-r border-gray-100 font-mono">
                                        {{ $score->no_induk }}
                                    </td>
                                    <td class="px-4 py-4 text-sm text-center border-r border-gray-100">
                                        <div class="space-y-1">
                                            <span class="inline-flex px-3 py-1 text-xs font-bold bg-blue-100 text-blue-800 rounded-full min-w-[60px] justify-center">
                                                {{ number_format($score->score_l, 1) }}
                                            </span>
                                            @if($score->last_score_l)
                                                <div class="text-xs text-gray-500">
                                                    <span class="bg-gray-100 px-2 py-0.5 rounded text-xs">{{ number_format($score->last_score_l, 1) }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-sm text-center border-r border-gray-100">
                                        <div class="space-y-1">
                                            <span class="inline-flex px-3 py-1 text-xs font-bold bg-green-100 text-green-800 rounded-full min-w-[60px] justify-center">
                                                {{ number_format($score->score_r, 1) }}
                                            </span>
                                            @if($score->last_score_r)
                                                <div class="text-xs text-gray-500">
                                                    <span class="bg-gray-100 px-2 py-0.5 rounded text-xs">{{ number_format($score->last_score_r, 1) }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-sm text-center border-r border-gray-100">
                                        <div class="space-y-1">
                                            <span class="inline-flex px-3 py-1 text-sm font-bold bg-purple-100 text-purple-800 rounded-full min-w-[70px] justify-center">
                                                {{ number_format($score->score_total, 1) }}
                                            </span>
                                            @if($score->last_score_total)
                                                <div class="text-xs text-gray-500">
                                                    <span class="bg-gray-100 px-2 py-0.5 rounded text-xs">{{ number_format($score->last_score_total, 1) }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-sm text-center text-gray-900 border-r border-gray-100">
                                        @if($score->group)
                                            <span class="inline-flex px-2 py-1 text-xs font-medium bg-indigo-100 text-indigo-800 rounded">
                                                {{ $score->group }}
                                            </span>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 text-sm text-center border-r border-gray-100">
                                        @if($score->position)
                                            <span class="inline-flex px-3 py-1 text-xs font-bold bg-yellow-100 text-yellow-800 rounded-full">
                                                #{{ $score->position }}
                                            </span>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 text-sm text-center text-gray-900 border-r border-gray-100">
                                        @if($score->category)
                                            <span class="inline-flex px-2 py-1 text-xs font-medium bg-teal-100 text-teal-800 rounded">
                                                {{ $score->category }}
                                            </span>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 text-sm text-center text-gray-900 border-r border-gray-100 font-mono">
                                        @if($score->test_date)
                                            <span class="text-xs bg-gray-100 px-2 py-1 rounded">
                                                {{ \Carbon\Carbon::parse($score->test_date)->format('d/m/Y') }}
                                            </span>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($scores instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    <div class="mt-8 flex justify-center">
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-2">
                            {{ $scores->links() }}
                        </div>
                    </div>
                @endif
            </div>
        @else
            <div class="text-center py-16">
                <div class="text-6xl text-gray-300 mb-4">📊</div>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">{{__('scoreAdmin.notyet')}}</h3>
                <p class="text-gray-500 mb-4">{{__('scoreAdmin.imp')}}</p>
                <div class="text-sm text-gray-400">
                    <p>{{__('scoreAdmin.format')}}</p>
                </div>
            </div>
        @endif
        </div>
    </section>

    <style>
        /* Custom styles for wider table */
        .min-w-full {
            min-width: 1200px;
        }
        
        /* Ensure table stretches full width */
        .table-fixed {
            table-layout: fixed;
            width: 100%;
        }
        
        /* Better scrollbar styling */
        .overflow-x-auto::-webkit-scrollbar {
            height: 8px;
        }
        
        .overflow-x-auto::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 4px;
        }
        
        .overflow-x-auto::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        
        .overflow-x-auto::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        
        /* Enhanced hover effects */
        .score-row:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        /* Better mobile responsiveness */
        @media (max-width: 768px) {
            .min-w-full {
                min-width: 1000px;
            }
        }
    </style>

    <!-- JavaScript for Search and Filter -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const categoryFilter = document.getElementById('categoryFilter');
            const groupFilter = document.getElementById('groupFilter');
            const rows = document.querySelectorAll('.score-row');

            function filterTable() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedCategory = categoryFilter.value;
                const selectedGroup = groupFilter.value;

                rows.forEach(row => {
                    const name = row.dataset.name;
                    const noInduk = row.dataset.noInduk;
                    const category = row.dataset.category;
                    const group = row.dataset.group;

                    const matchesSearch = name.includes(searchTerm) || noInduk.includes(searchTerm);
                    const matchesCategory = !selectedCategory || category === selectedCategory;
                    const matchesGroup = !selectedGroup || group === selectedGroup;

                    if (matchesSearch && matchesCategory && matchesGroup) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            searchInput.addEventListener('input', filterTable);
            categoryFilter.addEventListener('change', filterTable);
            groupFilter.addEventListener('change', filterTable);
        });


    </script>
</x-layout>