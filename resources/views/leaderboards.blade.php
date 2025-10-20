<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    {{-- {{ var_dump($users) }} --}}
    <div class="h-screen">
        @php
            $currentUser = auth()->user();
        @endphp
        <ul class="list bg-zinc-100 text-zinc-800 rounded-box shadow-md mt-5 mb-5 lg:w-5xl md:w-full mx-auto">

            @foreach ($users as $index => $user)
                @php
                    $isCurrentUser = $currentUser && $user->id === $currentUser->id;
                @endphp
                <li class="list-row {{ $isCurrentUser ? 'bg-blue-900 text-white font-bold' : '' }}">
                    <div class="text-4xl font-thin opacity-30 tabular-nums">{{ $index + 1 }}</div>
                    <div><img class="size-10 rounded-box" src="https://img.daisyui.com/images/profile/demo/1@94.webp" />
                    </div>
                    <div class="list-col-grow">
                        <div>{{ $user->name }}</div>
                        <div class="text-xs uppercase font-semibold opacity-60"><span class="text-bold">Point :
                            </span>{{ $user->score }} pts</div>
                    </div>
                    <a href="/projects?author={{ $user->username }}" class="btn btn-square btn-ghost mr-2">
                        Visit
                    </a>
                </li>
            @endforeach

        </ul>
    </div>
</x-layout>
