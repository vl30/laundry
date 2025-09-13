<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Koneksi Database - Laravel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-scree2e  n py-8">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold text-center mb-6 text-blue-600">
            <i class="fas fa-database mr-2"></i>Test Koneksi Database MySQL
        </h1>

        <div class="bg-blue-50 p-4 rounded-lg mb-6">
            <h2 class="text-lg font-semibold mb-2 text-blue-800">
                <i class="fas fa-info-circle mr-2"></i>Informasi Konfigurasi Database
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4" id="config-info">
                <!-- Will be populated by JavaScript -->
                <div class="animate-pulse bg-gray-200 h-20 rounded"></div>
                <div class="animate-pulse bg-gray-200 h-20 rounded"></div>
                <div class="animate-pulse bg-gray-200 h-20 rounded"></div>
                <div class="animate-pulse bg-gray-200 h-20 rounded"></div>
            </div>
        </div>

        <div class="text-center mb-6">
            <button onclick="testConnection()" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-lg flex items-center justify-center mx-auto">
                <i class="fas fa-plug mr-2"></i> Test Koneksi Database
            </button>
        </div>

        <div id="loading" class="text-center py-4 hidden">
            <div class="inline-flex items-center">
                <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-500 mr-2"></div>
                <span>Menghubungkan ke database...</span>
            </div>
        </div>

        <div id="result" class="p-4 rounded-lg hidden mb-6">
            <h2 class="text-lg font-semibold mb-2">
                <i class="fas fa-clipboard-list mr-2"></i>Hasil Test:
            </h2>
            <pre id="result-content" class="bg-gray-100 p-4 rounded overflow-auto max-h-60"></pre>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-yellow-50 p-4 rounded-lg">
                <h2 class="text-lg font-semibold mb-2 text-yellow-800">
                    <i class="fas fa-exclamation-triangle mr-2"></i>Langkah Troubleshooting
                </h2>
                <ol class="list-decimal pl-5 space-y-2">
                    <li>Pastikan MySQL server berjalan</li>
                    <li>Pastikan database 'laravel' sudah dibuat di MySQL</li>
                    <li>Pastikan username dan password di .env benar</li>
                    <li>Jalankan <code class="bg-gray-200 px-1 rounded">php artisan migrate</code></li>
                    <li>Jalankan <code class="bg-gray-200 px-1 rounded">php artisan config:clear</code></li>
                </ol>
            </div>

            <div class="bg-green-50 p-4 rounded-lg">
                <h2 class="text-lg font-semibold mb-2 text-green-800">
                    <i class="fas fa-wrench mr-2"></i>Perbaikan Cepat
                </h2>
                <div class="space-y-2">
                    <button onclick="runMigration()" class="w-full bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded flex items-center justify-center">
                        <i class="fas fa-table mr-2"></i> Buat Tabel Sessions
                    </button>
                    <button onclick="clearCache()" class="w-full bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded flex items-center justify-center">
                        <i class="fas fa-broom mr-2"></i> Clear Config Cache
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
    function updateConfigInfo(config) {
        const configInfo = document.getElementById('config-info');
        configInfo.innerHTML = `
            <div class="bg-white p-4 rounded-lg border">
                <div class="font-medium text-gray-700">Connection Type:</div>
                <div class="bg-gray-50 p-2 rounded mt-1 font-mono text-sm">${config.connection}</div>
            </div>
            <div class="bg-white p-4 rounded-lg border">
                <div class="font-medium text-gray-700">Host:</div>
                <div class="bg-gray-50 p-2 rounded mt-1 font-mono text-sm">${config.host}:${config.port}</div>
            </div>
            <div class="bg-white p-4 rounded-lg border">
                <div class="font-medium text-gray-700">Database:</div>
                <div class="bg-gray-50 p-2 rounded mt-1 font-mono text-sm">${config.database}</div>
            </div>
            <div class="bg-white p-4 rounded-lg border">
                <div class="font-medium text-gray-700">Username:</div>
                <div class="bg-gray-50 p-2 rounded mt-1 font-mono text-sm">${config.username}</div>
            </div>
        `;
    }

    function testConnection() {
        const loading = document.getElementById('loading');
        const result = document.getElementById('result');
        const resultContent = document.getElementById('result-content');

        loading.classList.remove('hidden');
        result.classList.add('hidden');

        fetch('/test-db-connection')
            .then(response => response.json())
            .then(data => {
                loading.classList.add('hidden');
                result.classList.remove('hidden');

                // Format JSON with indentation for better readability
                resultContent.textContent = JSON.stringify(data, null, 2);

                // Update config info
                if (data.config) {
                    updateConfigInfo(data.config);
                }

                // Update result styling based on status
                result.className = 'p-4 rounded-lg mb-6 ' +
                    (data.status === 'success' ? 'bg-green-100' : 'bg-red-100');
            })
            .catch(error => {
                loading.classList.add('hidden');
                result.classList.remove('hidden');
                result.className = 'p-4 rounded-lg mb-6 bg-red-100';
                resultContent.textContent = 'Error: ' + error.message;
            });
    }

    function runMigration() {
        const loading = document.getElementById('loading');
        loading.classList.remove('hidden');

        fetch('/test-db-connection?migrate=1')
            .then(response => response.json())
            .then(data => {
                loading.classList.add('hidden');
                alert(data.message);
                testConnection();
            })
            .catch(error => {
                loading.classList.add('hidden');
                alert('Error: ' + error.message);
            });
    }

    function clearCache() {
        const loading = document.getElementById('loading');
        loading.classList.remove('hidden');

        fetch('/test-db-connection?clear-cache=1')
            .then(response => response.json())
            .then(data => {
                loading.classList.add('hidden');
                alert(data.message);
                testConnection();
            })
            .catch(error => {
                loading.classList.add('hidden');
                alert('Error: ' + error.message);
            });
    }

    // Run connection test when page loads
    window.onload = testConnection;
</script>
    </div>
</body>
</html>
<?php /**PATH /opt/lampp/htdocs/laundry/resources/views/test-db.blade.php ENDPATH**/ ?>