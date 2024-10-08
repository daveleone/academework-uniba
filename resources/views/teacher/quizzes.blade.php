<x-app-layout>
    <div>
        <div class="max-w-7xl mx-auto">
            <div class="mb-8 inline-flex items-center">
                <a href="{{ url()->previous() }}">
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
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">@lang('trad.Status')</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">@lang('trad.Actions')</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($quizzes as $quiz)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $quiz->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $quiz->created_at->format('d M Y H:i') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        @if($quiz->course_quiz->start_time)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                @lang('trad.Scheduled for') {{ \Carbon\Carbon::parse($quiz->course_quiz->start_time)->format('d/m/y H:i') }}
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                @lang('trad.Not scheduled')
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="mt-1 mb-1">
                                            <a href="{{ route('quiz.show', $quiz->id) }}" class="text-indigo-600 hover:text-indigo-900 flex items-center">
                                                <x-heroicon-o-pencil-square class="w-4 h-4 mr-1" />
                                                @lang('trad.Edit')
                                            </a>
                                        </div>
                                        <div class="mt-1 mb-1">
                                            <form action="{{ route('quiz.remove', ['course' => $course->id, 'quiz' => $quiz->id]) }}" method="POST" onsubmit="return confirm('@lang('trad.Are you sure you want to remove this quiz from the course?')');">
                                                @csrf
                                                @method('DELETE')
                                                <a
                                                        x-data=""
                                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-quiz-deletion-{{ $course->id }}')"
                                                        class="text-red-600 hover:text-red-900 flex items-center cursor-pointer">
                                                    <x-heroicon-o-trash class="w-4 h-4 mr-1" />
                                                    @lang('trad.Remove')
                                                </a>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">@lang('trad.No quizzes found for this course.')</td>
                                </tr>

                            @endforelse
                            </tbody>
                        </table>
                        @if($quizzes->count() > 0)
                            @include('partials.confirm_quiz_class_remove')
                        @endif
                    </div>
                </div>
            </div>
            {{ $quizzes->links() }}
        </div>
    </div>


</x-app-layout>
