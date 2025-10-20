@extends('dashboard.components.main')

@section('container')
    <div class="p-4 rounded-lg dark:border-gray-700 mt-14">
        <div class="mb-5">
            <p class="text-5xl">Edit project</p>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form class="max-w-xl" method="post" action="/dashboard/projects/{{ $project->slug }}" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-5 mt-12">
                <label for="title" class="block mb-2 text-sm font-medium text-white">Title Project</label>
                <input type="text" id="title" name="title"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Judul Project" autofocus value="{{ old('title', $project->title) }}" />
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="slug" class="block mb-2 text-sm font-medium text-white">Slug</label>
                <input type="text" id="slug" name="slug"
                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    value="{{ old('slug', $project->slug) }}" />
                @error('slug')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="body" class="block mb-2 text-sm font-medium text-white">Description</label>
                <textarea id="body" name="body" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Write your thoughts here..." required>{{ old('body', $project->body) }}</textarea>
                @error('body')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="hosting" class="block mb-2 text-sm font-medium text-white">Link Hosting</label>
                <input type="text" id="hosting" name="hosting"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required value="{{ old('hosting', $project->hosting) }}" />
                @error('hosting')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <label class="block mb-2 text-sm font-medium text-white" for="file_input">Upload Projects Image</label>
            <input type="hidden" name="oldImage" value="{{ $project->image }}">
            @if ($project->image)
                <img src="{{ asset('storage/' . $project->image) }}" class="img-preview w-full mb-3 rounded-lg">
            @else
                <img class="img-preview w-full mb-3 rounded-lg">
            @endif
            <input name="image[]" id="image"
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                aria-describedby="file_input_help" type="file" onchange="previewImage()" multiple>
            @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
    </div>

    <button type="submit"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Upload
        Projects</button>
    </form>
    </div>

    <script>
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function() {
            fetch('/dashboard/projects/checkSlug?title=' + title.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        });

        function previewImage(){
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');
            
            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(OFREvent){
                imgPreview.src = OFREvent.target.result;
            }
        }
    </script>
@endsection
