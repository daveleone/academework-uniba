<x-app-layout>
    <div>
        <div class="max-w-7xl mx-auto">
            <div class="mb-8 inline-flex items-center">
                <a href="{{ route('courses.edit', $course->id) }}">
                    <x-heroicon-o-chevron-left class="ml-1 mr-2 w-6 h-6" />
                </a>
                <h1 class="text-3xl font-bold text-gray-900">@lang('trad.Course Quizzes')</h1>
            </div>
            <div class="bg-indigo-600 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6 pb-6 text-center">
                    <div>
                        <p class="text-sm font-medium text-white">@lang('trad.Course Name')</p>
                        <p class="mt-1 text-lg text-white">{{ $course->course_name }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-white">@lang('trad.Total Quizzes')</p>
                        <p class="mt-1 text-lg text-white">{{ $quizzes->count() }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-white">@lang('trad.Latest Quiz')</p>
                        <p class="mt-1 text-lg text-white">{{ $quizzes->first() ? $quizzes->first()->name : __('trad.N/A') }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-8 inline-flex items-center">
                <x-heroicon-o-clipboard-document-list class="w-6 h-6 mr-2 ml-1 text-indigo-600" />
                <h1 class="text-3xl font-bold text-gray-900">
                    @lang('trad.Quiz List')
                </h1>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="overflow-x-auto mx-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">@lang('trad.Quiz Name')</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">@lang('trad.Created At')</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">@lang('trad.Actions')</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($quizzes as $quiz)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $quiz->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $quiz->created_at->format('Y-m-d H:i') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('quiz.show', $quiz->id) }}" class="text-indigo-600 hover:text-indigo-900 flex items-center">
                                            <x-heroicon-o-pencil-square class="w-4 h-4 mr-1" />
                                            @lang('trad.Edit')
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">@lang('trad.No quizzes found for this course.')</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{ $quizzes->links() }}
        </div>
    </div>
</x-app-layout>
