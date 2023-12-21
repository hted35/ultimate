@if($country)
<form action="{{ route('admin.expanses.country.save', $country->country_code ) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <div id="myGroup">
            <a  class="btn btn-sm btn-outline--primary ms-1 mb-2 updateBtn" type="button" data-bs-toggle="collapse" data-bs-target="#documents" aria-expanded="true" aria-controls="documents"><i class="la la-edit"></i>  @lang('Documents')</a>
            <a  class="btn btn-sm btn-outline--primary ms-1 mb-2 updateBtn" type="button" data-bs-toggle="collapse" data-bs-target="#fees" aria-expanded="false" aria-controls="fees"><i class="la la-tag"></i> @lang('Fees')</a>
            <div class="accordion-group">
                <div class="collapse show"  data-bs-parent="#myGroup" id="documents">
                    <div class="card card-body">
                        <div class="row">
                            @forelse($documents as $item)
                                <div class="form-group col-lg-12">
                                    <label>
                                        <input type="checkbox" name="setting[{{ $item['code'] }}]" class="" value="1" {{ Hted35\Hattat::_IsChecked($country->settings, $item['code']) }}> {{ $item['title'] }}
                                        <small><i class="la la-info-circle"></i> {{ $item['description'] }}</small>
                                    </label>
                                </div>
                            @empty
                            @endforelse
                        </div>

                    </div>
                </div>
                <div class="collapse" data-bs-parent="#myGroup" id="fees"> sadasd
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn--primary w-100 h-45">@lang('Submit')</button>
    </div>
</form>
@else
ssss
@endif
