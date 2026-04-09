<?php
try {
    DB::statement("ALTER TABLE users ADD COLUMN role VARCHAR(255) DEFAULT 'user'");
    echo "Column added successfully\n";
} catch (\Exception $e) {
    echo "Column might exist or error: " . $e->getMessage() . "\n";
}

try {
    DB::table('users')->update(['role' => 'user']);
    DB::table('users')->where('email', 'admin@gmail.com')->update(['role' => 'admin']);
    echo "Roles updated!\n";
} catch (\Exception $e) {
    echo "Update error: " . $e->getMessage() . "\n";
}
