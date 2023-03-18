<!-- resources/views/tweet/edit.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>イエつく！！</title>
      
<!-- Select2.css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css">
<!-- jquery & iScroll -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Select2本体 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
<script src="{{ asset('js/test.js') }}"></script>
        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>
      <x-app-layout>
        <x-slot name="header">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('編集画面') }}
          </h2>
        </x-slot>

      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-800 ">
          @include('common.errors')
          
          
          <!--フォーム開始-->
          <form class="mb-6" action="{{ route('tweet.update',$tweet->id) }}" method="POST">
            @method('put')
            @csrf
            
            <!--tweet-->
            <div class="flex flex-col mb-4">
              <x-input-label for="tweet" :value="__('Tweet')" />
              <x-text-input id="tweet" class="block mt-1 w-full" type="text" name="tweet" value="{{$tweet->tweet}}" required autofocus />
              <x-input-error :messages="$errors->get('tweet')" class="mt-2" />
            </div>
            
            
            <!--Description-->
            <div class="flex flex-col mb-4">
              <x-input-label for="description" :value="__('tags')" />
              <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" value="{{$tweet->description}}" autofocus />
              <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>
 
            <!--Tags-->
            <select class="select2 html block mt-1 w-full" name="tags[]"   multiple>
                <option value="a">キッチン</option>
                <option value="b">リビング</option>
                <option value="c">風呂</option>
                <option value="d">洗面</option>
                <option value="e">和室</option>
            </select>
            <script>
              $(".select2.html").select2({
                placeholder: "タグを選択"
              });
            </script>
            
            <!--画像-->
            <img src="{{ asset('storage/image/'.$tweet->image)}}"　class="mx-auto" style="height:300px;">
            
            <div class="flex items-center justify-end mt-4">
              <!--前画面に戻るボタン-->
              <a href="{{ url()->previous() }}">
                <x-secondary-button class="ml-3">
                  {{ __('Back') }}
                </x-primary-button>
              </a>
              <!--更新ボタン-->
              <x-primary-button class="ml-3">
                {{ __('Update') }}
              </x-primary-button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


</x-app-layout>

    </body>
</html>



