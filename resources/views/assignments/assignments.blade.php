<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Assignments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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

            @php 
                $now = date("Y-m-d H:i:s");
            @endphp
            @foreach($assignments as $row)
            <div class="w-full flex flex-col bg-white shadow-lg rounded-lg overflow-hidden mb-8">
                <div class="bg-gray-200 text-gray-700 text-lg px-6 py-4">{{ $row->name }}</div>

                <div class="flex justify-between items-center px-6 py-4">
                    @if($row->expire_at > $now )
                    <div class="bg-orange-600 text-xs uppercase px-2 py-1 rounded-full border border-green-600 text-green-600 font-bold"> Active </div>
                    @else 
                    <div class="bg-orange-600 text-xs uppercase px-2 py-1 rounded-full border border-red-600 text-red-600 font-bold"> Expired </div>
                    @endif
                    <div class="text-sm"><?php
                        date_default_timezone_set('Asia/Dhaka');
                        $date = date_create($row->expire_at);
                        echo "<b>Deadline:</b> ".date_format($date, 'jS F Y \: g:i A');
                    ?></div>
                </div>

                <div class="px-6 py-4 border-t border-gray-200">
                    <div class="findme border rounded-lg p-4 bg-gray-200">
                        <?php 
                        $string = $row->instructions;
                        if (strlen($string) > 200) {
                        
                            // truncate string
                            $stringCut = substr($string, 0, 200);
                            $endPoint = strrpos($stringCut, ' ');
                        
                            //if the string doesn't contain any space then it will cut without word basis.
                            $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                            $gg = substr($row->instructions,100,strlen($row->instructions));
                            $string .= '<span class="read-more-show hide_content">...Read More<i class="fa fa-angle-down"></i></span><span class="read-more-content">'.$gg.'<span class="font-bold read-more-hide hide_content">Less <i class="fa fa-angle-up"></i></span> </span>';
                        }else{
                            $string = $row->instructions;
                        }
                        echo $string;
                        ?>
                    </div>
                    <br>
                    <div class="container mx-auto">
                    <div class="flex flex-wrap -mx-1 lg:-mx-4">
                        @foreach( $row->files as $index)
                        <?php
                            $filename = $index->file;
                            $ext = pathinfo($filename, PATHINFO_EXTENSION);
                        ?>
                        <!-- Column -->
                        <div class="relative my-1 px-1 w-32 lg:my-4 lg:px-4">
                            <!-- Article -->
                            <article class="overflow-hidden rounded-lg shadow-lg" style="max-height: 100px;">
                                    <a href="/storage/images/assignment-files/{{ $index->file }}">
                                        @if ($ext == 'gif' || $ext == 'png' || $ext == 'jpg' || $ext == 'webp')
                                            <img alt="Placeholder" class="block h-auto w-full" src="/storage/images/assignment-files/{{ $index->file }}">
                                            @elseif($ext == 'pdf')
                                            <iframe src="/storage/images/assignment-files/{{ $index->file }}" frameborder="0" style="width:100%; height:150px;"></iframe>
                                            @elseif($ext == 'doc' || $ext == 'docx')
                                            <iframe src="/storage/images/assignment-files/{{ $index->file }}" frameborder="0" style="width:100%; height:auto;"></iframe>
                                            @else
                                            <p>No Preview Available!</p>
                                        @endif
                                    
                                </a>
                            </article>
                            <!-- END Article -->
                            <div class="absolute bottom-0 right-1.5">
                                <a href="/storage/images/assignment-files/{{ $index->file }}" download="{{ $index->file }}" class="bg-blue-500 h-5 w-5 text-white text-center font-extrabold flex items-center justify-center rounded-full"><svg class="fill-current w-4 h-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg></a>
                            </div>
                        </div>
                        <!-- END Column -->
                        @endforeach
                    </div>
                </div>
                </div>

                <div class="bg-gray-200 px-6 py-4">
                    <div class="uppercase text-xs text-gray-600 font-bold">Assignment By</div>

                    <div class="flex items-center pt-3">
                        <div class="bg-blue-700 w-12 h-12 flex justify-center items-center rounded-full uppercase font-bold text-white">
                            <?php
                                $str = $row->user->name;
                                $words = explode(' ', $str);
                                $result = $words[0][0]. $words[1][0];
                                echo $result; 
                            ?></div>
                        <div class="ml-4">
                        <p class="font-bold">{{ $row->user->name }}</p>
                        <p class="text-sm text-gray-700 mt-1">Instructor</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <style type="text/css">
        .read-more-show{
            cursor:pointer;
            color: #ed8323;
        }
        .read-more-hide{
            cursor:pointer;
            color: #ed8323;
        }

        .hide_content{
            display: none;
        }
    </style>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script>
        // Hide the extra content initially, using JS so that if JS is disabled, no problemo:
            $('.read-more-content').addClass('hide_content')
            $('.read-more-hide').addClass('hide_content')
            $('.read-more-show').removeClass('hide_content')

            // Set up the toggle effect:
            $("body").on('click', '.read-more-show', function(e) {
              $(this).next('.read-more-content').removeClass('hide_content');
              $(this).addClass('hide_content');
              var p = $(this).closest('.findme').find('.read-more-hide');
              p.removeClass('hide_content');
              e.preventDefault();
            });

            // Changes contributed by @diego-rzg
            $("body").on('click','.read-more-hide', function(e) {
              var p = $(this).closest('.findme').find('.read-more-content');
              p.addClass('hide_content');
              p.prev('.read-more-show').removeClass('hide_content'); // Hide only the preceding "Read More"
              $(this).addClass('hide_content');
              e.preventDefault();
            });
    </script>
</x-app-layout>