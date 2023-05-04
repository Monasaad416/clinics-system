@if($current_screen == 1) 
    <div class="card-body">
        <div class="form-group">
            <input  type="text" wire:model="first_name_en" class='form-control  mt-1 mb-3' placeholder= 'أدخل الأسم الاول بالإنجليزية'>
            @error('first_name_en')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <input type="text" wire:model='first_name_ar' class ='form-control  mt-1 mb-3' placeholder = 'أدخل الإسم الأول بالعربية'>
            @error('first_name_ar')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <input type="text" wire:model='last_name_en' class ='form-control  mt-1 mb-3' placeholder ='أدخل الأسم الاول بالإنجليزية'>
            @error('last_name_en')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <input type= "text" wire:model='last_name_ar' class ='form-control  mt-1 mb-3' placeholder= 'أدخل الإسم الأول بالعربية'>
            @error('last_name_ar')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <input type= "text" wire:model='about_en' class ='form-control  mt-1 mb-3' placeholder ='أدخل  نبذة عن الطبيب باللغة الإنجليزية'>
            @error('about_en')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <input type= "text" wire:model='about_ar' class ='form-control  mt-1 mb-3' placeholder =' نبذة عن الطبيب باللغة العربية'>
            @error('about_ar')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <input type= "text" wire:model='email' class ='form-control  mt-1 mb-3' placeholder ='أدخل البريد الإلكتروني'>
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <input type= "text" wire:model='phone' class ='form-control  mt-1 mb-3' placeholder ='أدخل رقم الهاتف '>
            @error('phone')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>


        <div class="form-group">
            <input type= "radio" wire:model='gender' value="1">  Male
            <input type= "radio" wire:model='gender', value="2">  Female
        </div>

          <button class="btn btn-primary my-2" wire:click="firstStep" >التالي</button>
    </div>  


@endif










        

