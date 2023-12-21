@extends('admin.layouts.app')
@section('panel')

    <div class="row">
        <div class="col-md-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two custom-data-table">
                            <thead>
                            <tr>
                                <th>@lang('Name')</th>
                                <th>@lang('ISO Code')</th>
                                <th>@lang('Dial Code')</th>
                                <th>@lang('Has Settings')</th>
                                <th>@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($countries as $item)
                                <tr>
                                    <td>{{ __($item->country) }}</td>
                                    <td>{{ __($item->country_code) }}</td>
                                    <td>+{{ __($item->dial_code) }}</td>
                                    <td>@if($item->has_settings) {!!  '<span class="badge badge--success"><i class="la la-check"></i></span>' !!}  @endif</td>
                                    <td>
                                        <div class="button--group">
                                            <button type="button" class="btn btn-sm btn-outline--primary ms-1 mb-2 updateBtn"
                                                    data-action="{{ route('admin.plugins.update', $item->country) }}"
                                                    data-name="{{ $item->country }}"
                                                    data-country_code="{{ $item->country_code }}"
                                            >
                                                <i class="la la-pen"></i> @lang('Update')
                                            </button>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Edit Country') (<span id="country-name"></span>)</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <div id="country-modal">...</div>
            </div>
        </div>
    </div>

    <x-confirmation-modal />
@endsection
@push('breadcrumb-plugins')

@endpush

@push('style')
    <style>
        .alert{
            padding: 1rem 1rem !important;
        }
    </style>
@endpush
@push('script')
    <script>

        $('.updateBtn').on('click ',function () {
            let modal = $('#updateModal');
            modal.modal('show');
            $('#country-name').html($(this).data('name'));
            $('#country-modal').html('...');
            $.ajax( {
                url:"{{ route('admin.expanses.country') }}/" + $(this).data('country_code'),
                method:"GET"
            } )
                .done(function(html) {
                    $('#country-modal').html(html);
                })
                .fail(function() {

                })
                .always(function() {

                });
        });
    </script>
@endpush
