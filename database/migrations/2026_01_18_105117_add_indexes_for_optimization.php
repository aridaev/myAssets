<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Assets table indexes
        Schema::table('assets', function (Blueprint $table) {
            // Index untuk filter dan sorting yang sering digunakan
            $table->index('status');
            $table->index('is_used');
            $table->index('purchase_date');
            $table->index('warranty_expiry');
            $table->index('created_at');
            
            // Composite index untuk filter kombinasi
            $table->index(['status', 'is_used']);
            $table->index(['leader_id', 'status']);
            $table->index(['category_id', 'status']);
            $table->index(['location_id', 'status']);
        });

        // Activity logs table indexes
        Schema::table('activity_logs', function (Blueprint $table) {
            $table->index('action');
            $table->index('created_at');
            $table->index(['user_id', 'created_at']);
            $table->index(['action', 'created_at']);
        });

        // Employees table indexes
        Schema::table('employees', function (Blueprint $table) {
            $table->index('name');
            $table->index('is_active');
            $table->index('department');
        });

        // Categories table indexes
        Schema::table('categories', function (Blueprint $table) {
            $table->index('is_active');
            $table->index('name');
        });

        // Areas table indexes
        Schema::table('areas', function (Blueprint $table) {
            $table->index('is_active');
            $table->index('name');
        });

        // Locations table indexes
        Schema::table('locations', function (Blueprint $table) {
            $table->index('is_active');
            $table->index('name');
        });

        // Settings table index
        Schema::table('settings', function (Blueprint $table) {
            $table->index('group');
        });

        // Users table indexes
        Schema::table('users', function (Blueprint $table) {
            $table->index('role_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['is_used']);
            $table->dropIndex(['purchase_date']);
            $table->dropIndex(['warranty_expiry']);
            $table->dropIndex(['created_at']);
            $table->dropIndex(['status', 'is_used']);
            $table->dropIndex(['leader_id', 'status']);
            $table->dropIndex(['category_id', 'status']);
            $table->dropIndex(['location_id', 'status']);
        });

        Schema::table('activity_logs', function (Blueprint $table) {
            $table->dropIndex(['action']);
            $table->dropIndex(['created_at']);
            $table->dropIndex(['user_id', 'created_at']);
            $table->dropIndex(['action', 'created_at']);
        });

        Schema::table('employees', function (Blueprint $table) {
            $table->dropIndex(['name']);
            $table->dropIndex(['is_active']);
            $table->dropIndex(['department']);
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropIndex(['is_active']);
            $table->dropIndex(['name']);
        });

        Schema::table('areas', function (Blueprint $table) {
            $table->dropIndex(['is_active']);
            $table->dropIndex(['name']);
        });

        Schema::table('locations', function (Blueprint $table) {
            $table->dropIndex(['is_active']);
            $table->dropIndex(['name']);
        });

        Schema::table('settings', function (Blueprint $table) {
            $table->dropIndex(['group']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['role_id']);
        });
    }
};
