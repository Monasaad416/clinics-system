@if($current_screen == 3)


        <div class="form-group">
            <select wire:model="branch_id" class ="form-control mt-1 mb-3">
                 <option value="">إختر الفرع  </option>
                @foreach ($branches as $branch )
                    <option value="{{ $branch->id }}">{{ $branch->name_ar }}</option>
                @endforeach
            </select>
            @error('branch_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

    <div class="form-group">
        <input  type="number" min="0" wire:model="salary" class='form-control  mt-1 mb-3' placeholder= 'أدخل راتب الطبيب'>
        @error('salary')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <input  type="number" min="0" wire:model="fees" class='form-control  mt-1 mb-3' placeholder= 'أدخل  رسوم الكشف '>
        @error('fees')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <input  type="number" min="0" wire:model="discount_fees" class='form-control  mt-1 mb-3' placeholder= ' أدخل  رسوم الكشف في حالة وجود خصم '>
        @error('discount_fees')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>


    {{-- <div class="form-group">
            <select wire:model ="days" class ="form-control  mt-1 mb-3" multiple>
                <option value="">إختر أيام العمل  </option>
             
                    <option value="1">السبت</option>
                    <option value="2">الاحد</option>
                    <option value="3">الاثنين</option>
                    <option value="4}">الثلاثاء</option>
                    <option value="5">الاربعاء</option>
                    <option value="6">الخميس</option>
            
            </select>

            @error('days')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
    </div> --}}


  
        <button class="btn btn-primary my-5 mx-2" wire:click="submitForm" >حفظ</button>
        <button class="btn btn-primary float-right my-5 mx-2" wire:click="back(2)" >رجوع</button>
@endif