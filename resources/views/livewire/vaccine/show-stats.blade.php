<div class="flex flex-col gap-4">
    <div>
        <h3 class="text-black dark:text-white font-medium text-lg mb-3">{{ __('Details:') }}</h3>
        <div class="relative overflow-x-auto">
            <table
                class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border-t-2 dark:border-gray-700">
                <tbody>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ __('Name:') }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $registration?->name ?? '' }}
                    </td>
                </tr>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ __('Disease:') }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $registration?->disease_display_name ?? '' }}
                    </td>
                </tr>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ __('Vaccine Name:') }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $registration?->vaccine?->name ?? '' }}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div>
        <h3 class="text-black dark:text-white font-medium text-lg mb-3">{{ __('Doses:') }}</h3>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Name') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Schedule At') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Vaccinated At') }}
                    </th>
                </tr>
                </thead>
                <tbody>
                @if($registration?->vaccinations->count() > 0)
                    @foreach($registration?->vaccinations as $vaccination)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ __('Dose: :number',['number'=>$vaccination->dose_number]) }}
                            </th>
                            <td class="px-6 py-4">
                                @if($vaccination->scheduled_at)
                                    <x-badge variant="info">
                                        {{ $vaccination->scheduled_at->format('d F, Y h:i a') }}
                                    </x-badge>
                                @else
                                    <x-badge variant="danger">
                                        {{ __('Not Schedule') }}
                                    </x-badge>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($vaccination->vaccinated_at)
                                    <x-badge variant="success">
                                        {{ $vaccination->vaccinated_at->format('d F, Y h:i a') }}
                                    </x-badge>
                                @else
                                    <x-badge variant="danger">
                                        {{ __('Not Vaccinated') }}
                                    </x-badge>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
