<div class="sidebar fixed h-screen z-50 shadow-xl transition-all duration-400 w-64 lg:w-64" 
        style="background-color: var(--sidebar-bg); color: var(--sidebar-text); transform: translateX(-100%);" 
        id="sidebar">
    <div class="sidebar-header p-5 border-b border-white border-opacity-10 flex justify-between items-center">
        <h2 class="text-xl font-bold">LMS Dashboard</h2>
        <button class="sidebar-close lg:hidden bg-transparent border-none cursor-pointer" 
                style="color: var(--sidebar-text);" onclick="toggleSidebar()">
            <i class="fas fa-times text-lg"></i>
        </button>
    </div>
    <nav class="sidebar-menu py-4">
        @foreach (config('sidebar')['items'] as $item)
        @php
            $isActive = false;
            foreach ($item['active_on'] ?? [] as $pattern) {
                if (request()->routeIs($pattern)) {
                    $isActive = true;
                    break;
                }
            }
        @endphp
       {{-- <a
            href="{{ route($item['route']) }}"
            class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors {{ $isActive ? 'bg-blue-600 text-white font-medium shadow-md' : 'text-gray-700 hover:bg-gray-100' }}"
        >
            <i data-lucide="{{ $item['icon'] }}" class="w-5 h-5"></i>
            <span>{{ $item['text'] }}</span>
        </a> --}}
        <a href="{{ route($item['route']) }}" class="menu-item flex items-center px-5 py-3 transition-colors duration-300 hover:bg-white hover:bg-opacity-10 no-underline {{ $isActive ? 'bg-blue-600 text-white font-medium shadow-md' : 'text-gray-700 hover:bg-gray-100' }}" 
            style="color: var(--sidebar-text);">
            <i class="{{ $item['icon'] }}"></i>
            {{ $item['text'] }}
        </a>
    @endforeach
        
    </nav>
</div>