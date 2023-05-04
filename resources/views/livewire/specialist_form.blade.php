@if($current_screen ==2)

        <div class="form-group">
            <select wire:model="doctor_title_id" class ="form-control  mt-1 mb-3">
                 <option value="">إختار المسمي الوظيفي </option>
                @foreach ($doctoTitles as $title )
                    <option value="{{ $title->id }}">{{ $title->name_ar }}</option>
                @endforeach
            </select>

            @error('doctor_title_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <select wire:model ="professional_title_id" class ="form-control  mt-1 mb-3">
                <option value="">إختار اللقب المهني </option>
                @foreach ($professionalTitles as $title )
                    <option value="{{ $title->id }}">{{ $title->name_en }}</option>
                @endforeach
            </select>

            @error('professional_title_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>


        <div class="form-group">
            <select wire:model ="specialist_id" name="specialist_id"  class ="form-control  mt-1 mb-3">
                <option value="">إختارالتخصص الرئيسي  </option>
                @foreach ($specialists as $sp )
                    <option value="{{ $sp->id }}">{{ $sp->name_en }}</option>
                @endforeach
            </select>
            @error('specialist_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>


        <div class="form-group">
            <select wire:model ="sub_specialist_ids" name="specialist_id"  class ="form-control  mt-1 mb-3" multiple>
                <option value="">إختارالتخصص الفرعي  </option>
                @foreach ($subSpecialists as $ssp )
                    <option value="{{ $ssp->id }}">{{ $ssp->name_en }}</option>
                @endforeach
            </select>

            @error('sub_specialist_ids')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        {{-- <div class="form-group" >
            <select model.debounce.500ms="sub_specialist_id" name="sub_specialist_id" class ="form-control  mt-1 mb-3" multiple>
            
        
            </select>
        </div> --}}

  


        <div class="form-group">
          <input type="file" wire:model="p_image"> <span class="text-muted"> صورةإثبات بطاقة مزاولة المهنة </span>
          
            @error('p_image')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
          <input type="file" wire:model="title_image"> <span class="text-muted">صورةإثبات اللقب المهني </span>
             @error('title_image')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>


        
        <button class="btn btn-primary my-5 mx-2" wire:click="secStep" >التالي</button>
        <button class="btn btn-primary float-right my-5 mx-2" wire:click="back(2)" >رجوع</button>
@endif



{{-- @push('scripts')
    <script>
  $(document).ready(function () {
        $('select[name="specialist_id"]').on('change', function () {
            var specialist_id = $(this).val();
console.log(specialist_id);
            if (specialist_id) {
                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ URL::to("/admin/getSubSpecialistsBySpecialist") }}/" + specialist_id,
                    type: "GET",
                    dataType:"json",
                    success: function (data) {
                        $('select[name="sub_specialist_id"]').empty();
                        $('select[name="sub_specialist_id"]').append('<option value="selected disabled">إختار التخصص الفرعي</option>');
                        $.each(data, function (key, value) {

                            $('select[name="sub_specialist_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },

                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
    </script>
@endpush --}}
