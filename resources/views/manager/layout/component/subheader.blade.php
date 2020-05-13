<div class="kt-subheader  kt-grid__item" id="kt_subheader">
    <div class="kt-container  kt-container--fluid ">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">{{ $main_text }}</h3>
            <div class="kt-input-icon kt-input-icon--right kt-subheader__search kt-hidden">
                <input type="text" class="form-control" placeholder="Search order..." id="generalSearch">
                <span class="kt-input-icon__icon kt-input-icon__icon--right">
                    <span><i class="flaticon2-search-1"></i></span>
                </span>
            </div>
        </div>
        <div class="kt-subheader__toolbar">
            <div class="kt-subheader__wrapper">
                @if ($btn_text)
                    <a href="{{ $btn_url }}" class="btn btn-label-warning btn-bold btn-sm btn-icon-h kt-margin-l-10">
                        {{ $btn_text }}
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>