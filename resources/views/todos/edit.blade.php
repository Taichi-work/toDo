<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3 sm:gap-4">
            <a href="{{ route('todos.index') }}" class="p-2 sm:p-2.5 hover:bg-slate-100 rounded-2xl transition-all duration-300 text-slate-500 hover:text-slate-700 hover:scale-110 active:scale-95 group shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-7 sm:w-7 transition-transform group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h2 class="font-bold text-2xl sm:text-3xl text-slate-800 tracking-tight">
                Edit Tasks
            </h2>
        </div>
    </x-slot>

    <div class="w-full max-w-3xl mx-auto px-4 sm:px-6 py-6 sm:py-8">
        <div class="bg-white/80 backdrop-blur-md p-6 sm:p-10 rounded-[2.5rem] shadow-[0_20px_60px_rgb(0,0,0,0.08)] border border-slate-200/50 transition-all duration-500 hover:shadow-[0_25px_70px_rgb(99,102,241,0.15)]">
            <form method="POST" action="{{ route('todos.update', $todo) }}" class="space-y-6 sm:space-y-8">
                @csrf
                @method('PUT')

                {{-- タイトル入力 --}}
                <div class="space-y-3">
                    <label class="flex items-center gap-2 text-sm sm:text-base font-bold text-slate-600 ml-2 tracking-wide">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        タイトル
                    </label>
                    <div class="relative group">
                        <input type="text" 
                            name="title" 
                            id="title"
                            value="{{ old('title', $todo->title) }}"
                            maxlength="50"
                            class="w-full bg-gradient-to-br from-slate-50 to-indigo-50/30 border-2 border-slate-200/50 rounded-3xl px-5 sm:px-6 py-4 sm:py-5 text-slate-800 text-base sm:text-lg placeholder-slate-400 focus:outline-none focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-400 focus:bg-white transition-all duration-300 shadow-inner group-hover:border-indigo-300/50"
                        >
                        <div class="absolute right-4 sm:right-5 top-1/2 -translate-y-1/2 opacity-0 group-focus-within:opacity-100 transition-opacity">
                            <svg class="w-5 h-5 text-indigo-400 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                        </div>
                    </div>

                    <div class="flex items-center justify-between px-2">
                        <div class="text-xs sm:text-sm text-slate-500 font-medium" id="title-counter">
                            0 / 50
                        </div>
                        <div class="text-xs text-slate-400 opacity-0 transition-opacity duration-300" id="title-hint">
                            簡潔に書きましょう
                        </div>
                    </div>
                </div>

                {{-- 期限入力 --}}
                <div class="space-y-3">
                    <label class="flex items-center gap-2 text-sm sm:text-base font-bold text-slate-600 ml-2 tracking-wide">
                        <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        期限
                    </label>
                    <div class="relative">
                        <input type="date"
                            name="due_date"
                            value="{{ optional($todo->due_date)->format('Y-m-d') }}"
                            class="w-full bg-gradient-to-br from-slate-50 to-purple-50/30 border-2 border-slate-200/50 rounded-3xl px-5 sm:px-6 py-4 sm:py-5 text-slate-700 text-base sm:text-lg focus:outline-none focus:ring-4 focus:ring-purple-500/20 focus:border-purple-400 focus:bg-white transition-all duration-300 shadow-inner hover:border-purple-300/50 cursor-pointer">
                    </div>
                </div>

                {{-- 更新情報 --}}
                @if($todo->updated_at && $todo->updated_at != $todo->created_at)
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50/50 border border-blue-200/50 rounded-2xl p-4 sm:p-5">
                    <div class="flex items-start gap-3">
                        <div class="shrink-0 w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-blue-900 mb-1">更新履歴</p>
                            <p class="text-xs sm:text-sm text-blue-700">
                                最終更新: {{ $todo->updated_at->timezone('Asia/Tokyo')->format('Y年m月d日 H:i') }}
                            </p>
                        </div>
                    </div>
                </div>
                @endif

                {{-- ボタン --}}
                <div class="pt-4 sm:pt-6 space-y-3 sm:space-y-4">
                    <button
                        type="submit"
                        class="w-full bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold py-4 sm:py-5 rounded-3xl transition-all duration-300 shadow-lg shadow-emerald-500/30 hover:shadow-xl hover:shadow-emerald-500/40 active:scale-[0.98] text-base sm:text-lg group relative overflow-hidden"
                    >
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5 transition-transform group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            変更を保存
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-teal-600 to-emerald-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </button>
                    
                    <a href="{{ route('todos.index') }}" 
                       class="flex items-center justify-center gap-2 w-full py-3 sm:py-4 text-slate-500 font-semibold hover:text-slate-700 transition-all duration-300 rounded-2xl hover:bg-slate-100 group">
                        <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        変更をキャンセル
                    </a>
                </div>
            </form>
        </div>
        
        {{-- 補足メッセージ --}}
        <div class="mt-6 sm:mt-8 text-center space-y-2">
            <p class="text-slate-400 text-sm sm:text-base flex items-center justify-center gap-2 flex-wrap">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
                <span>変更内容は即座に反映されます</span>
            </p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const titleInput = document.getElementById('title');
            const counter = document.getElementById('title-counter');
            const hint = document.getElementById('title-hint');
            const maxLength = 50;

            // 初期表示
            updateCounter();

            function updateCounter() {
                const currentLength = titleInput.value.length;
                counter.textContent = `${currentLength} / ${maxLength}`;

                // 文字数に応じてスタイル変更
                if (currentLength === 0) {
                    counter.classList.remove('text-indigo-600', 'text-amber-600', 'text-red-600', 'font-bold');
                    counter.classList.add('text-slate-500');
                    hint.style.opacity = '0';
                } else if (currentLength < 30) {
                    counter.classList.remove('text-slate-500', 'text-amber-600', 'text-red-600');
                    counter.classList.add('text-indigo-600', 'font-semibold');
                    hint.style.opacity = '0';
                } else if (currentLength < 45) {
                    counter.classList.remove('text-slate-500', 'text-indigo-600', 'text-red-600');
                    counter.classList.add('text-amber-600', 'font-bold');
                    hint.style.opacity = '1';
                    hint.textContent = '長すぎるかも';
                } else {
                    counter.classList.remove('text-slate-500', 'text-indigo-600', 'text-amber-600');
                    counter.classList.add('text-red-600', 'font-bold');
                    hint.style.opacity = '1';
                    hint.textContent = '上限に近づいています';
                }
            }

            titleInput.addEventListener('input', updateCounter);
        });
    </script>
</x-app-layout>