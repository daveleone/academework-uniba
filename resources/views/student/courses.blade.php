<x-app-layout>
    <div class="bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
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
            </div>

            @if($courses->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                    @foreach ($courses as $course)
                        <a href="{{ route('student.exercises', $course->id) }}" class="block">
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition duration-300 ease-in-out">
                                <div class="p-6">
                                    <x-heroicon-o-academic-cap class="w-7 h-7" />
                                    <h2 class="text-xl font-semibold text-gray-900 mb-2">{{ $course->course_name }}</h2>
                                    <p class="text-gray-600">{{ $course->course_description }}</p>
                                </div>
                                <div class="px-6 py-4 bg-gray-50 flex justify-end">
                                    <span class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                        @lang('trad.View class')
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
                        <p class="mt-1 text-sm text-gray-500">@lang('trad.Ask your professor to add you to his classes!')</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
