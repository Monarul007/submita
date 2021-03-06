<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Submit Assignment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-4/5 mx-auto sm:px-6 lg:px-8">
            @if ($success = Session::get('flash_message_success'))
            <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ $success }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>
            <br>
            @endif
            
            @if ($error = Session::get('flash_message_error'))
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
                <div class="flex">
                    <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                    <div>
                    <p class="font-bold">Sorry!</p>
                    <p class="text-sm">{{ $error }}</p>
                    </div>
                </div>
            </div>
            <br>
            @endif

            <form action="{{ url('/user/assignment/submit') }}" id="submit-assignment" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
                <div class="flex flex-wrap -mx-3 mb-2">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="required block text-gray-700 text-sm font-bold mb-2" for="IHSB_no">Your IHSB No</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="IHSB_no" type="text" name="IHSB_no" placeholder="Your IHSB No">
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="required block text-gray-700 text-sm font-bold mb-2" for="class">Your Class:</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="class" type="text" name="class" placeholder="Your Class">
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-2">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="required block text-gray-700 text-xs font-bold mb-2" for="first_name">First Name</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="first_name" type="text" name="first_name" placeholder="Enter First Name...." required>
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label class="required block text-gray-700 text-xs font-bold mb-2" for="last_name">Last Name</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="last_name" type="text" name="last_name" placeholder="Your Last Name...." required>
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-2">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="required block text-gray-700 text-sm font-bold mb-2" for="section">Your Section: </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="section" type="text" name="section" placeholder="Your Section" required>
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="required block text-gray-700 text-sm font-bold mb-2" for="gender">Your Gender: </label>
                        <div class="mt-2">
                            <label class="inline-flex items-center">
                            <input type="radio" class="form-radio" name="gender" value="Male">
                            <span class="ml-2">Male</span>
                            </label>
                            <label class="inline-flex items-center ml-6">
                            <input type="radio" class="form-radio" name="gender" value="Female">
                            <span class="ml-2">Female</span>
                            </label>
                            <label class="inline-flex items-center ml-6">
                            <input type="radio" class="form-radio" name="gender" value="Other">
                            <span class="ml-2">Other</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-2">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="birth_date">Date of Birth: </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="birth_date" type="date" name="birth_date" placeholder="Date of birth">
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Your E-mail Address: </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="email" type="text" name="email" placeholder="Enter E-mail Address....">
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-2">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block text-gray-700 text-xs font-bold mb-2" for="files">
                            Upload Your File(s)
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="files" type="file" name="files[]" placeholder="Your File(s)" multiple>
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label class="block text-gray-700 text-xs font-bold mb-2" for="message">
                            Your Message
                        </label>
                        <textarea name="message" class="resize border rounded-md"></textarea>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Submit
                    </button>
                    <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="/dashboard">
                        Back to mainpage
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>