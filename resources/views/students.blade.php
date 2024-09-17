<x-app-layout>
    <div class="">
        <div class="max-w-7xl mx-auto">
            <div class="mb-8 inline-flex items-center">
                <a href="{{ url()->previous() }}">
                    <x-heroicon-o-chevron-left class="ml-1 mr-2 w-6 h-6" />
                </a>
                <h1 class="text-3xl font-bold text-gray-900">@lang('trad.Add Students to Course')</h1>
            </div>

            <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8">
                <div class="p-6">
                    <div class="mb-4">
                        <label for="input-group-search" class="sr-only">@lang('trad.Search')</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <x-heroicon-s-magnifying-glass class="w-5 h-5 text-gray-400" />
                            </div>
                            <input type="text" id="input-group-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="@lang('trad.Search for students')">
                        </div>
                    </div>

                    @if ($students->count() > 0)
                        <form action="{{ route('student.store', $course->id) }}" method="POST" id="add-students-form">
                            @csrf
                            @method('PUT')
                            @include('student.partials.students-list')
                        </form>
                    @else
                        <div class="text-center py-12">
                            <x-heroicon-o-users class="mx-auto h-12 w-12 text-gray-400" />
                            <h3 class="mt-2 text-sm font-medium text-gray-900">@lang('trad.No available students')</h3>
                            <p class="mt-1 text-sm text-gray-500">@lang('trad.All students are already enrolled in this course')</p>
                        </div>
                    @endif
                </div>
            </div>

            @if ($students->count() > 0)
                <div class="mt-6">
                    <button dusk="add-student-button" type="submit" form="add-students-form" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition ease-in-out duration-150">
                        <x-heroicon-s-user-plus class="w-5 h-5 mr-2" />
                        @lang('trad.Add Selected Students')
                    </button>
                </div>
            @endif
        </div>
    </div>

    <script>
        let input = document.getElementById('input-group-search');
        let list = document.querySelectorAll('#course-list li');

        function search() {
            for (let i = 0; i < list.length; i++) {
                let label = list[i].querySelector('label');
                let email = list[i].querySelector('p');
                let searchText = (label.innerText + ' ' + email.innerText).toLowerCase();
                if (searchText.includes(input.value.toLowerCase())) {
                    list[i].style.display = 'block';
                } else {
                    list[i].style.display = 'none';
                }
            }
        }

        input.addEventListener('input', search);
    </script>
</x-app-layout>
