        <div class="main-wrapper">
            <header class="main-header">                
                <div class="main-header-cont">
                    <div class="timer-desc" style="opacity:0;">
                        До часа<br>
                        страсти
                        <span class="small">осталось</span>
                    </div>
                    <div id="timer" class="timer" style="opacity:0;"></div>
                    <h1 class="logo">
                        Час страсти
                    </h1>
                    <div class="counter" style="opacity:0;">
                @if($set = Setting::where('name', 'manifest_count')->first())
                        {{ $set->value }}
                @else
                        0
                @endif
                    </div>
                </div>                
            </header>
