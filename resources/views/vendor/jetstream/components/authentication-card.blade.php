<div id="overlay" class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100" style="background-image: url('storage/images/theme/undraw_remotely_2j6y.svg');background-repeat: no-repeat; background-size: contain;">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
    @if ( Route::current()->uri == 'login' || Route::current()->uri == '/')
    <br>
    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="/register" style="text-align: center;padding: 5px 10px;border-radius: 4px;background: white;">Don't have an account? Create here</a>
    @endif
</div>
