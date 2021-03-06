<x-app-layout>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    @foreach($data as $row)
        @php($name = $row->name)
        @php($id = $row->id)
        @php($instruction = $row->instructions)
        @php($expire = $row->expire_at)
    @endforeach
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Assignment') }}
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
            
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="{{route('assignments.edit', $id)}}" id="create-assignment" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="nine"><span>ASSIGNMENT INFROMATIONS</span></div>
                <div class="flex flex-wrap -mx-3 mb-2">
                    <div class="w-full px-3 mb-6 md:mb-0">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Name</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" name="name" value="{{ $name }}">
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-2">
                    <div class="w-full px-3">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="instructions">
                            Instructions
                        </label>
                        <textarea name="instructions" class="resize border rounded-md">{{ $instruction }}</textarea>
                        <script>
                            CKEDITOR.replace( 'instructions' );
                        </script>
                    </div>
                </div>
                <br>
                <hr>
                <br>
                <div class="nine"><span>ASSIGNMENT FILES</span></div>
                <div class="container mx-auto">
                    <div class="flex flex-wrap -mx-1 lg:-mx-4">
                        @foreach( $files as $row)
                        <?php
                            $filename = $row->file;
                            $ext = pathinfo($filename, PATHINFO_EXTENSION);
                        ?>
                        <!-- Column -->
                        <div class="relative my-1 px-1 w-32 lg:my-4 lg:px-4">
                            <!-- Article -->
                            <article class="overflow-hidden rounded-lg shadow-lg">
                                    <a href="#">
                                        @if ($ext == 'gif' || $ext == 'png' || $ext == 'jpg' || $ext == 'webp')
                                            <img alt="Placeholder" class="block h-auto w-full" src="/storage/images/assignment-files/{{ $row->file }}">
                                            @elseif($ext == 'pdf')
                                            <iframe src="/storage/images/assignment-files/{{ $row->file }}" frameborder="0" style="width:100%; height:auto;"></iframe>
                                            @elseif($ext == 'doc' || $ext == 'docx')
                                            <iframe src="/storage/images/assignment-files/{{ $row->file }}" frameborder="0" style="width:100%; height:auto;"></iframe>
                                            @else
                                            <p>No Preview Available!</p>
                                        @endif
                                    
                                </a>
                            </article>
                            <!-- END Article -->
                            <div class="absolute -top-1.5 right-1.5">
                                <a href="#" id="deleteFile" data-id="{{ $row->id }}" class="bg-red-500 h-5 w-5 text-white text-center font-extrabold flex items-center justify-center rounded-full">x</a>
                            </div>
                        </div>
                        <!-- END Column -->
                        @endforeach
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-2">
                    <div class="w-full px-3 mb-6 md:mb-0">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="files">
                            Upload Your Files
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="files" type="file" name="files[]" multiple>
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-2">
                    <div class="w-full px-3 mb-6 md:mb-0">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="grid-first-name">Due Dates</label>
                        <span style="color:#FCA5A5">Submissions are accepted after this date, but are marked <b>Late</b></span>
                        <br>
                        <div class="text-sm"><b>Current Due Date: {{ $expire }}</b></div>
                        <input type="datetime-local" value="<?php echo date("c", strtotime($expire)); ?>" id="due-dates" name="due-dates" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Update Assignment
                    </button>
                    <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="/dashboard">
                        Back to Main Page
                    </a>
                </div>
            </form>
        </div>
    </div>
    <script>
        // $('textarea').ckeditor();
        // $('.textarea').ckeditor(); // if class is prefered.
        $(document).ready(function () {

            $("body").on("click","#deleteFile",function(e){

            if(!confirm("Do you really want to do this?")) {
                return false;
            }

            e.preventDefault();
            var id = $(this).data("id");
            // var id = $(this).attr('data-id');
            var token = $("meta[name='csrf-token']").attr("content");
            var url = e.target;

            $.ajax(
                {
                    url: url.href, //or you can use url: "company/"+id,
                    type: 'DELETE',
                    data: {
                    _token: token,
                        id: id
                },
                success: function (response){

                    alert('Successful');

                    // $("#success").html(response.message)

                    // Swal.fire(
                    //     'Success!',
                    //     'Company deleted successfully!',
                    //     'success'
                    // )
                }
            });
                return false;
            });

        });
    </script>
</x-app-layout>