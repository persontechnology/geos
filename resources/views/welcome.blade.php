<x-guest-layout>
  <x-auth-card>
      <x-slot name="logo">
          <a href="/">
              <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
          </a>
      </x-slot>
      <div class="text-center">
        @auth
        <a class="text-green-900" href="{{ route('dashboard') }}">ADMINISTRACIÓN</a>
        @else
        <a class="text-purple-600	" href="{{ route('login') }}">INGRESAR</a>
        @endauth
        <hr>
        <h1 class="fill-current text-gray-500 text-center"> copyright {{ date('Y') }}</h1>
      </div>
  </x-auth-card>
</x-guest-layout>
