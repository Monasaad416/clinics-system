<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */   public function run()
    {
        $permissions = [
            'dashboard',
            'dashboard-1',
            'dashboard-2',
            'dashboard-3',
            
            'roles-list',
            'roles-create',
            'roles-edit',
            'roles-delete',
            'roles-show',

            'settings-edit',

            'branches-list',
            'branches-create',
            'branches-edit',
            'branches-delete',
            'branches-show',

            
            'employees-list',
            'employees-create',
            'employees-edit',
            'employees-delete',
            'employees-delete-permanent',


            'doctors-list',
            'doctors-create',
            'doctors-edit',
            'doctors-delete',

            'clients-list',
            'clients-create',
            'clients-edit',
            'clients-delete',



            'departments-list',
            'departments-create',
            'departments-edit',
            'departments-delete',


            'specialists-list',
            'specialists-create',
            'specialists-edit',
            'specialists-delete',
            'specialists-show',

            'sub-pecialists-list',
            'sub-pecialists-create',
            'sub-pecialists-edit',
            'sub-pecialists-delete',
            'sub-pecialists-show',

            'payments-list',
            'payments-create',
            'payments-edit',
            'payments-delete',
            'payments-show',


            'financila-list',

            'offers-list',
            'offers-create',
            'offers-edit',
            'offers-delete',
            'offers-show',

            
            'invoices-list',
            'invoices-create',
            'invoices-edit',
            'invoices-delete',
            'invoices-show',

            'services-list',
            'services-create',
            'services-edit',
            'services-delete',
            'services-show',

            'reservations-list',
            'reservations-create',
            'reservations-edit',
            'reservations-delete',
            'reservations-show',


            'clients_payments-list',
            'clients_payments-create',
            'clients_payments-edit',
            'clients_payments-delete',
            'clients_payments-show',


        //     'reservations-show-3',
        //     'employees-list-1',
        //     'employees-create-1',
        //     'employees-edit-1',
        //     'employees-delete-1',
        //     'employees-delete-permanent-1',

        //     'employees-list-2',
        //     'employees-create-2',
        //     'employees-edit-2',
        //     'employees-delete-permanent-2',

        //     'employees-list-3',
        //     'employees-create-3',
        //     'employees-edit-3',
        //     'employees-delete-permanent-3',

        //     'doctors-list-1',
        //     'doctors-create-1',
        //     'doctors-edit-1',
        //     'doctors-delete-1',

        //     'doctors-list-2',
        //     'doctors-create-2',
        //     'doctors-edit-2',
        //     'doctors-delete-2',

        //     'doctors-list-3',
        //     'doctors-create-3',
        //     'doctors-edit-3',
        //     'doctors-delete-3',


        //     'clients-list-1',
        //     'clients-create-1',
        //     'clients-edit-1',
        //     'clients-delete-1',

        //     'clients-list-2',
        //     'clients-create-2',
        //     'clients-edit-2',
        //     'clients-delete-2',

        //     'clients-list-3',
        //     'clients-create-3',
        //     'clients-edit-3',
        //     'clients-delete-3',

        //     'departments-list-1',
        //     'departments-create-1',
        //     'departments-edit-1',
        //     'departments-delete-1',

        //     'departments-list-2',
        //     'departments-create-2',
        //     'departments-edit-2',
        //     'departments-delete-2',

        //     'departments-list-3',
        //     'departments-create-3',
        //     'departments-edit-3',
        //     'departments-delete-3',

        //     'specialists-list-1',
        //     'specialists-create-1',
        //     'specialists-edit-1',
        //     'specialists-delete-1',
        //     'specialists-show-1',

        //     'specialists-list-2',
        //     'specialists-create-2',
        //     'specialists-edit-2',
        //     'specialists-delete-2',
        //     'specialists-show-2',

        //     'specialists-list-3',
        //     'specialists-create-3',
        //     'specialists-edit-3',
        //     'specialists-delete-3',
        //     'specialists-show-3',

        //     'sub-pecialists-list-1',
        //     'sub-pecialists-create-1',
        //     'sub-pecialists-edit-1',
        //     'sub-pecialists-delete-1',
        //     'sub-pecialists-show-1',
        
        //     'sub-pecialists-list-2',
        //     'sub-pecialists-create-2',
        //     'sub-pecialists-edit-2',
        //     'sub-pecialists-delete-2',
        //     'sub-pecialists-show-2',
            
        //     'sub-pecialists-list-3',
        //     'sub-pecialists-create-3',
        //     'sub-pecialists-edit-3',
        //     'sub-pecialists-delete-3',
        //     'sub-pecialists-show-3',

        //     'payments-list-1',
        //     'payments-create-1',
        //     'payments-edit-1',
        //     'payments-delete-1',
        //     'payments-show-1',

        //     'payments-list-2',
        //     'payments-create-2',
        //     'payments-edit-2',
        //     'payments-delete-2',
        //     'payments-show-2',

        //     'payments-list-3',
        //     'payments-create-3',
        //     'payments-edit-3',
        //     'payments-delete-3',
        //     'payments-show-3',

        //     'financila-list-1',
        //     'financila-list-2',
        //     'financila-list-3',

        //     'offers-list-1',
        //     'offers-create-1',
        //     'offers-edit-1',
        //     'offers-delete-1',
        //     'offers-show-1',

        //     'offers-list-2',
        //     'offers-create-2',
        //     'offers-edit-2',
        //     'offers-delete-2',
        //     'offers-show-2',

        //     'offers-list-3',
        //     'offers-create-3',
        //     'offers-edit-3',
        //     'offers-delete-3',
        //     'offers-show-3',

            
        //     'invoices-list-1',
        //     'invoices-create-1',
        //     'invoices-edit-1',
        //     'invoices-delete-1',
        //     'invoices-show-1',

        //     'invoices-list-2',
        //     'invoices-create-2',
        //     'invoices-edit-2',
        //     'invoices-delete-2',
        //     'invoices-show-2',


        //     'invoices-list-3',
        //     'invoices-create-3',
        //     'invoices-edit-3',
        //     'invoices-delete-3',
        //     'invoices-show-3',

        //     'services-list-1',
        //     'services-create-1',
        //     'services-edit-1',
        //     'services-delete-1',
        //     'services-show-1',

        //     'services-list-2',
        //     'services-create-2',
        //     'services-edit-2',
        //     'services-delete-2',
        //     'services-show-2',

        //     'services-list-3',
        //     'services-create-3',
        //     'services-edit-3',
        //     'services-delete-3',
        //     'services-show-3',

        //     'reservations-list-1',
        //     'reservations-create-1',
        //     'reservations-edit-1',
        //     'reservations-delete-1',
        //     'reservations-show-1',

        //     'reservations-list-2',
        //     'reservations-create-2',
        //     'reservations-edit-2',
        //     'reservations-delete-2',
        //     'reservations-show-2',

        //     'reservations-list-3',
        //     'reservations-create-3',
        //     'reservations-edit-3',
        //     'reservations-delete-3',
        //     'reservations-show-3',  
         ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
