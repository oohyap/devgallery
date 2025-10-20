<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <title>{{ $title }}</title>
</head>

<body class="h-full">
    <div class="min-h-full">

        <x-navbar></x-navbar>

        @if (request()->routeIs('home') || !request()->is('/'))
            <x-header>{{ $title }}</x-header>
        @endif

        @if (request()->routeIs('home') || request()->is('/'))
            <x-jumbotron />
        @endif


        <main>
            <div class="mx-auto w-full px-4 sm:px-6 lg:px-8">
                <!-- Your content -->
                {{ $slot }}
            </div>
        </main>
        <x-footer></x-footer>
    </div>

    
</body>
<script>
    let currentPage = 1;
const perPage = 5;

document.getElementById('load-more-btn').addEventListener('click', function () {
    fetch(`/get-comments.php?page=${currentPage + 1}&limit=${perPage}`)
        .then(response => response.json())
        .then(data => {
            if (data.comments.length > 0) {
                currentPage++;
                renderComments(data.comments);
                if (!data.hasMore) {
                    document.getElementById('load-more-btn').style.display = 'none';
                }
            }
        });
});

function renderComments(comments) {
    const container = document.getElementById('comments-container');
    comments.forEach(comment => {
        const div = document.createElement('div');
        div.innerHTML = `<p>${comment.author}: ${comment.text}</p>`;
        container.appendChild(div);
    });
}

</script>

</html>
