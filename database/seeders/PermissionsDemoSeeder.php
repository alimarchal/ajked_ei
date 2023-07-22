<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsDemoSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        // Define an array of permissions and roles with their corresponding mapping
        $permissions = [
            'view_wiring_contractors',
            'register_wiring_contractor',
            'block/allow_wiring_contractors',
            'submit_test_report_form',
            'validate_test_report',
            'make_objection_test_report',
            'issue_noc',
            'view_noc_cases',
            'view_issued_nocs',
            'view_pending_approval',
            'view_issued_test_reports',
            'view_approved_test_reports',
            'view_objected_reports',
            'view_deposited_amount',
            'view_existing_connections',
            'view_new_connections',
            'view_annual_inspections',
            'view_challan_form',
            'apply_wc_license_renewal',
            'view_wc_license_renewal',
            'license_cancelation_recomandation',
            'view_noc_fee_notification',
            'view_wc_fee_notification',
            'apply_test_reports_qouta',
            'allot_test_reports_qouta',
            'view_test_reports_qouta',
            'download_files',
        ];

        // Create permissions
        foreach ($permissions as $permissionName) {
            Permission::create(['name' => $permissionName]);
        }

        // Create roles and assign permissions
        $roles = [
            'Wiring Contractor',
            'DEI',
            'AEI',
            'SDO',
            'X-En',
            'Electric Inspector',
            'Super-Admin',
        ];

        foreach ($roles as $roleName) {
            $role = Role::create(['name' => $roleName]);

            // Assign permissions based on the table data
            switch ($roleName) {
                case 'Wiring Contractor':
                    $role->syncPermissions([
                        'submit_test_report_form',
                        'view_issued_test_reports',
                        'view_approved_test_reports',
                        'view_objected_reports',
                        'view_challan_form',
                        'apply_wc_license_renewal',
                        'view_wc_fee_notification',
                        'apply_test_reports_qouta',
                        'view_test_reports_qouta',
                        'download_files',
                    ]);
                    break;
                case 'DEI':
                    $role->syncPermissions([
                        'view_wiring_contractors',
                        'validate_test_report',
                        'make_objection_test_report',
                        'view_noc_cases',
                        'view_issued_nocs',
                        'view_pending_approval',
                        'view_issued_test_reports',
                        'view_approved_test_reports',
                        'view_objected_reports',
                        'view_deposited_amount',
                        'view_existing_connections',
                        'view_new_connections',
                        'view_annual_inspections',
                        'view_challan_form',
                        'license_cancelation_recomandation',
                        'view_noc_fee_notification',
                        'view_wc_fee_notification',
                        'view_test_reports_qouta',
                        'download_files',
                    ]);
                    break;
                case 'AEI':
                    $role->syncPermissions([
                        'view_wiring_contractors',
                        'validate_test_report',
                        'make_objection_test_report',
                        'view_noc_cases',
                        'view_issued_nocs',
                        'view_pending_approval',
                        'view_issued_test_reports',
                        'view_approved_test_reports',
                        'view_objected_reports',
                        'view_deposited_amount',
                        'view_existing_connections',
                        'view_new_connections',
                        'view_annual_inspections',
                        'view_challan_form',
                        'license_cancelation_recomandation',
                        'view_noc_fee_notification',
                        'view_wc_fee_notification',
                        'view_test_reports_qouta',
                        'download_files',
                    ]);
                    break;
                case 'SDO':
                    $role->syncPermissions([
                        'view_wiring_contractors',
                        'validate_test_report',
                        'make_objection_test_report',
                        'view_pending_approval',
                        'view_issued_test_reports',
                        'view_approved_test_reports',
                        'view_objected_reports',
                        'download_files',
                    ]);
                    break;
                case 'X-En':
                    $role->syncPermissions([
                        'view_wiring_contractors',
                        'validate_test_report',
                        'make_objection_test_report',
                        'view_pending_approval',
                        'view_issued_test_reports',
                        'view_approved_test_reports',
                        'view_objected_reports',
                        'download_files',
                    ]);
                    break;
                case 'Electric Inspector':
                    $role->syncPermissions([
                        'view_wiring_contractors',
                        'register_wiring_contractor',
                        'block/allow_wiring_contractors',
                        'make_objection_test_report',
                        'issue_noc',
                        'view_noc_cases',
                        'view_issued_nocs',
                        'view_pending_approval',
                        'view_issued_test_reports',
                        'view_approved_test_reports',
                        'view_objected_reports',
                        'view_deposited_amount',
                        'view_existing_connections',
                        'view_new_connections',
                        'view_annual_inspections',
                        'view_challan_form',
                        'view_wc_license_renewal',
                        'view_noc_fee_notification',
                        'view_wc_fee_notification',
                        'allot_test_reports_qouta',
                        'view_test_reports_qouta',
                        'download_files',
                    ]);
                    break;
                case 'Super-Admin':
                    // Super-Admin already has all permissions via Gate::before rule
                    break;
                default:
                    break;
            }
        }


        // Create relevant demo users
        $usersData = [
            [
                'name' => 'Wiring Contractor User',
                'email' => 'wiring@ajkced.gok.pk',
                'role' => 'Wiring Contractor',
            ],
            [
                'name' => 'DEI User',
                'email' => 'dei@ajkced.gok.pk',
                'role' => 'DEI',
            ],
            [
                'name' => 'AEI User',
                'email' => 'aei@ajkced.gok.pk',
                'role' => 'AEI',
            ],
            [
                'name' => 'SDO User',
                'email' => 'sdo@ajkced.gok.pk',
                'role' => 'SDO',
            ],
            [
                'name' => 'X-En User',
                'email' => 'xen@ajkced.gok.pk',
                'role' => 'X-En',
            ],
            [
                'name' => 'Electric Inspector User',
                'username' => 'electric_inspector',
                'email' => 'electric.inspector@ajkced.gok.pk',
                'role' => 'Electric Inspector',
            ],
            [
                'name' => 'Super-Admin User',
                'username' => 'superadmin_user',
                'email' => 'superadmin@ajkced.gok.pk',
                'role' => 'Super-Admin',
            ],
        ];

        foreach ($usersData as $userData) {
            $user = \App\Models\User::factory()->create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make('123456'), // Set the password to "123456"
            ]);
            $user->assignRole($userData['role']);
        }

    }
}
