<x-app-layout>
    @php
        // Get total days in the selected month
        $daysInMonth = $firstDay->daysInMonth;

        // Get the first weekday (0 = Sunday, 1 = Monday, ...)
        $startDayOfWeek = $firstDay->dayOfWeek;

        // Previous and Next Month Links
        $prevMonth = $firstDay->copy()->subMonth();
        $nextMonth = $firstDay->copy()->addMonth();

        $currentDay = now()->format('d');
    @endphp

    <section class="px-5 pt-24 lg:px-14 xl:px-24 pb-20">
        <a href="/PersonalProfile" class="flex items-center space-x-2 text-gray-700 font-medium hover:text-gray-500 hvr-icon-back">
            <i class="fa-solid fa-arrow-left-long hvr-icon"></i>
            <span>Back</span>
        </a>
        <div class="text-center mx-auto">
            <div class="flex justify-center gap-4 my-4 items-center">
                <a href="{{ route('user.calendar', ['month' => $prevMonth->month, 'year' => $prevMonth->year]) }}" 
                    class="text-customYellow text-2xl font-bold"><i class="fa-solid fa-angle-left"></i></a>

                <h3 class="text-3xl lg:text-4xl text-customYellow font-extrabold">{{ $firstDay->format('F Y') }}</h3>

                <a href="{{ route('user.calendar', ['month' => $nextMonth->month, 'year' => $nextMonth->year]) }}" 
                    class="text-customYellow text-2xl font-bold"><i class="fa-solid fa-angle-right"></i></a>
            </div>

            <table class="w-full bg-calendarLightYellow table-fixed overflow-hidden rounded-3xl">
                <thead class="bg-calendarDarkYellow">
                    <tr>
                        <th class="text-white p-3">Sun</th>
                        <th class="text-white p-3">Mon</th>
                        <th class="text-white p-3">Tue</th>
                        <th class="text-white p-3">Wed</th>
                        <th class="text-white p-3">Thu</th>
                        <th class="text-white p-3">Fri</th>
                        <th class="text-white p-3">Sat</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        {{-- Empty cells before the first day --}}
                        @for ($i = 0; $i < $startDayOfWeek; $i++)
                            <td class="h-14 sm:h-24"></td>
                        @endfor

                        {{-- Calendar days --}}
                        @for ($day = 1; $day <= $daysInMonth; $day++)
                            @php
                                $formattedDay = str_pad($day, 2, '0', STR_PAD_LEFT); // Format as "01", "02", etc.
                                $isToday = $formattedDay == $currentDay;
                            @endphp

                            <td class="h-14 sm:h-24 relative text-center">
                                @if ($isToday)
                                    <a href="{{ route('foodpost.create') }}" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-xl font-bold rounded-full bg-calendarDarkYellow w-7 h-7 hover:bg-yellow-400"><i class="fa-solid fa-plus text-white"></i></a>
                                @else
                                    {{-- Displaying food post images as background --}}
                                    @if (isset($posts[$formattedDay]))
                                        @foreach ($posts[$formattedDay] as $post)
                                            <div class="absolute inset-0 bg-cover bg-center rounded-xl" 
                                                style="background-image: url('{{ asset($post->image) }}');">
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="flex justify-center items-center">
                                            <p class="bg-gray-300 w-3 h-3 rounded-full"> </p>
                                        </div>
                                    @endif
                                @endif
                            </td>
                            {{-- Start new row after Saturday --}}
                            @if (($day + $startDayOfWeek) % 7 == 0)
                                </tr><tr>
                            @endif
                        @endfor
                        {{-- Empty cells after the last day --}}
                        @for ($i = ($daysInMonth + $startDayOfWeek) % 7; $i < 7 && $i != 0; $i++)
                            <td class="h-14 sm:h-24"></td>
                        @endfor
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</x-app-layout>
