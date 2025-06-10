<style>
    #bottom-overlay {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        z-index: 9999;
        padding: 15px;
        text-align: center;
        animation: slideUp 0.5s ease-out forwards;
    }

    @keyframes slideUp {
        from {
            transform: translateY(100%);
        }

        to {
            transform: translateY(0);
        }
    }

    #right-overlay {
        position: fixed;
        top: 0;
        right: 0;
        width: 300px;
        height: 100vh;
        /* Full viewport height */
        overflow-y: auto;
        text-align: center;
        color: white;
        padding: 20px;
        z-index: 9999;
        transform: translateX(100%);
        animation: slideInFromRight 0.5s ease-out forwards;
    }

    /* Slide-in animation */
    @keyframes slideInFromRight {
        from {
            transform: translateX(100%);
        }

        to {
            transform: translateX(0);
        }
    }

    #top-right-overlay {
        position: fixed;
        top: 20px;
        right: 20px;
        width: 280px;
        padding: 15px;
        border-radius: 8px;
        z-index: 9999;
        transform: translateY(-100px);
        opacity: 0;
        animation: slideDownFade 0.6s ease-out forwards;
    }

    /* Slide-down + fade-in animation */
    @keyframes slideDownFade {
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    #bottom-right-overlay {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 280px;
        padding: 15px;
        border-radius: 8px;
        z-index: 9999;
        transform: translateY(100px);
        /* Start off-screen downward */
        opacity: 0;
        animation: slideUpFade 0.6s ease-out forwards;
    }

    /* Slide-up + fade-in */
    @keyframes slideUpFade {
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    #show_popin a,
    #show_popin p,
    #show_popin span,
    #show_popin li,
    #show_popin h3 {
        color: white !important;
    }
</style>
@if ($popin->design == 'bottom')
    <div id="bottom-overlay" style="background-color:{{ $popin->bg_color }}">
        <p class="close_popin" style="cursor:pointer;color:white;text-align:right;margin-bottom:0">✖</p>
        <div style="display: flex;align-items:center">
            <div style="width:10%">
                @if ($popin->image)
                    <img src="{{ asset('uploads/popin_images/' . $popin->image) }}" width="100px" alt="Image">
                @endif
            </div>
            <div style="width:75%;text-align:left">
                <h3 style="color:white;">{{ $popin->heading }}</h3>
                <div style="color:white">{!! $popin->description !!}</div>
            </div>
            <div style="width:10%">
                @if ($popin->url)
                    <a href="{{ $popin->url }}" target="_blank" class="btn btn-light"
                        style="color:white;background-color:{{ $popin->btn_color }}">{{ $popin->title }}</a>
                @endif
            </div>
        </div>
    </div>
@elseif($popin->design == 'right')
    <div id="right-overlay" style="background-color: {{ $popin->bg_color }}">
        <p class="close_popin" style="cursor:pointer;color:white;text-align:right;">✖</p>
        <h3 style="color:white;margin-top:30px">{{ $popin->heading }}</h3>
        @if ($popin->image)
            <img src="{{ asset('uploads/popin_images/' . $popin->image) }}" width="70%" style="margin:20px 0px"
                alt="Image">
        @endif
        <div style="color:white;margin:20px 0px">{!! $popin->description !!}</div>
        @if ($popin->url)
            <a href="{{ $popin->url }}" target="_blank" class="btn btn-light"
                style="color:white;background-color:{{ $popin->btn_color }}">{{ $popin->title }}</a>
        @endif
    </div>
@elseif($popin->design == 'top_right')
    <div id="top-right-overlay" style="background-color: {{ $popin->bg_color }}">
        <p class="close_popin" style="cursor:pointer;color:white;text-align:right;margin:0px">✖</p>
        <div style="display:flex;align-items:center">
            @if ($popin->image)
                <img src="{{ asset('uploads/popin_images/' . $popin->image) }}"
                    style="border-radius:50px;width:50px;height:50px;margin:10px" alt="Image">
            @endif
            <p style="color:white"><b>{{ $popin->heading }}</b></p>
        </div>
        <div style="color:white">{!! $popin->description !!}</div>
        @if ($popin->url)
            <a href="{{ $popin->url }}" target="_blank" class="btn btn-light"
                style="width:100%;color:white;background-color:{{ $popin->btn_color }};">{{ $popin->title }}</a>
        @endif
    </div>
@elseif($popin->design == 'bottom_right')
    <div id="bottom-right-overlay" style="background-color: {{ $popin->bg_color }}">
        <p class="close_popin" style="cursor:pointer;color:white;text-align:right;margin:0px">✖</p>
        <div style="display:flex;align-items:center">
            @if ($popin->image)
                <img src="{{ asset('uploads/popin_images/' . $popin->image) }}"
                    style="border-radius:50px;width:50px;height:50px;margin:10px" alt="Image">
            @endif
            <p style="color:white"><b>{{ $popin->heading }}</b></p>
        </div>
        @if ($popin->url)
            <a href="{{ $popin->url }}" target="_blank" class="btn btn-light"
                style="width:100%;color:white;background-color:{{ $popin->btn_color }};margin-bottom:10px">{{ $popin->title }}</a>
        @endif
        <div style="color:white">{!! $popin->description !!}</div>
    </div>
@endif
