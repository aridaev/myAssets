<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_tag',
        'barcode',
        'permalink_slug',
        'model_number',
        'manufacturer',
        'model_name',
        'model_description',
        'category_id',
        'area_id',
        'location_id',
        'employee_id',
        'leader_id',
        'serial_number',
        'purchase_date',
        'purchase_cost',
        'warranty_expiry',
        'status',
        'is_used',
        'notes',
        'image',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'warranty_expiry' => 'date',
        'purchase_cost' => 'decimal:2',
        'is_used' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($asset) {
            // Auto-generate permalink_slug
            if (empty($asset->permalink_slug)) {
                $asset->permalink_slug = Str::uuid()->toString();
            }
            
            // Auto-generate asset_tag dari ID terakhir + 1
            if (empty($asset->asset_tag)) {
                $lastAsset = static::orderBy('id', 'desc')->first();
                $nextId = $lastAsset ? $lastAsset->id + 1 : 1;
                $asset->asset_tag = 'AST-' . str_pad($nextId, 6, '0', STR_PAD_LEFT);
            }
        });

        static::created(function ($asset) {
            // Update barcode setelah asset dibuat (karena butuh ID dan category)
            // Format: KATEGORI-ASSETID (contoh: LAPTOP-000001)
            $categorySlug = $asset->category ? strtoupper($asset->category->slug) : 'ASSET';
            $barcode = $categorySlug . '-' . str_pad($asset->id, 6, '0', STR_PAD_LEFT);
            $asset->update(['barcode' => $barcode]);
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function leader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'leader_id');
    }

    public function getIsUsedLabelAttribute(): string
    {
        return $this->is_used ? 'Digunakan' : 'Tidak Digunakan';
    }

    public function getIsUsedBadgeAttribute(): string
    {
        return $this->is_used ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800';
    }

    public function scopeForLeader($query, $leaderId)
    {
        return $query->where('leader_id', $leaderId);
    }

    public function getPermalinkAttribute(): string
    {
        return url('/asset/' . $this->permalink_slug);
    }

    public function getQrCodeUrlAttribute(): string
    {
        return 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' . urlencode($this->permalink);
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'available' => 'bg-green-100 text-green-800',
            'in_use' => 'bg-blue-100 text-blue-800',
            'maintenance' => 'bg-yellow-100 text-yellow-800',
            'retired' => 'bg-gray-100 text-gray-800',
            'lost' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'available' => 'Tersedia',
            'in_use' => 'Digunakan',
            'maintenance' => 'Maintenance',
            'retired' => 'Retired',
            'lost' => 'Hilang',
            default => $this->status,
        };
    }
}
