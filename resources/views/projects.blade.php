<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <form class="max-w-md mx-auto mt-20">
        @if (request('author'))
            <input type="hidden" name="author" value="{{ request('author') }}">
        @endif
        <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input type="search" autofocus id="search" name="search"
                class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Search Projects..." required autocomplete="" />
            <button type="submit"
                class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
        </div>
    </form>


    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">
        <div class="grid gap-8 mb-6 lg:mb-16 lg:grid-cols-3 md:grid-cols-2 mt-3">
            @forelse ($projects as $project)
            <div class="relative max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <div class="absolute top-3 right-3 bg-white/30 backdrop-invert backdrop-opacity-1 rounded-lg py-1 px-1">{{ $project['created_at']->diffForHumans() }}</div>
                    <a href="/projects/{{ $project['slug'] }}">
                        @if ($project->firstImage)
                            <img class="rounded-lg" src="{{ asset('storage/' . $project->firstImage->image_path) }}"
                                alt="Gambar Pertama Project" />
                        @else
                            <img class="rounded-lg" src="https://picsum.photos/1600/900" alt="Random Image" />
                        @endif
                    </a>
                    <div class="p-5">
                        <a href="/projects/{{ $project['slug'] }}">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $project['title'] }}</h5>
                        </a>
                        <a href="/projects?author={{ $project->author->username }}"
                            class="hover:underline text-base text-gray-400">
                            <h5 class="mb-2 text-xl font-semibold tracking-tight  dark:text-white">
                                {{ $project->author->name }}</h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                            {{ Str::limit($project['body'], 100) }}</p>
                        <a href="/projects/{{ $project['slug'] }}"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Detail Projects
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                    </div>
                </div>
            @empty
                <div class="flex items-center justify-center w-full py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
                    <div class="mx-auto max-w-screen-sm text-center">
                        <h1
                            class="mb-4 text-7xl tracking-tight font-extrabold lg:text-9xl text-primary-600 dark:text-primary-500">
                            404</h1>
                        <p class="mb-4 text-3xl tracking-tight font-bold text-gray-900 md:text-4xl dark:text-white">
                            Something's missing.</p>
                        <p class="mb-4 text-lg font-light text-gray-500 dark:text-gray-400">Sorry, we can't find
                            that project. </p>
                        <a href="/projects"
                            class="inline-flex text-white bg-primary-600 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-primary-900 my-4">Back
                            to Homepage</a>
                </div>
            </div>
            @endforelse
        </div>
        {{ $projects->links() }}
    </div>
</x-layout>
