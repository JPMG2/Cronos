
<div>
    @if ($queryacion == 1)
        {{ $nameofModel . " " . "( " . $mainModelName . " )" }}
    @endif

    @if ($queryacion == 2)
        <ul role="list" class="space-y-0.5 divide-y divide-gray-100">
            @foreach ($whatchange as $key => $data)
                @if ($key != "updated_at")
                    <li
                        class="flex items-center justify-between gap-x-6 py-0.5"
                    >
                        <div class="flex min-w-0 gap-x-2">
                            <div
                                class="hidden shrink-0 sm:flex sm:flex-col sm:items-start"
                            >
                                <p class="text-sm text-gray-900">Campo.</p>
                                <p class="mt-0.5 text-xs text-gray-500">
                                    @php
                                        $name = strtolower(substr(strstr($key, "_"), 1));
                                        $nicename = ! empty(config("nicename." . $name)) ? config("nicename." . $name) : $name;
                                    @endphp

                                    {{ strtolower($nicename) }}
                                </p>
                            </div>
                            <div class="min-w-0 flex-auto">
                                <p
                                    class="text-xs font-semibold leading-6 text-red-600"
                                >
                                    antes: {{ $data["old"] }}
                                </p>
                                <p
                                    class="mt-0.5 truncate text-xs leading-5 text-blue-600"
                                >
                                    después: {{ $data["new"] }}
                                </p>
                            </div>
                        </div>
                    </li>
                @endif
            @endforeach
        </ul>
    @endif
</div>
