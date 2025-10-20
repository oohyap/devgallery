@extends('dashboard.components.main')

@section('container')
    <div class="p-4 rounded-lg dark:border-gray-700 mt-14">
        <div class="mb-5">
            <p class="text-5xl">Manage User Projects</p>
        </div>
        @if (session()->has('success'))
            <div id="alert-3"
                class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-gray-100 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    {{ session('success') }}
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-3" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif
          
         <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Project Title
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Hosting
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Persetujuan</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pendingProjects as $project)
                       <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $loop->iteration }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $project->title }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="https://{{ $project->hosting }}">
                                    {{ $project->hosting }}
                                </a>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <form action="{{ url('/dashboard/allProjects/'. $project->slug.'/approve') }}" method="post" class="inline">
                                    @csrf
                                    <button class="badge py-3 bg-green-700 border-1 h-8">Setujui</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Project Title
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Hosting
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allProjects as $project)
                       <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $loop->iteration }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $project->title }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="https://{{ $project->hosting }}">
                                    {{ $project->hosting }}
                                </a>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="/dashboard/allProjects/{{ $project->slug }}" class="badge py-3 bg-green-600 h-8"><span
                                        class="bi bi-eye"></span></a>
                                <form action="/dashboard/allProjects/{{ $project->slug }}" method="post" class="inline">
                                    @method('delete')
                                    @csrf
                                    <button class="badge py-3 bg-red-700 border-1 h-8" onclick="return confirm('Are you sure deleted this Project?')"><span class="bi bi-x-circle"></span></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
@endsection
