<footer class="bg-white w-full border-t-[1px] border-gray-200 dark:border-gray-400 mt-4 dark:bg-gray-800">
    <div class="container px-4 py-6 md:flex md:items-center justify-center">
      <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© {{ now()->format('Y') }} <a
              href="{{ route('home') }}"
              class="hover:underline">{{ __('Vaccine System') }}</a>. {{ __('All Rights Reserved.') }}
    </span>
    </div>
</footer>
