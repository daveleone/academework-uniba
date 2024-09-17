<ul id="course-list" class="divide-y divide-gray-200">
    @foreach ($students as $student)
        <li class="py-3 sm:py-4">
            <div class="flex items-center space-x-4">
                <div class="flex-shrink-0">
                    <x-heroicon-s-user-circle class="w-8 h-8 text-gray-400" />
                </div>
                <div class="flex-1 min-w-0">
                    <label dusk="add-student-label" for="student-{{ $student->id }}" class="text-sm font-medium text-gray-900 truncate">
                        {{ $student->user->name }}
                    </label>
                    <p class="text-sm text-gray-500 truncate">
                        {{ $student->user->email }}
                    </p>
                </div>
                <div class="inline-flex items-center text-base font-semibold text-gray-900">
                    <input dusk="add-student-checkbox" id="student-{{ $student->id }}" name="students[]" type="checkbox" value="{{ $student->id }}" class="w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 rounded focus:ring-indigo-600 focus:ring-2">
                </div>
            </div>
        </li>
    @endforeach
</ul>
