<x-guest-layout>
  <x-auth-card>
      <x-slot name="logo">
          <a href="/">
              <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
          </a>
      </x-slot>
      
        @auth
        <a class="text-green-900" href="{{ route('dashboard') }}">ADMINISTRACIÓN</a>
        @else
        <a class="text-purple-600	" href="{{ route('login') }}">INGRESAR</a>
        @endauth
        <hr>
        <small>&copy; {{ date('Y') }}</small>
      
  </x-auth-card>
</x-guest-layout>
