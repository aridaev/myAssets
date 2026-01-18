<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'action',
        'model_type',
        'model_id',
        'old_values',
        'new_values',
        'description',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function log(string $action, $model, ?array $oldValues = null, ?array $newValues = null, ?string $description = null): self
    {
        return static::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'model_type' => get_class($model),
            'model_id' => $model->id ?? null,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'description' => $description,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }

    public function getActionLabelAttribute(): string
    {
        return match($this->action) {
            'created' => 'Menambahkan',
            'updated' => 'Mengubah',
            'deleted' => 'Menghapus',
            'transferred' => 'Memindahkan',
            default => $this->action,
        };
    }

    public function getModelNameAttribute(): string
    {
        return match($this->model_type) {
            'App\Models\Asset' => 'Aset',
            'App\Models\Employee' => 'Karyawan',
            'App\Models\Category' => 'Kategori',
            'App\Models\Area' => 'Area',
            'App\Models\Location' => 'Lokasi',
            default => class_basename($this->model_type),
        };
    }

    public function getChangesAttribute(): array
    {
        if ($this->action !== 'updated' || empty($this->old_values) || empty($this->new_values)) {
            return [];
        }

        $changes = [];
        $fieldLabels = $this->getFieldLabels();

        foreach ($this->new_values as $key => $newValue) {
            if (!isset($this->old_values[$key])) continue;
            
            $oldValue = $this->old_values[$key];
            
            // Skip jika tidak ada perubahan
            if ($oldValue == $newValue) continue;
            
            // Skip field yang tidak perlu ditampilkan
            if (in_array($key, ['updated_at', 'updated_by', 'created_at', 'created_by', 'password', 'remember_token'])) continue;

            $label = $fieldLabels[$key] ?? ucfirst(str_replace('_', ' ', $key));
            
            $changes[] = [
                'field' => $label,
                'old' => $this->formatValue($key, $oldValue),
                'new' => $this->formatValue($key, $newValue),
            ];
        }

        return $changes;
    }

    protected function getFieldLabels(): array
    {
        return [
            'asset_tag' => 'Asset Tag',
            'barcode' => 'Barcode',
            'model_number' => 'Nomor Model',
            'manufacturer' => 'Manufaktur',
            'model_name' => 'Nama Model',
            'model_description' => 'Deskripsi Model',
            'category_id' => 'Kategori',
            'area_id' => 'Area',
            'location_id' => 'Lokasi',
            'employee_id' => 'Karyawan',
            'leader_id' => 'Penanggung Jawab',
            'serial_number' => 'Serial Number',
            'purchase_date' => 'Tanggal Pembelian',
            'purchase_cost' => 'Harga Pembelian',
            'warranty_expiry' => 'Garansi Berakhir',
            'status' => 'Status',
            'is_used' => 'Digunakan',
            'notes' => 'Catatan',
            'image' => 'Gambar',
            'name' => 'Nama',
            'email' => 'Email',
            'department' => 'Departemen',
            'position' => 'Posisi',
            'phone' => 'Telepon',
            'is_active' => 'Aktif',
            'description' => 'Deskripsi',
            'code' => 'Kode',
            'address' => 'Alamat',
            'slug' => 'Slug',
        ];
    }

    protected function formatValue(string $key, $value): string
    {
        if (is_null($value) || $value === '') {
            return '-';
        }

        if (is_bool($value) || $value === '0' || $value === '1') {
            if ($key === 'is_used') {
                return $value ? 'Ya' : 'Tidak';
            }
            if ($key === 'is_active') {
                return $value ? 'Aktif' : 'Tidak Aktif';
            }
        }

        if ($key === 'status') {
            return match($value) {
                'available' => 'Tersedia',
                'in_use' => 'Digunakan',
                'maintenance' => 'Maintenance',
                'retired' => 'Retired',
                'lost' => 'Hilang',
                default => $value,
            };
        }

        if ($key === 'purchase_cost') {
            return 'Rp ' . number_format((float)$value, 0, ',', '.');
        }

        if (in_array($key, ['purchase_date', 'warranty_expiry'])) {
            try {
                return \Carbon\Carbon::parse($value)->format('d M Y');
            } catch (\Exception $e) {
                return $value;
            }
        }

        // Untuk foreign key, coba ambil nama dari relasi
        if (str_ends_with($key, '_id')) {
            return $this->getRelatedName($key, $value);
        }

        return (string) $value;
    }

    protected function getRelatedName(string $key, $id): string
    {
        if (empty($id)) return '-';

        try {
            return match($key) {
                'category_id' => Category::find($id)?->name ?? "ID: {$id}",
                'area_id' => Area::find($id)?->name ?? "ID: {$id}",
                'location_id' => Location::find($id)?->name ?? "ID: {$id}",
                'employee_id' => Employee::find($id)?->name ?? "ID: {$id}",
                'leader_id' => User::find($id)?->name ?? "ID: {$id}",
                'role_id' => Role::find($id)?->name ?? "ID: {$id}",
                default => "ID: {$id}",
            };
        } catch (\Exception $e) {
            return "ID: {$id}";
        }
    }
}
