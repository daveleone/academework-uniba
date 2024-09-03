<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Exam') }} - {{ $course->course_name ?? '' }} - {{ $quiz->name ?? '' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(isset($remainingTime))
                        <div id="timer" class="text-xl font-bold mb-4">Time remaining: <span id="time-left"></span></div>
                    @endif

                    <form id="exam-form" action="{{ route('student.submitExam', ['courses' => $course, 'quiz' => $quiz]) }}" method="POST">
                        @csrf
                        @foreach($exercises->shuffle()->all() as $exercise)
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold mb-2">{{ $exercise->question }}</h3>
                                @switch($exercise->type)
                                    @case('true/false')
                                        @include('student.exercises.tf_question')
                                        @break
                                    @case('open')
                                        @include('student.exercises.open_question')
                                        @break
                                    @case('close')
                                        @include('student.exercises.closed_question')
                                        @break
                                    @case('fill-in')
                                        @include('student.exercises.fill_question')
                                        @break
                                @endswitch
                            </div>
                        @endforeach
                        <x-primary-button type="submit" id="submit-btn">{{ __('Submit Exam') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if(isset($remainingTime))
        <script>
            let timeLeft = {{ $remainingTime }};
            const timerElement = document.getElementById('time-left');
            const examForm = document.getElementById('exam-form');
            const submitBtn = document.getElementById('submit-btn');

            function updateTimer() {
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                timerElement.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;

                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    submitBtn.click();
                }
                timeLeft--;
            }

            updateTimer();
            const timerInterval = setInterval(updateTimer, 1000);

            // Prevent form resubmission on page refresh
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }

            // Warn user before leaving the page
            window.onbeforeunload = function() {
                return "Are you sure you want to leave? Your exam progress may be lost.";
            };

            // Remove warning when submitting the form
            examForm.onsubmit = function() {
                window.onbeforeunload = null;
            };
        </script>
    @endif
</x-app-layout>
