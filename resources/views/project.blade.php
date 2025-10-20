<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section class="py-8 bg-gray-50 md:py-16 dark:bg-gray-900 antialiased rounded-lg mt-3 mb-3">
        <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
                <div id="gallery" class="relative w-full " data-carousel="slide">
                    {{-- <div class="shrink-0 max-w-md lg:max-w-lg mx-auto"> --}}
                    {{-- <img class="absolute block w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" src="{{ asset('storage/' . $project->image) }}" alt="" /> --}}


                    <!-- Carousel wrapper -->
                    <div class="relative h-56 overflow-hidden md:h-96">
                        @foreach ($project->images as $img)
                            <div class="hidden duration-700 ease-in-out bg-gray-50" data-carousel-item>
                                <img class="absolute block w-full h-auto -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 rounded-lg"
                                    src="{{ asset('storage/' . $img->image_path) }}" alt="" />

                            </div>
                        @endforeach
                    </div>
                    <!-- Slider controls -->
                    <button type="button"
                        class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                        data-carousel-prev>
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 1 1 5l4 4" />
                            </svg>
                            <span class="sr-only">Previous</span>
                        </span>
                    </button>
                    <button type="button"
                        class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                        data-carousel-next>
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="sr-only">Next</span>
                        </span>
                    </button>
                    {{-- </div> --}}

                </div>

                <div class="mt-6 sm:mt-8 lg:mt-0">
                    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                        {{ $project['title'] }}
                    </h1>
                    <p class="text-black">
                        Author : <b class="text-gray-600">{{ $project->author->name }}</b>
                    </p>
                    <div class="mt-4 sm:items-center sm:gap-4 sm:flex">

                        <div class="flex items-center gap-2 mt-2 sm:mt-0">
                            <a href="#"
                                class="text-sm font-medium leading-none text-gray-900 underline hover:no-underline dark:text-white">
                                {{ count($project->comment) }} Reviews
                            </a>
                        </div>
                    </div>

                    <div class="mt-6 sm:gap-4 sm:items-center sm:flex sm:mt-8">
                        <a href="../projects" title=""
                            class="text-white mt-4 sm:mt-0 bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800 flex items-center justify-center"
                            role="button">
                            &laquo; Back to Projects
                        </a>
                        <a href="https://{{ $project['hosting'] }}" target="_blank" title=""
                            class="flex items-center justify-center py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                            role="button">
                            Visit Website
                        </a>

                    </div>

                    <hr class="my-6 md:my-8 border-gray-200 dark:border-gray-800" />

                    <p class="mb-6 text-gray-500 dark:text-gray-400">
                        {{ $project['body'] }}
                    </p>
                </div>
            </div>
        </div>
        <div class="max-w-2xl mx-auto px-4">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Komentar
                    ({{ count($project->comment) }})</h2>
            </div>
            <form class="mb-6" method="post" action="{{ route('comments.store') }}">
                @csrf
                <input type="hidden" name="project_id" value="{{ $project->id }}">
                <div
                    class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <label for="content" class="sr-only bg-amber-100">Your Comment</label>
                    <textarea id="content" name="content" rows="6"
                        class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                        placeholder="Write a comment..." value="{{ old('content') }}" required></textarea>
                    @error('content')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                @if (session()->has('success'))
                    <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                        role="alert">
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                @endif
                @can('admin')
                    <button type="submit"
                        class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                        Post comment
                    </button>
                </form>

                @foreach ($project->comment as $comment)
                    <article class="p-6 text-base bg-white rounded-lg dark:bg-gray-900 mb-3">
                        <footer class="flex justify-between items-center mb-2">
                            <div id="comments-container" class="flex items-center">
                                <p
                                    class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">
                                    <img class="mr-2 w-6 h-6 rounded-full"
                                        src="https://flowbite.com/docs/images/people/profile-picture-2.jpg"
                                        alt="Michael Gough">{{ $comment->author->name }}
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="2022-02-08"
                                        title="February 8th, 2022">{{ $comment['created_at']->diffForHumans() }}</time>
                                </p>
                            </div>
                            <!-- Dropdown menu -->
                        </footer>
                        <p class="text-gray-500 dark:text-gray-400">{{ $comment->content }}</p>
                        <div class="flex items-center mt-4 space-x-4">
                            <button type="button"
                                class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400 font-medium">
                                <svg class="mr-1.5 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 20 18">
                            </button>
                        </div>
                    </article>
                @endforeach
            @endcan
            {{-- <button type="submit" id="load-more-btn"
                class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                Load More
            </button> --}}
        </div>
    </section>
</x-layout>
