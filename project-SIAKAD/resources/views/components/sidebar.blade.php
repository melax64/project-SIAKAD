<aside class="w-64 bg-white border-r border-gray-200 min-h-screen fixed left-0 top-[73px]">
    <nav class="p-4">
        <ul class="space-y-1">
            @foreach($menuItems as $item)
                <li>
                    <a href="{{ route($item['route']) }}" 
                       class="w-full flex items-center gap-3 px-4 py-3 rounded-lg transition-all 
                              {{ $activePage === $item['id'] 
                                  ? 'bg-blue-600 text-white shadow-md' 
                                  : 'text-gray-700 hover:bg-gray-100' }}">
                        <i data-lucide="{{ $item['icon'] }}" class="w-5 h-5"></i>
                        <span>{{ $item['label'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>
</aside>
