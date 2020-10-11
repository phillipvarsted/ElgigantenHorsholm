<div style="background:linear-gradient(0deg, rgba(18, 21, 94, .8), rgba(18, 21, 94, .98)), url('/media/backgrounds/guest-background.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;" class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>

    <div class="mt-2 mb-20">
        <span class="text-gray-500">EG Horsholm v1.0</span>
    </div>
</div>
