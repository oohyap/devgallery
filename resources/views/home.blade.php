<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- Hero Section --}}
    <section class="dark:bg-gray-900 bg-white">

        <div
            class="gap-8 items-center py-8 px-4 mx-auto max-w-screen-xl xl:gap-16 md:grid md:grid-cols-2 sm:py-16 lg:px-6">

            <div
                class="relative mx-auto border-gray-800 dark:border-gray-800 bg-gray-800 border-[14px] rounded-[2.5rem] h-[454px] max-w-[341px] md:h-[682px] md:max-w-[512px]">
                <div
                    class="h-[32px] w-[3px] bg-gray-800 dark:bg-gray-800 absolute -start-[17px] top-[72px] rounded-s-lg">
                </div>
                <div
                    class="h-[46px] w-[3px] bg-gray-800 dark:bg-gray-800 absolute -start-[17px] top-[124px] rounded-s-lg">
                </div>
                <div
                    class="h-[46px] w-[3px] bg-gray-800 dark:bg-gray-800 absolute -start-[17px] top-[178px] rounded-s-lg">
                </div>
                <div class="h-[64px] w-[3px] bg-gray-800 dark:bg-gray-800 absolute -end-[17px] top-[142px] rounded-e-lg">
                </div>
                <div class="rounded-[2rem] overflow-hidden h-[426px] md:h-[654px] bg-white dark:bg-gray-800">
                    <img src="https://flowbite.s3.amazonaws.com/docs/device-mockups/tablet-mockup-image.png"
                        class="dark:hidden h-[426px] md:h-[654px]" alt="">
                    <img src="https://flowbite.s3.amazonaws.com/docs/device-mockups/tablet-mockup-image-dark.png"
                        class="hidden dark:block h-[426px] md:h-[654px]" alt="">
                </div>
            </div>

            <div class="mt-4 md:mt-0">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">About us
                </h2>
                <p class="mb-6 font-light text-gray-500 md:text-lg dark:text-gray-400">DevGallery adalah platform
                    kolaboratif bagi developer untuk memamerkan proyek, menemukan inspirasi, dan terhubung dengan sesama
                    kreator. Di sini, setiap kode bercerita, dan setiap ide berpeluang menjadi nyata.</p>
            </div>
        </div>
    </section>
    
</x-layout>
