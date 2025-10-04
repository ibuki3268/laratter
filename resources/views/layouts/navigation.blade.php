<nav x-data="{ open: false }" class="bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 dark:from-gray-800 dark:via-gray-700 dark:to-gray-600 border-b border-blue-200 dark:border-gray-700 shadow-lg">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16">
      <div class="flex">
        <div class="shrink-0 flex items-center">
          <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 hover:scale-105 transition-transform duration-200">
            <x-application-logo class="block h-9 w-auto fill-current text-white" />
            <span class="text-white font-bold text-xl hidden sm:block">Laratter</span>
          </a>
        </div>

        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
          <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            <svg class="w-4 h-4 mr-2 inline" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 3L3 9v8h4v-6h6v6h4V9l-7-6z"/>
            </svg>
            {{ __('Dashboard') }}
          </x-nav-link>
          <x-nav-link :href="route('tweets.index')" :active="request()->routeIs('tweets.index')">
            <svg class="w-4 h-4 mr-2 inline" fill="currentColor" viewBox="0 0 20 20">
              <path d="M18 10c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v6c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2v-6zM4 6h12v2H4V6z"/>
            </svg>
            {{ __('Tweet一覧') }}
          </x-nav-link>
          <x-nav-link :href="route('tweets.create')" :active="request()->routeIs('tweets.create')">
            <svg class="w-4 h-4 mr-2 inline" fill="currentColor" viewBox="0 0 20 20">
              <path d="M12 4v7l5-3.5L12 4zM2 4h8v2H2V4zm0 4h8v2H2V8zm0 4h5v2H2v-2z"/>
            </svg>
            {{ __('Tweet作成') }}
          </x-nav-link>
          <x-nav-link :href="route('tweets.search')" :active="request()->routeIs('tweets.search')">
            <svg class="w-4 h-4 mr-2 inline" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
            </svg>
            {{ __('Tweet検索') }}
          </x-nav-link>
          
          {{-- ▼ ブックマークリンク ▼ --}}
          <x-nav-link :href="route('bookmarks.index')" :active="request()->routeIs('bookmarks.index')">
            <svg class="w-4 h-4 mr-2 inline" fill="currentColor" viewBox="0 0 20 20">
              <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"/>
            </svg>
            {{ __('ブックマーク') }}
          </x-nav-link>
          
          <x-nav-link :href="route('profile.show', auth()->user())" :active="request()->routeIs('profile.show')">
            <svg class="w-4 h-4 mr-2 inline" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
            </svg>
            {{ __('マイページ') }}
          </x-nav-link>
        </div>
      </div>

      <div class="hidden sm:flex sm:items-center sm:ms-6">
        <x-dropdown align="right" width="48">
          <x-slot name="trigger">
            <button class="inline-flex items-center px-4 py-2 border border-white/20 text-sm leading-4 font-medium rounded-lg text-white bg-white/10 hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-white/50 transition-all duration-200 backdrop-blur-sm">
              <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
              </svg>
              <div>{{ Auth::user()->name }}</div>

              <div class="ms-1">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
              </div>
            </button>
          </x-slot>

          <x-slot name="content">
            <x-dropdown-link :href="route('profile.edit')">
              {{ __('Profile') }}
            </x-dropdown-link>

            <form method="POST" action="{{ route('logout') }}">
              @csrf

              <x-dropdown-link :href="route('logout')"
                  onclick="event.preventDefault();
                                this.closest('form').submit();">
                {{ __('Log Out') }}
              </x-dropdown-link>
            </form>
          </x-slot>
        </x-dropdown>
      </div>

      <div class="-me-2 flex items-center sm:hidden">
        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
          <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
    <div class="pt-2 pb-3 space-y-1">
      <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        {{ __('Dashboard') }}
      </x-responsive-nav-link>
      <x-responsive-nav-link :href="route('tweets.index')" :active="request()->routeIs('tweets.index')">
        {{ __('Tweet一覧') }}
      </x-responsive-nav-link>
      <x-responsive-nav-link :href="route('tweets.create')" :active="request()->routeIs('tweets.create')">
        {{ __('Tweet作成') }}
      </x-responsive-nav-link>
      <x-responsive-nav-link :href="route('tweets.search')" :active="request()->routeIs('tweets.search')">
        {{ __('Tweet検索') }}
      </x-responsive-nav-link>

      <x-responsive-nav-link :href="route('profile.show', auth()->user())" :active="request()->routeIs('profile.show')">
        {{ __('マイページ') }}
      </x-responsive-nav-link>

            {{-- ▼ ブックマークリンク ▼ --}}
      <x-responsive-nav-link :href="route('bookmarks.index')" :active="request()->routeIs('bookmarks.index')">
          {{ __('ブックマーク') }}
      </x-responsive-nav-link>
      
    </div>

    <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
      <div class="px-4">
        <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
      </div>

      <div class="mt-3 space-y-1">
        <x-responsive-nav-link :href="route('profile.edit')">
          {{ __('Profile') }}
        </x-responsive-nav-link>

        <form method="POST" action="{{ route('logout') }}">
          @csrf

          <x-responsive-nav-link :href="route('logout')"
                  onclick="event.preventDefault();
                                this.closest('form').submit();">
            {{ __('Log Out') }}
          </x-responsive-nav-link>
        </form>
      </div>
    </div>
  </div>
</nav>