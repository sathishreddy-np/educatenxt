<div style="display: flex; gap: 10px;">
    @foreach ($routes as $route)
        @if ($route['method'] === 'GET')
            <a href="{{ route($route['route'], $id) }}" class="btn {{ $route['class'] }} btn-sm"
                @if ($route['onClick'])
                    onclick="return confirm('{{ $route['onClickMessage'] }}')"
                @endif>
                <i class="{{ $route['icon'] }}"></i>
            </a>
        @else
            <form action="{{ route($route['route'], $id) }}" method="POST" style="display:inline;">
                @csrf
                @method($route['method'])
                <button type="submit" class="btn {{ $route['class'] }} btn-sm"
                    @if ($route['onClick'])
                        onclick="return confirm('{{ $route['onClickMessage'] }}')"
                    @endif>
                    <i class="{{ $route['icon'] }}"></i>
                </button>
            </form>
        @endif
    @endforeach
</div>
