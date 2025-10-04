<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center space-x-3">
      <div class="bg-gradient-to-r from-yellow-500 to-orange-600 p-2 rounded-lg">
        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
          <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"/>
        </svg>
      </div>
      <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('ブックマーク') }}
      </h2>
    </div>
  </x-slot>

  <div class="py-8">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
      @if($tweets->count() > 0)
        <div class="space-y-6">
          @foreach ($tweets as $tweet)
          <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-xl border border-gray-200 dark:border-gray-700 hover:shadow-xl transition-all duration-300">
            <div class="p-6">
              <!-- ユーザー情報 -->
              <div class="flex items-center space-x-3 mb-4">
                <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-2 rounded-full">
                  <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                  </svg>
                </div>
                <div>
                  <a href="{{ route('profile.show', $tweet->user) }}" class="hover:underline">
                    <p class="font-semibold text-gray-800 dark:text-gray-200">{{ $tweet->user->name }}</p>
                  </a>
                  <p class="text-xs text-gray-500 dark:text-gray-400">{{ $tweet->created_at->format('Y年m月d日 H:i') }}</p>
                </div>
                <!-- ブックマーク済みバッジ -->
                <div class="ml-auto">
                  <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"/>
                    </svg>
                    保存済み
                  </span>
                </div>
              </div>
              
              <!-- Tweet内容 -->
              <div class="mb-4">
                <p class="text-gray-800 dark:text-gray-300 text-lg leading-relaxed">{{ $tweet->tweet }}</p>
              </div>
              
              <!-- アクションボタン -->
              <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-600">
                <div class="flex items-center space-x-6">
                  <!-- いいねボタン -->
                  @if ($tweet->liked->contains(auth()->id()))
                  <form action="{{ route('tweets.dislike', $tweet) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="flex items-center space-x-2 px-3 py-2 rounded-lg bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-900/30 transition-colors duration-200">
                      <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                      </svg>
                      <span class="text-sm font-medium">{{ $tweet->liked->count() }}</span>
                    </button>
                  </form>
                  @else
                  <form action="{{ route('tweets.like', $tweet) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="flex items-center space-x-2 px-3 py-2 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-400 hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-600 dark:hover:text-red-400 transition-colors duration-200">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                      </svg>
                      <span class="text-sm font-medium">{{ $tweet->liked->count() }}</span>
                    </button>
                  </form>
                  @endif

                  <!-- ブックマーク解除ボタン -->
                  <form action="{{ route('bookmarks.destroy', $tweet) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="flex items-center space-x-2 px-3 py-2 rounded-lg bg-yellow-50 dark:bg-yellow-900/20 text-yellow-600 dark:text-yellow-400 hover:bg-yellow-100 dark:hover:bg-yellow-900/30 transition-colors duration-200">
                      <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"/>
                      </svg>
                      <span class="text-sm font-medium">解除</span>
                    </button>
                  </form>
                </div>
                
                <!-- 詳細リンク -->
                <a href="{{ route('tweets.show', $tweet) }}" class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                  <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                  </svg>
                  詳細を見る
                </a>
              </div>
            </div>
          </div>
          @endforeach
        </div>

        <!-- ページネーション -->
        <div class="mt-8">
          {{ $tweets->links() }}
        </div>
      @else
        <!-- 空の状態 -->
        <div class="text-center py-12">
          <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-xl border border-gray-200 dark:border-gray-700 p-8">
            <div class="mb-4">
              <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 19V5z"/>
              </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">
              ブックマークはありません
            </h3>
            <p class="text-gray-500 dark:text-gray-400 mb-6">
              気に入ったTweetをブックマークして、後で簡単に見つけることができます。
            </p>
            <a href="{{ route('tweets.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-lg transition-colors duration-200">
              <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path d="M18 10c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v6c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2v-6zM4 6h12v2H4V6z"/>
              </svg>
              Tweet一覧を見る
            </a>
          </div>
        </div>
      @endif
    </div>
  </div>
</x-app-layout>