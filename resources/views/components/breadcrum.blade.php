<div>
    <x-headerform.breadcrum-header>
        @foreach ($menu as $breacdata)
            <x-headerform.breadcrum-li>
                {{ $breacdata }}
            </x-headerform.breadcrum-li>
        @endforeach
    </x-headerform.breadcrum-header>
</div>
