<div class="row">
    <div class="col">
        @include('inc.messages')

        <div class="stepwizard">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step">
                    <a href="#step-1" type="button"
                       class="btn btn-circle {{ $current_screen != 1 ? 'btn-default' : 'btn-primary' }}">1</a>
                    <p>المعلومات الأساسية</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-2" type="button"
                       class="btn btn-circle {{ $current_screen != 2 ? 'btn-default' : 'btn-primary' }}">2</a>
                    <p>التخصص</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-3" type="button"
                       class="btn btn-circle {{ $current_screen != 3 ? 'btn-default' : 'btn-primary' }}"
                       disabled="disabled">3</a>
                    <p>المنشأة</p>
                </div>
            </div>
        </div>

        @include('livewire.main_info')
        @include('livewire.specialist_form')
         @include('livewire.clinic_info_form')

       
{{-- 
        <div class="row setup-content {{ $current_screen != 3 ? 'displayNone' : '' }}" id="step-3">
            @if ($current_screen != 3)
            <div style="display: none" class="row setup-content" id="step-3">
            @endif
                <div class="col-xs-12">
                    <div class="col-md-12"><br>
                        <label style="color: red">{{trans('parent_trans.attachments')}}</label>
                        <div class="form-group">
                            <input type="file" wire:model="photos" accept="image/*" multiple>
                        </div>
                        <br>

                        <input type="hidden" wire:model="Parent_id">

                        <button class="button-danger float-right" type="button"
                                wire:click="back(2)">الرجوع</button>

                        @if($updateMode)
                    <button class="button-danger float-right mr-2" type="button" wire:click="back(2)">الرجوع</button>
                        @else
                    <button class="button btn-sm btn-lg pull-right" wire:click="submitForm" type="button">حفظ</button>
                        @endif

                    </div>
                </div>
            </div>
        </div>  --}}
    </div>
</div>

