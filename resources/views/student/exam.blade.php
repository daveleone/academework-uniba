<x-app-layout>
    <div class="">
        <div class="max-w-7xl mx-auto">
            <div class="mb-8 inline-flex items-center">
                <h1 class="text-3xl font-bold text-gray-900">@lang('trad.Exam') - {{ $course->course_name ?? '' }} - {{ $quiz->name ?? '' }}</h1>
            </div>

            @if(isset($remainingTime))
                <div id="timer" class="text-xl font-bold mb-4 text-indigo-600">@lang('trad.Time remaining'): <span id="time-left"></span></div>
            @endif

            <form id="exam-form" action="{{ route('student.submitExam', ['courses' => $course, 'quiz' => $quiz]) }}" method="POST">
                @csrf
                @foreach($exercises->shuffle()->all() as $exercise)
                    <div class="mb-6 bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold mb-2 text-gray-800">{{ $exercise->question }}</h3>
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
                <div class="mt-6">
                    <button dusk="submit-exam" type="submit" id="submit-btn" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition ease-in-out duration-150">
                        <x-heroicon-s-check class="w-5 h-5 mr-2" />
                        @lang('trad.Submit Exam')
                    </button>
                </div>
            </form>
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
