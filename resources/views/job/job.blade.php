@extends("layouts.app")

@section('styles')

<link rel="stylesheet" type="text/css" href="/css/job_hire.css">
<link rel="stylesheet" type="text/css" href="/css/job_apply.css">
<link rel="stylesheet" type="text/css" href="/AdminLTE-3.0.5/plugins/select2/css/select2.min.css">
<style>
    label {
        z-index: 1;
    }

    .select2-container {
        width: 100% !important;
        z-index: 0 !important;
    }

    .select2-container.select2-container--open {
        box-shadow: 0px 0px 4px 0px #00000040;
        z-index: 4 !important;
    }

    .select2-container.select2-container--open .select2-dropdown.select2-dropdown--below {
        z-index: 4 !important;
    }

    .select2-selection {
        height: 61px !important;
        display: flex !important;
        align-items: center !important;
        border-color: #ced4da !important;
    }

    .select2-selection .select2-selection__rendered {
        flex: 1;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__rendered {
        padding-top: 20px;
    }

    .select2-container--default .select2-selection__arrow {
        height: 20px !important;
        background: url('{{ asset('images/arrow_down.svg') }}') center no-repeat;
        position: relative !important;
    }

    .select2-selection.select2-selection--multiple {
        background: url('{{ asset('images/arrow_down.svg') }}') right no-repeat;
        position: relative !important;
        background-origin: content-box;
        padding-right: 15px;
    }

    .select2-selection.select2-selection--multiple {
        width: 100%;
    }

    .select2-container--default .select2-selection__arrow b {
        border: none !important;
    }

    .select2-container--default.select2-container--open .select2-selection__arrow {
        background: url('{{ asset('images/arrow_up.svg') }}') center no-repeat;
    }

    .select2-container--open .select2-selection.select2-selection--multiple {
        background: url('{{ asset('images/arrow_up.svg') }}') right no-repeat;
        background-origin: content-box;
        padding-right: 15px;
    }

    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #ECECEC !important;
        color: #143E59 !important;
    }

    .select2-results__option {
        color: #143E59 !important;
        padding: 12px 6px !important;
    }

    .select2-container--default .select2-results__option[aria-selected=true] {
        background-color: #143E59 !important;
        color: #ffffff !important;
        background-image: url('{{ asset('images/check.svg') }}');
        background-repeat: no-repeat;
        background-position-x: right;
        background-position-y: center;
        background-origin: content-box;
    }

    .select2-container--default .select2-results__option[aria-disabled=true] {
        color: #C4C4C4 !important;
        background-image: url('{{ asset('images/disabled_check.svg') }}');
        background-repeat: no-repeat;
        background-position-x: right;
        background-position-y: center;
        background-origin: content-box;
    }

    .select2-container--default .select2-results__options[aria-multiselectable="true"] .select2-results__option::before {
        display: inline-block;
        content: '';
        width: 25px;
        height: 10px;
    }

    .select2-container--default .select2-results__options[aria-multiselectable="true"] .select2-results__option {
        background-position-x: left;
        background-repeat: no-repeat;
        background-position-y: center;
        background-origin: content-box;
        background-image: url('{{ asset('images/empty_check.svg') }}');
        padding-left: 25px !important;
    }

    .select2-container--default .select2-results__options[aria-multiselectable="true"] .select2-results__option[aria-selected=true] {
        background-position-x: left;
        background-image: url('{{ asset('images/checked_check.svg') }}');
    }

    .select2-dropdown.select2-dropdown--below {
        border-color: #ced4da !important;
        box-shadow: 0px 0px 4px 0px #00000040;
    }

    .apply_custom_form_group {
        z-index: 0;
    }

    .apply_custom_form_group.dropdown {
        z-index: 3;
    }

    .select2-selection--multiple .select2-selection__choice {
        padding-right: 15px !important;
    }

    .select2-selection__choice {
        background-color: #143E59 !important;
        border-color: #143E59 !important;
        padding: 0 15px;
        position: relative;
     }

    .select2-selection__choice,
    .select2-selection__choice__remove {
        color: #ffffff !important;
        padding-left: 2.5px !important;
    }

    .select2-selection__choice__remove {
        position: absolute;
        right: 0;
    }

    .select2-selection.select2-selection--single {
        padding-right: 10px;
    }

    .select2-selection.select2-selection--multiple .select2-search {
        margin-top: -25px;
    }
</style>
@endsection



@section('content')

@include('job.job_banner')

@include('job.job_hire')

@include('job.job_apply')

@endsection

@section('scripts')

<script src="js/job/job_apply.js"></script>
<script src="js/job/job_validation.js"></script>
<script src="/AdminLTE-3.0.5/plugins/select2/js/select2.min.js"></script>
<script>
@if(Session::has('success'))
    $('#myModal').modal('show');
@endif
    $('#experience').select2({
        minimumResultsForSearch: Infinity,
    });

    $('#frameworks').select2({
        placeholder: '{{ __('Select frameworks') }}',
    });

    $('#tools').select2({
        placeholder: '{{ __('Select tools') }}',
    });
    $('.select2-search__field').css('width', '100%');

    $('#frameworks,#tools').on('select2:opening select2:closing', function (event) {
        var $searchfield = $(this).parent().find('.select2-search__field');
        $searchfield.prop('disabled', true);

        var parent = $(this).closest('.dropdown');
        if (event.type == 'select2:opening') {
            if (parent) {
                parent.find('label').css({'z-index': 10});
            }
        } else {
            if (parent) {
                parent.find('label').css({'z-index': 3});
            }
        }
    });

    $('select').on('select2:select', function (event) {
        var options = Array.from(event.target.options);
        if (options.filter(o => o.selected).length == 3) {
            Array.from(options.filter(o => !o.selected)).forEach(option => $(option).prop('disabled', true));
        }
    });

    $('select').on('select2:unselect', function (event) {
        $(event.target).find(':not([aria-selected=true])').prop('disabled', false);
    });

    $('#experience').on('change', function () {
        if ($(this).val() == '0') {
            $('#no-experience-fields').show();
            $('#experienced-fields').hide();
        } else {
            $('#no-experience-fields').hide();
            $('#experienced-fields').show();
        }
    });
</script>
@endsection
