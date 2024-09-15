<x-app-layout>
    <div class="">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-8">

                <div class="mb-8 inline-flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-heroicon-o-chevron-left class="ml-1 mr-2 w-6 h-6" />
                    </a>
                    <h1 class="text-3xl font-bold text-gray-900">
                        @lang('trad.Your Classes')
                    </h1>
                </div>
                <div class="mb-8 inline-flex items-center">
                    <a x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-course-creation')" class="cursor-pointer inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-300 hover:-translate-y-1">
                        <x-heroicon-s-plus class="w-5 h-5 mr-2" />
                        @lang('trad.Create a class')
                    </a>

                </div>

                @include('partials.class_creation_modal')

            </div>

            @if($courses->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                    @foreach ($courses as $course)
                        <a href="{{ route('courses.edit', $course->id) }}" class="block">
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition duration-300 ease-in-out">
                                <div class="p-6">
                                    <div class="flex justify-between items-center mb-4">
                                        <x-heroicon-o-academic-cap class="w-7 h-7 text-indigo-600" />
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                            <x-heroicon-s-users class="w-4 h-4 mr-1" />
                                            @if($course->students_count < 2)
                                                {{ $course->students_count }} @lang('trad.student')
                                            @elseif($course->students_count >= 2)
                                                {{ $course->students_count }} @lang('trad.students')
                                            @endif

                                        </span>
                                    </div>
                                    <h2 class="text-xl font-semibold text-gray-900 mb-2">{{ $course->course_name }}</h2>
                                    <p class="text-gray-600 mb-4">{{ Str::limit($course->course_description, 100) }}</p>
                                    <div class="flex justify-between items-center text-sm text-gray-500">
                                        <span class="inline-flex items-center">
                                            <x-heroicon-s-calendar class="w-4 h-4 mr-1" />
                                            {{ $course->created_at->format('M d, Y') }}
                                        </span>
                                        <span class="inline-flex items-center">
                                            <x-heroicon-s-clipboard class="w-4 h-4 mr-1" />
                                            @if($course->quizzes->count() < 2)
                                                {{ $course->quizzes->count() }} @lang('trad.quiz')
                                            @elseif($course->quizzes->count() >= 2)
                                                {{ $course->quizzes->count() }} @lang('trad.quizzes')
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="px-6 py-4 bg-gray-50 flex justify-end">
                                    <span class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                        @lang('trad.Edit class')
                                        <x-heroicon-s-chevron-right class="ml-1 w-5 h-5" />
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                {{ $courses->links() }}
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <x-heroicon-o-academic-cap class="mx-auto h-12 w-12 text-gray-400" />
                        <h3 class="mt-2 text-sm font-medium text-gray-900">@lang('trad.No classes')</h3>
                        <p class="mt-1 text-sm text-gray-500">@lang('trad.Get started by creating a new class')</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
