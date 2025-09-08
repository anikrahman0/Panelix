<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\PermissionGroup;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::truncate();
        $permissions = [

            // Group - Location
            [
                'group_id'=>1,
                'parent_id'=>0,
                'name'=>'Country',
                'meta_name'=>'country',
                'type'=>1
            ],
            [
                'group_id'=>1,
                'parent_id'=>0,
                'name'=>'City',
                'meta_name'=>'city',
                'type'=>1
            ],
            [
                'group_id'=>1,
                'parent_id'=>0,
                'name'=>'State',
                'meta_name'=>'state',
                'type'=>1
            ],

            // Group - Payments
            [
                'group_id'=>2,
                'parent_id'=>0,
                'name'=>'Payment',
                'meta_name'=>'payment',
                'type'=>1
            ],

            // Group - Administrator

            // parent roles
            [
                'group_id'=>3,
                'parent_id'=>0,
                'name'=>'Roles',
                'meta_name'=>'roles',
                'type'=>1
            ],
            [
                'group_id'=>3,
                'parent_id'=>5,
                'name'=>'Create',
                'meta_name'=>'roles-create',
                'type'=>1
            ],
            [
                'group_id'=>3,
                'parent_id'=>5,
                'name'=>'Update',
                'meta_name'=>'roles-update',
                'type'=>1
            ],
            [
                'group_id'=>3,
                'parent_id'=>5,
                'name'=>'Delete',
                'meta_name'=>'roles-delete',
                'type'=>1
            ],
            
            // parent users
            [
                'group_id'=>3,
                'parent_id'=>0,
                'name'=>'Users',
                'meta_name'=>'users',
                'type'=>1
            ],
            [
                'group_id'=>3,
                'parent_id'=>9,
                'name'=>'Create',
                'meta_name'=>'users-create',
                'type'=>1
            ],
            [
                'group_id'=>3,
                'parent_id'=>9,
                'name'=>'Update',
                'meta_name'=>'users-update',
                'type'=>1
            ],
            [
                'group_id'=>3,
                'parent_id'=>9,
                'name'=>'Delete',
                'meta_name'=>'users-delete',
                'type'=>1
            ],

            // Authors
            [
                'group_id'=>4,
                'parent_id'=>0,
                'name'=>'Authors',
                'meta_name'=>'authors',
                'type'=>1
            ],
            [
                'group_id'=>4,
                'parent_id'=>13,
                'name'=>'Create',
                'meta_name'=>'author-create',
                'type'=>1
            ],
            [
                'group_id'=>4,
                'parent_id'=>13,
                'name'=>'Update',
                'meta_name'=>'author-update',
                'type'=>1
            ],
            [
                'group_id'=>4,
                'parent_id'=>13,
                'name'=>'Delete',
                'meta_name'=>'author-delete',
                'type'=>1
            ],

            // Publishers
            [
                'group_id'=>5,
                'parent_id'=>0,
                'name'=>'Publishers',
                'meta_name'=>'publishers',
                'type'=>1
            ],
            [
                'group_id'=>5,
                'parent_id'=>17,
                'name'=>'Create',
                'meta_name'=>'publisher-create',
                'type'=>1
            ],
            [
                'group_id'=>5,
                'parent_id'=>17,
                'name'=>'Update',
                'meta_name'=>'publisher-update',
                'type'=>1
            ],
            [
                'group_id'=>5,
                'parent_id'=>17,
                'name'=>'Delete',
                'meta_name'=>'publisher-delete',
                'type'=>1
            ],

            // Group - Book Listing
            
            // parent category
            [
                'group_id'=>6,
                'parent_id'=>0,
                'name'=>'Category',
                'meta_name'=>'category',
                'type'=>1
            ],
            [
                'group_id'=>6,
                'parent_id'=>21,
                'name'=>'Create',
                'meta_name'=>'category-create',
                'type'=>1
            ],
            [
                'group_id'=>6,
                'parent_id'=>21,
                'name'=>'Update',
                'meta_name'=>'category-update',
                'type'=>1
            ],
            [
                'group_id'=>6,
                'parent_id'=>21,
                'name'=>'Delete',
                'meta_name'=>'category-delete',
                'type'=>1
            ],

            // parent Book
            [
                'group_id'=>6,
                'parent_id'=>0,
                'name'=>'Book',
                'meta_name'=>'book',
                'type'=>1
            ],
            [
                'group_id'=>6,
                'parent_id'=>25,
                'name'=>'Create',
                'meta_name'=>'book-create',
                'type'=>1
            ],
            [
                'group_id'=>6,
                'parent_id'=>25,
                'name'=>'Update',
                'meta_name'=>'book-update',
                'type'=>1
            ],
            [
                'group_id'=>6,
                'parent_id'=>25,
                'name'=>'Delete',
                'meta_name'=>'book-delete',
                'type'=>1
            ],

            // parent Book Rating & Review
            [
                'group_id'=>6,
                'parent_id'=>0,
                'name'=>'Book Rating Review',
                'meta_name'=>'book-rating-review',
                'type'=>1
            ],
            [
                'group_id'=>6,
                'parent_id'=>29,
                'name'=>'Delete',
                'meta_name'=>'book-review-rating-delete',
                'type'=>1
            ],

            // parent Book Tag

            [
                'group_id'=>6,
                'parent_id'=>0,
                'name'=>'Book Tag',
                'meta_name'=>'book-tag',
                'type'=>1
            ],
            [
                'group_id'=>6,
                'parent_id'=>31,
                'name'=>'Create',
                'meta_name'=>'book-tag-create',
                'type'=>1
            ],
            [
                'group_id'=>6,
                'parent_id'=>31,
                'name'=>'Update',
                'meta_name'=>'book-tag-update',
                'type'=>1
            ],
            [
                'group_id'=>6,
                'parent_id'=>31,
                'name'=>'Delete',
                'meta_name'=>'book-tag-delete',
                'type'=>1
            ],

            // Group - Orders

            // parent Order
            [
                'group_id'=>7,
                'parent_id'=>0,
                'name'=>'Order',
                'meta_name'=>'order',
                'type'=>1
            ],
            [
                'group_id'=>7,
                'parent_id'=>35,
                'name'=>'View Orders',
                'meta_name'=>'view-orders',
                'type'=>1
            ],
            [
                'group_id'=>7,
                'parent_id'=>35,
                'name'=>'View Invoice',
                'meta_name'=>'view-invoice',
                'type'=>1
            ],
            [
                'group_id'=>7,
                'parent_id'=>35,
                'name'=>'Update',
                'meta_name'=>'order-update',
                'type'=>1
            ],


            // Group - Marketing

            // parent Flash Sale
            [
                'group_id'=>8,
                'parent_id'=>0,
                'name'=>'Flash Sale',
                'meta_name'=>'flash-sale',
                'type'=>1
            ],
            [
                'group_id'=>8,
                'parent_id'=>39,
                'name'=>'Create',
                'meta_name'=>'flash-sale-create',
                'type'=>1
            ],
            [
                'group_id'=>8,
                'parent_id'=>39,
                'name'=>'Update',
                'meta_name'=>'flash-sale-update',
                'type'=>1
            ],
            [
                'group_id'=>8,
                'parent_id'=>39,
                'name'=>'Delete',
                'meta_name'=>'flash-sale-delete',
                'type'=>1
            ],

            // parent Coupon
            [
                'group_id'=>8,
                'parent_id'=>0,
                'name'=>'Coupon',
                'meta_name'=>'coupon',
                'type'=>1
            ],
            [
                'group_id'=>8,
                'parent_id'=>43,
                'name'=>'Create',
                'meta_name'=>'coupon-create',
                'type'=>1
            ],
            [
                'group_id'=>8,
                'parent_id'=>43,
                'name'=>'Update',
                'meta_name'=>'coupon-update',
                'type'=>1
            ],
            [
                'group_id'=>8,
                'parent_id'=>43,
                'name'=>'Delete',
                'meta_name'=>'coupon-delete',
                'type'=>1
            ],

            // parent sliders
            [
                'group_id'=>8,
                'parent_id'=>0,
                'name'=>'Sliders',
                'meta_name'=>'sliders',
                'type'=>1
            ],
            [
                'group_id'=>8,
                'parent_id'=>47,
                'name'=>'Create',
                'meta_name'=>'sliders-create',
                'type'=>1
            ],
            [
                'group_id'=>8,
                'parent_id'=>47,
                'name'=>'Update',
                'meta_name'=>'sliders-update',
                'type'=>1
            ],
            [
                'group_id'=>8,
                'parent_id'=>47,
                'name'=>'Delete',
                'meta_name'=>'sliders-delete',
                'type'=>1
            ],

            // Group - Social Media

            // parent social platform
            [
                'group_id'=>9,
                'parent_id'=>0,
                'name'=>'Social Platform',
                'meta_name'=>'social-platform',
                'type'=>1
            ],
            [
                'group_id'=>9,
                'parent_id'=>51,
                'name'=>'Create',
                'meta_name'=>'social-platform-create',
                'type'=>1
            ],
            [
                'group_id'=>9,
                'parent_id'=>51,
                'name'=>'Update',
                'meta_name'=>'social-platform-update',
                'type'=>1
            ],
            [
                'group_id'=>9,
                'parent_id'=>51,
                'name'=>'Delete',
                'meta_name'=>'social-platform-delete',
                'type'=>1
            ],

             // parent blogs
             [
                'group_id'=>9,
                'parent_id'=>0,
                'name'=>'Blogs',
                'meta_name'=>'blogs',
                'type'=>1
            ],
            [
                'group_id'=>9,
                'parent_id'=>55,
                'name'=>'Create',
                'meta_name'=>'blogs-create',
                'type'=>1
            ],
            [
                'group_id'=>9,
                'parent_id'=>55,
                'name'=>'Update',
                'meta_name'=>'blogs-update',
                'type'=>1
            ],
            [
                'group_id'=>9,
                'parent_id'=>55,
                'name'=>'Delete',
                'meta_name'=>'blogs-delete',
                'type'=>1
            ],

            // parent pages
            [
                'group_id'=>9,
                'parent_id'=>0,
                'name'=>'Pages',
                'meta_name'=>'pages',
                'type'=>1
            ],
            [
                'group_id'=>9,
                'parent_id'=>59,
                'name'=>'Create',
                'meta_name'=>'pages-create',
                'type'=>1
            ],
            [
                'group_id'=>9,
                'parent_id'=>59,
                'name'=>'Update',
                'meta_name'=>'pages-update',
                'type'=>1
            ],
            [
                'group_id'=>9,
                'parent_id'=>59,
                'name'=>'Delete',
                'meta_name'=>'pages-delete',
                'type'=>1
            ],

            // Group - General Setting
            
            // parent General Setting
            [
                'group_id'=>10,
                'parent_id'=>0,
                'name'=>'General Setting',
                'meta_name'=>'general-setting',
                'type'=>1
            ],

        ];

        Permission::insert($permissions);

    }
}
