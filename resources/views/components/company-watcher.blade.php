<div>
    @if (session("status"))
        <x-headerform.banner type="{{session('status.1')}}">
            {{ session("status.0") }}
            @if (session("status.1") === "error")
                <a
                    href="{{ route("re_company") }}"
                    class="text-white-600 underline"
                >
                    Ir a registro.
                </a>
            @endif
        </x-headerform.banner>
    @endif
</div>
