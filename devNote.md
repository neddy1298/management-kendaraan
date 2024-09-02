
update stok_suku_cadangs because Merge data:
    $sukuCadangs = SukuCadang::all();
    $stokSukuCadangs = StokSukuCadang::orderBy('group_anggaran_id', 'asc')->get();
    foreach ($stokSukuCadangs as $stokSukuCadang) {
        $stokSukuCadang->update([
            'stok' => $stokSukuCadang->stok_awal,
        ]);
    }

    foreach ($sukuCadangs as $sukuCadang) {
        $stokSukuCadang = $stokSukuCadangs->where('id', '=', $sukuCadang->stok_suku_cadang_id)->first();
        $stokSukuCadang->update([
            'stok' => $stokSukuCadang->stok - $sukuCadang->jumlah,
        ]);
    }


if suku cadang dont have tanggal_belanja:
    -- Step 1: Add the column as nullable
    ALTER TABLE `suku_cadangs` ADD `tanggal_belanja` DATE NULL AFTER `total_harga`;

    -- Step 2: Update the new column with data from belanjas table
    UPDATE suku_cadangs sc
    INNER JOIN belanjas b ON sc.belanja_id = b.id
    SET sc.tanggal_belanja = b.tanggal_belanja;

    -- Step 3: Handle any remaining NULL values (if necessary)
    UPDATE suku_cadangs
    SET tanggal_belanja = '1970-01-01'
    WHERE tanggal_belanja IS NULL;

    -- Step 4: Alter the column to NOT NULL (if required)
    ALTER TABLE `suku_cadangs` MODIFY `tanggal_belanja` DATE NOT NULL;

Backup Database:

mysqldump -h dishub-kendaraan.mysql.database.azure.com -P 3306 -u managementKendaraan -p db_kendaraan>db_management_kendaraan.sql