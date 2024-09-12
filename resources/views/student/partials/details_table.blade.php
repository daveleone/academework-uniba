@if(!empty($quizzes))
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-50 dark:bg-gray-700">
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">@lang('trad.Quiz Name')</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">@lang('trad.Grade')</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">@lang('trad.Date')</th>
        </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
        @foreach ($quizzes as $quizMark)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-300">{{ $quizMark->quiz->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-300">
                    {{ $quizMark->mark !== null ? number_format($quizMark->mark, 2, '.', '') : '@lang('trad.N/A')' }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-300">
                    {{ $quizMark->created_at ? $quizMark->created_at->format('Y-m-d H:i') : '@lang('trad.N/A')' }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="mt-4">
        {{ $quizzes->links() }}
    </div>
@else
    <p class="text-gray-700 dark:text-gray-300">@lang('trad.No quizzes found in this category.')</p>
@endif
