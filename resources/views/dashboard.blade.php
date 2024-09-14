<x-app-layout>
    <div class="">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-8">
                <div class="mb-8 inline-flex items-center">
                    <a class="ml-1 mr-2 w-6 h-6">

                    </a>
                    <h1 class="text-3xl font-bold text-gray-900">
                        Dashboard
                    </h1>
                </div>
            </div>
        </div>
    </div>
    @if(auth()->user()->isStudent())
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                @include('student.partials.upcoming_quizzes')
            </div>
            <div>
                @include('student.partials.latest_highest_grades')
            </div>
        </div>
    @endif
</x-app-layout>
