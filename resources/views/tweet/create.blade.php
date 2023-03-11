<!-- resources/views/tweet/create.blade.php -->

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('投稿してみよう') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-800 ">
          @include('common.errors')
          <!--フォーム-->
          <form class="mb-6" action="{{ route('tweet.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col mb-4">
              <x-input-label for="tweet" :value="__('Tweet')" />
              <x-text-input id="tweet" class="block mt-1 w-full" type="text" name="tweet" :value="old('tweet')" required autofocus />
              <x-input-error :messages="$errors->get('tweet')" class="mt-2" />
            </div>
            
            <!--テスト用-->
            <div class="flex flex-col mb-4">
              <x-input-label for="tweetTest" :value="__('TweetTest')" />
              <x-text-input id="tweetTest" class="block mt-1 w-full" type="text" name="tweetTest" :value="old('tweetTest')" required autofocus />
              <x-input-error :messages="$errors->get('tweet')" class="mt-2" />
            </div>
            
            
            
            <div class="flex flex-col mb-4">
              <x-input-label for="picture" :value="__('Picture')" />
              <!--<x-text-input id="picture" class="block mt-1 w-full" type="file" name="picture" :value="old('picture')" required autofocus />-->
              <input type="file" accept='image/*' name="picture" onchange="previewImage(this);">
              <x-input-error :messages="$errors->get('tweet')" class="mt-2" />
            </div>
            
        
            <div class="flex flex-col mb-4">
              <x-input-label for="description" :value="__('Description')" />
              <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" required autofocus />
              <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>
            <div class="flex items-center justify-end mt-4">
              <x-primary-button class="ml-3">
                {{ __('投稿') }}
              </x-primary-button>
            </div>
  
                
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>

