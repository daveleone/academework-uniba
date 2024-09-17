<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition duration-300 ease-in-out">
    <div class="p-6">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <x-heroicon-o-clipboard-document-list class="w-8 h-8 text-indigo-600 mr-3" />
                <h2 class="text-2xl font-bold text-gray-900">@lang('trad.Recent Submissions')</h2>
            </div>
            <span class="text-sm text-gray-500">@lang('trad.Last 10 submissions')</span>
        </div>

        @if($recentSubmissions->count() > 0)
            <ul class="space-y-6">
                @foreach($recentSubmissions as $submission)
                    <li class="bg-gradient-to-r from-indigo-50 to-indigo-60 p-5 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                        <div class="flex justify-between items-start">
                            <div class="flex-grow">
                                <div class="flex items-center mb-3">
                                    <a class="mr-3 bg-indigo-100 rounded-full p-2 ">
                                        <x-heroicon-o-user-circle class="w-6 h-6 text-indigo-600"/>
                                    </a>
                                    <h3 class="text-xl font-semibold text-gray-900">{{ $submission->student->user->name }}</h3>
                                </div>
                                <p class="text-sm text-gray-600 mb-2">
                                    <x-heroicon-o-clipboard-document-check class="w-4 h-4 inline mr-1" />
                                    {{ $submission->quiz->name }}
                                </p>
                                <p class="text-sm text-gray-600 mb-2">
                                    <x-heroicon-o-academic-cap class="w-4 h-4 inline mr-1" />
                                    {{ $submission->quiz->course_quiz->course->course_name }}
                                </p>
                                <div class="flex items-center text-sm text-gray-500">
                                    <x-heroicon-o-calendar class="w-4 h-4 mr-1" />
                                    <span>{{ $submission->created_at->format('d M, H:i') }}</span>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="inline-block bg-green-100 text-green-800 text-lg font-semibold px-3 py-1 rounded-full">
                                    {{ $submission->mark }} / {{ $submission->maxPoints }}
                                </span>
                            </div>
                        </div>
                        <div class="mt-4 flex justify-end">
                            <a href="{{ route('student.changeVote', ['course' => $submission->quiz->course_quiz->course->id, 'student' => $submission->student->id, 'quiz' => $submission->quiz->id ]) }}" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-500 transition-colors duration-200">
                                @lang('trad.View Details')
                                <x-heroicon-s-arrow-right class="ml-1 w-4 h-4" />
                            </a>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="mt-6">
                {{ $recentSubmissions->appends(['submissions_page' => request()->submissions_page])->links() }}
            </div>
        @else
            <div class="text-center py-12 bg-gradient-to-r from-indigo-50 to-indigo-60 rounded-xl">
                <x-heroicon-o-clipboard-document-check class="mx-auto h-16 w-16 text-indigo-400" />
                <h3 class="mt-4 text-xl font-semibold text-gray-900">@lang('trad.No recent submissions')</h3>
                <p class="mt-2 text-base text-gray-600">@lang('trad.There are no recent quiz submissions from students')</p>
                <p class="mt-4 text-sm text-indigo-600">@lang('trad.Check back later for new submissions!')</p>
            </div>
        @endif
    </div>
</div>
