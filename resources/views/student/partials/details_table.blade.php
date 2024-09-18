{{--@if(!empty($quizzes))--}}
{{--    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">--}}
{{--        <thead class="bg-gray-50 dark:bg-gray-700">--}}
{{--        <tr>--}}
{{--            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">@lang('trad.Quiz Name')</th>--}}
{{--            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">@lang('trad.Grade')</th>--}}
{{--            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">@lang('trad.Date')</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">--}}
{{--        @foreach ($quizzes as $quizMark)--}}
{{--            <tr>--}}
{{--                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-300">{{ $quizMark->quiz->name }}</td>--}}
{{--                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-300">--}}
{{--                    {{ $quizMark->mark !== null ? number_format($quizMark->mark, 2, '.', '') : '@lang('trad.N/A')' }}--}}
{{--                    @if($quizMark->mark !== null)--}}
{{--                        {{ number_format($quizMark->mark, 2, '.', '') }}--}}
{{--                    @else--}}
{{--                        @lang('trad.N/A')--}}
{{--                    @endif--}}
{{--                </td>--}}
{{--                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-300">--}}
{{--                    @if($quizMark->created_at)--}}
{{--                        {{$quizMark->created_at->format('Y-m-d H:i')}}--}}
{{--                    @else--}}
{{--                        @lang('trad.N/A')--}}
{{--                    @endif--}}
{{--                    {{ $quizMark->created_at ? $quizMark->created_at->format('Y-m-d H:i') : '@lang('trad.N/A')' }}--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
{{--        </tbody>--}}
{{--    </table>--}}
{{--    <div class="mt-4">--}}
{{--        {{ $quizzes->links() }}--}}
{{--    </div>--}}
{{--@else--}}
{{--    <p class="text-gray-700 dark:text-gray-300">@lang('trad.No quizzes found in this category.')</p>--}}
{{--@endif--}}
@php
    $user_id = \Illuminate\Support\Facades\Auth::user()->id;
    $student = \App\Models\Student::where('user_id', $user_id)->get()->first();
@endphp


@if(!empty($quizzes))
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">@lang('trad.Quiz Name')</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">@lang('trad.Grade')</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">@lang('trad.Date')</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">@lang('trad.Actions')</th>
            </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
            @foreach ($quizzes as $quizMark)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition duration-150 ease-in-out">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">{{ $quizMark->quiz->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                        @if($quizMark->mark !== null)
                            {{ number_format($quizMark->mark, 2, '.', '') }}
                        @else
                            @lang('trad.N/A')
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                        @if($quizMark->created_at)
                            {{$quizMark->created_at->format('Y-m-d H:i')}}
                        @else
                            @lang('trad.N/A')
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('student.reviewVote', ['course' => $course->id, 'student' => $student->id, 'quiz' => $quizMark->quiz->id]) }}" class="text-indigo-600 hover:text-indigo-900 flex items-center">
                            <x-heroicon-o-pencil-square class="w-4 h-4 mr-1" />
                            @lang('trad.Review')
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $quizzes->links() }}
    </div>
@else
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
        <p class="text-gray-700 dark:text-gray-300">@lang('trad.No quizzes found in this category.')</p>
    </div>
@endif
