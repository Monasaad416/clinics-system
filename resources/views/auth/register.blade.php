<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('الإسم')"  style="text-align: right"/>
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('البريد الإلكتروني')"   style="text-align: right"/>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('كلمة السر')"  style="text-align: right"  style="text-align: right"/>

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('تأكيد كلمة السر')"  style="text-align: right"/>

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                @php
                    $branches = App\Models\Branch::all();
                    $departments = App\Models\Department::all();
                @endphp
                <label class= 'block font-medium text-sm text-gray-700 mt-2'  style="text-align: right">الفرع</label>
                <select name="branch_id" style="width: 100%" class = 'mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm' style="text-align: right">
                    <option value="">--إختر الفرع--</option>
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->name_ar }}</option>
                    @endforeach
                    
                </select>

                <label class= 'block font-medium text-sm text-gray-700 mt-2'  style="text-align: right">القسم</label>
                <select name="department_id" style="width: 100%" class = 'mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm'>
                   <option value="">--إختر القسم--</option>
                    @foreach ($departments as $dep)
                        <option value="{{ $dep->id }}">{{ $dep->name_ar }}</option>
                    @endforeach
                    
                </select>
                
        </div>

        {{-- <!-- Role Selection-->
        <div class="mt-4">
        <label for="role_name"> Select Role </label>   <br>
          <select name="roles_name" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            <option value="superadmin">Super Admin</option>
            <option value="admin">Admin</option>
            <option value="reception">Reception</option>
            <option value="marketing">Marketing</option>
            <option value="financial">Finantial</option>
            <option value="customer_service">Customer Service</option>
            <option value="nursing">Nusring</option>
            <option value="doctor">Doctor</option>
            <option value="client">Client</option>
          </select>

        </div> --}}

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script>
    // console.log("dddddddddd");
  $(document).ready(function () {
        $('select[name="branch_id"]').on('change', function () {
            var branch_id = $(this).val();
            console.log(branch_id);
            if (branch_id) {
                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ URL::to("/admin/getDepartmentsByBranch") }}/" + branch_id,
                    type: "GET",
                    dataType:"json",
                    success: function (data) {
                        $('select[name="department_id"]').empty();
                        $('select[name="department_id"]').append('<option value="selected disabled">إختر القسم </option>');
                        $.each(data, function (key, value) {

                            $('select[name="department_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },

                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });

<script>
