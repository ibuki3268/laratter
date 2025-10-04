
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-2 rounded-lg">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 3L3 9v8h4v-6h6v6h4V9l-7-6z"/>
                </svg>
            </div>
            <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- ウェルカムカード -->
            <div class="bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-800 dark:to-gray-700 overflow-hidden shadow-xl sm:rounded-lg mb-6 border border-blue-200 dark:border-gray-600">
                <div class="p-8">
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="bg-blue-500 p-3 rounded-full">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200">ようこそ、{{ Auth::user()->name }}さん！</h3>
                            <p class="text-gray-600 dark:text-gray-400">Laratterへログインしました</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                        <a href="{{ route('tweets.index') }}" class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow hover:shadow-lg transition-shadow duration-200 border border-gray-200 dark:border-gray-600">
                            <div class="flex items-center space-x-3">
                                <div class="bg-green-100 dark:bg-green-900 p-2 rounded-lg">
                                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M18 10c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v6c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2v-6zM4 6h12v2H4V6z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 dark:text-gray-200">Tweet一覧</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">みんなのTweetを見る</p>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('tweets.create') }}" class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow hover:shadow-lg transition-shadow duration-200 border border-gray-200 dark:border-gray-600">
                            <div class="flex items-center space-x-3">
                                <div class="bg-blue-100 dark:bg-blue-900 p-2 rounded-lg">
                                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M12 4v7l5-3.5L12 4zM2 4h8v2H2V4zm0 4h8v2H2V8zm0 4h5v2H2v-2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 dark:text-gray-200">Tweet作成</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">新しいTweetを投稿</p>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('bookmarks.index') }}" class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow hover:shadow-lg transition-shadow duration-200 border border-gray-200 dark:border-gray-600">
                            <div class="flex items-center space-x-3">
                                <div class="bg-yellow-100 dark:bg-yellow-900 p-2 rounded-lg">
                                    <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 dark:text-gray-200">ブックマーク</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">保存したTweet</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>