<!-- Dynamic Pop‑ins Blade Partial with Extended Positions  -->
<style>
    /* ============== Common Elements ============== */
    .popin-overlay p,
    .popin-overlay a,
    .popin-overlay span,
    .popin-overlay li,
    .popin-overlay h3 {
        color: white !important;
    }
    .popin-overlay {
        position: fixed;
        z-index: 9999;
        color: white;
    }
    .popin-close {
        cursor: pointer;
        color: white;
        text-align: right;
        margin: 0;
    }
    /* ============== Bottom (existing) ============== */
    #bottom-overlay {
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 15px;
        animation: slideUp 0.5s ease-out forwards;
    }
    @keyframes slideUp {
        from { transform: translateY(100%); }
        to   { transform: translateY(0);    }
    }
    /* ============== Right (existing) ============== */
    #right-overlay {
        top: 0;
        right: 0;
        width: 300px;
        height: 100vh;
        padding: 20px;
        text-align: center;
        transform: translateX(100%);
        animation: slideInFromRight 0.5s ease-out forwards;
    }
    @keyframes slideInFromRight {
        from { transform: translateX(100%); }
        to   { transform: translateX(0);     }
    }
    /* ============== NEW: Left ============== */
    #left-overlay {
        top: 0;
        left: 0;
        width: 300px;
        height: 100vh;
        padding: 20px;
        text-align: center;
        transform: translateX(-100%);
        animation: slideInFromLeft 0.5s ease-out forwards;
    }
    @keyframes slideInFromLeft {
        from { transform: translateX(-100%); }
        to   { transform: translateX(0);      }
    }
    /* ============== NEW: Top (full‑width) ============== */
    #top-overlay {
        top: 0;
        left: 0;
        width: 100%;
        padding: 15px;
        animation: slideDown 0.5s ease-out forwards;
    }
    @keyframes slideDown {
        from { transform: translateY(-100%); }
        to   { transform: translateY(0);      }
    }
    /* ============== Top‑Right (existing) ============== */
    #top-right-overlay,
    #top-left-overlay {
        top: 20px;
        width: 280px;
        padding: 15px;
        border-radius: 8px;
        transform: translateY(-100px);
        opacity: 0;
        animation: slideDownFade 0.6s ease-out forwards;
    }
    /* ============== NEW: Top‑Left (mirrors top‑right) ============== */
    #top-left-overlay { left: 20px; }
    #top-right-overlay { right: 20px; }

    /* ============== Bottom‑Right (existing) & Bottom‑Left (new) ============== */
    #bottom-right-overlay,
    #bottom-left-overlay {
        bottom: 20px;
        width: 280px;
        padding: 15px;
        border-radius: 8px;
        transform: translateY(100px);
        opacity: 0;
        animation: slideUpFade 0.6s ease-out forwards;
    }
    #bottom-left-overlay { left: 20px; }
    #bottom-right-overlay { right: 20px; }

    /* Shared animations for mini pop‑ins */
    @keyframes slideDownFade {
        to { transform: translateY(0); opacity: 1; }
    }
    @keyframes slideUpFade {
        to { transform: translateY(0); opacity: 1; }
    }
    /* ============== NEW: Full‑Screen Modal ============== */
    #fullscreen-overlay {
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        padding: 40px;
        display: flex;
        text-align: center;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        opacity: 0;
        animation: fadeIn 0.5s forwards;
    }
    @keyframes fadeIn {
        to { opacity: 1; }
    }
.btn {
    font-weight: 700;
    border-radius: 2px;
    color: #74c52c;
    border-color: transparent !important;
    box-shadow: 0 1px 6px rgba(57, 73, 76, 0.52);
    line-height: 14px;
    padding: 8px 15px;
}
</style>

{{-- ========================= Mark‑up ========================= --}}
{{-- Bottom --}}
@if ($popin->design == 'bottom')
    <div id="bottom-overlay" class="popin-overlay" style="background-color:{{ $popin->bg_color }}">
        <div style="display:flex;justify-content:space-between">
            @if($popin->status == 'Most Liked')
            <span class="badge">Most Liked</span>
            @else
            <span class="badge">Sponsered</span>
            @endif
            <p class="popin-close close_popin">✖</p>
        </div>
        <div class="row">
            <div class="col-md-2 text-center">
                @if ($popin->image)
                    <img style="margin-top:10px" src="{{ asset('uploads/popin_images/' . $popin->image) }}" width="100px" alt="Image">
                @endif
            </div>
            <div class="col-md-8">
                <h3>{{ $popin->heading }}</h3>
                <div style="height:100px;overflow:hidden">{!! $popin->description !!}</div>
            </div>
            <div class="col-md-2 text-center">
                @if ($popin->url)
                    <a href="{{ $popin->url }}" target="_blank" class="btn btn-light" style="background-color:{{ $popin->btn_color }};margin-top:20px">{{ $popin->title }}</a>
                @endif
            </div>
        </div>
    </div>
{{-- Right --}}
@elseif($popin->design == 'right')
    <div id="right-overlay" class="popin-overlay" style="background-color: {{ $popin->bg_color }}">
        <div style="display:flex;justify-content:space-between">
            @if($popin->status == 'Most Liked')
            <span class="badge">Most Liked</span>
            @else
            <span class="badge">Sponsered</span>
            @endif
            <p class="popin-close close_popin">✖</p>
        </div>
        <h3 style="margin-top:30px">{{ $popin->heading }}</h3>
        @if ($popin->image)
            <img src="{{ asset('uploads/popin_images/' . $popin->image) }}" width="70%" style="margin:20px 20px 0px 20px" alt="Image">
        @endif
        <div style="margin:20px 0;height:240px;overflow:hidden">{!! $popin->description !!}</div>
        @if ($popin->url)
            <a href="{{ $popin->url }}" target="_blank" class="btn btn-light" style="background-color:{{ $popin->btn_color }}">{{ $popin->title }}</a>
        @endif
    </div>
{{-- Top‑Right --}}
@elseif($popin->design == 'top_right')
    <div id="top-right-overlay" class="popin-overlay" style="background-color: {{ $popin->bg_color }}">
        <div style="display:flex;justify-content:space-between">
            @if($popin->status == 'Most Liked')
            <span class="badge">Most Liked</span>
            @else
            <span class="badge">Sponsered</span>
            @endif
            <p class="popin-close close_popin">✖</p>
        </div>
        <div style="display:flex;align-items:center">
            @if ($popin->image)
                <img src="{{ asset('uploads/popin_images/' . $popin->image) }}" style="border-radius:50%;width:50px;height:50px;margin:10px" alt="Image">
            @endif
            <p style="margin-top:10px"><b>{{ $popin->heading }}</b></p>
        </div>
        <div style="height:150px;overflow:hidden">{!! $popin->description !!}</div>
        @if ($popin->url)
            <a href="{{ $popin->url }}" target="_blank" class="btn btn-light" style="width:100%;background-color:{{ $popin->btn_color }};margin-top:10px">{{ $popin->title }}</a>
        @endif
    </div>
{{-- Bottom‑Right --}}
@elseif($popin->design == 'bottom_right')
    <div id="bottom-right-overlay" class="popin-overlay" style="background-color: {{ $popin->bg_color }}">
        <div style="display:flex;justify-content:space-between">
            @if($popin->status == 'Most Liked')
            <span class="badge">Most Liked</span>
            @else
            <span class="badge">Sponsered</span>
            @endif
            <p class="popin-close close_popin">✖</p>
        </div>
        <div style="display:flex;align-items:center">
            @if ($popin->image)
                <img src="{{ asset('uploads/popin_images/' . $popin->image) }}" style="border-radius:50%;width:50px;height:50px;margin:10px" alt="Image">
            @endif
            <p><b>{{ $popin->heading }}</b></p>
        </div>
        @if ($popin->url)
            <a href="{{ $popin->url }}" target="_blank" class="btn btn-light" style="width:100%;background-color:{{ $popin->btn_color }};margin-bottom:10px">{{ $popin->title }}</a>
        @endif
        <div style="height:150px;overflow:hidden">{!! $popin->description !!}</div>
    </div>
{{-- ================= NEW POSITIONS ================= */
{{-- Left --}}
@elseif($popin->design == 'left')
    <div id="left-overlay" class="popin-overlay" style="background-color: {{ $popin->bg_color }}">
        <div style="display:flex;justify-content:space-between">
            @if($popin->status == 'Most Liked')
            <span class="badge">Most Liked</span>
            @else
            <span class="badge">Sponsered</span>
            @endif
            <p class="popin-close close_popin">✖</p>
        </div>
        <h3 style="margin-top:30px">{{ $popin->heading }}</h3>
        @if ($popin->image)
            <img src="{{ asset('uploads/popin_images/' . $popin->image) }}" width="70%" style="margin:20px 20px 0px 20px" alt="Image">
        @endif
        <div style="margin:20px 0;height:240px;overflow:hidden">{!! $popin->description !!}</div>
        @if ($popin->url)
            <a href="{{ $popin->url }}" target="_blank" class="btn btn-light" style="background-color:{{ $popin->btn_color }}">{{ $popin->title }}</a>
        @endif
    </div>
{{-- Top (full‑width banner) --}}
@elseif($popin->design == 'top')
    <div id="top-overlay" class="popin-overlay" style="background-color:{{ $popin->bg_color }}">
        <div style="display:flex;justify-content:space-between">
            @if($popin->status == 'Most Liked')
            <span class="badge">Most Liked</span>
            @else
            <span class="badge">Sponsered</span>
            @endif
            <p class="popin-close close_popin">✖</p>
        </div>
        <div class="row">
            @if ($popin->image)
            <div class="col-md-2 text-center">
                <img src="{{ asset('uploads/popin_images/' . $popin->image) }}" width="100px" alt="Image" style="margin-top:10px">
            </div>
            @endif
            <div class="col-md-8">
                <h3>{{ $popin->heading }}</h3>
                <div style="height:100px;overflow:hidden">{!! $popin->description !!}</div>
            </div>
            @if ($popin->url)
                <div class="col-md-2 text-center">
                    <a href="{{ $popin->url }}" target="_blank" class="btn btn-light" style="background-color:{{ $popin->btn_color }};margin-top:20px">{{ $popin->title }}</a>
                </div>
            @endif
        </div>
    </div>
{{-- Top‑Left --}}
@elseif($popin->design == 'top_left')
    <div id="top-left-overlay" class="popin-overlay" style="background-color: {{ $popin->bg_color }}">
        <div style="display:flex;justify-content:space-between">
            @if($popin->status == 'Most Liked')
            <span class="badge">Most Liked</span>
            @else
            <span class="badge">Sponsered</span>
            @endif
            <p class="popin-close close_popin">✖</p>
        </div>
        <div style="display:flex;align-items:center">
            @if ($popin->image)
                <img src="{{ asset('uploads/popin_images/' . $popin->image) }}" style="border-radius:50%;width:50px;height:50px;margin:10px" alt="Image">
            @endif
            <p style="margin-top:10px"><b>{{ $popin->heading }}</b></p>
        </div>
        <div style="height:150px;overflow:hidden">{!! $popin->description !!}</div>
        @if ($popin->url)
            <a href="{{ $popin->url }}" target="_blank" class="btn btn-light" style="width:100%;background-color:{{ $popin->btn_color }};margin-top:10px">{{ $popin->title }}</a>
        @endif
    </div>
{{-- Bottom‑Left --}}
@elseif($popin->design == 'bottom_left')
    <div id="bottom-left-overlay" class="popin-overlay" style="background-color: {{ $popin->bg_color }}">
        <div style="display:flex;justify-content:space-between">
            @if($popin->status == 'Most Liked')
            <span class="badge">Most Liked</span>
            @else
            <span class="badge">Sponsered</span>
            @endif
            <p class="popin-close close_popin">✖</p>
        </div>
        <div style="display:flex;align-items:center">
            @if ($popin->image)
                <img src="{{ asset('uploads/popin_images/' . $popin->image) }}" style="border-radius:50%;width:50px;height:50px;margin:10px" alt="Image">
            @endif
            <p style="margin-top:10px"><b>{{ $popin->heading }}</b></p>
        </div>
        @if ($popin->url)
            <a href="{{ $popin->url }}" target="_blank" class="btn btn-light" style="width:100%;background-color:{{ $popin->btn_color }};margin-bottom:10px">{{ $popin->title }}</a>
        @endif
        <div style="height:150px;overflow:hidden">{!! $popin->description !!}</div>
    </div>
{{-- Full‑Screen --}}
@elseif($popin->design == 'full_screen')
    <div id="fullscreen-overlay" class="popin-overlay" style="background-color: {{ $popin->bg_color }}">
        <div style="display:flex;justify-content:space-between">
            @if($popin->status == 'Most Liked')
            <span class="badge" style="position:absolute;top:20px;left:20px">Most Liked</span>
            @else
            <span class="badge" style="position:absolute;top:20px;left:20px">Sponsered</span>
            @endif
            <p class="popin-close close_popin" style="position:absolute;top:20px;right:20px">✖</p>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <h2 style="color:white;margin-bottom:30px">{{ $popin->heading }}</h2>
                @if ($popin->image)
                <div>
                    <img src="{{ asset('uploads/popin_images/' . $popin->image) }}" width="180px" style="margin-bottom:30px" alt="Image">
                </div>
                    @endif
                @if ($popin->url)
                    <a href="{{ $popin->url }}" target="_blank" class="btn btn-light btn-lg mt-4" style="background-color:{{ $popin->btn_color }}">{{ $popin->title }}</a>
                @endif
            </div>
            <div class="col-md-7 text-left">
                <div style="max-width:100%;margin:0 auto;height:500px;overflow:hidden">{!! $popin->description !!}</div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
@endif
