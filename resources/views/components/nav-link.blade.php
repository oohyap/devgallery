@props(['active' => false])

<a {{ $attributes }} href="/"
    class="{{ $active ? 'bg-gray-900 text-white' : 'text-gray-100 hover:bg-gray-700 hover:text-white' }} rounded-md  px-3 py-2 text-sm font-medium"
    aria-current="{{ $active? 'page' : false }}">{{ $slot }}</a>
