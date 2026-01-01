<x-app-layout>
    <x-slot name="header">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 flex justify-between items-center gap-3 flex-wrap">
            <h2 class="font-bold text-2xl sm:text-3xl text-slate-800 tracking-tight">
                My Tasks
            </h2>
            <a href="{{ route('todos.create') }}"
                class="inline-flex items-center bg-gradient-to-br from-indigo-600 to-purple-600 text-white px-5 py-2 sm:px-7 py-3 sm:py-3.5 rounded-3xl transition-all duration-300 shadow-lg shadow-indigo-500/30 hover:shadow-xl hover:shadow-indigo-500/40 hover:-translate-y-0.5 active:translate-y-0 active:scale-95 font-bold text-sm sm:text-base backdrop-blur-sm group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 stroke-[2.5px] transition-transform group-hover:rotate-90 duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                <span class="whitespace-nowrap">Create new Task</span>
            </a>
        </div>
    </x-slot>

    <div class="w-full max-w-3xl mx-auto px-4 sm:px-6 py-6 sm:py-8 space-y-8">
        {{-- 未完了セクション --}}
        <section class="animate-fade-in">
            <div class="flex items-center mb-5 ml-2">
                <div class="relative flex items-center">
                    <span class="flex h-2.5 w-2.5 rounded-full bg-indigo-500 mr-3 animate-pulse"></span>
                    <span class="absolute h-2.5 w-2.5 rounded-full bg-indigo-500 mr-3 animate-ping opacity-75"></span>
                </div>
                <h3 class="p-4 text-md sm:text-sm font-bold text-slate-600 uppercase tracking-wider">未完了のタスク</h3>
            </div>
            
            <div class="grid gap-3 sm:gap-4">
                @forelse ($todosNotDone as $todo)
                    <div class="group bg-white/80 backdrop-blur-md p-4 sm:p-5 rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] border border-slate-200/50 flex sm:flex-row sm:justify-between sm:items-center gap-4 transition-all duration-500 hover:shadow-[0_20px_60px_rgb(99,102,241,0.15)] hover:-translate-y-1 hover:bg-white hover:border-indigo-200/50">
                        
                        <div class="flex items-start sm:items-center gap-3 sm:gap-4 flex-1 min-w-0">
                            @can('update', $todo)
                                <form method="POST" action="{{ route('todos.update', $todo->id) }}" class="flex items-center shrink-0 pt-0.5 sm:pt-0">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="is_done" value="1">
                                    <input type="checkbox"
                                           onchange="this.form.submit()"
                                           class="w-6 h-6 sm:w-7 sm:h-7 rounded-full border-2 border-slate-300 text-indigo-600 focus:ring-2 focus:ring-indigo-500/50 focus:ring-offset-2 transition-all cursor-pointer hover:border-indigo-400 hover:scale-110">
                                </form>
                            @endcan
                            <div class="flex flex-col min-w-0 flex-1">
                                <span class="text-slate-800 font-semibold text-base sm:text-lg break-words">{{ $todo->title }}</span>

                                <div class="flex flex-wrap items-center gap-2 sm:gap-3 text-xs sm:text-sm text-gray-500 mt-2">
                                    <span class="inline-flex items-center gap-1.5 bg-slate-100 px-2.5 py-1 rounded-full">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ $todo->created_at->timezone('Asia/Tokyo')->format('Y/m/d') }}
                                    </span>

                                    @if ($todo->due_date)
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full
                                            {{ $todo->due_date->isPast() && !$todo->is_done
                                                ? 'bg-red-100 text-red-600 font-bold animate-pulse'
                                                : 'bg-indigo-100 text-indigo-600 font-semibold'
                                            }}">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            期限 {{ $todo->due_date->format('Y/m/d') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 justify-end sm:justify-start transition-all duration-200 shrink-0">
                            @can('update', $todo)
                                <a href="{{ route('todos.edit', $todo->id) }}"
                                class="p-2.5 sm:p-3 text-slate-500 bg-slate-100/80 hover:text-indigo-600 hover:bg-indigo-100 rounded-2xl transition-all shadow-sm hover:shadow-md hover:scale-110 active:scale-95">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5m-5-5l5 5m7-7l-9 9h-4v-4l9-9z" />
                                    </svg>
                                </a>
                            @endcan

                            @can('delete', $todo)
                                <form method="POST" action="{{ route('todos.destroy', $todo->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="p-2.5 sm:p-3 text-slate-500 bg-slate-100/80 hover:text-red-600 hover:bg-red-100 rounded-2xl transition-all shadow-sm hover:shadow-md hover:scale-110 active:scale-95"
                                            onclick="return confirm('削除しますか？')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </div>
                @empty
                    <div class="bg-gradient-to-br from-slate-50 to-indigo-50/30 border-2 border-dashed border-slate-300 rounded-3xl p-8 sm:p-12 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 bg-indigo-100 rounded-full mb-4">
                            <svg class="w-8 h-8 sm:w-10 sm:h-10 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p class="text-slate-500 font-semibold text-base sm:text-lg">タスクはありません</p>
                        <p class="text-slate-400 text-sm sm:text-base mt-1">今日はゆっくりしましょう！</p>
                    </div>
                @endforelse
            </div>
        </section>

        {{-- 完了済みセクション --}}
        @if($todosDone->isNotEmpty())
        <section class="animate-fade-in-delay">
            <div class="flex items-center mb-5 ml-2">
                <svg class="w-5 h-5 text-green-500 mr-2.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <h3 class="p-4 text-md sm:text-sm font-bold text-slate-500 uppercase tracking-wider">完了済み</h3>
            </div>
            
            <div class="grid gap-3">
                @foreach ($todosDone as $todo)
                    <div class="bg-white/40 backdrop-blur-sm p-4 sm:p-5 rounded-3xl border border-slate-200/50 flex sm:flex-row sm:justify-between sm:items-center gap-4 transition-all duration-300 hover:bg-white/60">
                        <div class="flex items-start sm:items-center gap-3 sm:gap-4 flex-1 min-w-0">
                            @can('update', $todo)
                                <form method="POST" action="{{ route('todos.update', $todo->id) }}" class="flex items-center shrink-0 pt-0.5 sm:pt-0">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="is_done" value="0">
                                    <input type="checkbox" checked onchange="this.form.submit()"
                                           class="w-6 h-6 sm:w-7 sm:h-7 rounded-full border-none bg-green-100 text-green-500 focus:ring-2 focus:ring-green-500/50 cursor-pointer hover:scale-110 transition-transform">
                                </form>
                            @endcan
                            <div class="flex flex-col min-w-0 flex-1">
                                <span class="text-slate-400 line-through font-medium text-base sm:text-lg break-words">{{ $todo->title }}</span>

                                <div class="flex flex-wrap items-center gap-2 sm:gap-3 text-xs text-gray-400 mt-2">
                                    <span class="inline-flex items-center gap-1.5">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ $todo->created_at->timezone('Asia/Tokyo')->format('Y/m/d') }}
                                    </span>

                                    @if ($todo->due_date)
                                        <span class="inline-flex items-center gap-1.5">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $todo->due_date->format('Y/m/d') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        @can('delete', $todo)
                            <form method="POST" action="{{ route('todos.destroy', $todo->id) }}" class="shrink-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2.5 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-2xl transition-all hover:scale-110 active:scale-95" onclick="return confirm('削除しますか？')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        @endcan
                    </div>
                @endforeach
            </div>
        </section>
        @endif
    </div>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in {
            animation: fade-in 0.6s ease-out;
        }
        
        .animate-fade-in-delay {
            animation: fade-in 0.6s ease-out 0.2s both;
        }
    </style>
</x-app-layout>